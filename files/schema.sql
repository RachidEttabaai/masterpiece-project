DROP DATABASE IF EXISTS covid19dashboard;
CREATE DATABASE covid19dashboard charset=utf8;

USE covid19dashboard;

DROP TABLE IF EXISTS Country;
CREATE TABLE Country(
    country_id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
    country_name VARCHAR(256),
    country_slug VARCHAR(256),
    country_code VARCHAR(256),
    latitude FLOAT,
    longitude FLOAT
);


