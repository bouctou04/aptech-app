<?php
session_start();
if(isset($_SESSION['id']) AND !empty($_SESSION['id']) AND $_SESSION['id'] > 0) {
	$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');
	require '../frontend/Form.class.php';
	$form = new Form();
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Inscription</h3>
						<div class="row">
							<form class="col-12">
								<div class="form-group">
									<button class="btn btn-success w-100">Ajouter un gestionnaire</button>
								</div>
								<div class="form-group">
									<button class="btn btn-success w-100">Ajouter un professeur</button>
								</div>
								<div class="form-group">
									<button class="btn btn-success w-100">Ajouter un étudiant</button>
								</div>
							</form>
						</div>
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
<?php } else { header('Location: ..index.php'); } ?>