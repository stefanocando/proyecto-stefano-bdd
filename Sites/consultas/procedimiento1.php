<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grupo 94 - 121</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="../styles/mystyles.css">
  </head>

  <body>
    <nav class="navbar is-fixed-top" role="navigation" aria-label="main navigation">
      <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
        <a class="navbar-item has-text-white" href="http://codd.ing.puc.cl/~grupo94/index.php?">Inicio</a>
        
        </div>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-link"  href="http://codd.ing.puc.cl/~grupo94/usuarios/sesion.php">
              <strong>Iniciar sesión</strong>
            </a>
            <br>
            <br>
            <a class="button is-light" href="http://codd.ing.puc.cl/~grupo94/usuarios/new.php">
              Registrarse
            </a>
          </div>
        </div>
      </div>
    </nav>    
    <?php

    // Nos conectamos a las bdds
    require("../config/conexion.php");

    // Primero obtenemos todos los usuarios de la tabla que queremos agregar
    $query = "SELECT personal.pid, personal.pnombre, personal.sexo, personal.rut, personal.edad FROM personal, administrativo WHERE personal.pid = administrativo.pid ORDER BY personal.pid;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $personal = $result -> fetchAll();

    foreach ($personal as $perso){

        // Luego construimos las querys con nuestro procedimiento almacenado para ir agregando esas tuplas a nuestra bdd objetivo
        $nombre2 = str_replace("'","''",$perso[1]);
        $sexo2 = str_replace("'","''",$perso[2]);
        $rut2 = str_replace("'","''",$perso[3]);
        $query = "SELECT move_user($perso[0], '$nombre2'::varchar,'$sexo2'::varchar,'$rut2'::varchar,$perso[4]);";


        // Ejecutamos las querys para efectivamente insertar los datos
        $result = $db -> prepare($query);
        $result -> execute();
        $imprimir = $result -> fetchAll();
        $imprimir = $imprimir[0][0];
        if ($imprimir == 0) {
          echo('ERROR');
          echo($perso[0]);
        }

        $query = "SELECT direccion.dnombre, direccion.cnombre FROM personal, unidades, direccion WHERE personal.pid = $perso[0] AND unidades.pid = personal.pid AND unidades.did = direccion.did;";

        // Ejecutamos las querys para efectivamente insertar los datos
        $result = $db2 -> prepare($query);
        $result -> execute();
        $direcciones = $result -> fetchAll();

        foreach ($direcciones as $direccion){
            $dnombre2 = str_replace("'","''",$direccion[0]);
            $cnombre2 = str_replace("'","''",$direccion[1]);
            $query = "SELECT agregar_direccion('$rut2'::varchar, '$dnombre2'::varchar,'$cnombre2'::varchar);";
            // Ejecutamos las querys para efectivamente insertar los datos
            $result = $db -> prepare($query);
            $result -> execute();
            $imprimir = $result -> fetchAll();
        }
    }

    // Ahora se realiza para los administrativos no administrativos
    $query = "SELECT personal.pid, personal.pnombre, personal.sexo, personal.rut, personal.edad FROM personal, otros  WHERE personal.pid = otros.pid ORDER BY personal.pid;";
    $result = $db2 -> prepare($query);
    $result -> execute();
    $personal = $result -> fetchAll();


    foreach ($personal as $perso){

      // Luego construimos las querys con nuestro procedimiento almacenado para ir agregando esas tuplas a nuestra bdd objetivo
      $nombre2 = str_replace("'","''",$perso[1]);
      $sexo2 = str_replace("'","''",$perso[2]);
      $rut2 = str_replace("'","''",$perso[3]);
      $query = "SELECT move_user($perso[0], '$nombre2'::varchar,'$sexo2'::varchar,'$rut2'::varchar,$perso[4]);";


      // Ejecutamos las querys para efectivamente insertar los datos
      $result = $db -> prepare($query);
      $result -> execute();
      $imprimir = $result -> fetchAll();
      $imprimir = $imprimir[0][0];
      if ($imprimir == 0) {
        echo('ERROR');
        echo($perso[0]);
      }

      $query = "SELECT direccion.dnombre, direccion.cnombre FROM personal, otros, unidades, direccion WHERE personal.pid = $perso[0] AND otros.pid = personal.pid AND otros.unidad = unidades.uid AND unidades.did = direccion.did;";

      // Ejecutamos las querys para efectivamente insertar los datos
      $result = $db2 -> prepare($query);
      $result -> execute();
      $direcciones = $result -> fetchAll();

      foreach ($direcciones as $direccion){
          $dnombre2 = str_replace("'","''",$direccion[0]);
          $cnombre2 = str_replace("'","''",$direccion[1]);
          $query = "SELECT agregar_direccion('$rut2'::varchar, '$dnombre2'::varchar,'$cnombre2'::varchar);";
          // Ejecutamos las querys para efectivamente insertar los datos
          $result = $db -> prepare($query);
          $result -> execute();
          $imprimir = $result -> fetchAll();
      }
  }

    ?>
    <br>
    <br>
    <br>
    <section class="hero">
        <div class="columns">
            <div class="column">
            </div>
            <div class="column">  
                <div class="card-content"> 
                    <div class="field">
                    <p class="title has-text-centered has-text-white">
                        ¡La importación del personal administrativo se ha realizado!
                    </p>
                    <br>
                    <label class="label has-text-centered has-text-white">¿Quieres ver el personal administrativo?</label>
                    <div class="control has-text-centered has-text-white">
                        <a  href="http://codd.ing.puc.cl/~grupo94/consultas/procedimiento_personal.php">
                        <button class="button is-link">Ver</button>
                        </a>
                    </div>
                    </div>
                    <br>       

                    <div class="field">
                    <label class="label has-text-centered has-text-white">¿Quieres ver todos los usuarios?</label>
                    <div class="control has-text-centered has-text-white">
                        <a  href="http://codd.ing.puc.cl/~grupo94/consultas/procedimiento_usuarios.php">
                        <button class="button is-link">Ver</button>
                        </a>
                    </div>
                    </div>
                </div>
            </div>
            <div class="column">
            </div>
        </div>
    </section>
    <br>
    <br>               
    <br>
    <br>
    <br>
    <br>  
    <?php include('../templates/footer.html'); ?>
  </body>
</html>

