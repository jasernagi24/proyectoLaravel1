CREATE DATABASE IF NOT EXISTS laravel_redSocial;
USE laravel_redSocial;

CREATE TABLE IF NOT EXISTS users(
id              int(255) auto_increment not null,
role            varchar(20),
name            varchar(100),
surname         varchar(200),
nickname        varchar(100),
email           varchar(255),
password        varchar(255),
image           varchar(255),
created_at       datetime,
updated_at       datetime,
remember_token  varchar(255),
CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

INSERT INTO users VALUES(NULL, 'user', 'Jaime', 'Serna', 'Jasernagi', 'jasernagi24@gmail.com', '1065656391jaser', null, CURTIME(), CURTIME(), null);
INSERT INTO users VALUES(NULL, 'user', 'Adriana', 'Giraldo', 'bagiraldo', 'bagiraldop24@gmail.com', '30290914', null, CURTIME(), CURTIME(), null);
INSERT INTO users VALUES(NULL, 'user', 'Esteban', 'Peñaloza', 'jepeñaloza', 'jepeñaloza11@gmail.com', '123456789', null, CURTIME(), CURTIME(), null);

CREATE TABLE IF NOT EXISTS images(
id              int(255) auto_increment not null,
user_id         int(255),
image_path      varchar(255),
description     text,
created_at      datetime,
updated_at       datetime,
CONSTRAINT pk_images PRIMARY KEY(id),
CONSTRAINT fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

INSERT INTO images VALUES(NULL, 1, 'test.jpg', 'Imagen de test', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 3, 'prueba.jpg', 'Imagen de prueba', CURTIME(), CURTIME());
INSERT INTO images VALUES(NULL, 4, 'ramdon.jpg', 'Imagen cualquiera', CURTIME(), CURTIME());


CREATE TABLE IF NOT EXISTS comments(
id              int(255) auto_increment not null,
user_id         int(255),
image_id        int(255),
content         text,
created_at       datetime,
updated_at      datetime,
CONSTRAINT pk_comments PRIMARY KEY(id),
CONSTRAINT fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO comments VALUES(NULL, 1, 1,'Excelente imagen de prueba', CURTIME(), CURTIME());
INSERT INTO comments VALUES(NULL, 3, 2,'Excelente imagen de prueba', CURTIME(), CURTIME());


CREATE TABLE IF NOT EXISTS likes(
id              int(255) auto_increment not null,
user_id         int(255),
image_id        int(255),
created_at       datetime,
updated_at       datetime,
CONSTRAINT pk_likes PRIMARY KEY(id),
CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
CONSTRAINT fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDb;

INSERT INTO likes VALUES(NULL, 1, 3, CURTIME(), CURTIME());
INSERT INTO likes VALUES(NULL, 3, 2, CURTIME(), CURTIME());