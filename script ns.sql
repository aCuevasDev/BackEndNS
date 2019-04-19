create table Users (myKey varchar(50) NOT NULL,createdAt date,deletedAt date, username varchar(20) NOT NULL, passwrd varchar(20) NOT NULL,id_photos bigint, PRIMARY KEY (myKey), FOREIGN KEY (id_photos) REFERENCES Photos(id));

create table Photos (id bigint primary key, photo varchar(255) not null, labels varchar(255));

create database NS;
use NS;