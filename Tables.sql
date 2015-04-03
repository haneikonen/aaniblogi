// http://fluxbb.org/docs/v1.4/dbstructure

// Ensimmäiset taulut

CREATE TABLE IF NOT EXISTS `a_kommentit` (
`ID` int(9) NOT NULL auto_increment,
`kommentti` char(150),
`url` text,
`kayttaja` char(20),
PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `a_julkaisu` (
`ID` int(9) NOT NULL auto_increment,
`url` text,
`kommentti` char(150),
`kayttaja` char(20),
`aihe` text,
PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS `a_kayttaja` (
`ID` int(9) NOT NULL auto_increment,
`kayttajanimi` char(20),
`salasana` text,
PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-----------------------------------------------------------------------------------------

// Hannun luonnos

CREATE TABLE a_oikeudet(
	ID INT PRIMARY KEY,
	ryhma VARCHAR(15),	-- ryhman nimi (admin, moderaattori, helpottaa tietokannassa liikkumista
	testiOikeus1 INT(1) DEFAULT 0,
	testioikeus2 INT(1) DEFAULT 0 -- listana eri oikeudet poistaa, muuttaa, editoida jne. Jos 1 niin on oikeus, jos 0 ei oikeutta
)DEFAULT CHARSET=utf8;

CREATE TABLE a_kayttaja(
	kayttajaID INT PRIMARY KEY AUTO_INCREMENT,
	oikeudet INT,	-- Foreign key, linkkaa oikeisiin oikeuksiin^
	salasana varchar(50),
	kayttaja varchar(20),
	email varchar(35),
	FOREIGN KEY(oikeudet) REFERENCES a_oikeudet(ID)
)DEFAULT CHARSET=utf8 AUTO_INCREMENT=1500 ;

CREATE TABLE a_julkaisu(
	ID INT PRIMARY KEY AUTO_INCREMENT,
	otsikko varchar(50),
	kayttajaID INT, -- kenen aloittama
	aloitettu TIMESTAMP, -- kello monelta luotu
	postilaskuri INT, -- kommenttien määrä tässä julkaisussa, aina kun tulee uusi kommentti +1, poistetaan -1. Ei tartte aina käyttää sql:n count()
	viimeisinAika TIMESTAMP, -- monelta viimesin posti tullut. kommentin lisäämisen yhteydessä updatetaan
	viimeisinKayttaja varchar(20), -- viimesimmän postaajaan nimi. kommentin lisäämisen yhteydessä updatetaan
	viimeisinKommentti INT, -- viimeisimmän postin id. Linkin luomiseksi viimesimpään postiin(ei tartte scrollaa koko sivua
							-- Kommentin lisäämisen yhteydessä updatetaan.
	FOREIGN KEY(kayttajaID) REFERENCES a_kayttaja(kayttajaID)
)DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

CREATE TABLE a_kommentti(
	ID INT PRIMARY KEY AUTO_INCREMENT,
	julkaisu INT, -- mihin julkaisuun kommentti
	kayttajaID INT, -- kuka postas
	kommentti varchar(150), 
	audio varchar(50),
	postattu TIMESTAMP,
	FOREIGN KEY(kayttajaID) REFERENCES a_kayttaja(kayttajaID),
	FOREIGN KEY(julkaisu) REFERENCES a_julkaisu(ID)
)DEFAULT CHARSET=utf8 AUTO_INCREMENT=4000 ;

