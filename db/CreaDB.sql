-- *********************************************
-- * SQL MySQL generation                      
-- *--------------------------------------------
-- * DB-MAIN version: 11.0.1              
-- * Generator date: Dec  4 2018              
-- * Generation date: Sat Jan 22 17:02:15 2022 
-- * LUN file: C:\Users\User\Downloads\E-Commerce.lun 
-- * Schema: E-Commerce/1 
-- ********************************************* 


-- Database Section
-- ________________ 

create database e_commerce;
use e_commerce;


-- Tables Section
-- _____________ 

create table CATEGORIA (
     IdCategoria int not null,
     NomeCategoria char(30) not null,
     ImmagineCategoria char(50) not null,
     constraint ID_CATEGORIA_ID primary key (IdCategoria));

create table DETTAGLIO_ORDINE (
     IdCategoria int not null,
     IdProduttore int not null,
     IdProdotto int not null,
     IdDettaglioOrdine int not null,
     Quantita int not null,
     Taglia char(5) not null,
     Colore char(20) not null,
     NomeUtente char(30) not null,
     IdOrdine int not null,
     constraint ID_DETTAGLIO_ORDINE_ID primary key (IdCategoria, IdProduttore, IdProdotto, IdDettaglioOrdine));

create table Notifica (
     Testo char(200) not null,
     Data date not null,
     Letta char(2) not null,
     NomeUtente char(30) not null);

create table IMMAGINE_OPZIONE (
     URL char(255) not null,
     IdCategoria int not null,
     IdProduttore int not null,
     IdProdotto int not null,
     Colore char(20) not null,
     constraint ID_IMMAGINE_OPZIONE_ID primary key (URL, IdCategoria, IdProduttore, IdProdotto, Colore));

create table OPZIONI_PRODOTTO (
     IdCategoria int not null,
     IdProduttore int not null,
     IdProdotto int not null,
     Colore char(20) not null,
     constraint ID_OPZIONI_PRODOTTO_ID primary key (IdCategoria, IdProduttore, IdProdotto, Colore));

create table ORDINE (
     NomeUtente char(30) not null,
     IdOrdine int not null,
     IdSpedizione int,
     IdPagamento int,
     CostoTotale float(20) not null,
     Stato char(30) not null,
     constraint ID_ORDINE_ID primary key (NomeUtente, IdOrdine),
     constraint FKseleziona_ID unique (IdSpedizione),
     constraint FKrelativo_ID unique (IdPagamento));

create table PAGAMENTO (
     DataPagamento date not null,
     IdPagamento int not null,
     MetodoPagamento char(30) not null,
     constraint ID_PAGAMENTO_ID primary key (IdPagamento));

create table PRODOTTO (
     IdCategoria int not null,
     IdProduttore int not null,
     IdProdotto int not null,
     NomeProdotto char(30) not null,
     Prezzo float(20) not null,
     Descrizione char(255) not null,
     Descrizione_Breve char(150) not null,
     Sconto int not null,
     constraint ID_PRODOTTO_ID primary key (IdCategoria, IdProduttore, IdProdotto));

create table PRODUTTORE (
     IdProduttore int not null,
     Provenienza char(30) not null,
     Nome char(30) not null,
     constraint ID_PRODUTTORE_ID primary key (IdProduttore));

create table RECENSIONE (
     IdCategoria int not null,
     IdProduttore int not null,
     IdProdotto int not null,
     NomeUtente char(30) not null,
     Voto int not null,
     Descrizione char(150) not null,
     constraint ID_RECENSIONE_ID primary key (IdCategoria, IdProduttore, IdProdotto, NomeUtente, Voto, Descrizione));

create table SPEDIZIONE (
     IdSpedizione int not null,
     DataArrivo date not null,
     Corriere char(30) not null,
     CostoSpedizione float(20) not null,
     constraint ID_SPEDIZIONE_ID primary key (IdSpedizione));

create table TAGLIA (
     Nome_taglia char(5) not null,
     Quantita int not null,
     IdCategoria int not null,
     IdProduttore int not null,
     IdProdotto int not null,
     Colore char(20) not null);

create table UTENTE (
     NomeUtente char(30) not null,
     Email char(50) not null,
     Nome char(30) not null,
     Cognome char(30) not null,
     DataNascita date not null,
     Password char(30) not null,
     Indirizzo char(50) not null,
     DarkMode int not null,
     Admin int not null,
     constraint ID_UTENTE_ID primary key (NomeUtente));


-- Constraints Section
-- ___________________ 

alter table DETTAGLIO_ORDINE add constraint FKpresente
     foreign key (IdCategoria, IdProduttore, IdProdotto)
     references PRODOTTO (IdCategoria, IdProduttore, IdProdotto);

alter table DETTAGLIO_ORDINE add constraint FKcomposione_FK
     foreign key (NomeUtente, IdOrdine)
     references ORDINE (NomeUtente, IdOrdine);

alter table Notifica add constraint FKlegge_FK
     foreign key (NomeUtente)
     references UTENTE (NomeUtente);

alter table IMMAGINE_OPZIONE add constraint FKpresenta_FK
     foreign key (IdCategoria, IdProduttore, IdProdotto, Colore)
     references OPZIONI_PRODOTTO (IdCategoria, IdProduttore, IdProdotto, Colore);

