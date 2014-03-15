#-------------------------------------------------------------------------------------------
#---------- Archivo batch (database.sql) para la creación de la Base de datos  -------------
#-------------------------------------------------------------------------------------------

# Creamos Base de Datos
CREATE DATABASE IF NOT EXISTS dcs_examenes;

# selecciono la base de datos sobre la cual voy a hacer modificaciones
USE dcs_examenes;

#-------------------------------------------------------------------------------------------
#------------------------------- Creación tablas -------------------------------------------
#-------------------------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS alumnos (
	id_alu INT UNSIGNED NOT NULL AUTO_INCREMENT,
	lu INT UNSIGNED NOT NULL UNIQUE,
	apellido_alu VARCHAR(50) NOT NULL,
	nom_alu VARCHAR(50) NOT NULL,
	dni_alu INT UNIQUE,

	PRIMARY KEY(id_alu)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS docentes (  # Usuarios del sistema
	id_doc INT UNSIGNED NOT NULL AUTO_INCREMENT,
	legajo INT UNSIGNED NOT NULL UNIQUE,
	pass VARCHAR(60) NOT NULL,
	apellido_doc VARCHAR(50) NOT NULL,
	nom_doc VARCHAR(50) NOT NULL,
	dni_doc INT NOT NULL UNIQUE,
	email_doc VARCHAR(60),
	telefono VARCHAR(20),
	activo BOOLEAN NOT NULL DEFAULT FALSE,
	admin INT NOT NULL DEFAULT -1,

	PRIMARY KEY(id_doc)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS carreras (
	id_carr INT UNSIGNED NOT NULL AUTO_INCREMENT,
	cod_carr INT UNSIGNED NOT NULL UNIQUE,
	nom_carr VARCHAR(40) NOT NULL,

	PRIMARY KEY(id_carr)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS catedras (
	id_cat INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_carr INT UNSIGNED NOT NULL,
	cod_cat INT UNSIGNED NOT NULL UNIQUE,
	nom_cat VARCHAR(80) NOT NULL,

	PRIMARY KEY(id_cat),
	FOREIGN KEY (id_carr) REFERENCES carreras (id_carr)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS alumnos_catedras (
	id_alu_cat INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_alu INT UNSIGNED NOT NULL,
	id_cat INT UNSIGNED NOT NULL,
	estado_alu_cat INT NOT NULL DEFAULT -1,

	PRIMARY KEY (id_alu_cat),
	FOREIGN KEY (id_alu) REFERENCES alumnos(id_alu),
	FOREIGN KEY (id_cat) REFERENCES catedras(id_cat)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS guias (
	id_guia INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_cat INT UNSIGNED NOT NULL,  
	id_nroguia INT UNSIGNED NOT NULL,
	tit_guia VARCHAR(100) NOT NULL,
	subtit_guia VARCHAR(160),

	PRIMARY KEY(id_guia),
	FOREIGN KEY (id_cat) REFERENCES catedras (id_cat) 
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS descripciones (
	id_desc INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_guia INT UNSIGNED NOT NULL,
	nom_desc VARCHAR(50), # Titulo descripcion
	contenido_desc TEXT, # Texto descripcion

	PRIMARY KEY(id_desc),
	FOREIGN KEY (id_guia) REFERENCES guias (id_guia)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS secciones (
	id_sec INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_sec VARCHAR(50), # Titulo seccion
		
	PRIMARY KEY(id_sec)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS grupositems (
	id_grupoitem INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_grupoitem VARCHAR(255), # Titulo grupo
		
	PRIMARY KEY(id_grupoitem)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS items (
	id_item INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_grupoitem INT UNSIGNED,
	id_sec INT UNSIGNED,
	nom_item VARCHAR(255) NOT NULL, # nombre pauta
	solo_texto BOOLEAN NOT NULL DEFAULT FALSE,
		
	PRIMARY KEY(id_item),
	FOREIGN KEY (id_grupoitem) REFERENCES grupositems (id_grupoitem),
	FOREIGN KEY (id_sec) REFERENCES secciones (id_sec)

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS items_guias (
	id_item_guia INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_item INT UNSIGNED NOT NULL,
	id_guia INT UNSIGNED NOT NULL,
	nro_item INT UNSIGNED NOT NULL, #pos del item en la guia

	PRIMARY KEY(id_item_guia),
	FOREIGN KEY (id_guia) REFERENCES guias (id_guia),
	FOREIGN KEY (id_item) REFERENCES items (id_item)

)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS itemsestudiante (
	id_itemest INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_itemest VARCHAR(255) NOT NULL, # nombre pauta
		
	PRIMARY KEY(id_itemest)
	
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS itemsestudiantes_guias (
	id_itemest_guia INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_item INT UNSIGNED NOT NULL,
	id_guia INT UNSIGNED NOT NULL,
	nro_item INT UNSIGNED NOT NULL,

	PRIMARY KEY(id_itemest_guia),
	FOREIGN KEY (id_guia) REFERENCES guias (id_guia),
	FOREIGN KEY (id_item) REFERENCES items (id_item)

)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS examenes (
	id_exam INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_guia INT UNSIGNED NOT NULL,
	id_alu INT UNSIGNED NOT NULL, 
	id_doc INT UNSIGNED NOT NULL,
	fecha DATE NOT NULL,

	PRIMARY KEY(id_exam),
	FOREIGN KEY (id_guia) REFERENCES guias (id_guia),
	FOREIGN KEY (id_alu) REFERENCES alumnos (id_alu),
	FOREIGN KEY (id_doc) REFERENCES docentes (id_doc)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS items_examenes (
	id_item_exam INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_item INT UNSIGNED NOT NULL,
	id_exam INT UNSIGNED NOT NULL,
	estado_item INT NOT NULL DEFAULT -1, #-1: sin responder, 0: NO, 1: SI
	obs_item TEXT,  # observacion

	PRIMARY KEY(id_item_exam),
	FOREIGN KEY (id_exam) REFERENCES examenes (id_exam),
	FOREIGN KEY (id_item) REFERENCES items (id_item)

)ENGINE=InnoDB;



#---------------------------------------------------------
# Creacion usuario dcs_lab. Password:
# 
#CREATE USER dcs_lab IDENTIFIED BY 'dcic2014..';

#GRANT ALL PRIVILEGES ON dcs_examenes.* TO dcs_lab IDENTIFIED BY 'dcic2014..';
