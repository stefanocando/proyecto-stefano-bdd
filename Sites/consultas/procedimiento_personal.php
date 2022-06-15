
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
					<a class="button is-link"  href="http://codd.ing.puc.cl/~grupo94/usuarios/sesion.php"><strong>Iniciar sesión</strong></a>
					<br>
					<br>
					<a class="button is-light" href="http://codd.ing.puc.cl/~grupo94/usuarios/new.php">Registrarse</a>
				</div>
				</div>
			</div>
		</nav>
		
		<?php
		#Llama a conexión, crea el objeto PDO y obtiene la variable $db
		require("../config/conexion.php");

		$query = "SELECT Personal.pnombre, Administrativo.clasificacion FROM Personal,Administrativo WHERE Personal.pid = Administrativo.pid ;";
		$result = $db2 -> prepare($query);
		$result -> execute();
		$administativos = $result -> fetchAll();

		$query = "SELECT Personal.pnombre, Otros.clasificacion FROM Personal,Otros WHERE Personal.pid = Otros.pid ;";
		$result = $db2 -> prepare($query);
		$result -> execute();
		$otros = $result -> fetchAll();
		?>	
		<br>
		<br>
		<br>
		<br>
		<section class="hero">
			<div class="columns">
				<div class="column">
				</div>
				<div class="column">
					<div class="card-content has-text-centered">
					<label align= "center"class = "title has-text-white has-text-centered is-size-4">Personal</label>
					<br>
					<br>  		
					<table id = "v1" class="table">
					<thead>
						<tr>
						<th class= "has-text-white has-text-centered">Nombre</th>
						<th class= "has-text-white has-text-centered">Clasificación</th>
						</tr>
					</thead>
					<?php  
						foreach ($administativos as $usuario) {
							echo '<tr> <td class= "has-text-centered">'.$usuario[0].'</td> <td class= "has-text-centered">'.$usuario[1].'</td> </tr>';
						}
						foreach ($otros as $usuario) {
							echo '<tr> <td class= "has-text-centered">'.$usuario[0].'</td> <td class= "has-text-centered">'.$usuario[1].'</td> </tr>';
						}
					?>
					</table>
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


  
