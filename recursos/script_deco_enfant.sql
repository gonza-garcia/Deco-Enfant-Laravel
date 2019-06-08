-- MySQL Workbench Forward Engineering

DROP DATABASE IF EXISTS deco_enfant;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema deco_enfant
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema deco_enfant
-- -----------------------------------------------------


CREATE SCHEMA IF NOT EXISTS `deco_enfant` DEFAULT CHARACTER SET latin1 ;
USE `deco_enfant` ;

-- -----------------------------------------------------
-- Table `deco_enfant`.`sexes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`sexes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`user_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`user_status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`roles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`roles` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`categories`
-- -----------------------------------------------------

CREATE TABLE IF NOT EXISTS `deco_enfant`.`categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;

ALTER TABLE `deco_enfant`.`categories`
  ADD UNIQUE INDEX `ui_categories_name` (`id` ASC, `name` ASC) ;

-- -----------------------------------------------------
-- Table `deco_enfant`.`sub_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `deco_enfant`.`colors`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`colors` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `deco_enfant`.`sizes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`sizes` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(25) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `deco_enfant`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `short_desc` VARCHAR(150) NULL DEFAULT NULL,
  `long_desc` TEXT NULL DEFAULT NULL,
  `price` DECIMAL(8,2) NOT NULL,
  `thumbnail` VARCHAR(255) NOT NULL,
  `color_id` INT(11) NULL DEFAULT NULL,
  `size_id` INT(11) NULL DEFAULT NULL,
  `stock` INT(11) NOT NULL,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT NOW(),
  `discount` DECIMAL(5,2) NULL DEFAULT NULL,
  `category_id` INT(11) NOT NULL,
  `sub_category_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `products_ibfk_2`
    FOREIGN KEY (`category_id`)
    REFERENCES `deco_enfant`.`categories` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `products_ibfk_3`
    FOREIGN KEY (`size_id`)
    REFERENCES `deco_enfant`.`sizes` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `products_ibfk_4`
    FOREIGN KEY (`color_id`)
    REFERENCES `deco_enfant`.`colors` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

ALTER TABLE `products`
  ADD INDEX `products_i2` (`category_id`),
  ADD INDEX `products_i4` (`color_id`);
  
ALTER TABLE `products`
  ADD INDEX `fk_products_sub_categories1_idx` (`sub_category_id` ASC) ,
  ADD CONSTRAINT `fk_products_sub_categories1`
    FOREIGN KEY (`sub_category_id`)
    REFERENCES `deco_enfant`.`sub_categories` (`id`)
    ON UPDATE NO ACTION,
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `deco_enfant`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(50) NOT NULL,
  `first_name` VARCHAR(80) NULL DEFAULT NULL,
  `last_name` VARCHAR(80) NULL DEFAULT NULL,
  `date_of_birth` DATE NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  `pass` VARCHAR(250) NOT NULL,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT NOW(),
  `sex_id` INT(11) NULL DEFAULT NULL,
  `user_status_id` INT(11) NOT NULL,
  `role_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

ALTER TABLE `users`  
  ADD UNIQUE INDEX `user_email` (`email` ASC),
  ADD UNIQUE INDEX `user_username` (`user_name` ASC) ,
  ADD INDEX `users_ibfk_2` (`user_status_id` ASC) ,
  ADD INDEX `users_ibfk_3` (`role_id` ASC) ,
  ADD INDEX `users_ibfk_1` (`sex_id` ASC) ,
  ADD  CONSTRAINT `users_ibfk_1`
    FOREIGN KEY (`sex_id`)
    REFERENCES `deco_enfant`.`sexes` (`id`)
    ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2`
    FOREIGN KEY (`user_status_id`)
    REFERENCES `deco_enfant`.`user_status` (`id`)
    ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3`
    FOREIGN KEY (`role_id`)
    REFERENCES `deco_enfant`.`roles` (`id`)
    ON UPDATE CASCADE;
  
