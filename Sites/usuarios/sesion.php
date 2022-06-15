<?php session_start();?>
<!--?php include('templates/header.html');   ?-->
<?php
	
	#Llama a conexión, crea el objeto PDO y obtiene la variable $db https://living-sun.com/es/php/670728-what-is-the-difference-between-bindparam-and-bindvalue-php-pdo-bindparam-bindvalue.html
	require("../config/conexion.php");
	$booli = True;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$ruts = $_POST['rut'];
		$pass = $_POST['password'];
		$booli = False;
		$query = "SELECT Usuarios.uid, Usuarios.nombre, Usuarios.rut, Usuarios.edad, Usuarios.sexo, Usuarios.password FROM Usuarios WHERE Usuarios.rut =  :elrut";
		$result = $db -> prepare($query);
		$result ->bindValue(':elrut', $ruts);
		$result -> execute();
		$usuariospasswords = $result -> fetchAll();
        foreach ($usuariospasswords as $uspass) {

			if ($uspass[2] == $ruts and $uspass[5] == $pass){
				$booli = True;
					
				$_SESSION['uid'] = $uspass[0];
				$_SESSION['nombre'] = $uspass[1];
				$_SESSION['rut'] = $uspass[2];
				$_SESSION['edad'] = $uspass[3];
				$_SESSION['sexo'] = $uspass[4];
				$_SESSION['contra'] = $uspass[5];
				?>


				<script type="text/javascript">
				window.location.href = 'http://codd.ing.puc.cl/~grupo94/index_logged.php';
				</script>
				<?php
				exit();
			}
        }
	if ($booli == False){
		echo "<td>Rut o contraseña equivocada</td>";
		}
	}	
?>

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
						Ingrese en Mi Tienda Web
						</p>
						<p class="subtitle has-text-centered has-text-white">
						Inicie sesión con sus datos
						</p>
						<?php 
						if ($booli == False){
							echo "<p class='subtitle is-6 has-text-centered has-text-white'> ¡Contraseña equivocada! Intente nuevamente. </p>";
							}
						?>
						<form action="sesion.php" method="post">
							<p class="has-text-white">Rut:</p>
							<input type="text" name="rut" required>
							<br/><br/>
							<p class="has-text-white">Contraseña:</p>
							<input type="text" name="password" required>
							<br/><br/>
							<button class="button is-link" required>Iniciar sesión</button>
							<!--input type="submit" value="Iniciar sesión" required-->
						</form>
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
	
	

