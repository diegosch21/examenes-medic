USE dcs_examenes;

#alumnos
INSERT INTO alumnos(lu_alu,apellido_alu,nom_alu,dni_alu) VALUES(100233,'Gómez','Fulano',37896524);
INSERT INTO alumnos(lu_alu,apellido_alu,nom_alu,dni_alu) VALUES(110568,'González','Natalia',39852147);
INSERT INTO alumnos(lu_alu,apellido_alu,nom_alu,dni_alu) VALUES(102137,'Prince','Martin',36893521);
INSERT INTO alumnos(lu_alu,apellido_alu,nom_alu,dni_alu) VALUES(93256,'Muntz','Nelson',35987654);
INSERT INTO alumnos(lu_alu,apellido_alu,nom_alu,dni_alu) VALUES(87546,'Jones','Jimbo',33843567);

#docentes
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,email_doc, admin) 
		VALUES(123,MD5('admin'),'Administrador','Super',11111111,'admin@laboratorios.dcs.uns.edu.ar',1);
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,email_doc,tel_doc) 
		VALUES(5201,MD5('hola'),'Zapata','Juan',10568956,'johnzapata@uns.edu.ar','4568746');
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,admin) 
		VALUES(10325,MD5('123456'),'Skinner','Seymour',9125654,'skinner@springfield.com','(011)156-589632',2); #2º nivel de admin
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc) 
		VALUES(7865,MD5('7865'),'Pérez','Marcela',20568987); 	

#carreras
INSERT INTO carreras(cod_carr,nom_carr) VALUES (166,'Licenciatura en Enfermería');
INSERT INTO carreras(cod_carr,nom_carr) VALUES (155,'Medicina');

#catedras
INSERT INTO catedras(cod_cat,cod_carr,nom_cat)
		VALUES(20018,166,'Enfermería, Fundamentos, Prácticas y Tendencias II');
INSERT INTO catedras(cod_cat,cod_carr,nom_cat)
		VALUES(20020,166,'Enfermería Familiar I');
INSERT INTO catedras(cod_cat,cod_carr,nom_cat)
		VALUES(20059,155,'Examen general final de carrera');

#Alumnos asociados a las catedras
INSERT INTO alumnos_catedras(lu_alu,cod_cat,estado_alu_cat) VALUES(100233,20018,1);
INSERT INTO alumnos_catedras(lu_alu,cod_cat,estado_alu_cat) VALUES(110568,20018,2);
INSERT INTO alumnos_catedras(lu_alu,cod_cat,estado_alu_cat) VALUES(110568,20020,1);
INSERT INTO alumnos_catedras(lu_alu,cod_cat) VALUES(93256,20020);
INSERT INTO alumnos_catedras(lu_alu,cod_cat,estado_alu_cat) VALUES(102137,20059,1);

#Docentes asociados a las catedras
INSERT INTO docentes_catedras(leg_doc,cod_cat,permiso_doc) VALUES (5201,20018,1);
INSERT INTO docentes_catedras(leg_doc,cod_cat,permiso_doc) VALUES (7865,20018,0);
INSERT INTO docentes_catedras(leg_doc,cod_cat,permiso_doc) VALUES (7865,20020,1);
INSERT INTO docentes_catedras(leg_doc,cod_cat) VALUES (10325,20059);

