<?php

/**
 *
create table users
(
id int auto_increment,
first_name varchar(50) null,
last_name varchar(50) null,
email varchar(50) not null,
gender ENUM('male', 'female') null,
is_active bool null,
password varchar(50) not null,
created_at datetime null,
updated_at datetime null,
constraint users_pk
primary key (id)
);

create unique index users_email_uindex
on users (email);


 */

echo "ROOOT";