create database parking;

\c parking;

create table profil(
    id serial primary key ,
    nom varchar(20) not null
);

insert into profil (nom) values
     ('Admin'),
     ('Client');

-- parking

CREATE SEQUENCE parking_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_parking_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('parking_sequence');
    formatted_id := 'PARK' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;


create table parking(
    id varchar(10) primary key,
    numero varchar(20) not null,
    longueur double precision not null ,
    largeur double precision not null
);

-- place

-- CREATE SEQUENCE place_sequence START WITH 1 INCREMENT BY 1;
--
-- CREATE OR REPLACE FUNCTION gen_place_id() RETURNS text AS $$
-- DECLARE
-- next_id integer;
--     formatted_id text;
-- BEGIN
--     next_id := nextval('place_sequence');
--     formatted_id := 'PLC' || lpad(next_id::text, 3, '0');
-- RETURN formatted_id;
-- END;
-- $$ LANGUAGE plpgsql;
--
--
-- create table place(
--     id varchar(10) primary key,
--     parking_id varchar(10) references parking(id),
--     numero varchar(20) not null,
--     longueur double precision not null ,
--     largeur double precision not null
-- );

-- tarif

CREATE SEQUENCE tarif_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_tarif_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('tarif_sequence');
    formatted_id := 'TRF' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;

create table tarif(
    id varchar(10) primary key,
    debut double precision,
    fin double precision,
    prix double precision not null
);

-- marque

CREATE SEQUENCE marque_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_marque_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('marque_sequence');
    formatted_id := 'MRQ' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;

create table marque(
    id varchar(10) primary key,
    nom varchar(50) not null
);

-- voiture

CREATE SEQUENCE voiture_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_voiture_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('voiture_sequence');
    formatted_id := 'VTR' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;

create table voiture(
    id varchar(10) primary key,
    marque_id varchar(10) references marque(id),
    numero varchar(20) not null ,
    longueur double precision not null,
    largeur double precision not null
);

-- en station

CREATE SEQUENCE station_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_station_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('station_sequence');
    formatted_id := 'STATVOI' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;

create table station(
    id varchar(20) primary key,
    user_id integer references users(id),
    parking_id varchar(10) references parking(id),
    voiture_id varchar(10) references voiture(id),
    duree_estime time not null,
    dateheure timestamp not null,
    etat integer default 0

);

CREATE SEQUENCE sortie_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_sortie_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('sortie_sequence');
    formatted_id := 'SRT' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;

create table sortie(
    id varchar(20) primary key,
    station_id varchar(20) references station(id),
    duree_reel double precision not null,
    dateheure timestamp not null,
    amende double precision default 0,
    montant double precision not null default 0

);


create or replace view stationnement as
SELECT st.*, COALESCE(s.duree_reel, '0') AS duree_reel,COALESCE(s.amende,0) as amende,COALESCE(s.montant,0) as montant
FROM station AS st
         JOIN voiture v ON v.id = st.voiture_id
        JOIN users u on u.id=st.user_id
         LEFT JOIN sortie s ON st.id = s.station_id
ORDER BY st.dateheure DESC;




-- amende

CREATE SEQUENCE amende_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_amende_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('amende_sequence');
    formatted_id := 'AMN' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;

create table amende(
    id varchar(10) primary key,
    tarif double precision not null ,
    date timestamp not null
);

insert into amende values ('AMN001',150000,'2024-02-22 00:00:00');
