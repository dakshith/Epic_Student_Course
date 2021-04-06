CREATE DATABASE `EpicStudent` ;
CREATE TABLE `EpicStudent`.`Student` (
`student_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`first_name` VARCHAR( 250 ) NOT NULL ,
`last_name` VARCHAR( 250 ) NOT NULL ,
`dob` VARCHAR( 45 ) NOT NULL,
`contact` VARCHAR(10) NOT NULL,
 `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;


CREATE TABLE `EpicStudent`.`course` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`course_name` VARCHAR( 250 ) NOT NULL ,
`detail` text NOT NULL , 
 `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP 
) ENGINE = InnoDB;

CREATE TABLE `EpicStudent`.`student_course_mapping` (
`id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`student_id` int NOT NULL ,
`course_id` int NOT NULL , 
 `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    FOREIGN KEY (`student_id`) REFERENCES `student`(`student_id`),
    FOREIGN KEY (`course_id`) REFERENCES `course`(`id`)

) ENGINE = InnoDB;