CREATE TABLE `resorts`.`admin` 
(   `sl` INT NOT NULL AUTO_INCREMENT , 
	`id` INT NOT NULL , `name` VARCHAR(50) NOT NULL , 
	`email` VARCHAR(50) NOT NULL , 
	`pwd` VARCHAR(50) NOT NULL , 
	`pno` VARCHAR(50) NOT NULL , 
	`username` VARCHAR(50) NOT NULL , 
	PRIMARY KEY (`sl`), 
	UNIQUE `id` (`id`)
) 
ENGINE = InnoDB;



CREATE TABLE `resorts`.`users` 
(   `user_id` INT NOT NULL AUTO_INCREMENT , 
	`first_name` VARCHAR(50) NOT NULL , 
	`last_name` VARCHAR(50) NOT NULL , 
	`username` VARCHAR(50) NOT NULL , 
	`email` VARCHAR(50) NOT NULL , 
	`password` VARCHAR(50) NOT NULL , 
	`gender` VARCHAR(10) NOT NULL , 
	`phonenumber` BIGINT(10) NOT NULL , 
	PRIMARY KEY (`user_id`)
)
ENGINE = InnoDB;



CREATE TABLE `resorts`.`rooms` 
(   `sl` INT NOT NULL AUTO_INCREMENT , 
	`roomno` INT(5) NOT NULL , 
	`type` VARCHAR(10) NOT NULL , 
	`uname` VARCHAR(50) NOT NULL , 
	`checkin` DATE NOT NULL , 
	`checkout` DATE NOT NULL , 
	`status` VARCHAR(20) NOT NULL DEFAULT 'Pending' , 
	PRIMARY KEY (`sl`), 
	UNIQUE `roomno` (`roomno`)
) 
ENGINE = InnoDB;

ALTER TABLE `rooms` ADD `price` INT NOT NULL AFTER `status`;



CREATE TABLE `resorts`.`halls` 
(   `sl` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(50) NOT NULL , 
	`username` VARCHAR(25) NOT NULL , 
	`type` VARCHAR(10) NOT NULL , 
	`guest` INT NOT NULL , 
	`pno` BIGINT NOT NULL , 
	`edate` DATE NOT NULL , 
	`etime` TIME NOT NULL , 
	`ftype` VARCHAR(10) NOT NULL , 
	`price` INT NOT NULL , 
	`status` VARCHAR(15) NOT NULL DEFAULT 'pending' , 
	`hallno` INT NOT NULL , 
	PRIMARY KEY (`sl`)
)
ENGINE = InnoDB;



CREATE TABLE `resorts`.`feedbacks` 
(   `sl` INT NOT NULL AUTO_INCREMENT , 
	`name` VARCHAR(50) NOT NULL , 
	`email` VARCHAR(30) NOT NULL , 
	`message` VARCHAR(100) NOT NULL , 
	PRIMARY KEY (`sl`)
) 
ENGINE = InnoDB;