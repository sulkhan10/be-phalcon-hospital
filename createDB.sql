CREATE DATABASE IF NOT EXISTS db_hospital;

USE db_hospital;

CREATE TABLE IF NOT EXISTS Patient (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    sex ENUM('Male', 'Female', 'Other') NOT NULL,
    religion VARCHAR(50) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address VARCHAR(255) NOT NULL,
    nik VARCHAR(20) NOT NULL UNIQUE
);