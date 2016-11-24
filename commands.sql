create database cakephp_blog;
use cakephp_blog;
create table posts (
    id int not null auto_increment primary key,
    title varchar(50),
    body text,
    created datetime default null,
    modified datetime default null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

insert into posts (title, body, created, modified) values
('title1', 'body1', now(), now()),
('title2', 'body2', now(), now()),
('title3', 'body3', now(), now());