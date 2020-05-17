-- MySQL Script generated by MySQL Workbench
-- sam. 16 mai 2020 22:38:46 GMT
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema aptech_app
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema aptech_app
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `aptech_app` ;
USE `aptech_app` ;

-- -----------------------------------------------------
-- Table `aptech_app`.`user_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`user_category` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`field` VARCHAR(45) NOT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`super_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`super_users` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`last_name` VARCHAR(45) NOT NULL,
`first_name` VARCHAR(45) NOT NULL,
`birth_date` DATE NULL,
`sexe` ENUM("M", "F") NOT NULL DEFAULT 'M',
`username` VARCHAR(45) NOT NULL,
`email` VARCHAR(45) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`accreditation` ENUM("0", "1", "2") NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
UNIQUE INDEX `username_UNIQUE` (`username` ASC),
UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`school`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`school` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`super_users_id` INT UNSIGNED NOT NULL,
`full_name` VARCHAR(255) NOT NULL,
`acronym` VARCHAR(45) NOT NULL,
`sign_date` DATE NOT NULL,
PRIMARY KEY (`id`, `super_users_id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
INDEX `fk_school_super_users1_idx` (`super_users_id` ASC),
CONSTRAINT `fk_school_super_users1`
FOREIGN KEY (`super_users_id`)
REFERENCES `aptech_app`.`super_users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`users` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`user_category_id` INT UNSIGNED NOT NULL,
`school_id` INT UNSIGNED NOT NULL,
`last_name` VARCHAR(45) NOT NULL,
`first_name` VARCHAR(45) NOT NULL,
`birth_date` DATE NOT NULL,
`sexe` ENUM("M", "F") NOT NULL,
`username` VARCHAR(45) NOT NULL DEFAULT 'Unknown',
`email` VARCHAR(45) NOT NULL,
`password` VARCHAR(255) NOT NULL,
`status` VARCHAR(255) NULL,
`profile` VARCHAR(255) NULL,
PRIMARY KEY (`id`, `user_category_id`, `school_id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
UNIQUE INDEX `username_UNIQUE` (`username` ASC),
UNIQUE INDEX `email_UNIQUE` (`email` ASC),
INDEX `fk_users_user_category_idx` (`user_category_id` ASC),
INDEX `fk_users_school1_idx` (`school_id` ASC),
CONSTRAINT `fk_users_user_category`
FOREIGN KEY (`user_category_id`)
REFERENCES `aptech_app`.`user_category` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT `fk_users_school1`
FOREIGN KEY (`school_id`)
REFERENCES `aptech_app`.`school` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`comment_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`comment_category` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`field` ENUM("forum", "article") NOT NULL,
PRIMARY KEY (`id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
UNIQUE INDEX `field_UNIQUE` (`field` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`comments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`comments` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`comment_category_id` INT UNSIGNED NOT NULL,
`user_id` INT UNSIGNED NOT NULL,
`article_id` INT NOT NULL,
`content` TEXT NOT NULL,
`pub_date` TIMESTAMP NOT NULL,
PRIMARY KEY (`id`, `comment_category_id`, `user_id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
INDEX `fk_comments_users1_idx` (`user_id` ASC),
INDEX `fk_comments_comment_category1_idx` (`comment_category_id` ASC),
CONSTRAINT `fk_comments_users1`
FOREIGN KEY (`user_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT `fk_comments_comment_category1`
FOREIGN KEY (`comment_category_id`)
REFERENCES `aptech_app`.`comment_category` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`forum`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`forum` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`users_id` INT UNSIGNED NOT NULL,
`subject` VARCHAR(255) NOT NULL,
`content` TEXT NOT NULL,
`pub_date` TIMESTAMP NOT NULL,
`resolved` TINYINT NOT NULL DEFAULT 0,
`file` VARCHAR(255) NULL,
PRIMARY KEY (`id`, `users_id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
INDEX `fk_forum_users1_idx` (`users_id` ASC),
CONSTRAINT `fk_forum_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`chat`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`chat` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`users_id` INT UNSIGNED NOT NULL,
`content` VARCHAR(255) NOT NULL,
`send_date` TIMESTAMP NOT NULL,
PRIMARY KEY (`id`, `users_id`),
INDEX `fk_chat_users1_idx` (`users_id` ASC),
CONSTRAINT `fk_chat_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`messages`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`messages` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`sender_id` INT UNSIGNED NOT NULL,
`receptor_id` INT NOT NULL,
`content` VARCHAR(255) NOT NULL,
`send_date` TIMESTAMP NOT NULL,
`file` VARCHAR(255) NULL,
`read` TINYINT NOT NULL DEFAULT 0,
PRIMARY KEY (`id`, `sender_id`),
INDEX `fk_message_users1_idx` (`sender_id` ASC),
CONSTRAINT `fk_message_users1`
FOREIGN KEY (`sender_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`articles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`articles` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`users_id` INT UNSIGNED NOT NULL,
`subject` VARCHAR(255) NOT NULL,
`excerpt` VARCHAR(255) NOT NULL,
`content` TEXT NOT NULL,
`send_date` TIMESTAMP NOT NULL,
`file` VARCHAR(255) NULL,
PRIMARY KEY (`id`, `users_id`),
INDEX `fk_article_users1_idx` (`users_id` ASC),
CONSTRAINT `fk_article_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`followers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`followers` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`sender_id` INT UNSIGNED NOT NULL,
`receptor_id` INT UNSIGNED NOT NULL,
`follow_date` TIMESTAMP NOT NULL,
`confirm` TINYINT NOT NULL DEFAULT 0,
PRIMARY KEY (`id`, `sender_id`),
INDEX `fk_followers_users1_idx` (`sender_id` ASC),
CONSTRAINT `fk_followers_users1`
FOREIGN KEY (`sender_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`notifications`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`notifications` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`users_id` INT UNSIGNED NOT NULL,
`subject` VARCHAR(255) NOT NULL,
`content` VARCHAR(255) NOT NULL,
`notify_date` TIMESTAMP NOT NULL,
`read` TINYINT NOT NULL DEFAULT 0,
PRIMARY KEY (`id`, `users_id`),
INDEX `fk_notifications_users1_idx` (`users_id` ASC),
CONSTRAINT `fk_notifications_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`faculty`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`faculty` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`school_id` INT UNSIGNED NOT NULL,
`faculty` VARCHAR(45) NOT NULL,
`level` ENUM("Licence 1", "Licence 2", "Licence 3", "Master 1", "Master 2", "Doctorat") NOT NULL DEFAULT "Licence 1",
`amount` INT NULL,
PRIMARY KEY (`id`, `school_id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
INDEX `fk_faculty_school1_idx` (`school_id` ASC),
CONSTRAINT `fk_faculty_school1`
FOREIGN KEY (`school_id`)
REFERENCES `aptech_app`.`school` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`period`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`period` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`school_id` INT UNSIGNED NOT NULL,
`period` VARCHAR(45) NULL,
PRIMARY KEY (`id`, `school_id`),
INDEX `fk_period_school1_idx` (`school_id` ASC),
CONSTRAINT `fk_period_school1`
FOREIGN KEY (`school_id`)
REFERENCES `aptech_app`.`school` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`user_has_school`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`user_has_school` (
`id` INT NOT NULL AUTO_INCREMENT,
`users_id` INT UNSIGNED NOT NULL,
`faculty_id` INT UNSIGNED NOT NULL,
`period_id` INT UNSIGNED NOT NULL,
PRIMARY KEY (`id`, `users_id`, `faculty_id`, `period_id`),
INDEX `fk_users_has_school_users1_idx` (`users_id` ASC),
INDEX `fk_users_has_school_period1_idx` (`period_id` ASC),
INDEX `fk_users_has_school_faculty1_idx` (`faculty_id` ASC),
CONSTRAINT `fk_users_has_school_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT `fk_users_has_school_period1`
FOREIGN KEY (`period_id`)
REFERENCES `aptech_app`.`period` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT `fk_users_has_school_faculty1`
FOREIGN KEY (`faculty_id`)
REFERENCES `aptech_app`.`faculty` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`online`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`online` (
`id` INT NOT NULL AUTO_INCREMENT,
`users_id` INT UNSIGNED NOT NULL,
`time_online` INT NOT NULL,
PRIMARY KEY (`id`, `users_id`),
INDEX `fk_online_users1_idx` (`users_id` ASC),
CONSTRAINT `fk_online_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`payment`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`payment` (
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`users_id` INT UNSIGNED NOT NULL,
`faculty_id` INT UNSIGNED NOT NULL,
`amount` INT NOT NULL,
`payment_date` DATE NOT NULL,
`type` VARCHAR(45) NULL,
PRIMARY KEY (`id`, `users_id`, `faculty_id`),
UNIQUE INDEX `id_UNIQUE` (`id` ASC),
INDEX `fk_payment_users1_idx` (`users_id` ASC),
INDEX `fk_payment_faculty1_idx` (`faculty_id` ASC),
CONSTRAINT `fk_payment_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT `fk_payment_faculty1`
FOREIGN KEY (`faculty_id`)
REFERENCES `aptech_app`.`faculty` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aptech_app`.`courses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aptech_app`.`courses` (
`id` INT NOT NULL AUTO_INCREMENT,
`domain` VARCHAR(45) NOT NULL,
`faculty_id` INT UNSIGNED NOT NULL,
`users_id` INT UNSIGNED NOT NULL,
`file` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id`, `faculty_id`, `users_id`),
INDEX `fk_courses_faculty1_idx` (`faculty_id` ASC),
INDEX `fk_courses_users1_idx` (`users_id` ASC),
CONSTRAINT `fk_courses_faculty1`
FOREIGN KEY (`faculty_id`)
REFERENCES `aptech_app`.`faculty` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE,
CONSTRAINT `fk_courses_users1`
FOREIGN KEY (`users_id`)
REFERENCES `aptech_app`.`users` (`id`)
ON DELETE CASCADE
ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
