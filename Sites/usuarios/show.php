<?php
  session_start();
  $nombre = $_SESSION['nombre'];
  $usuariouid = $_SESSION['uid'];
  $usuariorut = $_SESSION['rut'];
?>

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
        <a class="navbar-item has-text-white" href="http://codd.ing.puc.cl/~grupo94/index_logged.php?">Inicio</a>
        <a class="navbar-item has-text-white" href="http://codd.ing.puc.cl/~grupo94/tiendas/index.php">Tiendas</a>
        <a class="navbar-item has-text-white" href="http://codd.ing.puc.cl/~grupo94/productos/index.php">Productos </a>
        </div>
      </div>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <a class="button is-link"  href="http://codd.ing.puc.cl/~grupo94/usuarios/show.php">
              <strong>Mi perfil</strong>
            </a>
            <a class="button is-light"  href="http://codd.ing.puc.cl/~grupo94/usuarios/logout.php">
              <strong>Salir de sesión</strong>
            </a>
          </div>
        </div>
      </div>
    </nav>    
    <br>
    <br>
    <br>
    <section class="hero">    
      <div class="column" id="v1">
        <div class="box">  
          <div class="panel-block">
            <div class="column">
              <label class="has-text-white">Nombre:</label>
            </div>
            <div class="column text-secondary">
              <label class="has-text-white"><?=$_SESSION['nombre']?></label>
            </div>
          </div>
          <div class="panel-block">
            <div class="column">
              <label class="has-text-white">Edad:</label>
            </div>
            <div class="column text-secondary">
              <label class="has-text-white"><?=$_SESSION['edad']?></label>
            </div>
          </div>
          <div class="panel-block">
            <div class="column">
              <label class="has-text-white">Rut:</label>
            </div>
            <div class="column text-secondary">
              <label class="has-text-white"><?=$_SESSION['rut']?></label>
            </div>
          </div>                 
          <?php
            require("../config/conexion.php");
            $query = "SELECT Direcciones.dirección FROM Usuarios, viveen, direcciones WHERE Usuarios.uid =  :eluid AND Usuarios.uid = viveen.uid AND direcciones.dirección_id = viveen.dirección_id;";
            $result = $db -> prepare($query);
            $result ->bindValue(':eluid', $usuariouid);
            $result -> execute();
            $direccionesuid = $result -> fetchAll();   
            foreach ($direccionesuid as $eso): ?>
              <div class="panel-block"> 
                <div class="column">
                  <label class="has-text-white">Dirección:</label>
                </div>
                <div class="column text-secondary">
                  <label class="has-text-white"><?= $eso[0]; ?></label>
                </div>
              </div>
            <?php endforeach; 
          ?>
        </div>
      </div>
    </div>        
    <div class="columns" id="v1">
      <div class="column is-one-quarter" id="v1">
        <div class="box has-text-centered">
          <label class="label has-text-centered has-text-white">¿Quieres cambiar tu password?</label>
          <div class="control has-text-centered has-text-white">
            <a  href="http://codd.ing.puc.cl/~grupo94/usuarios/cambiar.php">
              <button class="button is-link">Cambiar</button>
            </a>
          </div>
        </div>
      </div>
      <br>
      <div class="column is-two-quarters" id="v1">
        <div class="box has-text-centered">
          <label class="label has-text-centered has-text-white">¿Eres jefe de una unidad?</label>
          <div class="control has-text-centered has-text-white">
            <?php
              $query = "SELECT es_jefe('$_SESSION[rut]')  ;";
              $result = $db2 -> prepare($query);
              $result -> execute();
              $booli = $result -> fetchAll();   
              $booli = $booli[0][0];
              if ($booli === TRUE) {
                $respuesta = "Si. A continuación la dirección de su unidad y el personal administrativo de esta:";
              }
              else{
                $respuesta = "No";
              }
              ?>
            <label class="label has-text-centered has-text-white"> Respuesta: <?= $respuesta; ?></label>
            <br>
            <?php
              if ($booli === TRUE) { 

                $query1 = "SELECT Direccion.dnombre, Direccion.cnombre FROM Direccion, Unidades WHERE Unidades.did = Direccion.did AND Unidades.pid IN (SELECT Personal.pid FROM Personal WHERE Personal.rut = :elrut);";
                $result1 = $db2 -> prepare($query1);
                $result1 ->bindValue(':elrut', $usuariorut );
                $result1 -> execute();
                $sabe = $result1 -> fetchAll();  
                $dnombre = $sabe[0][0];
                $cnombre = $sabe[0][1];

                $query = "SELECT Personal.pid, Personal.pnombre, Personal.sexo, Personal.rut, Personal.edad , Otros.clasificacion FROM Personal, Otros WHERE Personal.pid = Otros.pid AND 
                Personal.pid IN (SELECT Otros.pid FROM Unidades, Personal, Otros WHERE Personal.rut = :elrut AND Unidades.pid = Personal.pid AND Unidades.uid = Otros.unidad);";
                $result = $db2 -> prepare($query);
                $result ->bindValue(':elrut', $usuariorut );
                $result -> execute();
                $piddeotros = $result -> fetchAll();  
                ?>
                <label class="label has-text-centered has-text-white"> Dirección de su unidad: <?= $dnombre; ?>, <?= $cnombre; ?> </label>
                <table id="v1" class='table is-centered has-text-centered'>
              <thead>
                  <tr>
                  <th class="has-text-centered has-text-white">Pid</th>
                  <th class="has-text-centered has-text-white">Nombre</th>
                  <th class="has-text-centered has-text-white">Sexo</th>
                  <th class="has-text-centered has-text-white">Rut</th>
                  <th class="has-text-centered has-text-white">Edad</th>
                  <th class="has-text-centered has-text-white">Clasificación</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  foreach ($piddeotros as $eso) {
                      echo "<tr>";
                      for ($i = 0; $i < 6; $i++) {
                          echo '<td class="has-text-centered has-text-white">'.$eso[$i].'</td>';
                      }
                      echo "</tr>";
                  }
                  ?>
              </tbody>
            </table>
              <?php }
            ?>
          </div>          
        </div>
      </div>
      <br>
      <div class="column is-one-quarter" id="v1">
        <div class="box has-text-centered">
          <div class="field">
            <label class="label has-text-centered has-text-white">¿Quieres ver tu historial de compra?</label>
            <div class="control has-text-centered has-text-white">
              <a  href="http://codd.ing.puc.cl/~grupo94/usuarios/historial_de_compra.php">
                <button class="button is-link">Ver</button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>    
    </section> 
    <br>
    <br>
    <?php include('../templates/footer.html'); ?>
  </body>
</html>