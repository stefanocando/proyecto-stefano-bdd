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
		<br>
		<br>
		<section class="hero">
			<div class="columns">
				<div class="column">
				</div>
				<div class="column"> 
					<div class="card-content">
						<div class="field">
						<label class="label has-text-centered has-text-white"> ¿Quieres ver todas las tiendas que venden un determinado producto?</label>      
							<form align="center" action="../consultas/consulta_tipo.php" method="post">
								<label class="label has-text-centered has-text-white"> Selecciona un tipo: 
								<div class="select is-link"> 
								<select name="producto_elegido">
									<option>categoría Productos Comestibles</option>
									<option>categoría Productos No Comestibles</option>
									<option>categoría Productos En Conserva</option>
									<option>categoría Productos Frescos</option>
									<option>categoría Productos Congelados</option>
								</select>
								</div>
								</label>
								<div class="control has-text-centered has-text-white">
								<button class="button is-link">Ver</button>
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
		<br> 
		<br>
		<br>
		<br>  
		<?php include('../templates/footer.html'); ?>
  	</body>
</html>

