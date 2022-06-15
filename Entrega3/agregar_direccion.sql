CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
agregar_direccion (rut_usuario varchar(20), nombre_direccion varchar(100), nombre_comuna varchar(100))

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
idmax int;
id_comuna int;
id_direccion int;
id_usuario int;

-- definimos nuestra función
BEGIN

    SELECT INTO id_usuario
    MAX(usuarios.uid)
    FROM usuarios
    WHERE usuarios.rut = rut_usuario;
    
    -- si el id en el argumento no está en la tabla, agregamos el pokemon
    -- notar que ahora debemos agregar el dato de la columna generation en el values a insertar
    IF NOT EXISTS (SELECT * FROM direcciones, comunas WHERE direcciones.dirección = nombre_direccion AND direcciones.comuna_id = comunas.comuna_id AND comunas.nombre = nombre_comuna) THEN
        -- RETURN 1;
        -- no existe la dirección del personal administrativo en la tabla direcciones, agregarla
        RAISE NOTICE 'A';
        SELECT INTO id_direccion
        MAX(direcciones.dirección_id)
        FROM direcciones;

        id_direccion := id_direccion + 1;

        SELECT INTO id_comuna
        MAX(comunas.comuna_id)
        FROM comunas
        WHERE comunas.nombre = nombre_comuna;

        INSERT INTO direcciones values(id_direccion, nombre_direccion, id_comuna);
    
    ELSE
        -- RETURN 2;
        RAISE NOTICE 'B';
        SELECT INTO id_direccion
        MAX(direcciones.dirección_id)
        FROM direcciones, comunas 
        WHERE direcciones.dirección = nombre_direccion AND direcciones.comuna_id = comunas.comuna_id AND comunas.nombre = nombre_comuna;

    END IF;

    --ahora agregar que este usuario efectivamente vive ahi.
    IF NOT EXISTS (SELECT * FROM viveen WHERE viveen.dirección_id = id_direccion AND viveen.uid = id_usuario) THEN
        --RETURN 3;
        RAISE NOTICE 'C';
        SELECT INTO idmax
        MAX(viveen.vid)
        FROM viveen;

        INSERT INTO viveen values(idmax+1, id_usuario, id_direccion);
        -- retornamos true si se agregó el valor
        RETURN TRUE;
    ELSE 
        --RETURN 4;
        RAISE NOTICE 'D';
        RETURN FALSE;
    END IF;



-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql