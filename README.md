# MySQL database setup

CREATE USER 'emails'@'localhost' IDENTIFIED BY 'emails_password';

CREATE DATABASE emails;

GRANT ALL PRIVILEGES ON emails.* TO 'emails'@'localhost';

USE emails;

CREATE TABLE addresses ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, email VARCHAR(50));