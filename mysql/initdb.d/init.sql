DROP DATABASE IF EXISTS webapp;
CREATE DATABASE webapp;

USE webapp;


-- 学習時間・内容テーブル
DROP TABLE IF EXISTS study_times;
CREATE TABLE study_times
(
  id             INT NOT NULL AUTO_INCREMENT,
  study_date     DATETIME NOT NULL,
  study_hour     INT NOT NULL,
  languages_id   INT NOT NULL,
  contents_id    INT NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO study_times (study_date, study_hour, languages_id, contents_id) VALUES 
('2021-07-01', 5, 2, 1),
('2022-01-03', 4, 5, 1),
('2022-01-03', 6, 3, 2),
('2022-01-06', 4, 1, 3),
('2022-02-09', 3, 4, 2),
('2022-02-12', 6, 6, 2),
('2022-02-16', 7, 7, 3),
('2022-03-08', 3, 8, 3),
('2022-03-17', 4, 8, 3);
-- ↑９，今日の日付にしてみる


-- mysql> select * from study_times;
-- +----+---------------------+------------+--------------+-------------+
-- | id | study_date          | study_hour | languages_id | contents_id |
-- +----+---------------------+------------+--------------+-------------+
-- |  1 | 2021-07-01 00:00:00 |          5 |            2 |           1 |
-- |  2 | 2022-01-03 00:00:00 |          4 |            5 |           1 |
-- |  3 | 2022-01-03 00:00:00 |          6 |            3 |           2 |
-- |  4 | 2022-01-06 00:00:00 |          4 |            1 |           3 |
-- |  5 | 2022-02-09 00:00:00 |          3 |            4 |           2 |
-- |  6 | 2022-02-12 00:00:00 |          6 |            6 |           2 |
-- |  7 | 2022-02-16 00:00:00 |          7 |            7 |           3 |
-- |  8 | 2022-03-08 00:00:00 |          3 |            8 |           3 |
-- |  9 | 2022-03-11 00:00:00 |          3 |            8 |           3 |
-- +----+---------------------+------------+--------------+-------------+



-- 学習言語テーブル
DROP TABLE IF EXISTS study_languages;
CREATE TABLE study_languages
(
  id               INT NOT NULL,
  language_name    VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO study_languages (id, language_name) VALUES 
(1, 'JavaScript'),
(2, 'css'),
(3, 'PHP'),
(4, 'HTML'),
(5, 'Laravel'),
(6, 'SQL'),
(7, 'SHELL'),
(8, '情報システム基礎知識（その他）');


-- mysql> select * from study_languages;
-- +----+-----------------------------------------------+
-- | id | language_name                                 |
-- +----+-----------------------------------------------+
-- |  1 | JavaScript                                    |
-- |  2 | css                                           |
-- |  3 | PHP                                           |
-- |  4 | HTML                                          |
-- |  5 | Laravel                                       |
-- |  6 | SQL                                           |
-- |  7 | SHELL                                         |
-- |  8 | 情報システム基礎知識（その他）                   |
-- +----+-----------------------------------------------+



-- 学習コンテンツテーブル
DROP TABLE IF EXISTS study_contents;
CREATE TABLE study_contents
(
  id              INT NOT NULL,
  contents_name   VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO study_contents (id, contents_name) VALUES 
(1, 'ドットインストール'),
(2, 'N予備校'),
(3, 'POSSE課題');


-- mysql> select * from study_contents;
-- +----+-----------------------------+
-- | id | contents_name               |
-- +----+-----------------------------+
-- |  1 | ドットインストール           |
-- |  2 | N予備校                     |
-- |  3 | POSSE課題                   |
-- +----+-----------------------------+



-- mysqlのルートのところで↓
-- mysql -u mysql -p < /docker-entrypoint-initdb.d/init.sql