-- Not implemented
-- alter table OPZIONI_PRODOTTO add constraint ID_OPZIONI_PRODOTTO_CHK
--     check(exists(select * from IMMAGINE_OPZIONE
--                  where IMMAGINE_OPZIONE.IdCategoria = IdCategoria and IMMAGINE_OPZIONE.IdProduttore = IdProduttore and IMMAGINE_OPZIONE.IdProdotto = IdProdotto and IMMAGINE_OPZIONE.Colore = Colore)); 

alter table OPZIONI_PRODOTTO add constraint FKcaratterizzato
     foreign key (IdCategoria, IdProduttore, IdProdotto)
     references PRODOTTO (IdCategoria, IdProduttore, IdProdotto);

-- Not implemented
-- alter table ORDINE add constraint ID_ORDINE_CHK
--     check(exists(select * from DETTAGLIO_ORDINE
--                  where DETTAGLIO_ORDINE.NomeUtente = NomeUtente and DETTAGLIO_ORDINE.IdOrdine = IdOrdine)); 

alter table ORDINE add constraint FKseleziona_FK
     foreign key (IdSpedizione)
     references SPEDIZIONE (IdSpedizione);

alter table ORDINE add constraint FKrelativo_FK
     foreign key (IdPagamento)
     references PAGAMENTO (IdPagamento);

alter table ORDINE add constraint FKacquista
     foreign key (NomeUtente)
     references UTENTE (NomeUtente);

-- Not implemented
-- alter table PAGAMENTO add constraint ID_PAGAMENTO_CHK
--     check(exists(select * from ORDINE
--                  where ORDINE.IdPagamento = IdPagamento)); 

-- Not implemented
-- alter table PRODOTTO add constraint ID_PRODOTTO_CHK
--     check(exists(select * from OPZIONI_PRODOTTO
--                  where OPZIONI_PRODOTTO.IdCategoria = IdCategoria and OPZIONI_PRODOTTO.IdProduttore = IdProduttore and OPZIONI_PRODOTTO.IdProdotto = IdProdotto)); 

alter table PRODOTTO add constraint FKproduce_FK
     foreign key (IdProduttore)
     references PRODUTTORE (IdProduttore);

alter table PRODOTTO add constraint FKappartiene
     foreign key (IdCategoria)
     references CATEGORIA (IdCategoria);

-- Not implemented
-- alter table PRODUTTORE add constraint ID_PRODUTTORE_CHK
--     check(exists(select * from PRODOTTO
--                  where PRODOTTO.IdProduttore = IdProduttore)); 

alter table RECENSIONE add constraint FKfatta_da_FK
     foreign key (NomeUtente)
     references UTENTE (NomeUtente);

alter table RECENSIONE add constraint FKha
     foreign key (IdCategoria, IdProduttore, IdProdotto)
     references PRODOTTO (IdCategoria, IdProduttore, IdProdotto);

-- Not implemented
-- alter table SPEDIZIONE add constraint ID_SPEDIZIONE_CHK
--     check(exists(select * from ORDINE
--                  where ORDINE.IdSpedizione = IdSpedizione)); 

alter table TAGLIA add constraint FKdi_FK
     foreign key (IdCategoria, IdProduttore, IdProdotto, Colore)
     references OPZIONI_PRODOTTO (IdCategoria, IdProduttore, IdProdotto, Colore);


-- Index Section
-- _____________ 

create unique index ID_CATEGORIA_IND
     on CATEGORIA (IdCategoria);

create unique index ID_DETTAGLIO_ORDINE_IND
     on DETTAGLIO_ORDINE (IdCategoria, IdProduttore, IdProdotto, IdDettaglioOrdine);

create index FKcomposione_IND
     on DETTAGLIO_ORDINE (NomeUtente, IdOrdine);

create index FKlegge_IND
     on Notifica (NomeUtente);

create unique index ID_IMMAGINE_OPZIONE_IND
     on IMMAGINE_OPZIONE (URL, IdCategoria, IdProduttore, IdProdotto, Colore);

create index FKpresenta_IND
     on IMMAGINE_OPZIONE (IdCategoria, IdProduttore, IdProdotto, Colore);

create unique index ID_OPZIONI_PRODOTTO_IND
     on OPZIONI_PRODOTTO (IdCategoria, IdProduttore, IdProdotto, Colore);

create unique index ID_ORDINE_IND
     on ORDINE (NomeUtente, IdOrdine);

create unique index FKseleziona_IND
     on ORDINE (IdSpedizione);

create unique index FKrelativo_IND
     on ORDINE (IdPagamento);

create unique index ID_PAGAMENTO_IND
     on PAGAMENTO (IdPagamento);

create unique index ID_PRODOTTO_IND
     on PRODOTTO (IdCategoria, IdProduttore, IdProdotto);

create index FKproduce_IND
     on PRODOTTO (IdProduttore);

create unique index ID_PRODUTTORE_IND
     on PRODUTTORE (IdProduttore);

create unique index ID_RECENSIONE_IND
     on RECENSIONE (IdCategoria, IdProduttore, IdProdotto, NomeUtente, Voto, Descrizione);

create index FKfatta_da_IND
     on RECENSIONE (NomeUtente);

create unique index ID_SPEDIZIONE_IND
     on SPEDIZIONE (IdSpedizione);

create index FKdi_IND
     on TAGLIA (IdCategoria, IdProduttore, IdProdotto, Colore);

create unique index ID_UTENTE_IND
     on UTENTE (NomeUtente);

ALTER TABLE `notifica` CHANGE `Data` `Data` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP;