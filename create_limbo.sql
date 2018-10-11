# This file creates the Limbo database. 
# Author: William Esposito, Hannah Youssef 

drop database if exists limbo_db;
create database limbo_db;
use limbo_db;

CREATE TABLE IF NOT EXISTS stuff
(
    id INT,
    description TEXT
);

ALTER TABLE stuff
ADD PRIMARY KEY (id),
ADD color TEXT,
ADD dateFound DATE,
ADD dateLost DATE;

explain stuff;

