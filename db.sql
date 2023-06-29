-- Quadro
CREATE TABLE IF NOT EXISTS `quadro` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(11) NOT NULL,
    PRIMARY KEY (`id`)
);

-- Triangulo
CREATE TABLE IF NOT EXISTS `triangulo` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `lado1` INT NOT NULL,
    `lado2` INT NOT NULL,
    `lado3` INT NOT NULL,
    `cor` VARCHAR(45) NOT NULL,
    `un` VARCHAR(45) NOT NULL,
    `tipo` VARCHAR(45) NOT NULL,
    `id_quadro` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_quadro`) REFERENCES `quadro` (`id`)
);

-- Circulo
CREATE TABLE IF NOT EXISTS `circulo` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `raio` INT NOT NULL,
    `cor` VARCHAR(45) NOT NULL,
    `un` VARCHAR(45) NOT NULL,
    `id_quadro` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_quadro`) REFERENCES `quadro` (`id`)
);

-- Retangulo
CREATE TABLE IF NOT EXISTS `retangulo` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `largura` INT NOT NULL,
    `altura` INT NOT NULL,
    `cor` VARCHAR(45) NOT NULL,
    `un` VARCHAR(45) NOT NULL,
    `id_quadro` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_quadro`) REFERENCES `quadro` (`id`)
);

-- Quadrado
CREATE TABLE IF NOT EXISTS `quadrado` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `lado` INT NOT NULL,
    `cor` VARCHAR(45) NOT NULL,
    `un` VARCHAR(45) NOT NULL,
    `id_quadro` INT NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`id_quadro`) REFERENCES `quadro` (`id`)
);
