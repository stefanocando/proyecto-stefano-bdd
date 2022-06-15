CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
cuenta_existe (rutusuario varchar(20), passw varchar(100))

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE


-- definimos nuestra función
BEGIN

    -- verificar si el rut esta registrado
    IF rutusuario, passw IN (SELECT Usuarios.rut, Usuarios.password FROM Usuarios WHERE Usuarios.rut = rutusuario AND Usuarios.password = passw) THEN
         -- se le asigna un nuevo uid (sucesor del mayor ya existente)

        RAISE NOTICE 'hola';
        -- crear relacion
        -- INSERT INTO viveen values(vidmax+1, idmax+1, dirid); 
        return TRUE;
    
    ELSE
        RETURN FALSE;

    END IF;

-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql