drop database if EXISTS todo;

create database todo;

use todo;

create table user(
    id int primary key auto_increment,
    username varchar(30) not null unique,
    password varchar(255) not null,
    firstname varchar(100),
    lastname varchar(100)
);

create table task(
    id int primary key auto_increment,
    title varchar(255) not null,
    added timestamp DEFAULT CURRENT_TIMESTAMP,
    description text,
    user_id int not null,
    index (user_id),
    foreign key (user_id) references user(id)
    on delete restrict
);

insert into task(title,description) VALUES
('test1','test kuvaus');

insert into task(title,description) VALUES
('test2','test kuvausta');

insert into task(title,description) VALUES
('test3','test kuvaus taas');