CREATE DATABASE bookshop character set utf8; 

USE bookshop;

CREATE TABLE users
(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name CHAR(30) NOT NULL,
  last_name CHAR(30) NOT NULL,
	login CHAR(50) NOT NULL, 
	password CHAR(100) NOT NULL 
); 


CREATE TABLE books
(
  isbn CHAR(13) NOT NULL PRIMARY KEY,
  autor  CHAR(50),
  tytul CHAR(100),
  cena FLOAT(6,2),
  stan INT NOT NULL
);

INSERT INTO books VALUES
  ('87-7361-784-1', 'Luke Welling, Laura Thomson', 'PHP i MySQL. Tworzenie stron WWW. 
   Vademecum profesjonalisty', 99.90,100),
  ('83-7361-391-1', 'Rob Flickenger', '100 sposobów na sieci bezprzewodowe', 25.30,200),
  ('83-7311-984-1', 'Dan Verton', 'Pamiętniki hakerów', 36.00,300),
  ('978-83-246-3791-1', 'Bartosz Danowski', 'Ćwiczenia praktyczne HTML5', 26.60,100),
  ('978-83-246-3887-1', 'Alex MacCaw', 'JavaScript. Aplikacje WWW', 48.25,50),
  ('83-86969-49-0', 'Andrzej Marciniak', 'Object Pascal', 110.15,100),
  ('83-7197-034-X', 'Kent Reisdorph', 'Delphi 4 dla każdego', 120.34,250),
  ('83-246-0375-1', 'Rafał Pawlak', 'Okablowanie strukturalne sieci', 22.10,400),
  ('978-83-246-1219-2', 'Piotr Czarny', 'Mandriva Linux', 30.20,10),
  ('83-7197-709-3', 'Bruce Eckel', 'Thinking in C++', 90.20,240);

