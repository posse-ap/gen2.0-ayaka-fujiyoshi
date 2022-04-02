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
('2021-12-01', 5, 2, 1),
('2022-01-03', 4, 5, 1),
('2022-01-03', 6, 3, 2),
('2022-01-06', 4, 1, 3),
('2022-02-09', 3, 4, 2),
('2022-02-12', 6, 6, 2),
('2022-02-16', 7, 7, 3),
('2022-03-1', 4, 8, 3),
('2022-03-2', 4, 2, 1),
('2022-03-3', 4, 5, 1),
('2022-03-4', 3, 3, 2),
('2022-03-5', 3, 1, 3),
('2022-03-8', 3, 4, 2),
('2022-03-11', 2, 6, 2),
('2022-03-12', 2, 7, 3),
('2022-03-13', 5, 2, 1),
('2022-03-14', 4, 5, 1),
('2022-03-16', 3, 5, 1),
('2022-03-17', 6, 3, 2),
('2022-03-18', 4, 1, 3),
('2022-03-19', 3, 4, 2),
('2022-03-21', 3, 5, 1),
('2022-03-23', 6, 6, 2),
('2022-03-25', 3, 5, 1),
('2022-03-28', 7, 7, 3),
('2022-03-30', 4, 8, 3),
('2022-04-01', 4, 8, 3),
('2022-04-010', 4, 8, 3);


-- mysql> select * from study_times;
-- +----+---------------------+------------+--------------+-------------+
-- | id | study_date          | study_hour | languages_id | contents_id |
-- +----+---------------------+------------+--------------+-------------+
-- |  1 | 2021-12-01 00:00:00 |          5 |            2 |           1 |
-- |  2 | 2022-01-03 00:00:00 |          4 |            5 |           1 |
-- |  3 | 2022-01-03 00:00:00 |          6 |            3 |           2 |
-- |  4 | 2022-01-06 00:00:00 |          4 |            1 |           3 |
-- |  5 | 2022-02-09 00:00:00 |          3 |            4 |           2 |
-- |  6 | 2022-02-12 00:00:00 |          6 |            6 |           2 |
-- |  7 | 2022-02-16 00:00:00 |          7 |            7 |           3 |
-- |  8 | 2022-03-01 00:00:00 |          4 |            8 |           3 |
-- |  9 | 2022-03-02 00:00:00 |          4 |            2 |           1 |
-- | 10 | 2022-03-03 00:00:00 |          4 |            5 |           1 |
-- | 11 | 2022-03-04 00:00:00 |          3 |            3 |           2 |
-- | 12 | 2022-03-05 00:00:00 |          3 |            1 |           3 |
-- | 13 | 2022-03-08 00:00:00 |          3 |            4 |           2 |
-- | 14 | 2022-03-11 00:00:00 |          2 |            6 |           2 |
-- | 15 | 2022-03-12 00:00:00 |          2 |            7 |           3 |
-- | 16 | 2022-03-13 00:00:00 |          5 |            2 |           1 |
-- | 17 | 2022-03-14 00:00:00 |          4 |            5 |           1 |
-- | 18 | 2022-03-16 00:00:00 |          3 |            5 |           1 |
-- | 19 | 2022-03-17 00:00:00 |          6 |            3 |           2 |
-- | 20 | 2022-03-18 00:00:00 |          4 |            1 |           3 |
-- | 21 | 2022-03-19 00:00:00 |          3 |            4 |           2 |
-- | 22 | 2022-03-21 00:00:00 |          3 |            5 |           1 |
-- | 23 | 2022-03-23 00:00:00 |          6 |            6 |           2 |
-- | 24 | 2022-03-25 00:00:00 |          3 |            5 |           1 |
-- | 25 | 2022-03-28 00:00:00 |          7 |            7 |           3 |
-- | 26 | 2022-03-30 00:00:00 |          4 |            8 |           3 |
-- +----+---------------------+------------+--------------+-------------+


