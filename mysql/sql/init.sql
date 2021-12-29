DROP DATABASE IF EXISTS quiz;
CREATE DATABASE quiz;

USE quiz;

DROP TABLE IF EXISTS big_questions;
CREATE TABLE big_questions
(
  id           INT(50),
  name     VARCHAR(50)
);

INSERT INTO big_questions (id, name) VALUES (1, "東京の難読地名クイズ");
INSERT INTO big_questions (id, name) VALUES (2, "広島県の難読地名クイズ");