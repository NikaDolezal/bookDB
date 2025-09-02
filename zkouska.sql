-- zalozeni databaze a uzivatele provedeno skrze GUI webhostingu

-- vytvoreni tabulky skrze konzoli
use db26494;

CREATE TABLE knihy(
	id INTEGER NOT NULL auto_increment,
    isbn VARCHAR(30) NOT NULL,
	jmeno_autora VARCHAR(50) NOT NULL,
	prijmeni_autora VARCHAR(50) NOT NULL,
	nazev VARCHAR(50) NOT NULL,
	popis VARCHAR(1000) NOT NULL,
	PRIMARY KEY (id)
);