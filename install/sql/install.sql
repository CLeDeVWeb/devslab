CREATE DATABASE IF NOT EXISTS DEVLAB
CHARACTER SET utf8mb4
COLLATE utf8mb4_0900_ai_ci;

USE DEVLAB;

SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS DOCUMENT;
DROP TABLE IF EXISTS TICKET;
DROP TABLE IF EXISTS SITE;
DROP TABLE IF EXISTS CLIENT;

SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE CLIENT
(
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    nom          VARCHAR(100) NOT NULL,
    prenom       VARCHAR(100) NOT NULL,

    email        VARCHAR(255),
    telephone    VARCHAR(30),

    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX idx_nom (nom)
);

CREATE TABLE SITE
(
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    client_id    INT UNSIGNED NOT NULL,

    nom          VARCHAR(150) NOT NULL,
    adresse      VARCHAR(255),
    cp           VARCHAR(10),
    ville        VARCHAR(100),

    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_site_client
        FOREIGN KEY (client_id)
        REFERENCES CLIENT(id)
        ON DELETE CASCADE,

    INDEX idx_client (client_id)
);
CREATE TABLE TICKET
(
    id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    site_id         INT UNSIGNED NOT NULL,

    titre           VARCHAR(512) NOT NULL,

    description      VARCHAR(1024) NOT NULL,

    statut ENUM(
        'Nouveau',
        'En cours',
        'Résolu',
        'Fermé'
    ) DEFAULT 'Nouveau',

    priorite ENUM(
        'Basse',
        'Normale',
        'Haute',
        'Critique'
    ) DEFAULT 'Normale',

    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_ticket_site
        FOREIGN KEY(site_id)
        REFERENCES SITE(id)
        ON DELETE CASCADE,

    INDEX idx_site(site_id),
    INDEX idx_statut(statut)
);

CREATE TABLE DOCUMENT
(
    id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    site_id      INT UNSIGNED NOT NULL,

    nom          VARCHAR(255) NOT NULL,

    fichier      VARCHAR(255) NOT NULL,

    type         VARCHAR(50),

    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_document_site
        FOREIGN KEY(site_id)
        REFERENCES SITE(id)
        ON DELETE CASCADE,

    INDEX idx_site(site_id)
);