-- 学習言語テーブル
DROP TABLE IF EXISTS study_languages;
CREATE TABLE study_languages
(
  id               INT NOT NULL AUTO_INCREMENT,
  language_name    VARCHAR(50) NOT NULL,
  language_color   VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO study_languages (id, language_name, language_color) VALUES 
(1, 'JavaScript', '#0042E5'),
(2, 'css', '#0070B9'),
(3, 'PHP', '#00BDDB'),
(4, 'HTML', '#B29DEF'),
(5, 'Laravel', '#6C43E5'),
(6, 'SQL', '#B29DEF'),
(7, 'SHELL', '#4609E8'),
(8, '情報システム基礎知識（その他）', '#2D00BA');


-- mysql> select * from study_languages;
-- +----+-------------------------------------+----------------+
-- | id | language_name                       | language_color |
-- +----+-------------------------------------+----------------+
-- |  1 | JavaScript                          | #0042E5        |
-- |  2 | css                                 | #0070B9        |
-- |  3 | PHP                                 | #00BDDB        |
-- |  4 | HTML                                | #B29DEF        |
-- |  5 | Laravel                             | #6C43E5        |
-- |  6 | SQL                                 | #B29DEF        |
-- |  7 | SHELL                               | #4609E8        |
-- |  8 | 情報システム基礎知識（その他）         | #2D00BA        |
-- +----+-------------------------------------+----------------+


-- 学習コンテンツテーブル
DROP TABLE IF EXISTS study_contents;
CREATE TABLE study_contents
(
  id              INT NOT NULL AUTO_INCREMENT,
  contents_name   VARCHAR(50) NOT NULL,
  contents_color  VARCHAR(50) NOT NULL,
  PRIMARY KEY (id)
);

INSERT INTO study_contents (id, contents_name, contents_color) VALUES 
(1, 'ドットインストール', '#0042E5'),
(2, 'N予備校', '#0070B9'),
(3, 'POSSE課題', '#00BDDB');


-- mysql> select * from study_contents;
--+----+-----------------------------+----------------+
--| id | contents_name               | contents_color |
--+----+-----------------------------+----------------+
--|  1 | ドットインストール           | #0042E5        |
--|  2 | N予備校                     | #0070B9        |
--|  3 | POSSE課題                   | #00BDDB        |
--+----+-----------------------------+----------------+



-- mysqlのルートのところで↓
-- mysql -u mysql -p < /docker-entrypoint-initdb.d/init.sql


-- mysql> SELECT
--              SUM(study_times.study_hour) AS study_hour,
--              study_languages.language_name AS language_name,
--              study_languages.language_color AS language_color
--              FROM study_times
--              INNER JOIN study_languages 
--              ON  study_times.languages_id = study_languages.id
--              WHERE DATE_FORMAT(study_date, "%Y-%m") = DATE_FORMAT(now(), "%Y-%m")    //今年のデータ分
--              GROUP BY study_languages.language_name, study_languages.language_color  //言語と色(この二つセットで動くから)でグループ分け
--              ORDER BY study_hour DESC                                                //グループ分けされた後、SUMの値降順に
--+------------+-----------------------------------------------+----------------+
-- | study_hour | language_name                                 | language_color |
-- +------------+-----------------------------------------------+----------------+
-- |         17 | Laravel                                       | #6C43E5        |
-- |          9 | css                                           | #0070B9        |
-- |          9 | PHP                                           | #00BDDB        |
-- |          9 | SHELL                                         | #4609E8        |
-- |          8 | 情報システム基礎知識（その他）                   | #2D00BA        |
-- |          8 | SQL                                           | #B29DEF        |
-- |          7 | JavaScript                                    | #0042E5        |
-- |          6 | HTML                                          | #B29DEF        |
-- +------------+-----------------------------------------------+----------------+

-- mysql-> SELECT
--               SUM(study_times.study_hour) AS study_hour,
--               study_contents.contents_name AS contents_name,
--               study_contents.contents_color AS contents_color
--               FROM study_times
--               INNER JOIN study_contents 
--               ON  study_times.contents_id = study_contents.id
--               WHERE DATE_FORMAT(study_date, "%Y-%m") = DATE_FORMAT(now(), "%Y-%m")
--               GROUP BY study_contents.contents_name, study_contents.contents_color
--               ORDER BY study_hour DESC
-- +------------+-----------------------------+----------------+
-- | study_hour | contents_name               | contents_color |
-- +------------+-----------------------------+----------------+
-- |         26 | ドットインストール            | #0042E5        |
-- |         24 | POSSE課題                    | #00BDDB        |
-- |         23 | N予備校                      | #0070B9        |
-- +------------+-----------------------------+----------------+