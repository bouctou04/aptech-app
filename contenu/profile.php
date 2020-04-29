<?php
session_start();
	require '../frontend/Form.class.php';
	$form = new Form();
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<div class="row">
							<div class="col-md-2">
								<div class="pr-2">
							    	<img src="../media/img/FHI.png" class="rounded-pill" width="100">
							    	<a href="#">Modifier la photo de profil</a>
							    </div>
							</div>
							<div class="col-md-3">
								<div>
							    	<h2>Balla Camara</h2>
							    	<span class="opacity-2">@santana</span>
							    </div>
							</div>
							<div class="col-md-3">
								<span class="opacity-2 h3">[ Étudiant ]</span>
							</div>
							<div class="col-md-4">
								<a href="#">Paramètre et confidentialité</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 alert alert-primary text-center">
								Homme
							</div>
							<div class="col-md-2 alert alert-primary text-center">
								22 ans
							</div>
							<div class="col-md-2 alert alert-primary text-center">
								Celibataire
							</div>
						</div>
						<div class="row">
							<div class="col-md-2 alert alert-primary text-center">
								Licence
							</div>
							<div class="col-md-3 alert alert-primary text-center">
								Informatique Génie Logiciel
							</div>
							<div class="col-md-2 alert alert-primary text-center">
								Celibataire
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
					
						<!-- <h3 class="text-center font-weight-bold">Évaluation</h3>
						<table class="table">
						  <thead class="thead-dark">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">First</th>
						      <th scope="col">Last</th>
						      <th scope="col">Handle</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>Mark</td>
						      <td>Otto</td>
						      <td>@mdo</td>
						    </tr>
						    <tr>
						      <th scope="row">2</th>
						      <td>Jacob</td>
						      <td>Thornton</td>
						      <td>@fat</td>
						    </tr>
						    <tr>
						      <th scope="row">3</th>
						      <td>Larry</td>
						      <td>the Bird</td>
						      <td>@twitter</td>
						    </tr>
						  </tbody>
						</table> -->
<?php require 'include/footer.php' ?>