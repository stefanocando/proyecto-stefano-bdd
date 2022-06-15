<?php
  session_start();
  $nombre = $_SESSION['nombre'];
  $usuariouid = $_SESSION['uid'];
  $usuariorut = $_SESSION['rut'];
?>

<!--?php include('templates/header.html');   ?-->

<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Grupo 94 - 121</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <link rel="stylesheet" href="styles/mystyles.css">
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
      <div class="columns">
        <div class="column">
        </div>
        <div class="column">  
          <div class="card-content"> 
            <p class="title has-text-centered has-text-white">¡Bienvenido, <?php echo $nombre ?>!</p>
            <div class="field">
              <label class="label has-text-centered has-text-white">¿Quieres ver todas las tiendas?</label>
              <div class="control has-text-centered has-text-white">
                <a  href="http://codd.ing.puc.cl/~grupo94/tiendas/index.php">
                  <button class="button is-link">Ver</button>
                </a>
              </div>
            </div>
            <br>
            <div class="field">
              <label class="label has-text-centered has-text-white">¿Quieres ver todos los productos?</label>
              <div class="control has-text-centered has-text-white">
                <a  href="http://codd.ing.puc.cl/~grupo94/productos/index.php">
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
    <br>
    <br>
    <?php include('templates/footer.html'); ?>
  </body>
</html>
