/*DROP DATABASE IF EXISTS chatterBD;
*CREATE DATABASE IF NOT EXISTS chatterBD;
*USE chatterBD;
*/
CREATE TABLE uzytkownicy (
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    imie VARCHAR(40) NOT NULL,
    nazwisko VARCHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL,
    haslo VARCHAR(255) NOT NULL,
    img VARCHAR(255) NOT NULL,
    dataUtworzenia DATETIME NOT NULL,
    jestDostepny BOOL NOT NULL
);


CREATE TABLE konwersacje
(
	id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idAutora integer NOT NULL REFERENCES uzytkownicy,
	dataUtworzenia datetime NOT NULL
);


CREATE TABLE wiadomosci
(
	id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idNadawcy integer NOT NULL REFERENCES uzytkownicy,
    idKonwersacji integer NOT NULL REFERENCES konwersacje,
    wiadomosc varchar(255) NOT NULL,
	dataUtworzenia datetime NOT NULL
);


CREATE TABLE uczestnicy
(
	id integer NOT NULL PRIMARY KEY AUTO_INCREMENT,
    idUżytkownika integer NOT NULL REFERENCES uzytkownicy,
    idKonwersacji integer NOT NULL REFERENCES konwersacje,
	dataUtworzenia datetime NOT NULL
);
