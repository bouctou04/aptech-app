<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=gestion_universitaire_2;charset=utf8', 'root', '');
$msg = $bdd->query('SELECT nom_utilisateur, id_expediteur, templates, date_envoi FROM Chat INNER JOIN Utilisateur ON Chat.id_expediteur = Utilisateur.id_utilisateur ORDER BY id_chat DESC LIMIT 0,20');
							    		if($msg->rowCount() > 0) {
							    			while($donnees = $msg->fetch()) { 
							    	?>
							    	<td class="row">
							    		<span class="font-weight-bold">
							    			<?php if($_SESSION['id'] == $donnees['id_expediteur']){
							    				echo 'Moi';
							    			} else { ?><a href="ecrire_message.php?id=<?= $donnees['id_expediteur'] ?>"><?php
							    				echo '@'.$donnees['nom_utilisateur'];
							    			} ?>
							    		</a> : </span> 
							    		<span class="opacity-4 pl-2"><?= nl2br($donnees['templates']); ?></span>
							    		<span class="pl-3 opacity-1 small">Il y'a<?= $donnees['date_envoi']; ?></span>
							    	</td>
							    	<?php 
							    			}
							    		} else { ?>
							    	<td class="row text-center">Pas de message</td>
							    	<?php
							    		}
							    	?>