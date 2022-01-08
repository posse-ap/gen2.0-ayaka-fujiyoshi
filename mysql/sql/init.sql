DROP DATABASE IF EXISTS quiz;
CREATE DATABASE quiz;

USE quiz;


-- 大問テーブル
DROP TABLE IF EXISTS big_questions;
CREATE TABLE big_questions
(
  id           INT(50),
  name     VARCHAR(50)
);

INSERT INTO big_questions (id, name) VALUES (1, "東京の難読地名クイズ");
INSERT INTO big_questions (id, name) VALUES (2, "広島県の難読地名クイズ");


-- 設問テーブル （写真）
DROP TABLE IF EXISTS questions;
CREATE TABLE questions
(
  id                INT(50),
  big_question_id   INT(50),
  image         VARCHAR(50)
);

INSERT INTO questions (id, big_question_id, image) VALUES (1, 1, "takanawa.png");
INSERT INTO questions (id, big_question_id, image) VALUES (2, 1, "kameido.png");
INSERT INTO questions (id, big_question_id, image) VALUES (3, 2, "mukainada.png");


-- 選択肢テーブル
DROP TABLE IF EXISTS choices;
CREATE TABLE choices
(
  id            INT(50),
  question_id   INT(50),
  name      VARCHAR(50),
  valid         INT(50)
);

INSERT INTO choices (id, question_id, name, valid) VALUES (1, 1, "たかなわ", 1);
INSERT INTO choices (id, question_id, name, valid) VALUES (2, 1, "たかわ", 0);
INSERT INTO choices (id, question_id, name, valid) VALUES (3, 1, "こうわ", 0);
INSERT INTO choices (id, question_id, name, valid) VALUES (4, 2, "かめと", 0);
INSERT INTO choices (id, question_id, name, valid) VALUES (5, 2, "かめど", 0);
INSERT INTO choices (id, question_id, name, valid) VALUES (6, 2, "かめいど", 1);
INSERT INTO choices (id, question_id, name, valid) VALUES (7, 3, "むこうひら", 0);
INSERT INTO choices (id, question_id, name, valid) VALUES (8, 3, "むきひら", 0);
INSERT INTO choices (id, question_id, name, valid) VALUES (9, 3, "むかいなだ", 1);