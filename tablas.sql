create table clases(
	id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre varchar(20),
	descripcion varchar(50),
	id_lugar INT,
	fecha date,
	hora time,
	activo int,
    actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
alter table clases add index nombre(nombre);


create table clases_precios(
	id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_clase MEDIUMINT UNSIGNED,
	descripcion varchar(20),
	fecha varchar(20),
	hora varchar(20),
	activo varchar(20),
    actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
alter table clases_precios add index id_clase(id_clase);

create table clases_horarios(
	id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    id_clase MEDIUMINT UNSIGNED,
    dia_semana int,
	descripcion varchar(20),
	desde_hora time,
	hasta_hora time,
	activo varchar(20),
    actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
alter table clases_precios add index id_clase(id_clase);

create table lugares(
	id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre varchar(20),
	descripcion varchar(50),
	activo varchar(20),
    actualizado DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);
alter table clases_precios add index id_clase(id_clase);




