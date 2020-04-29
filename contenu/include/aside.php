<aside class="d-none d-lg-inline d-xl-inline col-3 bg-light border-right">
						<div class="col-md-12">
							<form method="GET" action="recherche.php" class="form">
								<div class="form-group">
									<input type="search" name="w" class="form-control" placeholder="Recherche ...">
								</div>
								<div class="form-group">
									<button type="submit" name="s" class="btn btn-success w-100 font-weight-bold">Rechercher</button>
								</div>
							</form>
						</div>
						<div class="col-md-12">
							<p class="h5 font-weight-bold bg-dark text-light p-2">Activités</p>
							<ul class="">
								<?php
								$req_actu_aside = $bdd->query('SELECT * FROM Article ORDER BY id_article DESC LIMIT 0,5');
								if($req_actu_aside->rowCount() > 0) {
								while($donnees_actu_aside = $req_actu_aside->fetch()) { ?>
								<li>
									<a href="article.php?id=<?= $donnees_actu_aside['id_article'] ?>"><?= $donnees_actu_aside['titre'] ?></a>
								</li>
								<?php }
									} else { ?>
										<li><h3>Pas de contenu</h3></li>
								<?php
									}
								 ?>
							</ul>
						</div>
						<div class="col-md-12">
							<p class="h5 font-weight-bold bg-dark text-light p-2">Notifications</p>
							<ul class="">
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
							</ul>
						</div>
						<div class="col-md-12">
							<p class="h5 font-weight-bold bg-dark text-light p-2">Forum</p>
							<ul class="">
								<?php
									$req_forum_aside = $bdd->query('SELECT id_forum, type_categorie, Forum.id_utilisateur, nom_utilisateur, sujet, contenu, date_pub, resolu FROM Forum INNER JOIN Categorie_Forum ON Forum.id_categorie = Categorie_Forum.id_categorie INNER JOIN Utilisateur ON Forum.id_utilisateur = Utilisateur.id_utilisateur ORDER BY id_forum DESC');
									if($req_forum_aside->rowCount() > 0) {
										while($donnees_forum_aside = $req_forum_aside->fetch()) { ?>
								<li>
									<a href="page.php?id=<?= $donnees_forum_aside['id_forum'] ?>"><?= $donnees_forum_aside['sujet'] ?></a>
								</li>
									<?php }
										} else { ?>
											<li><h3>Pas de contenu</h3></li>
									<?php
										}
									?>
							</ul>
						</div>
						<div class="col-md-12">
							<p class="h5 font-weight-bold bg-dark text-light p-2">Chat Générale</p>
							<ul class="">
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
								<li>
									<a href="#">Examen session de juin prévu ce mardi</a>
								</li>
							</ul>
						</div>
					</aside>
