-- Import this file into your database

create table users (
    user_id int(11) not null PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(128) not null, 
    user_mail varchar(255) not null, 
    user_uid varchar(128) not null, 
    user_pwd varchar(128) not null
);