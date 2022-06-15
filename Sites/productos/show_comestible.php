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
		#caractertísticas producto comestible
		
		$pid = $_GET['pid'];
		$query = "SELECT Productos.nombre, Productos.descripción, Productos.precio FROM Productos WHERE Productos.pid = $pid";
		$result = $db -> prepare($query);
		$result -> execute();
		$dataCollected = $result -> fetchAll();
		$query_conserva = "SELECT ProductosEnConserva.pid FROM ProductosEnConserva";
		$result_conserva = $db -> prepare($query_conserva);
		$result_conserva -> execute();
		$Conserva = $result_conserva -> fetchAll();
		$query_fresco = "SELECT ProductosFrescos.pid FROM ProductosFrescos";
		$result_fresco = $db -> prepare($query_fresco);
		$result_fresco -> execute();
		$Fresco = $result_fresco -> fetchAll();
		$query_congelado = "SELECT ProductosCongelados.pid FROM ProductosCongelados";
		$result_congelado = $db -> prepare($query_congelado);
		$result_congelado -> execute();
		$Congelado = $result_congelado -> fetchAll();
		?>
		<br>
		<br>
		<br>
		<section class="hero">
    		<div class="content">
				<table class="table" id = "v1">
					<thead>
					<tr>
					<th class = "title has-text-white has-text-centered">Nombre</th>
					<th class = "title has-text-white has-text-centered">Descripción</th>
					<th class = "title has-text-white has-text-centered">Precio</th>
					<th></th>
					</tr>
					</thead>
					<tr>
					<?php
					foreach ($dataCollected as $p) {
					echo ' <td class= "has-text-centered">' .$p[0] .'</td> <td class= "has-text-centered">' .$p[1] .'</td> <td class= "has-text-centered">' .$p[2] .'</td> ';
					}			
					foreach ($Conserva as $c) 
						if ($pid == $c[0]){
						echo  '<td><a href="http://codd.ing.puc.cl/~grupo94/productos/conserva.php?pid= '.$pid .'"><button class="button is-link">Ver producto conserva</button> </a></td>';
					}

					foreach ($Fresco as $f) 
						if ($pid == $f[0]){
						echo  '<td><a href="http://codd.ing.puc.cl/~grupo94/productos/fresco.php?pid= '.$pid .'"><button class="button is-link">Ver producto fresco</button> </a></td>';
					}

					foreach ($Congelado as $d) 
						if ($pid == $d[0]){
						echo  '<td><a href="http://codd.ing.puc.cl/~grupo94/productos/congelado.php?pid= '.$pid .'"><button class="button is-link">Ver producto congelado</button> </a></td>';
					}?>
					</tr>
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
		<br>  
		<?php include('../templates/footer.html'); ?>
  	</body>
</html>
