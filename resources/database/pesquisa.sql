# Tabela do Techday 2020
CREATE TABLE IF NOT EXISTS `pesquisa` (
    `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    `nome` VARCHAR(250) NOT NULL, 
    `email` VARCHAR(50) NULL, 
    `telefone` VARCHAR(15) NULL, 
    `celular` VARCHAR(14) NULL,
    `created` DATE NOT NULL
);

