-- Import this file into your database

CREATE TABLE users (
    user_id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    user_name varchar(128) NOT NULL, 
    user_mail varchar(255) NOT NULL, 
    user_uid varchar(128) NOT NULL, 
    user_pwd varchar(128) NOT NULL
);