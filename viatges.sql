CREATE DATABASE IF NOT EXISTS viatges;
USE viatges;

/* TABLA EXPERIENCIA */

CREATE TABLE IF NOT EXISTS usuari(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(30),
  contrasenya VARCHAR(40)
);

CREATE TABLE IF NOT EXISTS categoria(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS experiencia(
  id INT PRIMARY KEY AUTO_INCREMENT,
  titol VARCHAR(50),
  contingut VARCHAR(400),
  imatge VARCHAR(100),
  coordenadas VARCHAR(25), 
  estat ENUM('esborrany', 'publicada', 'rebutjada'),
  valoracioPos INT(6) DEFAULT 0,
  valoracioNeg INT(6) DEFAULT 0,
  fecha_publ DATETIME,
  id_us INT,
  FOREIGN KEY (id_us) REFERENCES usuari (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS categoria(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom VARCHAR(30)
);

CREATE TABLE IF NOT EXISTS contiene(
  id_exp INT,
  id_cat INT,
  PRIMARY KEY(id_exp, id_cat),
  FOREIGN KEY (id_exp) REFERENCES experiencia (id) ON DELETE CASCADE,
  FOREIGN KEY (id_cat) REFERENCES categoria (id) ON DELETE CASCADE
);

INSERT INTO usuari (id, nom, contrasenya) VALUES
  (1, 'laLore', '123456'),
  (2, 'goerge', 'george'),
  (3, 'usuario', 'usuario'),
  (4, 'anonimo', 'anonimo');

INSERT INTO experiencia (id, titol, contingut, imatge, coordenadas, estat, valoracioPos, valoracioNeg, fecha_publ, id_us) VALUES
  (1, 'Ruta por la costa de márfil', 'Nulla fermentum risus at ornare congue. Pellentesque sit amet consequat massa. Morbi quis orci et eros vulputate congue. Phasellus sit amet varius quam. Quisque pulvinar purus nec cursus interdum. Phasellus consectetur urna non tortor lobortis auctor. Aenean a justo nunc. Maecenas malesuada, lorem ut sodales cursus, purus turpis feugiat nisi, eget feugiat ex sapien vitae nunc.', 'https://picsum.photos/286/180', '5.047258, -6.250224', 'publicada', 0, 0, '2019-12-08', 2),
  (2, 'Vacaciones románticas en Hawai', 'Nulla fermentum risus at ornare congue. Pellentesque sit amet consequat massa. Morbi quis orci et eros vulputate congue. Phasellus sit amet varius quam. Quisque pulvinar purus nec cursus interdum. Phasellus consectetur urna non tortor lobortis auctor. Aenean a justo nunc. Maecenas malesuada, lorem ut sodales cursus, purus turpis feugiat nisi, eget feugiat ex sapien vitae nunc.', 'https://picsum.photos/286/180', '5.047258, -6.250224', 'esborrany', 0, 0, '2019-12-08', 2),
  (3, 'Tour gastronomico por las calles de Mexico', 'Nulla fermentum risus at ornare congue. Pellentesque sit amet consequat massa. Morbi quis orci et eros vulputate congue. Phasellus sit amet varius quam. Quisque pulvinar purus nec cursus interdum. Phasellus consectetur urna non tortor lobortis auctor. Aenean a justo nunc. Maecenas malesuada, lorem ut sodales cursus, purus turpis feugiat nisi, eget feugiat ex sapien vitae nunc.', 'https://picsum.photos/286/180', '5.047258, -6.250224', 'publicada', 0, 0, '2019-12-08', 3),
  (4, 'Retiro Budista por Japón', 'Nulla fermentum risus at ornare congue. Pellentesque sit amet consequat massa. Morbi quis orci et eros vulputate congue. Phasellus sit amet varius quam. Quisque pulvinar purus nec cursus interdum. Phasellus consectetur urna non tortor lobortis auctor. Aenean a justo nunc. Maecenas malesuada, lorem ut sodales cursus, purus turpis feugiat nisi, eget feugiat ex sapien vitae nunc.', 'https://picsum.photos/286/180', '5.047258, -6.250224', 'esborrany', 0, 0, '2019-12-08', 2),
  (5, 'Relax en las costas de Mallorca', 'Nulla fermentum risus at ornare congue. Pellentesque sit amet consequat massa. Morbi quis orci et eros vulputate congue. Phasellus sit amet varius quam. Quisque pulvinar purus nec cursus interdum. Phasellus consectetur urna non tortor lobortis auctor. Aenean a justo nunc. Maecenas malesuada, lorem ut sodales cursus, purus turpis feugiat nisi, eget feugiat ex sapien vitae nunc.', 'https://picsum.photos/286/180', '5.047258, -6.250224', 'publicada', 0, 0, '2019-12-08', 2),
  (6, 'Fiesteo por Ibiza', 'Nulla fermentum risus at ornare congue. Pellentesque sit amet consequat massa. Morbi quis orci et eros vulputate congue. Phasellus sit amet varius quam. Quisque pulvinar purus nec cursus interdum. Phasellus consectetur urna non tortor lobortis auctor. Aenean a justo nunc. Maecenas malesuada, lorem ut sodales cursus, purus turpis feugiat nisi, eget feugiat ex sapien vitae nunc.', 'https://picsum.photos/286/180', '5.047258, -6.250224', 'rebutjada', 0, 0, '2019-12-08', 4),
  (7, 'Viaje en família por Londres', 'Nulla fermentum risus at ornare congue. Pellentesque sit amet consequat massa. Morbi quis orci et eros vulputate congue. Phasellus sit amet varius quam. Quisque pulvinar purus nec cursus interdum. Phasellus consectetur urna non tortor lobortis auctor. Aenean a justo nunc. Maecenas malesuada, lorem ut sodales cursus, purus turpis feugiat nisi, eget feugiat ex sapien vitae nunc.', 'https://picsum.photos/286/180', '5.047258, -6.250224', 'publicada', 0, 0, '2019-12-08', 3);

  INSERT INTO categoria (id, nom) VALUES
  (1, 'aventures'),
  (2, 'romàntic'),
  (3, 'gastronomic'),
  (4, 'historic'),
  (5, 'familiar'),
  (6, 'festa'),
  (7, 'platja'),
  (8, 'cultural');