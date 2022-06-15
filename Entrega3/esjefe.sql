CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
es_jefe (rutusuario varchar)

-- declaramos lo que retorna, en este caso un booleano
RETURNS BOOLEAN AS $$


-- definimos nuestra función
BEGIN

    IF rutusuario IN (SELECT Personal.rut FROM Personal, Administrativo WHERE Personal.pid = Administrativo.pid) THEN
        return TRUE;
    
    ELSE
        RETURN FALSE;

    END IF;

-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql