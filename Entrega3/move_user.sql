CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
move_user (pid int, pnombre varchar(100), sexo varchar(20), rut varchar(20), edad int)

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
idmax int;

-- definimos nuestra función
BEGIN

    -- verificar si existe la columna generation, si no existe la agregamos y seteamos todos los valores de esa columna en 1
    IF 'password' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD password varchar(100);
        UPDATE usuarios SET password = '123123';
    END IF;
    
    -- si el id en el argumento no está en la tabla, agregamos el pokemon
    -- notar que ahora debemos agregar el dato de la columna generation en el values a insertar
    IF rut NOT IN (SELECT usuarios.rut from usuarios) THEN

        SELECT INTO idmax
        MAX(usuarios.uid)
        FROM usuarios;

        INSERT INTO usuarios values(idmax+1, pnombre, rut, edad, sexo, '123123');

        -- retornamos true si se agregó el valor
        RETURN TRUE;
    ELSE
        -- y false si no se agregó
        RETURN FALSE;

    END IF;



-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql