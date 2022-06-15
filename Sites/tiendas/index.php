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
		require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db
		#lista de todas las tiendas
		
		$query = "SELECT tiendas.tid, tiendas.nombre FROM tiendas;";
		$result = $db -> prepare($query);
		$result -> execute();
		$dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
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
					<table id = "v1" class="table">
					<thead>
					<tr>
					<th class = "title has-text-white has-text-centered is-size-3">Tiendas</th>
					<th></th>
					</tr>
					</thead>
					<?php
					foreach ($dataCollected as $p) {
					echo ' <tr><td class="has-text-weight-bold">' .$p[1] .'</td> <td><a href="http://codd.ing.puc.cl/~grupo94/tiendas/show.php?tid= ' .$p[0] .'&tnombre=' .$p[1] .'" ><button class="button is-link">Ver</button> </a></td> <tr>';
					}
					?>
					</table>
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

<!--button class="button is-link">Ver</button-->