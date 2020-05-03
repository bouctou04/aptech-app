<?php
require_once '../../libraries/Database.php';

$pdo = Database::get_pdo();

$super_users_fixtures = "INSERT INTO `super_users` (`id`, `last_name`, `first_name`, `birth_date`, `sexe`, `username`, `email`, `password`, `accreditation`) VALUES (NULL, 'Maiga', 'Baba', '1990-04-15', 'M', 'bouctou04_2', 'bmaiga04_@gmail.com', '3e2a7b439cc921d678faca6dc14f70c17ed883ea', '2'), (NULL, 'Coulibaly', 'Dafe', '1998-04-08', 'M', 'dafe01', 'dafe_2@gmail.com', '3e2a7b439cc921d678faca6dc14f70c17ed883ea', '0')";
if($super_users_fixtures = $pdo->exec($super_users_fixtures)) {
    print("Load fixtures for super_users is success <br>");
} else {
    print("Load fixtures for super_users is failure <br>");
}

$school_fixtures = "INSERT INTO `school` (`id`, `super_users_id`, `full_name`, `acronym`, `sign_date`) VALUES (NULL, '1', 'Technolab ISTA', 'TECHNOLAB-ISTA', '2020-04-30'), (NULL, '2', 'Aptech Mali', 'APTECH-MALI', '2020-04-30')";
if($school_fixtures = $pdo->exec($school_fixtures)) {
    print("Load fixtures for school is success <br>");
} else {
    print("Load fixtures for school is failure <br>");
}

$user_category_fixtures = "INSERT INTO `user_category` (`id`, `field`) VALUES (NULL, 'admin'), (NULL, 'teacher'), (NULL, 'student')";
if($user_category_fixtures = $pdo->exec($user_category_fixtures)) {
    print("Load fixtures for user_category is success <br>");
} else {
    print("Load fixtures for user_category is failure <br>");
}

$users_fixtures = "INSERT INTO `users` (`id`, `user_category_id`, `school_id`, `last_name`, `first_name`, `birth_date`, `sexe`, `username`, `email`, `password`) VALUES (NULL, '1', '2', 'Camara', 'Maimouna', '1990-04-06', 'F', 'maicam23', 'mai@gmail.com', '3e2a7b439cc921d678faca6dc14f70c17ed883ea'), (NULL, '3', '2', 'Bamba', 'Keleti', '1998-04-07', 'M', 'bamba', 'bamaba@gmail.com', '3e2a7b439cc921d678faca6dc14f70c17ed883ea')";
if($users_fixtures = $pdo->exec($users_fixtures)) {
    print("Load fixtures for users is success <br>");
} else {
    print("Load fixtures for users is failure <br>");
}

$articles_fixtures = "INSERT INTO `articles` (`id`, `users_id`, `subject`, `content`, `send_date`, `file`) VALUES (NULL, '1', 'Examen session de juin 2017', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aspernatur beatae blanditiis commodi cum, deleniti deserunt ea exercitationem in incidunt magnam maxime necessitatibus nulla odio quidem quod sed. Animi, doloremque!\r\n', '2020-04-30 22:51:15', NULL), (NULL, '1', 'Examen session de juin 2019', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Alias aspernatur beatae blanditiis commodi cum, deleniti deserunt ea exercitationem in incidunt magnam maxime necessitatibus nulla odio quidem quod sed. Animi, doloremque!\r\n', '2020-04-30 22:51:15', NULL)";
if($articles_fixtures = $pdo->exec($articles_fixtures)) {
    print("Load fixtures for article is success <br>");
} else {
    print("Load fixtures for article is failure <br>");
}


$category_comment_fixtures = "INSERT INTO `comment_category` (`id`, `field`) VALUES (NULL, 'article'), (NULL, 'forum')";
if($category_comment_fixtures = $pdo->exec($category_comment_fixtures)) {
    print("Load fixtures for category_comment is success");
} else {
    print("Load fixtures for category_comment is failure");
}

$comments_fixtures = "INSERT INTO `comments` (`id`, `comment_category_id`, `user_id`, `article_id`, `content`, `pub_date`) VALUES (NULL, '1', '2', '1', 'Très cool', '2020-05-19 05:42:28'), (NULL, '1', '2', '2', 'C\'est trop chiant !', '2020-05-22 01:42:42')";
if($comments_fixtures = $pdo->exec($comments_fixtures)) {

} else {

}