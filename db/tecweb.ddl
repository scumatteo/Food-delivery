-- *********************************************
-- * Standard SQL generation                   
-- *--------------------------------------------
-- * DB-MAIN version: 10.0.3              
-- * Generator date: Aug 17 2017              
-- * Generation date: Sun Jan 20 22:06:58 2019 
-- * LUN file: C:\Users\Scu\Desktop\progetto-tecnologie-web\db\tecweb.lun 
-- * Schema: logic4/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database logic4;


-- DBSpace Section
-- _______________


-- Tables Section
-- _____________ 

create table AULA (
     idAula smallint(8) not null,
     constraint IDAULA primary key (idAula));

create table CARRELLO (
     idCarrello smallint(8) not null,
     email varchar(30) not null,
     constraint IDCARRELLO primary key (idCarrello),
     constraint FKpossiede_ID unique (email));

create table CLIENTE (
     email varchar(30) not null,
     nome varchar(16) not null,
     cognome varchar(16) not null,
     constraint FKUTE_CLI_ID primary key (email));

create table FATTORINO (
     email varchar(30) not null,
     nome varchar(16) not null,
     cognome varchar(16) not null,
     Dis_email varchar(30) not null,
     constraint FKUTE_FAT_ID primary key (email));

create table FORNITORE (
     email varchar(30) not null,
     nome varchar(16) not null,
     cognome varchar(16) not null,
     CF varchar(16) not null,
     P_IVA varchar(8) not null,
     telefono varchar(10) not null,
	 ristorante varchar(30) not null,
	 immagine varchar(300) not null,
	 descrizione varchar(100) not null,
     constraint FKUTE_FOR_ID primary key (email));

create table LISTINO (
     idListino smallint(8) not null,
     email varchar(30) not null,
     constraint IDLISTINO primary key (idListino),
     constraint FKfornisce_ID unique (email));

create table ORDINE (
     idOrdine smallint(8) not null,
     data date not null,
     ora varchar(5) not null,
     prezzo_tot double(4,2) not null,
     fornitore_email varchar(30) not null,
     cliente_email varchar(30) not null,
     idAula smallint(8) not null,
	 stato varchar(30) not null,
     constraint IDORDINE primary key (idOrdine));

create table PRODOTTO (
     idProdotto smallint(8) not null,
     immagine varchar(100) not null,
     nome varchar(30) not null,
     prezzo double(4,2) not null,
     tipo varchar(30) not null,
     descrizione varchar(60) not null,
     idListino smallint(8) not null,
     constraint IDPRODOTTO primary key (idProdotto));
	 
create table PRODOTTO_ORDINATO (
     idProdotto_ordinato smallint(8) not null,
     porzioni smallint(4) not null,
     prezzo_tot double(4,2) not null,
     idProdotto smallint(8) not null);

create table PRODOTTO_IN_CARRELLO (
     idCarrello smallint(8) not null,
     idProdotto_in_carrello smallint(8) not null,
     porzioni smallint(4) not null,
     prezzo_tot double(4,2) not null,
     idProdotto smallint(8) not null);

create table UTENTE (
     email varchar(30) not null,
     password varchar(20) not null,
     FATTORINO varchar(30),
     FORNITORE varchar(30),
     CLIENTE varchar(30),
     constraint IDUTENTE primary key (email));
	 
create table SESSION (
     email varchar(30) not null,
     tipo varchar(20) not null,
	 nome varchar(20) not null,
	 forn_email varchar(30) not null,
	 IDLISTINO varchar(30),
     IDCARRELLO varchar(30),
     constraint IDSESSION primary key (email));
	 
create table notifiche( idOrdine smallint(8) not null, forn_email varchar(30) not null, cli_email varchar(30) not null, stato varchar(20) not null
constraint IDNOTIFICHE primary key (idOrdine));


-- Constraints Section
-- ___________________ 

alter table CARRELLO add constraint FKpossiede_FK
     foreign key (email)
     references CLIENTE;

alter table CLIENTE add constraint FKUTE_CLI_CHK
     check(exists(select * from CARRELLO
                  where CARRELLO.email = email)); 

alter table CLIENTE add constraint FKUTE_CLI_FK
     foreign key (email)
     references UTENTE;

alter table FATTORINO add constraint FKUTE_FAT_FK
     foreign key (email)
     references UTENTE;

alter table FATTORINO add constraint FKdisponde di
     foreign key (Dis_email)
     references FORNITORE;

alter table FORNITORE add constraint FKUTE_FOR_CHK
     check(exists(select * from LISTINO
                  where LISTINO.email = email)); 

alter table FORNITORE add constraint FKUTE_FOR_FK
     foreign key (email)
     references UTENTE;

alter table LISTINO add constraint FKfornisce_FK
     foreign key (email)
     references FORNITORE;

alter table ORDINE add constraint FKa
     foreign key (email)
     references FORNITORE;

alter table ORDINE add constraint FKper
     foreign key (idCarrello)
     references CARRELLO;

alter table ORDINE add constraint FKeffettua
     foreign key (Eff_email)
     references CLIENTE;

alter table ORDINE add constraint FKin
     foreign key (idAula)
     references AULA;

alter table PRODOTTO add constraint FKcontiene
     foreign key (idListino)
     references LISTINO;

alter table PRODOTTO_IN_CARRELLO add constraint FKriferisce
     foreign key (idProdotto)
     references PRODOTTO;

alter table PRODOTTO_IN_CARRELLO add constraint FKaggiunge
     foreign key (idCarrello)
     references CARRELLO;

alter table UTENTE add constraint ISAUTENTE
     check((CLIENTE is not null and FATTORINO is null and FORNITORE is null)
           or (CLIENTE is null and FATTORINO is not null and FORNITORE is null)
           or (CLIENTE is null and FATTORINO is null and FORNITORE is not null)); 


-- Index Section
-- _____________ 

