<?php
  session_start();
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
		<?php
		require("../config/conexion.php");

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$antes = $_POST['anterior'];
			echo($antes);
			$new = $_POST['nueva'];
			echo($new);
			$session_uid =  $_SESSION['uid'];
			if ($antes == $_SESSION["contra"] ){
				echo "<td>Registrado con exito</td>" ;

				$query = "UPDATE usuarios SET password = '$new' WHERE usuarios.uid =  $session_uid;";
				$result = $db -> prepare($query);
				$result -> execute();
				$result -> fetchAll();
				// $_SESSION['contra'] = $new;
   				session_destroy();
				echo '<script type="text/javascript"> window.location = "http://codd.ing.puc.cl/~grupo94/usuarios/sesion.php" </script>';
			} else {
				echo($antes);
				echo $_SESSION["contra"];
				echo "Contraseña incorrecta";
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
					<div class="card-content has-text-centered">
						<p class="title has-text-centered has-text-white">
						Mi Tienda Web
						</p>
						<p class="subtitle has-text-centered has-text-white">
						Cambiar datos
						</p> 
						<div class="field">
							<form action="cambiar.php" method="post">
								<p class="has-text-white">Contraseña anterior:</p>
								<input type="text" name="anterior" required>
								<br/><br/>
								<p class="has-text-white">Nueva contraseña:</p>
								<input type="text" name="nueva" required>
								<br/><br/>
								<button class="button is-link" required>Cambiar</button>
								<!--input type="submit" value="Cambiar" required-->
							</form>					
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
		<?php include('../templates/footer.html'); ?>
	</body>
</html>