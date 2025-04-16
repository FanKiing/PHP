CREATE DATABASE gestionEtud;

USE gestionEtud;

CREATE TABLE etudiants (
    cef INT PRIMARY KEY,
    fullName VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    github VARCHAR(255),
    filiere VARCHAR(50) NOT NULL,
    image VARCHAR(255),
    genre VARCHAR(10) NOT NULL,
    loisirs TEXT
);
