CREATE DATABASE IF NOT EXISTS argonaute;
USE argonaute;
CREATE TABLE members
(
    id TINYINT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(25) NOT NULL
);
INSERT INTO members
(name)
VALUES
("Eleftheria"),
("Gennadios"),
("Lysimachos");