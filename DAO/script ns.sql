CREATE DATABASE IF NOT EXISTS NS;
use NS;

DROP TABLE IF EXISTS photos, users;

create table photos (id bigint primary key, photo varchar(255) not null, labels varchar(255));

create table users (id bigint primary key auto_increment, code varchar(50) NOT NULL UNIQUE,createdAt datetime,deletedAt datetime, username varchar(20) NOT NULL, passwrd varchar(20) NOT NULL,id_photos bigint, FOREIGN KEY (id_photos) REFERENCES photos(id));
