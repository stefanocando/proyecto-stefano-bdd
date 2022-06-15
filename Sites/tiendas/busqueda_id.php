<?php session_start();?>

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
		$pid = $_POST['pid'];

		// reviso que el usuario esté logueado
		if (count($_SESSION, COUNT_RECURSIVE) == 0) {
			$logueado = FALSE;
		}
		else {
			$logueado = TRUE;
			$uid = $_SESSION['uid'];
			$query = "SELECT tienda_vende_producto($tid, $pid);";
			$result = $db -> prepare($query);
			$result -> execute();
			$tienda_vende_producto = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
			$tienda_vende_producto = $tienda_vende_producto[0][0];
			if ($tienda_vende_producto == 1) {
				// La tiende vende el producto
				$query = "SELECT usuario_cobertura_tienda($uid, $tid, $pid);";
				$result = $db -> prepare($query);
				$result -> execute();
				$cobertura = $result -> fetchAll();
				$cobertura = $cobertura[0][0];
				if ($cobertura == -1) {
					$comprado = FALSE;
				}
				else {
					$comprado = TRUE;
					$id_compra = $cobertura;
				}


			}
		}

		
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
				<div class= "card-content"> 	
					
				<?php 
					if ($logueado == FALSE) {
						echo('<label class="label has-text-centered has-text-white is-size-2"> ¡Debes estar logueado para poder comprar! </label>');
					}
					else {
						
						if ($comprado == TRUE){
							echo('<label class="label has-text-centered has-text-white is-size-2"> ¡Compra Exitosa!</label>');
							$query = "SELECT Compras.cid, Usuarios.rut, Tiendas.nombre, Direcciones.dirección, Comunas.nombre, Productos.nombre, ProductosCompra.cantidad FROM Compras, Usuarios, Tiendas, Direcciones, Comunas, ProductosCompra, Productos WHERE Compras.cid = $id_compra AND Compras.uid = Usuarios.uid AND Compras.tid = Tiendas.tid AND Compras.dirección_id = Direcciones.dirección_id AND Direcciones.comuna_id = Comunas.comuna_id AND Compras.cid = ProductosCompra.cid AND ProductosCompra.pid = Productos.pid;";
							$result = $db -> prepare($query);
							$result -> execute();
							$datos_compra = $result -> fetchAll();
							echo('<br>');
							echo('<label class="label has-text-centered has-text-white is-size-4"> Datos de tu compra: </label>');
							echo('<table id = "v1" class="table">');
							echo('<thead> <tr> <th has-text-white> ID Compra</th> <th has-text-white> RUT Usuario </th> <th has-text-white> Nombre Tienda </th> <th has-text-white> Dirección </th> <th has-text-white> Comuna </th> <th has-text-white> Producto </th> <th has-text-white> Cantidad </th></tr> </thead>');

							foreach ($datos_compra as $p) {
								echo ' <tr> <td>' .$p[0] .'</td> <td>' .$p[1] .'</td> <td>' .$p[2] .'</td> <td>' .$p[3] .'</td> <td>' .$p[4] .'</td> <td>' .$p[5] .'</td> <td>' .$p[6] .'</td><tr>';
							}
							echo('</table>');
						}
						else {
							if ($tienda_vende_producto == 1) {
								echo('<label class="label has-text-centered has-text-white is-size-2"> ¡Compra Fallida! La tienda no realiza despachos a tus direcciones registradas. </label>');
							}
							elseif ($tienda_vende_producto == 0){
								echo('<label class="label has-text-centered has-text-white is-size-2"> ¡Compra Fallida! La tienda no vende este producto. </label>');
							}
							$query = "SELECT DISTINCT Tiendas.tid, Tiendas.nombre FROM Tiendas, Despacha, ViveEn, Direcciones, Productos, SeVendeEn WHERE ViveEn.uid = $uid AND Direcciones.dirección_id = ViveEn.dirección_id AND Direcciones.comuna_id = Despacha.comuna_id AND Despacha.tid = Tiendas.tid AND SeVendeEn.tid = Tiendas.tid AND SeVendeEn.pid = Productos.pid AND Productos.pid = $pid;";
							$result = $db -> prepare($query);
							$result -> execute();
							$tiendas_q_si_venden = $result -> fetchAll();
							$cont = 0;
							foreach ($tiendas_q_si_venden as $t) {
								$cont = $cont + 1;
							}
							if ($cont == 0){
								echo('<br>');
								echo('<label class="label has-text-centered has-text-white is-size-4"> Lamentablemente, no existen tiendas que vendan este producto y que despachen a tu comuna. Perdónanos. </label>');
							}
							else{
								echo('<br>');
								echo('<label class="label has-text-centered has-text-white is-size-4"> Sin embargo, ¡encontramos las siguientes tiendas que venden el MISMO PRODUCTO y que SÍ DESPACHAN A TU COMUNA! </label>');
								echo('<table id = "v1" class="table">');
								echo('<thead> <tr> <th class = "title has-text-white has-text-centered is-size-4"> Nombre Tienda</th> <th class = "title has-text-white has-text-centered is-size-4"> </th> </tr> </thead>');
								foreach ($tiendas_q_si_venden as $p) {
									echo ' <tr> <td>' .$p[1] .'</td> <td><a href="http://codd.ing.puc.cl/~grupo94/tiendas/show.php?tid= ' .$p[0] .'&tnombre=' .$p[1] .'" ><button class="button is-link">Ver</button> </a></td> <tr>';
									}
								echo('</table>');
							}
						}
					}
				?>
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
		<br>
		<br>
		<br>
		<br>
		<?php include('../templates/footer.html'); ?>  
  </body>
</html>

<!--button class="button is-link">Ver</button-->