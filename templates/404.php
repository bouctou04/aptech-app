<?php
session_start();
	require '../frontend/Form.class.php';
	$form = new Form();
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Recherche</h3>
						<form class="row form">
							<div class="form-group col-11">
								<input type="search" class="form-control" placeholder="Recherche" name="">
							</div>
							<div class="form-group col-1 ml-n5">
								<button class="btn btn-primary"><span class="fa fa-search"></span></button>
							</div>
						</form>
						<div class="col-12 text-center alert alert-danger">
							<div class="h1"><span class="fa fa-times-circle"></span></div>
							<h3 class="font-weight-bold ">Erreur 404 trouvée !</h3>
							<p>Désolé, la page que vous essayez d'atteindre n'est pas disponible</p>
						</div>
						<div class="invisible">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</div>
<?php require 'include/footer.php' ?>