CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
usuario_cobertura_tienda (usuario_id int, tienda_id int, producto_id int)

-- declaramos lo que retorna, en este caso un booleano
RETURNS INT AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
id_direccion int;
id_compra int;
id_productoscompra int;

-- definimos nuestra función
BEGIN
    
    -- si el id en el argumento no está en la tabla, agregamos el pokemon
    -- notar que ahora debemos agregar el dato de la columna generation en el values a insertar
    IF EXISTS (SELECT * FROM Despacha, ViveEn, Direcciones WHERE ViveEn.uid = usuario_id AND Direcciones.dirección_id = ViveEn.dirección_id AND Direcciones.comuna_id = Despacha.comuna_id AND Despacha.tid = tienda_id) THEN
        -- Hacer compra

        SELECT INTO id_direccion
        MAX(Direcciones.dirección_id)
        FROM Despacha, ViveEn, Direcciones
        WHERE ViveEn.uid = usuario_id
        AND Direcciones.dirección_id = ViveEn.dirección_id
        AND Direcciones.comuna_id = Despacha.comuna_id
        AND Despacha.tid = tienda_id;

        SELECT INTO id_compra
        MAX(Compras.cid)
        FROM Compras;

        SELECT INTO id_productoscompra
        MAX(ProductosCompra.pc_id)
        FROM ProductosCompra;

        INSERT INTO Compras values(id_compra + 1, usuario_id, tienda_id, id_direccion);

        INSERT INTO ProductosCompra values(id_productoscompra + 1, id_compra + 1, producto_id, 1);

        RETURN id_compra+1;

    ELSE
        RETURN -1;

    END IF;

-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql