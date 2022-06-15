CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
tienda_vende_producto (tienda_id int, producto_id int)

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE

-- definimos nuestra función
BEGIN


    
    -- si el id en el argumento no está en la tabla, agregamos el pokemon
    -- notar que ahora debemos agregar el dato de la columna generation en el values a insertar
    IF producto_id IN (SELECT productos.pid from sevendeen,productos where sevendeen.tid = tienda_id and sevendeen.pid = productos.pid ) THEN
        -- retornamos true si la tienda vende el producto
        RETURN TRUE;
    ELSE
        -- y false si la tienda no lo vende
        RETURN FALSE;
    END IF;



-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql