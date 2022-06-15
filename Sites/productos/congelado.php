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
		#caractertísticas producto comestible-congelado
		
		$pid = $_GET['pid'];
		$query = "SELECT Productos.nombre, Productos.descripción, Productos.precio, ProductosComestibles.fecha_expiración, ProductosCongelados.peso FROM Productos, ProductosComestibles, ProductosCongelados WHERE Productos.pid = $pid AND ProductosComestibles.pid = Productos.pid AND ProductosCongelados.pid = Productos.pid;";
		$result = $db -> prepare($query);
		$result -> execute();
		$dataCollected = $result -> fetchAll();
		?>
		<br>
		<br>
		<br>
		<section class="hero">
			<div class="content">
				<table class="table" id = "v1">
					<thead>
					<tr>
					<th class = "title has-text-white has-text-centered">ID</th>
					<th class = "title has-text-white has-text-centered">Nombre</th>
					<th class = "title has-text-white has-text-centered">Descripción</th>
					<th class = "title has-text-white has-text-centered">Precio</th>
					<th class = "title has-text-white has-text-centered">Fecha expiración</th>
					<th class = "title has-text-white has-text-centered">Peso</th>
					</thead>
					<?php
					foreach ($dataCollected as $p) {
						echo ' <tr><td class = "has-text-centered">' .$pid .'</td><td class = "has-text-centered">'.$p[0].'</td> <td class = "has-text-centered">'.$p[1].'</td> <td class = "has-text-centered">'.$p[2].'</td> <td class = "has-text-centered">'.$p[3].'</td> <td class = "has-text-centered">'.$p[4].'</td></tr>  ';
					}
					?>
				</table>
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
		<br>
		<br>
		<br>  
		<?php include('../templates/footer.html'); ?>
  	</body>
</html>
