-- create an empty database. Name of the database: 
SET storage_engine=InnoDB;
SET FOREIGN_KEY_CHECKS=1;
CREATE DATABASE IF NOT EXISTS GARE
CHARACTER SET utf8mb4;

-- USE GARE 
USE GARE;


-- drop tables if they already exist
DROP TABLE IF EXISTS PILOTA;
DROP TABLE IF EXISTS CIRCUITO;
DROP TABLE IF EXISTS GARA;

-- create tables

CREATE TABLE PILOTA (
	CodFisc CHAR(20) ,
	Nome CHAR(50) NOT NULL ,
	Cognome CHAR(50) NOT NULL ,
	Nazionalità CHAR(20) NOT NULL ,
	AnnoDiNascita YEAR NOT NULL ,
	Schuderia CHAR(50) NOT NULL ,
	PRIMARY KEY (CodFisc)
);

CREATE TABLE CIRCUITO (
	CodCircuito SMALLINT AUTO_INCREMENT NOT NULL ,
	Città CHAR(50) NOT NULL ,
	Lunghezza FLOAT NOT NULL ,
	Record FLOAT NOT NULL,
	PRIMARY KEY (CodCircuito)
);

CREATE TABLE GARA (
	CodFisc CHAR(20) NOT NULL ,
	CodCircuito SMALLINT AUTO_INCREMENT NOT NULL ,
	Data DATE NOT NULL ,
	OraInizio TIME NOT NULL ,
	OraFine TIME NULL,
	Posizionamento SMALLINT NOT NULL,
	PRIMARY KEY (CodFisc,CodCircuito,Data,OraInizio),
	FOREIGN KEY (CodFisc)
		REFERENCES PILOTA(CodFisc) 
		ON DELETE CASCADE
		ON UPDATE CASCADE,
	FOREIGN KEY (CodCircuito)
		REFERENCES CIRCUITO(CodCircuito) 
		ON DELETE CASCADE
		ON UPDATE CASCADE
);

-- Insert data
INSERT INTO PILOTA (CodFisc,Nome,Cognome,Nazionalità,AnnoDiNascita,Schuderia)
VALUES ('SMTPLA80N31B791Z','Paul','Smith','Americana','1980','ScuderiaAmerica');
INSERT INTO PILOTA (CodFisc,Nome,Cognome,Nazionalità,AnnoDiNascita,Schuderia)
VALUES ('KHNJHN81E30C455Y','Mario','Rossi','Italiana','1981','ScuderiaItalia');
INSERT INTO PILOTA (CodFisc,Nome,Cognome,Nazionalità,AnnoDiNascita,Schuderia)
VALUES ('AAAGGG83E30C445A','Robert','Kubica','Polacca','1990','ScuderiaPolonia');
INSERT INTO CIRCUITO (CodCircuito,Città,Lunghezza,Record)
VALUES ('1','Torino','5734.78','37.22');
INSERT INTO CIRCUITO (CodCircuito,Città,Lunghezza,Record)
VALUES ('2','Szczecin','6897.46','42.13');
INSERT INTO CIRCUITO (CodCircuito,Città,Lunghezza,Record)
VALUES ('3','New York','4637.42','35.68');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('SMTPLA80N31B791Z','1','2007-07-13','15:30:22','16:23:56','3');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('KHNJHN81E30C455Y','1','2007-07-13','15:30:22','16:21:41','2');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('AAAGGG83E30C445A','1','2007-07-13','15:30:22','16:19:23','1');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('SMTPLA80N31B791Z','2','2014-05-20','15:29:43','16:32:21','2');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('KHNJHN81E30C455Y','2','2014-05-20','15:29:43','16:34:33','3');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('AAAGGG83E30C445A','2','2014-05-20','15:29:43','16:27:49','1');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('AAAGGG83E30C445A','2','2014-05-16','09:34:17','10:12:33','5');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('AAAGGG83E30C445A','2','2012-04-22','17:03:29','17:58:51','2');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('SMTPLA80N31B791Z','3','2018-09-05','15:31:14','16:19:32','3');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('KHNJHN81E30C455Y','3','2018-09-05','15:31:14','16:17:56','2');
INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('AAAGGG83E30C445A','3','2018-09-05','15:31:14','16:16:35','1');

-- Check and Insert data
SELECT Data, OraInizio, OraFine, Posizionamento
FROM GARA
WHERE GARA.CodFisc = "AAAGGG83E30C445A" AND GARA.CodCircuito = "2"
ORDER BY Data, OraInizio ASC;

INSERT INTO PILOTA (CodFisc,Nome,Cognome,Nazionalità,AnnoDiNascita,Schuderia)
VALUES ('BRUARE94T26F768E','Adelante','Morras','Spagnola','1994-02-16','ScuderiaSpagna');

INSERT INTO GARA (CodFisc,CodCircuito,Data,OraInizio,OraFine,Posizionamento)
VALUES ('BRUARE94T26F768E','2','2010-10-18','20:14:52','21:10:22','4');