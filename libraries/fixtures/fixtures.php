<?php
require_once '../../libraries/database.php';
$school_fixtures = "INSERT INTO `school` (`id`, `full_name`, `acronym`, `sign_date`) VALUES (NULL, 'APTECH MALI', 'APTECH-MALI', '2020-04-02'), (NULL, 'Technolab ISTA', 'Technolab ISTA', '2020-04-30')";
$user_category = "INSERT INTO `user_category` (`id`, `field`) VALUES ('', 'super_admin'), ('', 'admin'), ('', 'teacher'), ('', 'student')";
$fixtures = get_pdo()->prepare($school_fixtures);