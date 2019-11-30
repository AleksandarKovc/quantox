CREATE TABLE `test`.`grades` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `grade` INT NOT NULL,
  `student_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `student_id_idx` (`student_id` ASC),
  CONSTRAINT `student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `test`.`students` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);