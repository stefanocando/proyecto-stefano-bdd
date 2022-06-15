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
                ¡Bienvenido a mi Tienda Web!
              </p>
              <br>
              <p class="subtitle has-text-centered has-text-white">
                Inicie sesión o regístrese para encontrar información sobre tiendas y productos.
              </p>
            </div>
            <br>     
            <div class="field">
            <label class="label has-text-centered has-text-white">Importación de personal administrativo</label>
              <div class="control has-text-centered has-text-white">
                <a  href="http://codd.ing.puc.cl/~grupo94/consultas/procedimiento1.php">
                <button class="button is-link">Ver</button>
                </a>
              </div>
            </div>
            <br>
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
    <?php include('templates/footer.html'); ?>
  </body>
</html>
