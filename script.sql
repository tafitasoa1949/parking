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

-- etat

create table etat(
    id serial primary key ,
    code integer not null,
    couleur varchar(20) not null,
    action varchar(20) not null
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
    etat_id integer references etat(id) default 1
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
    duree_reel time not null,
    dateheure timestamp not null,
    amende double precision default 0,
    montant double precision not null default 0

);


create or replace view stationnement as
SELECT st.*,COALESCE(s.dateheure, null) AS datesortie, COALESCE(s.duree_reel, NULL) AS duree_reel,COALESCE(s.amende,'0') as amende,COALESCE(s.montant,0) as montant
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

-- solde

CREATE SEQUENCE depot_sequence START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE FUNCTION gen_depot_id() RETURNS text AS $$
DECLARE
next_id integer;
    formatted_id text;
BEGIN
    next_id := nextval('depot_sequence');
    formatted_id := 'DPT' || lpad(next_id::text, 3, '0');
RETURN formatted_id;
END;
$$ LANGUAGE plpgsql;

create table depot(
    id varchar(10) primary key,
    user_id integer references users(id),
    solde double precision not null default 0,
    date timestamp not null,
    etat double precision default 0,
    action double precision default 0
);

SELECT
    (SELECT SUM(solde) FROM depot WHERE etat = 10 AND action = 0 AND user_id = 2) -
    COALESCE((SELECT SUM(solde) FROM depot WHERE action = 1 AND user_id = 2),0) AS solde;


create or replace view situation_parking as
select p.*,COALESCE(e.code,0) as etat,COALESCE(e.couleur,'green') as couleur,COALESCE(e.action,'Libre') as action,COALESCE(s.dateheure,null) as heure_arrive,
       COALESCE(s.duree_estime,null) as duree_estime,COALESCE(s2.dateheure) as heure_depart,
       COALESCE(s2.duree_reel,null) as duree_reel
from parking p
left join station s on p.id = s.parking_id
left join etat e on e.id = s.etat_id
left outer join sortie s2 on s.id = s2.station_id
where COALESCE(s.dateheure,null) is null or COALESCE(s.dateheure,null) < '2024-05-06 21:15:33';


create or replace view entre_parking as
select p.id,p.numero,COALESCE(e.id,1) as etat_id,COALESCE(s.dateheure,null) as heure_arrive,
       COALESCE(s.duree_estime,null) as duree_estime
from parking p
    left join station s on p.id = s.parking_id
    left join etat e on e.id = s.etat_id;



select etat_id,count(*) as total from parking group by etat_id order by etat_id asc;


create or replace view etat_parking as
select p.*,COALESCE(e.id,1) as etat_id
from parking p
left join station s on p.id = s.parking_id
left join etat e on e.id = s.etat_id;

create or replace view stat_etat_parking as
select e.*,count(et) as nombre
from etat e
left join etat_parking et on et.etat_id = e.id group by e.id;




-- test crud evaluation

create table genre(
    id serial primary key,
    sexe varchar(20) not null
);
insert into genre (sexe) values ('Homme'),('Femme'),('Bisexuel');

create table diplome(
                      id serial primary key,
                      nom varchar(20) not null
);
insert into diplome (nom) values ('Bacc'),('Licence'),('Master');

create table amoureuse(
                      id serial primary key,
                      situation varchar(20) not null
);
insert into amoureuse (situation) values (' Marié(e)'),('Celibataire'),('Compliqué');

create table crud(
    id serial primary key ,
    nom varchar(20) not null ,
    datenaissance date not null ,
    genre_id integer references genre(id),
    diplome_id integer references diplome(id),
    amoureuse_id integer references amoureuse(id),
    url_photo varchar(500) not null
);


create table personne(
    id serial primary key ,
    nom varchar(50) not null ,
    age integer not null
);


