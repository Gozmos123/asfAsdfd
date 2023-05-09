CREATE DATABASE IF NOT EXISTS bhis;
use bhis;

CREATE TABLE
    puroks (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        purok_name VARCHAR(100) NOT NULL UNIQUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL
    );

insert into puroks(purok_name, last_user)values('1', 'admin');

insert into puroks(purok_name, last_user)values('2', 'admin');

insert into puroks(purok_name, last_user)values('3', 'admin');

CREATE TABLE
    religions (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        religion_name VARCHAR(255) NOT NULL UNIQUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL
    );

insert into
    religions(religion_name, last_user)
values
('Roman Catholic', 'admin');

CREATE TABLE
    users (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password CHAR(128) NOT NULL,
        user_type VARCHAR(25) NOT NULL,
        photo VARCHAR(255),
        first_name VARCHAR(100) NOT NULL,
        middle_name VARCHAR(100),
        last_name VARCHAR(100) NOT NULL,
        prefix VARCHAR(10),
        birthdate DATE NOT NULL,
        age INT NOT NULL,
        sex VARCHAR(20) NOT NULL,
        civil_status VARCHAR(20) NOT NULL,
        birthplace LONGTEXT NOT NULL,
        religion VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        contact_no VARCHAR(12),
        purok_name VARCHAR(100) NOT NULL,
        last_login_date DATETIME,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT FK_Users_Puroks_purok_name FOREIGN KEY (purok_name) REFERENCES puroks (purok_name) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Users_religion_Religions_religion_name FOREIGN KEY (religion) REFERENCES religions (religion_name) ON UPDATE CASCADE ON DELETE RESTRICT
    );

insert into
    users(
        username,
        password,
        user_type,
        photo,
        first_name,
        last_name,
        birthdate,
        age,
        sex,
        civil_status,
        birthplace,
        religion,
        purok_name
    )
values
(
        'admin',
        sha2('adminpass', 512),
        'administrator',
        'uploads/undraw_profile_2.svg',
        'Administrative',
        'User',
        '1990-01-01',
        33,
        'Male',
        'Married',
        'Catanduanes',
        'Roman Catholic',
        1
    );

insert into
    users(
        username,
        password,
        user_type,
        photo,
        first_name,
        last_name,
        birthdate,
        age,
        sex,
        civil_status,
        birthplace,
        religion,
        purok_name
    )
values
(
        'bhw',
        sha2('bhw_password', 512),
        'bhw',
        'uploads/undraw_profile_1.svg',
        'BHW',
        'User',
        '1990-01-01',
        33,
        'Female',
        'Married',
        'Catanduanes',
        'Roman Catholic',
        1
    );

insert into
    users(
        username,
        password,
        user_type,
        photo,
        first_name,
        last_name,
        birthdate,
        age,
        sex,
        civil_status,
        birthplace,
        religion,
        purok_name
    )
values
(
        'user',
        sha2('user_password', 512),
        'user',
        'uploads/undraw_profile_2.svg',
        'Barangay',
        'User',
        '1990-01-01',
        33,
        'Male',
        'Married',
        'Catanduanes',
        'Roman Catholic',
        1
    );

alter table puroks
add
    CONSTRAINT FK_Puroks_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT;

alter table religions
add
    CONSTRAINT FK_Religions_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT;