-- -----------------------------------------------------
-- Table `deco_enfant`.`countries`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`countries` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `deco_enfant`.`provinces`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`provinces` (
  `id` INT(11) NOT NULL,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

-- -----------------------------------------------------
-- Table `deco_enfant`.`adresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`addresses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `street` VARCHAR(100) NOT NULL,
  `street_2` VARCHAR(100) NULL DEFAULT NULL,
  `number` VARCHAR(15) NULL DEFAULT NULL,
  `piso` VARCHAR(10) NULL DEFAULT NULL,
  `dpto` VARCHAR(10) NULL DEFAULT NULL,
  `cp` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `country_id` INT(11) NOT NULL,
  `province_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`));
  
  ALTER TABLE `deco_enfant`.`addresses`
  ADD INDEX `adresses_ibfk_1` (`user_id` ASC) ,
  ADD INDEX `fk_adresses_countries1_idx` (`country_id` ASC) ,
  ADD INDEX `fk_adresses_provinces1_idx` (`province_id` ASC) ,
  ADD CONSTRAINT `adresses_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `deco_enfant`.`users` (`id`)
    ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_adresses_countries1`
    FOREIGN KEY (`country_id`)
    REFERENCES `deco_enfant`.`countries` (`id`)
    ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_adresses_provinces1`
    FOREIGN KEY (`province_id`)
    REFERENCES `deco_enfant`.`provinces` (`id`)
    ON UPDATE NO ACTION,
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`shipping_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`shipping_status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`order_status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`order_status` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 1
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`orders`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `number` INT(11) NULL DEFAULT NULL,
  `product_id` INT(11) NOT NULL,
  `product_qty` INT(11) NOT NULL,
  `product_price_unit` DECIMAL(8,2) NOT NULL,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT NOW(),
  `order_status_id` INT(11) NOT NULL,
  `shipping_status_id` INT(11) NULL DEFAULT NULL,
  `user_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `orders_ibfk_2` (`order_status_id` ASC) ,
  INDEX `orders_ibfk_3` (`product_id` ASC) ,
  INDEX `orders_ibfk_4` (`user_id` ASC) ,
  INDEX `orders_ibfk_1` (`shipping_status_id` ASC) ,
  CONSTRAINT `orders_ibfk_1`
    FOREIGN KEY (`shipping_status_id`)
    REFERENCES `deco_enfant`.`shipping_status` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `orders_ibfk_2`
    FOREIGN KEY (`order_status_id`)
    REFERENCES `deco_enfant`.`order_status` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `orders_ibfk_3`
    FOREIGN KEY (`product_id`)
    REFERENCES `deco_enfant`.`products` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `orders_ibfk_4`
    FOREIGN KEY (`user_id`)
    REFERENCES `deco_enfant`.`users` (`id`)
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


use deco_enfant;


rename table order_status to order_statuses;
rename table shipping_status to shipping_statuses;
rename table user_status to user_statuses;



-- ----------------------------------------------------
-- -------------------Order Statuses----------------------------

INSERT INTO order_statuses VALUES (1, 'Válido');
INSERT INTO order_statuses VALUES (2, 'Inválido');


-- ----------------------------------------------------
-- -------------------Shipping Statuses----------------------------

INSERT INTO shipping_statuses VALUES (1, 'Enviado');
INSERT INTO shipping_statuses VALUES (2, 'Entregado');


-- ----------------------------------------------------
-- -------------------User_Statuses----------------------------

INSERT INTO user_statuses VALUES (1, 'Activo');
INSERT INTO user_statuses VALUES (2, 'Inactivo');



-- ----------------------------------------------------
-- -------------------Roles----------------------------

INSERT INTO roles VALUES (1, 'Admin');
INSERT INTO roles VALUES (2, 'Usuario');
INSERT INTO roles VALUES (3, 'Invitado');


-- ----------------------------------------------------
-- -------------------Sexes---------------------------

INSERT INTO sexes VALUES (default, 'Femenino');
INSERT INTO sexes VALUES (default, 'Masculino');


-- ----------------------------------------------------
-- -------------------Sizes----------------------------

INSERT INTO sizes VALUES (4, '40x40');
INSERT INTO sizes VALUES (5, '50x50');
INSERT INTO sizes VALUES (6, '60x60');
INSERT INTO sizes VALUES (9, '90x50');
INSERT INTO sizes VALUES (7, '120x70');
INSERT INTO sizes VALUES (8, '120x80');
INSERT INTO sizes VALUES (12, '120x150');
INSERT INTO sizes VALUES (10, '100x100');
INSERT INTO sizes VALUES (13, '130x130');



-- ----------------------------------------------------
-- -------------------Colors---------------------------

INSERT INTO colors VALUES (1, 'Blanco');
INSERT INTO colors VALUES (2, 'Negro');
INSERT INTO colors VALUES (3, 'Azul');
INSERT INTO colors VALUES (4, 'Rojo');
INSERT INTO colors VALUES (5, 'Amarillo');
INSERT INTO colors VALUES (6, 'Verde');
INSERT INTO colors VALUES (7, 'Naranja');
INSERT INTO colors VALUES (8, 'Marrón');
INSERT INTO colors VALUES (9, 'Violeta');
INSERT INTO colors VALUES (10, 'Rosa');


-- ----------------------------------------------------
-- --------------Categories----------------------------

INSERT INTO categories VALUES (1, 'Alfombras');
INSERT INTO categories VALUES (2, 'Almohadones');
INSERT INTO categories VALUES (3, 'Bolsas De Dormir');
INSERT INTO categories VALUES (4, 'Muebles');
INSERT INTO categories VALUES (5, 'Puffs');



-- ----------------------------------------------------
-- --------------Sub Categories----------------------------
INSERT INTO sub_categories VALUES (6, 'Tusor Liso');
INSERT INTO sub_categories VALUES (7, 'Estampados');
INSERT INTO sub_categories VALUES (8, 'Tusor Pintados A Mano');

INSERT INTO sub_categories VALUES (9, 'Bancos');
INSERT INTO sub_categories VALUES (10, 'Sillones');

INSERT INTO sub_categories VALUES (11, 'Lino');
INSERT INTO sub_categories VALUES (12, 'Playmats');

INSERT INTO sub_categories VALUES (13, 'Grandes');
INSERT INTO sub_categories VALUES (14, 'Pequeños');

INSERT INTO sub_categories VALUES (15, 'Grandes');
INSERT INTO sub_categories VALUES (16, 'Pequeños');


-- ----------------------------------------------------
-- -------------------Products-------------------------

INSERT INTO products 
		VALUES (1,
				'Almohadón Nórdico',
        'Almohadón de pelo de zorro sintético importado.',
        'Almohadón de pelo de zorro sintético importado. Lavable apto para lavarropas. 40x40x20.',
        610,
        './img/articles/almo_001.jpg',
        3,
        4,
        10,
        '2019-04-20',
        NOW(),
        20,
        2,
        6);
        
INSERT INTO products 
		VALUES (2,
				'Almohadón Estampado',
        'Almohadón estampado blanco y negro.',
        'Almohadón estampado blanco y negro. Relleno vellón siliconado. 50x50x20',
        410,
        './img/articles/almo_002.jpg',
        5,
        5,
        10,
        '2019-04-21',
        NOW(),
        0,
        2,
        7);
        
INSERT INTO products 
		VALUES (3,
				'Almohadón Libertad',
        'Almohadón libertad tusor crudo.',
        'Almohadón libertad tusor crudo pintado a mano. 40x40x20. Rosa y Dorado.',
        450,
        './img/articles/almo_003.jpg',
        9,
        4,
        6,
        '2019-04-21',
        NOW(),
        0,
        2,
        8);
        
INSERT INTO products 
		VALUES (4,
				'Banquito Nórdico.',
        'Banquito nórdico con funda de pelo.',
        'Banquito nórdico mini con funda de pelo desmontable. 60x30x30',
        590,
        './img/articles/banq_001.jpg',
        6,
        6,
        8,
        '2019-03-02',
        NOW(),
        5,
        4,
        9);
        
INSERT INTO products 
		VALUES (5,
				'Sillón De Mimbre 2 Cuerpos',
        'Sillón de mimbre 2 cuerpos.',
        'Sillón de mimbre 2 cuerpos. 120x150x80. Blanco.',
        1600,
        './img/articles/banq_002.jpg',
        1,
        12,
        4,
        '2019-03-30',
        NOW(),
        13,
        4,
        10);
        
        
INSERT INTO products 
		VALUES (6,
				'Alfombra De Lino.',
        'Alfombra de lino acolchada.',
        'Alfombra de lino acolchada. 1 metro de diámetro. 100x100.',
        1300,
        './img/articles/alfo_001.jpg',
        3,
        10,
        6,
        '2019-04-10',
        NOW(),
        0,
        1,
        11);
        
INSERT INTO products 
		VALUES (7,
				'Playmat 1.3 metros.',
        'Playmat 1.3 metros de diámetro.',
        'Playmat 1.3 metros de diámetro. 130x130x110.',
        1200,
        './img/articles/alfo_002.jpg',
        1,
        13,
        6,
        '2019-05-02',
        NOW(),
        10,
        1,
        12);
        
        
INSERT INTO products 
		VALUES (8,
				'Puff Grande.',
        'Puff grande de pelo sintético largo.',
        'Puff grande de pelo sintético largo. 120x80x80.',
        1900,
        './img/articles/puff_001.jpg',
        2,
        8,
        8,
        '2019-05-16',
        NOW(),
        30,
        5,
        13);
        
INSERT INTO products 
		VALUES (9,
				'Puff Pequeño.',
        'Puff pequeño de pelo sintético largo.',
        'Puff pequeño de pelo sintético largo. 90x50x50.',
        1500,
        './img/articles/puff_002.jpg',
        8,
        9,
        7,
        '2019-03-10',
        NOW(),
        25,
        5,
        14);
        
INSERT INTO products 
		VALUES (10,
				'Bolsa De Dormir.',
        'Bolsa de dormir grande.',
        'Bolsa de dormir grande super abrigadita de castorino. 120x60x20.',
        2500,
        './img/articles/bols_001.jpg',
        9,
        7,
        6,
        '2019-02-15',
        NOW(),
        14,
        3,
        15);
