DROP DATABASE IF EXISTS test_db;
CREATE DATABASE quizy;
USE quizy;
DROP TABLE IF EXISTS big_questions;
CREATE TABLE big_questions ( id INT, name VARCHAR(50)) DEFAULT CHARACTER SET=utf8;
INSERT INTO big_questions VALUES (1,'東京の難読地名クイズ');