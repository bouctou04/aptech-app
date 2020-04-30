<?php
session_start();
	require '../frontend/Form.class.php';
	$form = new Form();
?>
<?php require 'include/header.php' ?>
<?php require 'include/aside.php' ?>
					<div class="col-12 col-lg-9 col-xl-9">
						<h3 class="text-center font-weight-bold">Évaluation</h3>
						<table class="table">
						  <thead class="thead-primary">
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Matière</th>
						      <th scope="col">Enseignant</th>
						      <th scope="col">Note de classe</th>
						      <th scope="col">Note d'examen</th>
						      <th scope="col">Rattrapage</th>
						    </tr>
						  </thead>
						  <tbody>
						    <tr>
						      <th scope="row">1</th>
						      <td>Base de données</td>
						      <td>N. SYLLA</td>
						      <td>12</td>
						      <td>16</td>
						      <td>NON</td>
						    </tr>
						    <tr>
						      <th scope="row">2</th>
						      <td>Réseaux & Système</td>
						      <td>Y. KEITA</td>
						      <td>14</td>
						      <td>17</td>
						      <td>NON</td>
						    </tr>
						    <tr>
						      <th scope="row">3</th>
						      <td>Anglais</td>
						      <td>M.THIAM</td>
						      <td>18</td>
						      <td>17</td>
						      <td>NON</td>
						    </tr>
						    <tr>
						      <th scope="row">4</th>
						      <td>Langage C++</td>
						      <td>N. SYLLA</td>
						      <td>15</td>
						      <td>14</td>
						      <td>NON</td>
						    </tr>
						    <tr>
						      <th scope="row">5</th>
						      <td>Langage JAVA</td>
						      <td>M. DIALLO</td>
						      <td>19</td>
						      <td>13</td>
						      <td>NON</td>
						    </tr>
						  </tbody>
						</table>
						<div class="text-center">
							<p class="font-weight-bold h4">
								Moyenne Générale : 17
							</p>
						</div>
						Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
						cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
						proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
					
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