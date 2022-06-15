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

			
		</nav>
		
		<?php
		require("../config/conexion.php");

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$name = str_replace("'","''",$_POST['nombre']);
			$ruts = str_replace("'","''",$_POST['rut']);
			$age = $_POST['edad'];
			$dir = str_replace("'","''",$_POST['direccion']);
			$sex = $_POST['sexo'];
			$comunan = str_replace("'","''",$_POST['comuna']);

			$query = "SELECT rut_unico('$name', '$ruts', $age, '$dir', '$sex',  '$comunan' );";
			$result = $db -> prepare($query);
			$result -> execute();
			$rut_err = $result -> fetchAll();
			$indicador_de_registro = -1;
            foreach ($rut_err as $ruts) {
                echo "<td>$ruts[0]</td> ";
				if ($ruts[0] == '1'){
					$indicador_de_registro = 'Registrado con éxito';
				}
				elseif($ruts[0] == '0'){
					$indicador_de_registro = 'Usuario ya registrado';
				}	
				elseif($ruts[0] == '2'){
					$indicador_de_registro = 'Dirección inválida';
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
					<div class="card-content has-text-centered">
						<p class="title has-text-centered has-text-white">
						Regístrese en Mi Tienda Web
						</p>
						<p class="subtitle has-text-centered has-text-white">
						Sea parte de esta bonita comunidad
						</p> 
						<?php
						if ($_SERVER["REQUEST_METHOD"] == "POST") {
							if ($indicador_de_registro == 'Registrado con éxito') {
								echo('<p class="subtitle has-text-centered has-text-white"> ¡Usuario registrado con éxito! </p>' );
							}
							elseif ($indicador_de_registro == 'Usuario ya registrado') {
								echo('<p class="subtitle has-text-centered has-text-white"> ¡Error! El rut ingresado ya se encuentra ocupado. </p>' );
							}
							elseif ($indicador_de_registro == 'Dirección inválida') {
								echo('<p class="subtitle has-text-centered has-text-white"> ¡Error! La dirección ingresada no existe en nuestra base de datos. </p>' );
							}
						}
						?>
						<div class="field">
							<form action="new.php" method="post">
								<p class="has-text-white">Nombre de usuario:</p>
								<input type="text" name="nombre" required>
								<br/><br/>
								<p class="has-text-white">Rut:</p>
								<input type="text" name="rut" required>
								<br/><br/>
								<p class="has-text-white">Edad:</p>
								<input type="number" name="edad" required>
								<br/><br/>
								<p class="has-text-white">Dirección:</p>
								<input type="text" name="direccion" required>
								<br/><br/>
								<p class="has-text-white" for="sexo">Indica tu sexo:</p>
								<div  class="select is-link">
									<select name="sexo">
										<option value="hombre">Hombre</option>
										<option value="mujer">Mujer</option>
									</select>
								</div>
								<br/><br/>
								<p class="has-text-white">Comuna:</p>
								<input type="text" name="comuna" required>
								<br/><br/>
								<button class="button is-link" required>Registrarse</button>
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
		<?php include('../templates/footer.html'); ?>
	</body>
</html>

<!--a  href="http://codd.ing.puc.cl/~grupo94/index.php?">
	<button class="button is-link" required>Registrarse</button>
</a-->