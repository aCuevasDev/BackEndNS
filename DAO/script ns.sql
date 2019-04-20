CREATE DATABASE IF NOT EXISTS ns;
use ns;

DROP TABLE IF EXISTS photos, users;

create table users (id bigint primary key auto_increment, code varchar(50) NOT NULL UNIQUE,createdAt datetime,deletedAt datetime, username varchar(20) NOT NULL, password varchar(20) NOT NULL, email varchar(20) NOT NULL);

create table photos (id bigint primary key, photo varchar(255) not null,createdAt datetime, labels varchar(255),localization varchar(255),category varchar(255), code_user varchar(50),  FOREIGN KEY (code_user) REFERENCES users(code));
