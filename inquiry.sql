create database inquiry;

use inquiry;

grant all on inquiry.* to testuser@localhost identified by '1243';



create table inquiry (
  id int primary key auto_increment,
  name varchar(32),
  mailaddress varchar(50),
  kind varchar(20),
  question text,
  createdAt datetime
);

create table users (
  id int primary key auto_increment,
  name varchar(255),
  password varchar(50),
  created_at datetime
);