USE viatges;

/* TABLA EXPERIENCIA */
CREATE TABLE IF NOT EXISTS experiencia(
  id INT PRIMARY KEY AUTO_INCREMENT,
  titol VARCHAR(30),
  fecha_publ DATETIME
);

INSERT INTO experiencia VALUES(1, 'Hawai', '2019-12-09');
INSERT INTO experiencia VALUES(2, 'Paris', '2019-12-09');
INSERT INTO experiencia VALUES(3, 'Madrid', '2019-12-08');