CREATE DATABASE fantacalcio;
USE fantacalcio;

-- Tabella degli utenti
CREATE TABLE user (
    id int PRIMARY KEY,
    username nvarchar(255) NOT NULL,
    password nvarchar(255) NOT NULL,
    email nvarchar(255) NOT NULL);

-- Tabella delle squadre
CREATE TABLE team (
    id int PRIMARY KEY,
    name nvarchar(100) NOT NULL,
    user_id int NOT NULL,
    FOREIGN KEY (utente_id) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE);

-- Tabella dei giocatori
CREATE TABLE player (
    id int PRIMARY KEY,
    name nvarchar(100) NOT NULL,
    surname nvarchar(100) NOT NULL,
    player_role nvarchar(50) NOT NULL,
    price decimal(10,2) NOT NULL);

-- Tabella delle rose
CREATE TABLE squad
    id int PRIMARY KEY,
    team_id int NOT NULL,
    player_id int NOT NULL,
    FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (player_id) REFERENCES player(id) ON DELETE CASCADE ON UPDATE CASCADE);

-- Tabella delle partite
CREATE TABLE match (
    id int PRIMARY KEY,
    homeTeam_id int NOT NULL,
    visitorTeam_id int NOT NULL,
    date_time datetime NOT NULL,
    homeTeamGoal int DEFAULT 0,
    visitorTeamGoal int DEFAULT 0,
    FOREIGN KEY (homeTeam_id) REFERENCES team(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (visitorTeam_id) REFERENCES team(id) ON DELETE CASCADE ON UPDATE CASCADE);

-- Tabella dei punteggi
CREATE TABLE score (
    id int PRIMARY KEY,
    team_id int NOT NULL,
    match_id int NOT NULL,
    score int NOT NULL,
    FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (match_id) REFERENCES match(id) ON DELETE CASCADE ON UPDATE CASCADE);

-- Tabella della classifica
CREATE TABLE ranking (
    id int PRIMARY KEY,
    team_id int NOT NULL,
    score int NOT NULL,
    place int NOT NULL,
    FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE CASCADE ON UPDATE CASCADE);

-- Tabella dell'asta
CREATE TABLE auction (
    id int PRIMARY KEY,
    player_id int NOT NULL,
    team_id int NOT NULL,
    price decimal(10,2) NOT NULL,
    date_time datetime NOT NULL,
    duration int NOT NULL,
    description nvarchar(255) NOT NULL,
 	FOREIGN KEY (player_id) REFERENCES player(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (team_id) REFERENCES team(id) ON DELETE CASCADE ON UPDATE CASCADE);