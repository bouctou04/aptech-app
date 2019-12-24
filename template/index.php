<?php
define('WEBROOT', dirname(__FILE__));
define('ROOT', dirname(WEBROOT));
define('DS', DIRECTORY_SEPARATOR);
define('CORE', ROOT.DS.'core');
define('MODEL', ROOT.DS.'model');
define('BASE_URL', dirname(dirname($_SERVER['SCRIPT_NAME'])));
define('BASE_HREF', '<base href="/aptech-app/template/">');

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



		<!-- End website content -->


		<!-- include JavaScript files -->
		<script src="js/jquery.js" type="text/javascript"></script>
		<script src="js/main.js" type="text/javascript"></script>
		<script src="js/app.js" type="text/javascript"></script>
		<!-- End JavaScript files -->
	</body>
</html>