CREATE TABLE `test`.`students` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `school_board_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `school_board_id_idx` (`school_board_id` ASC),
  CONSTRAINT `school_board_id`
    FOREIGN KEY (`school_board_id`)
    REFERENCES `test`.`school_boards` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);