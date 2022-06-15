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
		#Llama a conexión, crea el objeto PDO y obtiene la variable $db
		#consulta 3: Seleccione un tipo de producto. Muestre todas las tiendas que venden al menos un producto de dicha categoría.
		require("../config/conexion.php");

		$tipo = $_POST["producto_elegido"];

		$query = "SELECT Tiendas.nombre, Tiendas.tid FROM (
			SELECT Tiendas.tid FROM Tiendas, SeVendeEn, ProductosComestibles WHERE Tiendas.tid = SeVendeEn.tid AND SeVendeEn.pid = ProductosComestibles.pid AND '$tipo' = 'categoría Productos Comestibles' UNION
			SELECT Tiendas.tid FROM Tiendas, SeVendeEn, ProductosCongelados WHERE Tiendas.tid = SeVendeEn.tid AND SeVendeEn.pid = ProductosCongelados.pid AND '$tipo'= 'categoría Productos Congelados' UNION
			SELECT Tiendas.tid FROM Tiendas, SeVendeEn, ProductosFrescos WHERE Tiendas.tid = SeVendeEn.tid AND SeVendeEn.pid = ProductosFrescos.pid AND '$tipo' = 'categoría Productos Frescos' UNION
			SELECT Tiendas.tid FROM Tiendas, SeVendeEn, ProductosEnConserva WHERE Tiendas.tid = SeVendeEn.tid AND SeVendeEn.pid = ProductosEnConserva.pid AND '$tipo' = 'categoría Productos En Conserva' UNION
			SELECT Tiendas.tid FROM Tiendas, SeVendeEn, ProductosNoComestibles WHERE Tiendas.tid = SeVendeEn.tid AND SeVendeEn.pid = ProductosNoComestibles.pid AND '$tipo' = 'categoría Productos No Comestibles') AS subconsulta, Tiendas WHERE subconsulta.tid = Tiendas.tid;";
		$result = $db -> prepare($query);
		$result -> execute();
		$tiendas = $result -> fetchAll();
		?>	
		<br>
		<br>
		<section class="hero">
			<div class="columns">
				<div class="column">
				</div>
				<div class="column">
					<!--label id = "v1" class = " title has-text-white has-text-centered is-size-4"> Tiendas que venden productos de la  <?php echo $tipo; ?></label-->  		
					<br>
					<br>
					<br>
					<table id = "v1" class="table">
					<thead>
						<tr>
						<th class= "has-text-white has-text-centered is-size-4">Tiendas que venden productos de la  <?php echo $tipo; ?></th>
						<th></th>
						</tr>
					</thead>
					<?php  
						foreach ($tiendas as $tienda) {
							echo '<tr> <td class= "has-text-weight-bold">'.$tienda[0].'</td><td><a href="http://codd.ing.puc.cl/~grupo94/tiendas/show.php?tid= ' .$tienda[1] .'&tnombre=' .$tienda[0] .'" ><button class="button is-link">Ver</button> </a></td> <tr>';
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
		<br>
		<br>
		<br>
		<?php include('../templates/footer.html'); ?>
  	</body>
</html>



  
