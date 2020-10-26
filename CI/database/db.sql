DROP DATABASE IF EXISTS curso;

CREATE DATABASE curso DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE curso;

CREATE TABLE marcas(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    status TINYINT NOT NULL
);

CREATE TABLE modelos(
    id INT PRIMARY KEY AUTO_INCREMENT,
    marca_id INT NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    status TINYINT NOT NULL,
    FOREIGN KEY (marca_id) REFERENCES marcas(id)
);