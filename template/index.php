<?php
define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('MODEL', ROOT.DS.'model');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('BASE_HREF', '<base href="/aptech-app/template/">');
require MODEL.DS.'User.class.php';
$user1 = new User('Coulibaly', 'Dafé', 'dafe@gmail.com', 'dafe1', '12345678', '12/09/1997');
$user1->setHost('localhost');
$user1->setdbName('bookbook');
$user1->setUsername('root');
$user1->setPassword('');
$user1->setSgbd('mysql');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<?= BASE_HREF; ?>
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<link rel="stylesheet" type="text/css" href="font/css/all.css">
		<title>Aptech-app</title>
	</head>
	<body>
		<!-- Website content -->

		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<form method="POST">
						<div class="form-group">
							<label for="identifiant" class="col-form-label">
								Votre adresse email ou Identifiant
							</label>
							<input type="text" name="identifiant" id="identifiant" class="form-control" placeholder="Votre adresse email ou Identifiant">
							<label for="password" class="col-form-label">
								Votre Mot de passe
							</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Votre Mot de passe">
							<button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
						</div>
						<?php 
							if(isset($error)) { ?> 
							<div class="text-danger text-center">
								<?= $error; ?>
							</div>
						<?php
							}
						?>
					</form>
				</div>
			</div>
		</div>

		<!-- End website content -->


		<!-- include JavaScript files -->
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<script src="js/ap.js" type="text/javascript"></script>
		<!-- End JavaScript files -->
	</body>
</html>