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
-- Table `deco_enfant`.`user_statuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`user_statuses` (
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
  `id_parent` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 15
DEFAULT CHARACTER SET = latin1;

ALTER TABLE `deco_enfant`.`categories`
  ADD UNIQUE INDEX `ui_categories_name` (`id` ASC, `name` ASC) ;


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
  `country_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`));

  ALTER TABLE `deco_enfant`.`provinces`
  ADD INDEX `fk_provinces_countries1_idx` (`country_id` ASC),
  ADD CONSTRAINT `fk_provinces_countries1`
    FOREIGN KEY (`country_id`)
    REFERENCES `deco_enfant`.`countries` (`id`)
    ON UPDATE NO ACTION,
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;




-- -----------------------------------------------------
-- Table `deco_enfant`.`addresses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`addresses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `street` VARCHAR(100) NOT NULL,
  `street_2` VARCHAR(100) NULL DEFAULT NULL,
  `number` VARCHAR(15) NULL DEFAULT NULL,
  `floor` VARCHAR(10) NULL DEFAULT NULL,
  `unit` VARCHAR(10) NULL DEFAULT NULL,
  `postal_code` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `province_id` INT(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`));
  
  ALTER TABLE `deco_enfant`.`addresses`
  ADD INDEX `adresses_ibfk_1` (`user_id` ASC) ,
  ADD INDEX `fk_adresses_provinces1_idx` (`province_id` ASC) ,
  ADD CONSTRAINT `adresses_ibfk_1`
    FOREIGN KEY (`user_id`)
    REFERENCES `deco_enfant`.`users` (`id`)
    ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_adresses_provinces1`
    FOREIGN KEY (`province_id`)
    REFERENCES `deco_enfant`.`provinces` (`id`)
    ON UPDATE NO ACTION,
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`shipping_statuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`shipping_statuses` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `deco_enfant`.`order_statuses`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`order_statuses` (
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
  `product_qty` INT(11) NOT NULL,
  `product_price_unit` DECIMAL(8,2) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `product_id` INT(11) NOT NULL,
  `order_status_id` INT(11) NOT NULL DEFAULT 1,
  `shipping_status_id` INT(11) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT NOW(),
  PRIMARY KEY (`id`),
  INDEX `orders_ibfk_2` (`order_status_id` ASC) ,
  INDEX `orders_ibfk_3` (`product_id` ASC) ,
  INDEX `orders_ibfk_4` (`user_id` ASC) ,
  INDEX `orders_ibfk_1` (`shipping_status_id` ASC) ,
  CONSTRAINT `orders_ibfk_1`
    FOREIGN KEY (`shipping_status_id`)
    REFERENCES `deco_enfant`.`shipping_statuses` (`id`)
    ON UPDATE CASCADE,
  CONSTRAINT `orders_ibfk_2`
    FOREIGN KEY (`order_status_id`)
    REFERENCES `deco_enfant`.`order_statuses` (`id`)
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


-- -----------------------------------------------------
-- Table `deco_enfant`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `deco_enfant`.`products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `short_desc` VARCHAR(150) NULL DEFAULT NULL,
  `long_desc` TEXT NULL DEFAULT NULL,
  `images` VARCHAR(255) NOT NULL,
  `stock` INT(11) NOT NULL,
  `price` DECIMAL(8,2) NOT NULL,
  `discount` DECIMAL(5,2) NULL DEFAULT 0,
  `color_id` INT(11) NOT NULL DEFAULT 1,
  `size_id` INT(11) NOT NULL DEFAULT 1,
  `category_id` INT(11) NOT NULL DEFAULT 1,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT NOW(),
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
  `password` VARCHAR(255) NOT NULL,
  `sex_id` INT(11) NOT NULL DEFAULT 1,
  `user_status_id` INT(11) NOT NULL DEFAULT 1,
  `role_id` INT(11) NOT NULL DEFAULT 3,
  `created_at` TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT NOW(),
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
    REFERENCES `deco_enfant`.`user_statuses` (`id`)
    ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_3`
    FOREIGN KEY (`role_id`)
    REFERENCES `deco_enfant`.`roles` (`id`)
    ON UPDATE CASCADE;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


use deco_enfant;


-- ----------------------------------------------------
-- -------------------Countries----------------------------
INSERT INTO countries VALUES (1,  'Indefinido');
INSERT INTO countries VALUES (2,  'Argentina');
INSERT INTO countries VALUES (3,  'Bolivia');
INSERT INTO countries VALUES (4,  'Brasil');
INSERT INTO countries VALUES (5,  'Colombia');
INSERT INTO countries VALUES (6,  'Chile');
INSERT INTO countries VALUES (7,  'Ecuador');
INSERT INTO countries VALUES (8,  'Paraguay');
INSERT INTO countries VALUES (9,  'Perú');
INSERT INTO countries VALUES (10, 'Uruguay');


-- ----------------------------------------------------
-- -------------------Provinces----------------------------
INSERT INTO provinces VALUES (1,  'Indefinido',          1);    -- Indefinido
INSERT INTO provinces VALUES (2,  'Buenos Aires',        2);    -- Argentina
INSERT INTO provinces VALUES (3,  'Catamarca',           2);
INSERT INTO provinces VALUES (4,  'Chaco',               2);
INSERT INTO provinces VALUES (5,  'Chubut',              2);
INSERT INTO provinces VALUES (6,  'Córdoba',             2);
INSERT INTO provinces VALUES (7,  'Corrientes',          2);
INSERT INTO provinces VALUES (8,  'Entre Ríos',          2);
INSERT INTO provinces VALUES (9,  'Formosa',             2);
INSERT INTO provinces VALUES (10, 'Jujuy',               2);
INSERT INTO provinces VALUES (11, 'La Pampa',            2);
INSERT INTO provinces VALUES (12, 'La Rioja',            2);
INSERT INTO provinces VALUES (13, 'Mendoza',             2);
INSERT INTO provinces VALUES (14, 'Misiones',            2);
INSERT INTO provinces VALUES (15, 'Neuquén',             2);
INSERT INTO provinces VALUES (16, 'Río Negro',           2);
INSERT INTO provinces VALUES (17, 'Salta',               2);
INSERT INTO provinces VALUES (18, 'San Juan',            2);
INSERT INTO provinces VALUES (19, 'San Luis',            2);
INSERT INTO provinces VALUES (20, 'Santa Cruz',          2);
INSERT INTO provinces VALUES (21, 'Santa Fe',            2);
INSERT INTO provinces VALUES (22, 'Santiago Del Estero', 2);
INSERT INTO provinces VALUES (23, 'Tierra Del Fuego',    2);
INSERT INTO provinces VALUES (24, 'Tucumán',             2);
INSERT INTO provinces VALUES (25, 'Abel Iturralde',      3);    -- Bolivia
INSERT INTO provinces VALUES (26, 'Abuná',               3);
INSERT INTO provinces VALUES (27, 'Alonso De Ibañez',    3);
INSERT INTO provinces VALUES (28, 'Acre',                4);    -- Brasil-
INSERT INTO provinces VALUES (29, 'Bahia',               4);
INSERT INTO provinces VALUES (30, 'Sao Paulo',           4);
INSERT INTO provinces VALUES (31, 'Caldas',              5);    -- Colombia
INSERT INTO provinces VALUES (32, 'Magdalena',           5);
INSERT INTO provinces VALUES (33, 'Santander',           5);
INSERT INTO provinces VALUES (34, 'Atacama',             6);    -- Chile-
INSERT INTO provinces VALUES (35, 'Coquimbo',            6);
INSERT INTO provinces VALUES (36, 'Valparaíso',          6);
INSERT INTO provinces VALUES (37, 'Bolívar',             7);    -- Ecuador
INSERT INTO provinces VALUES (38, 'Chimborazo',          7);
INSERT INTO provinces VALUES (39, 'Esmeraldas',          7);
INSERT INTO provinces VALUES (40, 'Alto Paraná',         8);    -- Paraguay-
INSERT INTO provinces VALUES (41, 'Boquerón',            8);
INSERT INTO provinces VALUES (42, 'Central',             8);
INSERT INTO provinces VALUES (43, 'Amazonas',            9);    -- Perú
INSERT INTO provinces VALUES (44, 'Arequipa',            9);
INSERT INTO provinces VALUES (45, 'Callao',              9);
INSERT INTO provinces VALUES (46, 'Canelones',          10);    -- Uruguay-
INSERT INTO provinces VALUES (47, 'Colonia',            10);
INSERT INTO provinces VALUES (48, 'Montevideo',         10);


-- ----------------------------------------------------
-- -------------------Order Statuses----------------------------
INSERT INTO order_statuses VALUES (1, 'Indefinido');
INSERT INTO order_statuses VALUES (2, 'Válido');
INSERT INTO order_statuses VALUES (3, 'Inválido');


-- ----------------------------------------------------
-- -------------------Shipping Statuses----------------------------
INSERT INTO shipping_statuses VALUES (1, 'Indefinido');
INSERT INTO shipping_statuses VALUES (2, 'Enviado');
INSERT INTO shipping_statuses VALUES (3, 'En tránsito');
INSERT INTO shipping_statuses VALUES (4, 'Entregado');


-- ----------------------------------------------------
-- -------------------User_Statuses----------------------------
INSERT INTO user_statuses VALUES (1, 'Indefinido');
INSERT INTO user_statuses VALUES (2, 'Activo');
INSERT INTO user_statuses VALUES (3, 'Inactivo');


-- ----------------------------------------------------
-- -------------------Roles----------------------------
INSERT INTO roles VALUES (1, 'Administrador');
INSERT INTO roles VALUES (2, 'Usuario');
INSERT INTO roles VALUES (3, 'Invitado');


-- ----------------------------------------------------
-- -------------------Sexes---------------------------
INSERT INTO sexes VALUES (1, 'Indefinido');
INSERT INTO sexes VALUES (2, 'Femenino');
INSERT INTO sexes VALUES (3, 'Masculino');


-- ----------------------------------------------------
-- -------------------Sizes----------------------------
INSERT INTO sizes VALUES (1, 'Indefinido');
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
INSERT INTO colors VALUES (1, 'Multi');
INSERT INTO colors VALUES (2, 'Blanco');
INSERT INTO colors VALUES (3, 'Negro');
INSERT INTO colors VALUES (4, 'Azul');
INSERT INTO colors VALUES (5, 'Rojo');
INSERT INTO colors VALUES (6, 'Amarillo');
INSERT INTO colors VALUES (7, 'Verde');
INSERT INTO colors VALUES (8, 'Naranja');
INSERT INTO colors VALUES (9, 'Marrón');
INSERT INTO colors VALUES (10, 'Violeta');
INSERT INTO colors VALUES (11, 'Rosa');


-- ----------------------------------------------------
-- --------------Categories----------------------------
INSERT INTO categories VALUES (1, 'Varios',           0);
INSERT INTO categories VALUES (2, 'Alfombras',        0);
INSERT INTO categories VALUES (3, 'Almohadones',      0);
INSERT INTO categories VALUES (4, 'Bolsas De Dormir', 0);
INSERT INTO categories VALUES (5, 'Muebles',          0);
INSERT INTO categories VALUES (6, 'Puffs',            0);
                
INSERT INTO categories VALUES (11, 'Tusor Liso',            3);    -- Subcategorias de Almohadones
INSERT INTO categories VALUES (12, 'Estampados',            3);
INSERT INTO categories VALUES (13, 'Tusor Pintados A Mano', 3);
INSERT INTO categories VALUES (14,  'Bancos',               5);    -- Subcategorias de Muebles
INSERT INTO categories VALUES (15, 'Sillones',              5);
INSERT INTO categories VALUES (16, 'Lino',                  2);    -- Subcategorias de Alfombras
INSERT INTO categories VALUES (17, 'Playmats',              2);
INSERT INTO categories VALUES (18, 'Grandes',               6);    -- Subcategorias de Puffs
INSERT INTO categories VALUES (19, 'Pequeños',              6);
INSERT INTO categories VALUES (20, 'Grandes',               4);    -- Subcategorias de Bolsas De Dormir
INSERT INTO categories VALUES (21, 'Pequeños',              4);


-- ----------------------------------------------------
-- -------------------Products-------------------------
INSERT INTO products VALUES (1,
		'Almohadón Nórdico', 'Almohadón de pelo de zorro sintético importado.',
        'Almohadón de pelo de zorro sintético importado. Lavable apto para lavarropas. 40x40x20.',
        './img/articles/almo_001.jpg',              -- image
        10, 610, 20,                 -- stock, price, discount
		3, 4, 11,					 -- color_id, size_id, category_id
        '2019-04-20', NOW());        -- created_at, updated_at
        
INSERT INTO products VALUES (2,
		'Almohadón Estampado', 'Almohadón estampado blanco y negro.',
        'Almohadón estampado blanco y negro. Relleno vellón siliconado. 50x50x20',
        './img/articles/almo_002.jpg',
        10, 410, 0,
        5, 5, 12,
        '2019-04-21', NOW());
        
INSERT INTO products VALUES (3,
		'Almohadón Libertad', 'Almohadón libertad tusor crudo.',
        'Almohadón libertad tusor crudo pintado a mano. 40x40x20. Rosa y Dorado.',
        './img/articles/almo_003.jpg',
		6, 450, 0,
        9, 4, 13,
        '2019-04-21', NOW());
        
INSERT INTO products VALUES (4,
		'Banquito Nórdico.', 'Banquito nórdico con funda de pelo.',
        'Banquito nórdico mini con funda de pelo desmontable. 60x30x30',
		'./img/articles/banq_001.jpg',
        8, 590, 5,
        6, 6, 14,
        '2019-03-02', NOW());
        
INSERT INTO products VALUES (5,
		'Sillón De Mimbre 2 Cuerpos', 'Sillón de mimbre 2 cuerpos.',
        'Sillón de mimbre 2 cuerpos. 120x150x80. Blanco.',
		'./img/articles/banq_002.jpg',
        4, 1600, 13,
        1, 12, 15,
        '2019-03-30', NOW());
        
INSERT INTO products VALUES (6,
		'Alfombra De Lino.', 'Alfombra de lino acolchada.',
        'Alfombra de lino acolchada. 1 metro de diámetro. 100x100.',
		'./img/articles/alfo_001.jpg',
        6, 1300, 0,
        3, 10, 16,
        '2019-04-10', NOW());
        
INSERT INTO products VALUES (7,
		'Playmat 1.3 metros.', 'Playmat 1.3 metros de diámetro.',
        'Playmat 1.3 metros de diámetro. 130x130x110.',
        './img/articles/alfo_002.jpg',    
        6, 1200, 10,
        1, 13, 17,
        '2019-05-02', NOW());
        
INSERT INTO products VALUES (8,
		'Puff Grande.', 'Puff grande de pelo sintético largo.',
        'Puff grande de pelo sintético largo. 120x80x80.',
		'./img/articles/puff_001.jpg',     
        8, 1900, 30,
        2, 8, 18,
        '2019-05-16', NOW());
        
INSERT INTO products VALUES (9,
		'Puff Pequeño.', 'Puff pequeño de pelo sintético largo.',
        'Puff pequeño de pelo sintético largo. 90x50x50.',
		'./img/articles/puff_002.jpg',
        7, 1500, 25,
        8, 9, 19,
        '2019-03-10', NOW());
        
INSERT INTO products VALUES (10,
		'Bolsa De Dormir.', 'Bolsa de dormir grande.',
        'Bolsa de dormir grande super abrigadita de castorino. 120x60x20.',
        './img/articles/bols_001.jpg',        
        2500, 6, 14,
        9, 7, 20,
        '2019-02-15', NOW());
        

-- ----------------------------------------------------
-- -------------------Usuarios-------------------------