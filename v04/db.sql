DROP DATABASE skola;
CREATE DATABASE skola;
USE skola;

CREATE TABLE klasser (
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	namn VARCHAR(32) NOT NULL
);

CREATE TABLE elev(
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	namn VARCHAR(64) NOT NULL,
	klass_id INT(8),
	FOREIGN KEY (klass_id) REFERENCES klasser(id),
	personnm VARCHAR(12) NOT NULL
);

CREATE TABLE lärare(
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	namn VARCHAR(64) NOT NULL
);

CREATE TABLE kurs(
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	namn VARCHAR(32) NOT NULL,
	code VARCHAR(12) NOT NULL
);

CREATE TABLE kurs_elever(
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	kurs_id INT(8),
	FOREIGN KEY(kurs_id) REFERENCES kurs(id),
	elev_id INT(8),
	FOREIGN KEY(elev_id) REFERENCES elev(id)
);

CREATE TABLE kurs_lärare(
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	kurs_id INT(8),
	FOREIGN KEY(kurs_id) REFERENCES kurs(id),
	lärare_id INT(8),
	FOREIGN KEY(lärare_id) REFERENCES lärare(id)
);

CREATE TABLE betyg_värden(
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	namn VARCHAR(8) NOT NULL,
	värde INT(1)
);

CREATE TABLE betyg(
	id INT(8) PRIMARY KEY AUTO_INCREMENT,
	betyg_id INT(8),
	FOREIGN KEY(betyg_id) REFERENCES betyg_värden(id),
	elev_id INT(8),
	FOREIGN KEY(elev_id) REFERENCES elev(id),
	kurs_id INT(8),
	FOREIGN KEY(kurs_id) REFERENCES kurs(id),
	lärare_id INT(8),
	FOREIGN KEY(lärare_id) REFERENCES lärare(id)
);

INSERT INTO betyg_värden(namn, värde) VALUES ("-", 0);
INSERT INTO betyg_värden(namn, värde) VALUES ("F", 0);
INSERT INTO betyg_värden(namn, värde) VALUES ("E", 1);
INSERT INTO betyg_värden(namn, värde) VALUES ("D", 2);
INSERT INTO betyg_värden(namn, värde) VALUES ("C", 3);
INSERT INTO betyg_värden(namn, värde) VALUES ("B", 4);
INSERT INTO betyg_värden(namn, värde) VALUES ("A", 5);

INSERT INTO klasser(namn) VALUES ("TE17C");
INSERT INTO klasser(namn) VALUES ("TE17D");

INSERT INTO lärare(namn) VALUES ("Karolin Hermansson");
INSERT INTO lärare(namn) VALUES ("Nicklas Håkansson");
INSERT INTO lärare(namn) VALUES ("Nathalie Ek");
INSERT INTO lärare(namn) VALUES ("Alexander Sjögren");

INSERT INTO kurs(namn, code) VALUES ("Matte 2c", "MATMAT2c");
INSERT INTO kurs(namn, code) VALUES ("Mekatronik", "MEKMEK01");
INSERT INTO kurs(namn, code) VALUES ("Enterpernörskap", "EMTEMR0");
INSERT INTO kurs(namn, code) VALUES ("Dator- och nätverksteknik", "DAODAC0");

INSERT INTO elev(namn, klass_id, personnm) VALUES ("Fredrik Lind", 1, "000921-1137");
INSERT INTO elev(namn, klass_id, personnm) VALUES ("Arian Sjöberg", 1, "010709-6174");
INSERT INTO elev(namn, klass_id, personnm) VALUES ("Paulina Magnusson", 1, "021029-8600");
INSERT INTO elev(namn, klass_id, personnm) VALUES ("Aston Johnsson", 1, "021009-3431");
INSERT INTO elev(namn, klass_id, personnm) VALUES ("Elisa Sundström", 1, "000919-3541");

INSERT INTO elev(namn, klass_id, personnm) VALUES ("Arian Hansson", 2, "020629-7194");
INSERT INTO elev(namn, klass_id, personnm) VALUES ("Ingrid Dahlberg", 2, "020405-4282");
INSERT INTO elev(namn, klass_id, personnm) VALUES ("Angelica Larsson", 2, "000802-8060");
INSERT INTO elev(namn, klass_id, personnm) VALUES ("Gabriela Samuelsson", 2, "001222-4366");

INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (3, 1);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (4, 1);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (2, 2);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (4, 2);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (3, 3);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (4, 3);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (1, 4);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (3, 4);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (1, 5);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (3, 5);

INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (4, 6);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (1, 6);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (4, 7);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (1, 7);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (2, 8);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (1, 8);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (4, 9);
INSERT INTO kurs_elever(kurs_id, elev_id) VALUES (2, 9);

INSERT INTO kurs_lärare(kurs_id, lärare_id) VALUES (1, 1);
INSERT INTO kurs_lärare(kurs_id, lärare_id) VALUES (2, 2);
INSERT INTO kurs_lärare(kurs_id, lärare_id) VALUES (3, 3);
INSERT INTO kurs_lärare(kurs_id, lärare_id) VALUES (4, 4);

INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (2, 1, 3, 3);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (2, 1, 4, 4);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (1, 2, 2, 2);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (2, 2, 4, 4);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (2, 3, 3, 3);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (6, 3, 4, 4);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (3, 4, 1, 1);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (3, 4, 3, 3);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (4, 5, 1, 1);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (4, 5, 3, 3);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (3, 6, 4, 4);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (6, 6, 1, 1);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (6, 7, 4, 4);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (5, 7, 1, 1);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (2, 8, 2, 2);
INSERT INTO betyg(betyg_id, elev_id, kurs_id, lärare_id) VALUES (2, 8, 1, 1);

SELECT elev.namn AS ElevNamn, klasser.namn AS KlassNamn FROM elev JOIN klasser ON elev.klass_id=klasser.id WHERE klasser.namn="TE17C";
SELECT elev.namn AS ElevNamn, betyg_värden.namn AS Betyg, kurs.namn AS kurs FROM elev JOIN betyg ON elev.id=betyg.elev_id JOIN betyg_värden ON betyg.betyg_id=betyg_värden.id JOIN kurs ON betyg.kurs_id=kurs.id WHERE elev.namn = "Fredrik Lind";
SELECT elev.namn AS ElevNamn, betyg_värden.namn AS Betyg, kurs.namn AS kurs, lärare.namn AS Lärare FROM elev JOIN betyg ON elev.id=betyg.elev_id JOIN betyg_värden ON betyg.betyg_id=betyg_värden.id JOIN kurs ON betyg.kurs_id=kurs.id JOIN lärare ON betyg.lärare_id=lärare.id ORDER BY elev.namn;
SELECT elev.namn As ElevNamn, kurs.namn AS Kurs FROM elev JOIN kurs_elever ON elev.id=kurs_elever.elev_id JOIN kurs ON kurs_elever.kurs_id=kurs.id WHERE elev.namn="Fredrik Lind";
SELECT kurs.namn, COUNT(kurs_id) AS Elever FROM kurs_elever JOIN kurs ON kurs_elever.kurs_id=kurs.id GROUP BY kurs_id ORDER BY elever DESC;
SELECT lärare.namn, COUNT(elev_id) AS Elever FROM kurs_lärare JOIN kurs ON kurs_lärare.kurs_id=kurs.id JOIN kurs_elever ON kurs.id=kurs_elever.kurs_id JOIN lärare ON kurs_lärare.lärare_id=lärare.id GROUP BY kurs_lärare.id;