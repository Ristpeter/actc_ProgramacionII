DROP DATABASE IF EXISTS automovilismo;
CREATE DATABASE IF NOT EXISTS automovilismo;
USE automovilismo;

DROP TABLE IF EXISTS noticias;

CREATE TABLE IF NOT EXISTS noticias(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(120) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(60) NOT NULL,
    fecha DATE NOT NULL,
    link VARCHAR(80) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS marcas;

CREATE TABLE IF NOT EXISTS marcas(
    id TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(80) NOT NULL,
    biografia TEXT NOT NULL,
    imagen VARCHAR(60) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS pilotos;

CREATE TABLE IF NOT EXISTS pilotos(
    id TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    biografia  TEXT NOT NULL,
    equipo VARCHAR(60) NOT NULL,
    imagen VARCHAR(60) NOT NULL,
    nacimiento DATE NOT NULL,
    edad TINYINT(2) NOT NULL,
    numero SMALLINT(3) NOT NULL,
    casco VARCHAR(60) NOT NULL,
    marca TINYINT(2) UNSIGNED NOT NULL,
    link VARCHAR(50) NOT NULL,
    FOREIGN KEY(marca) REFERENCES marcas(id),
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS usuarios;

CREATE TABLE IF NOT EXISTS usuarios(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(40) NOT NULL UNIQUE,
    nombre VARCHAR(40) NOT NULL,
    apellido VARCHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(250) NOT NULL,
    nacimiento DATE,
    icono TINYINT(1),
    piloto_id TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(piloto_id) REFERENCES pilotos(id),
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS comentarios;

CREATE TABLE IF NOT EXISTS comentarios(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    comentario VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    usuario_id INT UNSIGNED NOT NULL,
    FOREIGN KEY(usuario_id) REFERENCES usuarios(id),
    noticia_id INT UNSIGNED NOT NULL,
    FOREIGN KEY(noticia_id) REFERENCES noticias(id),
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS marcas_has_noticias;

CREATE TABLE IF NOT EXISTS marcas_has_noticias(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    marca TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(marca) REFERENCES marcas(id),
    noticia INT UNSIGNED NOT NULL,
    FOREIGN KEY(noticia) REFERENCES noticias(id),
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS pilotos_has_noticias;

CREATE TABLE IF NOT EXISTS pilotos_has_noticias(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    piloto TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(piloto) REFERENCES pilotos(id),
    noticia INT UNSIGNED NOT NULL,
    FOREIGN KEY(noticia) REFERENCES noticias(id),
    PRIMARY KEY(id)
)ENGINE=innoDB;

INSERT INTO marcas (id, nombre, biografia, imagen) 
VALUES 
(1,'Chevrolet','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','chevroletLogo.png'),
(2,'Ford','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','FordLogo.png'),
(3,'Torino','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','TorinoLogo.png'),
(4,'Dodge','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','DodgeLogo.png');

INSERT INTO pilotos (id, nombre, biografia, equipo, imagen, nacimiento, edad, numero, casco, link, marca) 
VALUES 
(1,'Agustín Canapino','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','Canapino Sport','canapinoPerfil.png','2020-01-20',30,1,'canapinoCasco.png','agustin-canapino',1),
(2,'Matias Rossi','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','Rossi Racing','rossiPerfil.png','2020-01-20',29,15,'rossiCasco.png','matias-rossi',2),
(3,'Facundo Ardusso','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','Renault Sport Torino Team','ardussoPerfil.png','2020-01-20',32,3,'ardussoCasco.png','facundo-ardusso',3),
(4,'Jonatan Castellano','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','Castellano Power Team','castellanoPerfil.png','2020-01-20',35,11,'castellanoCasco.png','jonatan-castellano',4);

INSERT INTO noticias (id, titulo, descripcion, imagen, fecha, link)
VALUES
(1, 'Agustín Canapino se consagra campeón de la copa de oro','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','noticia01.png','2020-01-20','Canapino-Campeon'),
(2, 'Castellano pide el pase de Dodge a Ford','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','noticia02.png','2020-01-20','Castellano-pase-Ford'),
(3, 'Ardusso tuvo un encontronazo con Rossi en la primera serie','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer luctus, felis consequat dignissim malesuada, magna mi vestibulum leo, sit amet vestibulum risus urna at purus. Mauris varius neque non tellus consectetur blandit. Nunc lobortis nisi est, quis maximus nisi commodo et. Donec iaculis enim massa, eu ullamcorper ex pulvinar vel. Curabitur a venenatis nulla. Nulla lobortis nibh tincidunt risus consequat, at bibendum odio consectetur. Praesent tristique elementum nunc ac vulputate. Aliquam ac faucibus elit. Donec pharetra porta orci a eleifend. </p>','noticia03.png','2020-01-20','Problema-Rossi-Ardusso');

INSERT INTO marcas_has_noticias(id, marca, noticia)
VALUES
(1, 1, 1),
(2, 2, 2),
(3, 4, 2),
(4, 2, 3),
(5, 3, 3);

INSERT INTO pilotos_has_noticias(id, piloto, noticia)
VALUES
(1,1,1),
(2,4,2),
(3,2,3),
(4,3,3);

DROP TABLE IF EXISTS encuestas;

CREATE TABLE IF NOT EXISTS encuestas(
    id TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
    votos INT NOT NULL,
    piloto TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(piloto) REFERENCES pilotos(id),
    PRIMARY KEY(id)
)ENGINE=innoDB;

INSERT INTO encuestas(id, votos, piloto)
VALUES
(1,132,1),
(2,121,2),
(3,122,3);