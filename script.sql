DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS groups;
DROP TABLE IF EXISTS userpergroup;
DROP TABLE IF EXISTS userapp;

CREATE TABLE user
(
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(150),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletedAt TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE groups
(
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description VARCHAR(150),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deletedAt TIMESTAMP NULL DEFAULT NULL
);

CREATE TABLE userpergroup
(
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    user BIGINT REFERENCES user(id),
    groups BIGINT REFERENCES groups(id),
    createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE userapp(
    id BIGINT AUTO_INCREMENT PRIMARY KEY ,
    username VARCHAR( 50 ) NOT NULL ,
    pass VARCHAR( 300 ) NOT NULL
);

INSERT INTO userapp(username, pass) VALUES('admin','21232f297a57a5a743894a0e4a801fc3');
INSERT INTO userapp(username, pass) VALUES('amijares','b1775eaf746903ad18dcf104ce926f88');
