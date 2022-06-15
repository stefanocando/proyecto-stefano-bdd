CREATE OR REPLACE FUNCTION

-- declaramos la función y sus argumentos
rut_unico (pnombre varchar(100), rut varchar(20), edad int, dir varchar(100), sexo varchar(20), comunan varchar(100))

-- declaramos lo que retorna, en este caso un booleano
RETURNS integer AS $$

-- declaramos las variables a utilizar si es que es necesario
DECLARE
idmax int;
dirid int;
vidmax int;


-- definimos nuestra función
BEGIN

    -- verificar si el rut es unico
    IF rut NOT IN (SELECT Usuarios.rut FROM Usuarios) THEN
         -- se le asigna un nuevo uid (sucesor del mayor ya existente)
        
        IF EXISTS (SELECT direcciones.dirección_id FROM direcciones, comunas WHERE direcciones.dirección = dir AND comunas.nombre = comunan AND comunas.comuna_id = direcciones.comuna_id) THEN

            SELECT INTO idmax
            MAX(usuarios.uid)
            FROM usuarios;

            INSERT INTO usuarios values(idmax+1, pnombre, rut, edad, sexo, '123123'); 

            -- obtener dirección_id de la direccion entregada
            SELECT direcciones.dirección_id INTO dirid
            FROM direcciones , comunas
            WHERE direcciones.dirección = dir AND
            comunas.nombre = comunan AND
            comunas.comuna_id = direcciones.comuna_id;

            SELECT INTO vidmax
            MAX(viveen.vid)
            FROM viveen;

            INSERT INTO viveen values(vidmax+1, idmax+1, dirid); 

             return 1;
        ELSE
            return 2;
        END IF;
    ELSE
        RETURN 0;
    END IF;

-- finalizamos la definición de la función y declaramos el lenguaje
END
$$ language plpgsql