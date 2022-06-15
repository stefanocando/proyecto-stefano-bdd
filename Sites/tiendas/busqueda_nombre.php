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
		$tid = $_GET['tid'];
		$pnombre = $_POST['pnombre'];

		$query = "SELECT productos.pid, productos.nombre, productos.descripción FROM tiendas, productos, productoscomestibles, sevendeen WHERE tiendas.tid = $tid AND tiendas.tid = sevendeen.tid AND sevendeen.pid = productos.pid AND productoscomestibles.pid = productos.pid AND productos.nombre LIKE lower('%$pnombre%');";
		$result = $db -> prepare($query);
		$result -> execute();
		$Comestibles = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
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
		$query = "SELECT productos.pid, productos.nombre, productos.descripción FROM tiendas, productos, productosnocomestibles, sevendeen WHERE tiendas.tid = $tid AND tiendas.tid = sevendeen.tid AND sevendeen.pid = productos.pid AND productosnocomestibles.pid = productos.pid AND productos.nombre LIKE lower('%$pnombre%');";
		$result = $db -> prepare($query);
		$result -> execute();
		$NoComestibles = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
		$tienda = "SELECT tiendas.nombre FROM tiendas WHERE tiendas.tid = $tid ;";
		$result = $db -> prepare($tienda);
		$result -> execute();
		$tienda = $result -> fetchAll();
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
					<div class="card-content is-centered">
						<p class="title has-text-centered has-text-white">
						Productos de <?php echo $tienda[0][0] ?>
						</p>  	
						<table id = "v1" class="table">
							<thead>
								<tr>
									<th class = "title has-text-white has-text-centered is-size-6">Nombre</th>
									<th class = "title has-text-white has-text-centered is-size-6">Descripción </th>
									<th class = "title has-text-white has-text-centered is-size-6">Categoría </th>
									<th> </th>
								</tr>
							</thead>
							<?php
							foreach ($Comestibles as $p) {
								foreach ($Conserva as $c){
									if ($p[0] == $c[0]){
										$tipo = 0;
									}
								}
								foreach ($Fresco as $f){
									if ($p[0] == $f[0]){
										$tipo = 1;
									}
								}
								foreach ($Congelado as $d){
									if ($p[0] == $d[0]){
										$tipo = 2;
									}
								}
								if ($tipo == 0){
									echo ' <tr><td>' .$p[1] .'</td> <td> ' .$p[2] .' </td>  <td> Comestible </td>  <td><a href="http://codd.ing.puc.cl/~grupo94/productos/conserva.php?pid=' .$p[0] .'" ><button class="button is-link">Ver</button> </a></td></tr>';
								}
								if ($tipo == 1){
									echo ' <tr><td>' .$p[1] .'</td> <td> ' .$p[2] .' </td>  <td> Comestible </td>  <td><a href="http://codd.ing.puc.cl/~grupo94/productos/fresco.php?pid=' .$p[0] .'" ><button class="button is-link">Ver</button> </a></td></tr>';
								}
								if ($tipo == 2){
									echo ' <tr><td>' .$p[1] .'</td> <td> ' .$p[2] .' </td>  <td> Comestible </td>  <td><a href="http://codd.ing.puc.cl/~grupo94/productos/congelado.php?pid=' .$p[0] .'" ><button class="button is-link">Ver</button> </a></td></tr>';
								}
							}
							foreach ($NoComestibles as $p) {
								echo ' <tr><td>' .$p[1] .'</td> <td> ' .$p[2] .' </td>  <td> No Comestible </td> <td> <a href="http://codd.ing.puc.cl/~grupo94/productos/show_no_comestible.php?pid=' .$p[0] .'" ><button class="button is-link">Ver</button> </a></td></tr>';
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
		<br>
		<br>
		<br>
		<br>
		<br>
		<?php include('../templates/footer.html'); ?>  
  </body>
</html>

<!--button class="button is-link">Ver</button-->