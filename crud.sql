CREATE DATABASE crud DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
use crud;
CREATE TABLE people (
    id INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45) NOT NULL,
    cpf VARCHAR(45) NOT NULL,
    rg VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL,
    maritial_status VARCHAR(45) NOT NULL,
    birth_date DATE NOT NULL,
    gender VARCHAR(45) NOT NULL,
    obs VARCHAR(15) DEFAULT NULL,
    PRIMARY KEY(id)
);