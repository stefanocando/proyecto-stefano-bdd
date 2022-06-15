<?php
  session_start();
?>

<!--?php include('templates/header.html');   ?-->

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
    require("../config/conexion.php");
	$usuario_id = $_SESSION['uid'];
	$query = "SELECT compras.cid, tiendas.nombre, productos.nombre, productoscompra.cantidad, productos.pid  FROM compras, tiendas, productoscompra, productos WHERE compras.tid = tiendas.tid AND productoscompra.cid = compras.cid AND productoscompra.pid = productos.pid AND compras.uid = $usuario_id ORDER BY compras.cid;";
    $result = $db -> prepare($query);
    $result -> execute();
    $historial = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
	$query_comestibles = "SELECT productos.pid FROM productos, productoscomestibles WHERE productos.pid = productoscomestibles.pid";
	$result_comestibles = $db -> prepare($query_comestibles);
    $result_comestibles -> execute();
    $comestibles = $result_comestibles -> fetchAll();
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
	$query_no_comestibles = "SELECT productos.pid FROM productos, productosnocomestibles WHERE productos.pid = productosnocomestibles.pid";
	$result_no_comestibles = $db -> prepare($query_no_comestibles);
    $result_no_comestibles -> execute();
    $no_comestibles = $result_no_comestibles -> fetchAll();
	?>
	
	<br>
	<br>
	<br>
	<section class="hero">
	<div class="columns">
		<div class="column">
		</div>
		<div class="column"> 
			<div class="card-content">  		
			<table id = "v1" class="table has-text-centered">
			<p class="title has-text-centered has-text-white">
			Mi Tienda Web
			</p>
			<br>
			<p class = "title has-text-white has-text-centered is-size-4"> Historial de compras </p>
			<thead>
				<tr>
				<th class= "has-text-white"> ID Compra</th>
				<th class= "has-text-white"> Tienda</th>
				<th class= "has-text-white"> Producto</th>
				<th class= "has-text-white"> Cantidad</th>
				<th></th>
				</tr>
			</thead>
			<?php 
				$id_compra_pasado = -1;
				foreach ($historial as $hist) {
					foreach ($Conserva as $c){
						if ($hist[4] == $c[0]){
							$tipo = 0;
						}
					}
					foreach ($Fresco as $f){
						if ($hist[4] == $f[0]){
							$tipo = 1;
						}
					}
					foreach ($Congelado as $d){
						if ($hist[4] == $d[0]){
							$tipo = 2;
						}
					}
					foreach ($no_comestibles as $no_com ){
						if ($hist[4] == $no_com[0]){
							$tipo = 3;
						}
					}
					if ($id_compra_pasado != $hist[0]) {
						$query = "SELECT COUNT(*)  FROM productoscompra WHERE productoscompra.cid = $hist[0] GROUP BY productoscompra.cid;";
						$result = $db -> prepare($query);
						$result -> execute();
						$cantidad = $result -> fetchAll();
						$cantidad = $cantidad[0][0];
						if ($tipo == 0){
							echo "<tr> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad'> " .$hist[0] ." </td> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad' > " .$hist[1] ."</td> <td> " .$hist[2] ."</td> <td>" .$hist[3] ."</td> <td><a href='http://codd.ing.puc.cl/~grupo94/productos/conserva.php?pid=" .$hist[4] ."' ><button class='button is-link'>Ver</button> </a></td></tr>"; 
						}
						if ($tipo == 1){
							echo "<tr> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad'> " .$hist[0] ." </td> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad' > " .$hist[1] ."</td> <td> " .$hist[2] ."</td> <td>" .$hist[3] ."</td> <td><a href='http://codd.ing.puc.cl/~grupo94/productos/fresco.php?pid=" .$hist[4] ."' ><button class='button is-link'>Ver</button> </a></td></tr>"; 
						}
						if ($tipo == 2){
							echo "<tr> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad'> " .$hist[0] ." </td> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad' > " .$hist[1] ."</td> <td> " .$hist[2] ."</td> <td>" .$hist[3] ."</td> <td><a href='http://codd.ing.puc.cl/~grupo94/productos/congelado.php?pid=" .$hist[4] ."' ><button class='button is-link'>Ver</button> </a></td></tr>"; 
						}
						if ($tipo == 3) {
							echo "<tr> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad'> " .$hist[0] ." </td> <td style= 'vertical-align : middle;text-align:center;' rowspan = '$cantidad' > " .$hist[1] ."</td> <td> " .$hist[2] ."</td> <td>" .$hist[3] ."</td> <td><a href='http://codd.ing.puc.cl/~grupo94/productos/show_no_comestible.php?pid=" .$hist[4] ."' ><button class='button is-link'>Ver</button> </a></td></tr>";  
						}
					}  
					else {
						if ($tipo == 0){
							echo '<tr> <td> ' .$hist[2] .'</td> <td>' .$hist[3] .'</td> <td><a href="http://codd.ing.puc.cl/~grupo94/productos/conserva.php?pid=' .$hist[4] .'" ><button class="button is-link">Ver</button> </a></td></tr>'; 
						}
						if ($tipo == 1){
							echo '<tr> <td> ' .$hist[2] .'</td> <td>' .$hist[3] .'</td> <td><a href="http://codd.ing.puc.cl/~grupo94/productos/fresco.php?pid=' .$hist[4] .'" ><button class="button is-link">Ver</button> </a></td></tr>'; 
						}
						if ($tipo == 2){
							echo '<tr> <td> ' .$hist[2] .'</td> <td>' .$hist[3] .'</td> <td><a href="http://codd.ing.puc.cl/~grupo94/productos/congelado.php?pid=' .$hist[4] .'" ><button class="button is-link">Ver</button> </a></td></tr>'; 
						}
						if ($tipo == 3) {
							echo '<tr>  <td> ' .$hist[2] .'</td> <td>' .$hist[3] .'</td> <td><a href="http://codd.ing.puc.cl/~grupo94/productos/show_no_comestible.php?pid=' .$hist[4] .'" ><button class="button is-link">Ver</button> </a></td></tr>'; 
						}
					}
					$id_compra_pasado = $hist[0];
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
	<?php include('../templates/footer.html'); ?>
  </body>
</html>



  
