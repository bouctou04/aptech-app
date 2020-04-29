<?php
$temps_session = 15;
	$temps_actuel = date("U");
	//$user = $_SESSION['username'];
	
	$req_user_exist = $bdd->prepare('SELECT * FROM en_ligne WHERE id_utilisateur = :id_utilisateur');
	$req_user_exist->execute(array('id_utilisateur' => $_SESSION['id']));
	$user_exist = $req_user_exist->rowCount();

	if($user_exist == 0) {
		$add_user = $bdd->prepare('INSERT INTO en_ligne(id_utilisateur, temps_en_ligne) VALUES(:id_utilisateur, :temps_en_ligne)');
		$add_user->execute(array('id_utilisateur' => $_SESSION['id'], 'temps_en_ligne' => $temps_actuel));
	} else {
		$update_user = $bdd->prepare('UPDATE en_ligne SET temps_en_ligne = :temps_en_ligne WHERE id_utilisateur = :id_utilisateur');
		$update_user->execute(array('temps_en_ligne' => $temps_actuel, 'id_utilisateur' => $_SESSION['id']));
	}

	$session_delete_time = $temps_actuel - $temps_session;
	$del_user = $bdd->prepare('DELETE FROM en_ligne WHERE temps_en_ligne < :temps_en_ligne');
	$del_user->execute(array('temps_en_ligne' => $session_delete_time));

	$user_en_ligne = $bdd->query('SELECT nom_utilisateur FROM en_ligne INNER JOIN Utilisateur ON Utilisateur.id_utilisateur = en_ligne.id_utilisateur');
	// $user_nbr = $user_en_ligne->rowCount();
	// if($user_nbr > 0) {
	// 	while($user_co = $user_en_ligne->fetch()) {
	// 		'<li>'.echo $user_co['nom_utilisateur'];
	// 	}
	// } else {
	// 	echo 'Personne';
	// }
	