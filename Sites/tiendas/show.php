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
		<br>
		<br>
		<?php
		require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db
		#perfil de cada tienda
		$tid = $_GET['tid'];
		$tnombre = $_GET['tnombre'];
		$query = "SELECT Tiendas.nombre FROM Tiendas WHERE Tiendas.tid = $tid;";
		$result = $db -> prepare($query);
		$result -> execute();
		$data = $result -> fetchAll();
		?>
		<br>
		<br>
		<section class="hero">
			<div class="columns">
				<div class="column">
				</div>
				<div class="column">  
					<div class="card-content">
						<div class="field">
						<label class="label has-text-centered has-text-white is-size-2">Bienvenido a <?php echo $tnombre ?> </label>
						<label class="label has-text-centered has-text-white">Productos más baratos</label>
						<?php echo '<a href="http://codd.ing.puc.cl/~grupo94/tiendas/productos_baratos.php?tid= ' .$tid .'&tnombre=' .$tnombre .'">' ?>
						<div class="control has-text-centered has-text-white">
							<button class="button is-link">Ver</button>
						</div>
						</a>
						</div>
						<br>

						<div class="field">
						<label class="label has-text-centered has-text-white">Búsqueda nombre producto: </label>
						<form action="http://codd.ing.puc.cl/~grupo94/tiendas/busqueda_nombre.php?tid= <?php echo $tid ?>" method="post">
							<input class="input is-link" type="text" placeholder="Nombre" name="pnombre">
							<br/><br/>
							<div class="control has-text-centered has-text-white">
								<!--?php echo '<a href="http://codd.ing.puc.cl/~grupo94/tiendas/busqueda_nombre.php?tid= ' .$tid .'">' ?-->
								<button class="button is-link">Ver</button>
							</div>
						</form>
						</div>
						<br>
						<div class="field">
						<label class="label has-text-centered has-text-white">Búsqueda ID producto: </label>
						<form action="http://codd.ing.puc.cl/~grupo94/tiendas/busqueda_id.php?tid= <?php echo $tid ?>" method="post">
							<input class="input is-link" type="text" placeholder="ID" name="pid">
							<br/><br/>
							<div class="control has-text-centered has-text-white">
							<button class="button is-link">Comprar</button>
							</div>
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
		<?php include('../templates/footer.html'); ?>  
  </body>
</html>