#Guia
INSERT INTO guias (cod_cat,nro_guia,tit_guia) 
		VALUES(20018,8,'Control de constantes vitales');

	INSERT INTO descripciones(id_guia,nom_desc,contenido_desc)
			VALUES(1,'Objetivo del taller','El estudiante será capaz  de controlar  constantes vitales.');
	INSERT INTO descripciones(id_guia,nom_desc,contenido_desc)
			VALUES(1,'Caso clínico','La señorita Mayra, de 20 años, ingresa al consultorio para control de presión arterial, pulso, frecuencia  respiratoria,  temperatura y dolor.');
	INSERT INTO descripciones(id_guia,nom_desc,contenido_desc)
			VALUES(1,'Escenario','Laboratorio de competencias profesionales.');
	INSERT INTO descripciones(id_guia,nom_desc,contenido_desc)
			VALUES(1,'Requerimientos','Usuario simulado, estetoscopio, esfigmomanómetro, reloj, termómetro digital, torundas de algodón, alcohol en gel, alcohol al 70%, bandeja, hojas de registro, bolígrafo, bolsa  roja, toallas descartables.');		

	INSERT INTO items(nom_item)	VALUES('Se lava las manos al inicio del procedimiento.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,1);
	INSERT INTO grupositems(nom_grupoitem,nro_grupoitem) VALUES ('Prepara material:',2);
		INSERT INTO items(nom_item)	VALUES('Bandeja.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,1,1);
		INSERT INTO items(nom_item)	VALUES('Torundas de algodón.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,2,1);
		INSERT INTO items(nom_item)	VALUES('Estetoscopio y esfigmomanómetro.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,3,1);
		INSERT INTO items(nom_item)	VALUES('Reloj.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,4,1);
		INSERT INTO items(nom_item)	VALUES('Termómetro digital.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,5,1);
		INSERT INTO items(nom_item)	VALUES('Alcohol en gel.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,6,1);
		INSERT INTO items(nom_item)	VALUES('Alcohol al 70%.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,7,1);
		INSERT INTO items(nom_item)	VALUES('Hojas de registro.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,8,1);
		INSERT INTO items(nom_item)	VALUES('Bolígrafo.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,9,1);
		INSERT INTO items(nom_item)	VALUES('Bolsa roja.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,10,1);
		INSERT INTO items(nom_item)	VALUES('Toallas descartables.');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,11,1);
	INSERT INTO items(nom_item)	VALUES('Identifica al usuario y se presenta.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,3);
	INSERT INTO items(nom_item)	VALUES('Explica el procedimiento a realizar.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,4);
	INSERT INTO items(nom_item)	VALUES('Considera la privacidad del usuario.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,5);
	INSERT INTO items(nom_item)	VALUES('Tiene en cuenta los factores predisponentes que alteran la presión arterial, pulso, frecuencia  respiratoria,  temperatura y dolor.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,6);
	INSERT INTO items(nom_item)	VALUES('Presión Arterial: Coloca adecuadamente el manguito.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,7);
	INSERT INTO items(nom_item)	VALUES('Palpa pulsos para localizar arterias (radial y braquial).');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,8);
	INSERT INTO items(nom_item)	VALUES('Insufla el manguito de acuerdo al pulso radial percibido y 20 mmHg. por encima de la ausencia del mismo.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,9);
	INSERT INTO items(nom_item)	VALUES('Coloca la membrana del estetoscopio en el lugar adecuado (arteria braquial).');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,10);
	INSERT INTO items(nom_item)	VALUES('Abre la válvula del rubinete y desinfla el manguito.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,11);
	INSERT INTO items(nom_item)	VALUES('Percibe presión arterial sistólica y diastólica.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,12);
	INSERT INTO items(nom_item)	VALUES('Pulso: Ubica adecuadamente la arteria para tomar pulso radial.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,13);
	INSERT INTO items(nom_item)	VALUES('Tiene en cuenta las características del pulso (frecuencia, ritmo, amplitud y elasticidad).');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,14);
	INSERT INTO items(nom_item)	VALUES('Utiliza  el tiempo correcto, 60’’ o 30’’ si es regular.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,15);
	INSERT INTO items(nom_item)	VALUES('Temperatura: Verifica el estado de la axila.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,16);
	INSERT INTO items(nom_item)	VALUES('Utiliza las toallas descartables si es necesario.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,17);
	INSERT INTO items(nom_item)	VALUES('Coloca el termómetro en la línea media axilar.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,18);
	INSERT INTO items(nom_item)	VALUES('Espera el tiempo correcto para la lectura según el termómetro utilizado.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,19);		
	INSERT INTO items(nom_item)	VALUES('Frecuencia Respiratoria: Tiene en cuenta las características de la respiración (frecuencia, profundidad, ritmo y calidad).');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,20);	
	INSERT INTO items(nom_item)	VALUES('Utiliza  el tiempo correcto (60’’).');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,21);	
	INSERT INTO items(nom_item)	VALUES('Dolor: Explica el procedimiento.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,22);	
	INSERT INTO items(nom_item)	VALUES('Solicita que ubique grado de dolor en la escala numérica.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,23);	
	INSERT INTO items(nom_item)	VALUES('Limpia y ordena  los elementos utilizados.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,24);	
	INSERT INTO items(nom_item)	VALUES('Informa al usuario los valores obtenidos.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,25);	
	INSERT INTO items(nom_item)	VALUES('Se lava las manos');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,26);	
	INSERT INTO items(nom_item)	VALUES('Registra el procedimiento.');
	INSERT INTO items_guias(id_item,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,27);								

	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Realizar la técnica completa y su registro.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,1);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para leer el caso: 2 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,2);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para preparar los materiales: 3 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,3);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para realizar y registrar la técnica: 10 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,4);			

#Examen	
INSERT INTO examenes (id_guia,lu_alu,leg_doc,calificacion,obs_exam) 
		VALUES(1,100233,5201,1,'Esta es una observación general del examen');

	INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item) VALUES (1,1,0,'Esto es una observación');
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (2,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (3,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (4,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (5,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (6,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (7,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (8,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (9,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (10,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (11,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (12,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (13,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (14,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (15,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (16,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (17,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (18,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (19,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (20,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (21,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (22,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (23,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (24,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item) VALUES (25,1,-1,'No pudo ser observado');
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (26,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (27,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (28,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (29,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (30,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (31,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (32,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (33,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (34,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (35,1,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (36,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (37,1,1);

#Guia medicina
INSERT INTO guias (cod_cat,nro_guia,tit_guia,subtit_guia) 
		VALUES(20059,3,'Examen final de carrera','Estación nº 3'); #id: 2

	#No hay descripciones

	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Historia clínica',1); #id: 1
		INSERT INTO items(nom_item)	VALUES('Investiga comienzo'); #id: 38
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,1,1);
		INSERT INTO items(nom_item)	VALUES('Investiga evolución');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,2,1);
		INSERT INTO grupositems(nom_grupoitem,nro_grupoitem) VALUES ('Respecto del dolor abdominal:',3); #id: 2
			INSERT INTO items(nom_item)	VALUES('Localización');
			INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,1,2,1);
			INSERT INTO items(nom_item)	VALUES('Irradiación');
			INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,2,2,1);
			INSERT INTO items(nom_item)	VALUES('Calma con las comidas');
			INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,3,2,1);
			INSERT INTO items(nom_item)	VALUES('Horarios');
			INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,4,2,1);
			INSERT INTO items(nom_item)	VALUES('Duración');
			INSERT INTO items_guias(id_item,id_guia,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,5,2,1);
		INSERT INTO items(nom_item)	VALUES('Investiga nauseas');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,4,1);	
		INSERT INTO items(nom_item)	VALUES('Investiga vomito');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,5,1);
		INSERT INTO items(nom_item)	VALUES('Investiga sobre la dieta (debe preguntar sobre tipo de alimentos y cantidad');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,6,1);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Examen físico',2); #id: 2
		INSERT INTO items(nom_item)	VALUES('Anuncia que realiza inspección y observa el abdomen por instante (no se penaliza si no observa la contracción muscular o la inspiración profunda');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,1,2);
		INSERT INTO items(nom_item)	VALUES('Realiza palpación superficial (debe comenzar por el lugar opuesto al dolor');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,2,2);
		INSERT INTO items(nom_item)	VALUES('Realiza maniobra de descomprensión abdominal');  #id: 50
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,3,2);
		INSERT INTO items(nom_item)	VALUES('Realiza al menos una de las siguientes maniobras (búsqueda del signo de psoas, del obturador, Rovsing) ');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,4,2);
		INSERT INTO items(nom_item)	VALUES('Realiza auscultación del abdomen');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,5,2);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Pedido de exámenes complementarios. Debe incluir todos',3); #id: 3
		INSERT INTO items(nom_item)	VALUES('Ecografía');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,1,3);
		INSERT INTO items(nom_item)	VALUES('Recuento leucocitario o hemograma');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,2,3);
		INSERT INTO items(nom_item)	VALUES('Sedimento urinario');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,3,3);
		INSERT INTO items(nom_item,solo_texto)	VALUES('Examenes solicitados',TRUE);    #id: 56
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,4,3);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Diagnóstico principal',4); #id: 4
		INSERT INTO items(nom_item)	VALUES('DEBE DECIR Abdomen agudo quirúrgico o Apendicitis aguda o abdomen agudo inflamatorio');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,1,4);
		INSERT INTO items(nom_item,solo_texto)	VALUES('¿Qué diagnóstico considera como más probable?',TRUE);  #id: 58
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,2,4);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('¿Qué recomendación realiza?',5); #id: 5
		INSERT INTO items(nom_item)	VALUES('Internación en observación');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,1,5);
		INSERT INTO items(nom_item)	VALUES('Consulta con cirujano de guardia');
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,2,5);
		INSERT INTO items(nom_item,solo_texto)	VALUES('¿Qué decisión tomaría con el paciente?',TRUE); #id: 61
		INSERT INTO items_guias(id_item,id_guia,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,3,5);	
	

	#No hay itemsestudiante

#Examen	
INSERT INTO examenes (id_guia,lu_alu,leg_doc,calificacion,obs_exam) 
		VALUES(2,102137,10325,0,'Esta es una observación general del examen');

	INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item) VALUES (38,2,0,'Esto es una observación');
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (39,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (40,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (41,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (42,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (43,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (44,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (45,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (46,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (47,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (48,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (49,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (50,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (51,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (52,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (53,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (54,2,1);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (55,2,1);
	INSERT INTO items_examenes(id_item,id_exam,obs_item) VALUES (56,2,'Bla bla bla'); #solo texto
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (57,2,1);
	INSERT INTO items_examenes(id_item,id_exam,obs_item) VALUES (58,2,'Bla bla bla'); #solo texto
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (59,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (60,2,1);
	INSERT INTO items_examenes(id_item,id_exam,obs_item) VALUES (61,2,'Bla bla bla'); #solo texto


#Consulta de los examanes
SELECT * FROM guias NATURAL LEFT JOIN items_guias NATURAL LEFT JOIN items NATURAL LEFT JOIN examenes NATURAL LEFT JOIN items_examenes;