CREATE TABLE
    user_logs (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        action VARCHAR(255) NOT NULL,
        content LONGTEXT,
        changes LONGTEXT,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT FK_UserLogs_Users_username FOREIGN KEY (username) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE
    civil_status (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        civil_status VARCHAR(25) NOT NULL UNIQUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_CivilStatus_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT
    );

insert into
    civil_status(civil_status, last_user)
values('Single', 'admin');

insert into
    civil_status(civil_status, last_user)
values('Married', 'admin');

insert into
    civil_status(civil_status, last_user)
values('Widowed', 'admin');

insert into
    civil_status(civil_status, last_user)
values
('Divorced/Separated', 'admin');

insert into
    civil_status(civil_status, last_user)
values('Annulled', 'admin');

insert into
    civil_status(civil_status, last_user)
values
('Common-law/Live-in', 'admin');

insert into
    civil_status(civil_status, last_user)
values('Unknown', 'admin');

CREATE TABLE
    mothers (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        photo VARCHAR(255),
        first_name VARCHAR(100) NOT NULL,
        middle_name VARCHAR(100),
        last_name VARCHAR(100) NOT NULL,
        birthdate DATE NOT NULL,
        age INT NOT NULL,
        sex VARCHAR(20) NOT NULL DEFAULT 'Female',
        civil_status VARCHAR(25) NOT NULL,
        highest_educ_attainment VARCHAR(255),
        birthplace LONGTEXT NOT NULL,
        religion VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        contact_no VARCHAR(12),
        purok_name VARCHAR(100) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_Mothers_Puroks_purok_name FOREIGN KEY (purok_name) REFERENCES puroks (purok_name) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Mothers_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Mothers_religion_Religions_religion_name FOREIGN KEY (religion) REFERENCES religions (religion_name) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Mothers_CivilStatus_civil_status FOREIGN KEY (civil_status) REFERENCES civil_status (civil_status) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE
    childrens (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        photo VARCHAR(255),
        first_name VARCHAR(100) NOT NULL,
        middle_name VARCHAR(100),
        last_name VARCHAR(100) NOT NULL,
        prefix VARCHAR(10),
        birthdate DATE NOT NULL,
        age VARCHAR(20) NOT NULL,
        sex VARCHAR(20) NOT NULL,
        civil_status VARCHAR(20) NOT NULL,
        highest_educ_attainment VARCHAR(255),
        birthplace LONGTEXT NOT NULL,
        religion VARCHAR(255) NOT NULL,
        email VARCHAR(255),
        contact_no VARCHAR(12),
        disability VARCHAR(255) NOT NULL,
        mother_id BIGINT UNSIGNED NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_Childrens_mother_id_Mothers_id FOREIGN KEY (mother_id) REFERENCES mothers (id) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Childrens_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Childrens_religion_Religions_religion_name FOREIGN KEY (religion) REFERENCES religions (religion_name) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Childrens_CivilStatus_civil_status FOREIGN KEY (civil_status) REFERENCES civil_status (civil_status) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE
    vitamins (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        children_id BIGINT UNSIGNED NOT NULL,
        date_given DATE,
        given_by varchar(255) not null,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_Vitamins_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Vitamins_children_id_Childrens_id FOREIGN KEY (children_id) REFERENCES childrens (id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE
    deworms (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        children_id BIGINT UNSIGNED NOT NULL,
        place_given LONGTEXT NOT NULL,
        date_given DATE,
        given_by varchar(255),
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_Deworms_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Deworms_children_id_Childrens_id FOREIGN KEY (children_id) REFERENCES childrens (id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE
    weights (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        children_id BIGINT UNSIGNED NOT NULL,
        weight DECIMAL(8, 2),
        height DECIMAL(8, 2),
        nutrition_status VARCHAR(100),
        checked_by VARCHAR(255),
        date_checked DATE NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_Weights_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Weights_children_id_Childrens_id FOREIGN KEY (children_id) REFERENCES childrens (id) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE
    immunizations_type (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        immunization_type VARCHAR(100) NOT NULL UNIQUE,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_ImmunizationsType_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT
    );

CREATE TABLE
    immunizations (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        children_id BIGINT UNSIGNED NOT NULL,
        vaccine_name VARCHAR(255) NOT NULL,
        dose VARCHAR(50) NOT NULL,
        date_given DATE,
        immunization_type VARCHAR(100) NOT NULL,
        administered_by VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        last_user VARCHAR(50) NOT NULL,
        CONSTRAINT FK_Immunizations_last_user_Users_username FOREIGN KEY (last_user) REFERENCES users (username) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Immunizations_children_id_Childrens_id FOREIGN KEY (children_id) REFERENCES childrens (id) ON UPDATE CASCADE ON DELETE RESTRICT,
        CONSTRAINT FK_Immunizations_ImmunizationsType FOREIGN KEY (immunization_type) REFERENCES immunizations_type (immunization_type) ON UPDATE CASCADE ON DELETE RESTRICT
    );