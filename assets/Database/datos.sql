USE dcs_examenes;

#alumnos
INSERT INTO alumnos(lu_alu,apellido_alu,nom_alu,dni_alu) VALUES
	(100233,'Gómez','Fulano',37896524),
	(110568,'González','Natalia',39852147),
	(105698,'Enriquez','Heracio',39852136),
	(100598,'Johansen','Paloma',37333636),
	(102137,'Prince','Martin',36893521),
	(106601,'Gorgory','Rafael',38652459),
	(87546,'Jones','Jimbo',33843567),
	(93256,'Muntz','Nelson',35987654);

#docentes
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,email_doc, privilegio,activo) 
		VALUES(123,MD5('admin'),'Administrador','Super',11111111,'admin@laboratorios.dcs.uns.edu.ar',3,TRUE);
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,activo) 
		VALUES(5201,MD5('hola'),'Zapata','Juan',10568956,'johnzapata@uns.edu.ar','4568746',TRUE);
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,privilegio,activo) 
		VALUES(10325,MD5('123456'),'Skinner','Seymour',9125654,'skinner@springfield.com','(011)156-589632',2,TRUE); #2º nivel de admin
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,activo) 
		VALUES(7865,MD5('7865'),'Pérez','Marcela',20568987,TRUE); 	
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,activo) 
		VALUES(5555,MD5('5555'),'Natalia','Natalia',5585585,TRUE);		
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc) 
		VALUES(1010	,MD5('1010'),'Castaña','Cacho',5654456); 
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc,dni_doc,privilegio) 
		VALUES(2020	,MD5('2020'),'Mensaje','Manda',12356845,-1); 

#carreras
INSERT INTO carreras(cod_carr,nom_carr) VALUES
	(166,'Licenciatura en Enfermería'),
	(155,'Medicina');

#catedras
INSERT INTO catedras(cod_cat,cod_carr,nom_cat) VALUES
	(20018,166,'Enfermería, Fundamentos, Prácticas y Tendencias II'),
	(20020,166,'Enfermería Familiar I'),
	(20022,166,'Enfermería Familiar II'),
	(20024,166,'Enfermería Familiar III'),
	(20063,155,'Obstetricia y ginecología'),
	(20059,155,'Examen general final de carrera');

#Alumnos asociados a las catedras
INSERT INTO alumnos_catedras(lu_alu,cod_cat,estado_alu_cat) VALUES
	(100233,20018,1),
	(93256,20018,1),
	(110568,20018,2),
	(100598,20018,2),
	(110568,20020,1),
	(87546,20020,1),
	(102137,20059,1),
	(105698,20059,0),
	(105698,20022,2),
	(100233,20022,1),
	(102137,20024,1),
	(106601,20063,1),
	(102137,20063,1);
INSERT INTO alumnos_catedras(lu_alu,cod_cat) VALUES
	(93256,20020);


#Docentes asociados a las catedras
INSERT INTO docentes_catedras(leg_doc,cod_cat,permiso_doc) VALUES
	(5201,20018,1),
	(5201,20020,1),
	(5201,20022,0),
	(5201,20024,0),
	(7865,20020,1),
	(7865,20018,0),
	(7865,20022,2),
	(7865,20024,0),
	(10325,20059,2),
	(5555,20063,1);

#Guia id: 1
INSERT INTO guias (tit_guia) 
		VALUES('Control de constantes vitales');
INSERT INTO guias_catedras(id_guia,cod_cat,nro_guia)		
		VALUES(LAST_INSERT_ID(),20018,8);

	INSERT INTO descripciones(id_guia,nom_desc,contenido_desc) VALUES
		(1,'Objetivo del taller','El estudiante será capaz  de controlar  constantes vitales.'),
		(1,'Caso clínico','La señorita Mayra, de 20 años, ingresa al consultorio para control de presión arterial, pulso, frecuencia  respiratoria,  temperatura y dolor.'),
		(1,'Escenario','Laboratorio de competencias profesionales.'),
		(1,'Requerimientos','Usuario simulado, estetoscopio, esfigmomanómetro, reloj, termómetro digital, torundas de algodón, alcohol en gel, alcohol al 70%, bandeja, hojas de registro, bolígrafo, bolsa  roja, toallas descartables.');		

	INSERT INTO items(nom_item)	VALUES('Se lava las manos al inicio del procedimiento.');  #id_item = 1
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,1,1);
	INSERT INTO grupositems(nom_grupoitem,nro_grupoitem) VALUES ('Prepara material:',2);
		INSERT INTO items(nom_item)	VALUES('Bandeja.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,2,1,1);
		INSERT INTO items(nom_item)	VALUES('Torundas de algodón.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,3,2,1);
		INSERT INTO items(nom_item)	VALUES('Estetoscopio y esfigmomanómetro.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,4,3,1);
		INSERT INTO items(nom_item)	VALUES('Reloj.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,5,4,1);
		INSERT INTO items(nom_item)	VALUES('Termómetro digital.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,6,5,1);
		INSERT INTO items(nom_item)	VALUES('Alcohol en gel.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,7,6,1);
		INSERT INTO items(nom_item)	VALUES('Alcohol al 70%.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,8,7,1);
		INSERT INTO items(nom_item)	VALUES('Hojas de registro.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,9,8,1);
		INSERT INTO items(nom_item)	VALUES('Bolígrafo.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,10,9,1);
		INSERT INTO items(nom_item)	VALUES('Bolsa roja.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,11,10,1);
		INSERT INTO items(nom_item)	VALUES('Toallas descartables.');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),1,12,11,1);
	INSERT INTO items(nom_item)	VALUES('Identifica al usuario y se presenta.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,13,3);
	INSERT INTO items(nom_item)	VALUES('Explica el procedimiento a realizar.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,14,4);
	INSERT INTO items(nom_item)	VALUES('Considera la privacidad del usuario.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,15,5);
	INSERT INTO items(nom_item)	VALUES('Tiene en cuenta los factores predisponentes que alteran la presión arterial, pulso, frecuencia  respiratoria,  temperatura y dolor.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,16,6);
	INSERT INTO items(nom_item)	VALUES('Presión Arterial: Coloca adecuadamente el manguito.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,17,7);
	INSERT INTO items(nom_item)	VALUES('Palpa pulsos para localizar arterias (radial y braquial).');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,18,8);
	INSERT INTO items(nom_item)	VALUES('Insufla el manguito de acuerdo al pulso radial percibido y 20 mmHg. por encima de la ausencia del mismo.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,19,9);
	INSERT INTO items(nom_item)	VALUES('Coloca la membrana del estetoscopio en el lugar adecuado (arteria braquial).');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,20,10);
	INSERT INTO items(nom_item)	VALUES('Abre la válvula del rubinete y desinfla el manguito.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,21,11);
	INSERT INTO items(nom_item)	VALUES('Percibe presión arterial sistólica y diastólica.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,22,12);
	INSERT INTO items(nom_item)	VALUES('Pulso: Ubica adecuadamente la arteria para tomar pulso radial.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,23,13);
	INSERT INTO items(nom_item)	VALUES('Tiene en cuenta las características del pulso (frecuencia, ritmo, amplitud y elasticidad).');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,24,14);
	INSERT INTO items(nom_item)	VALUES('Utiliza  el tiempo correcto, 60’’ o 30’’ si es regular.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,25,15);
	INSERT INTO items(nom_item)	VALUES('Temperatura: Verifica el estado de la axila.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,26,16);
	INSERT INTO items(nom_item)	VALUES('Utiliza las toallas descartables si es necesario.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,27,17);
	INSERT INTO items(nom_item)	VALUES('Coloca el termómetro en la línea media axilar.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,28,18);
	INSERT INTO items(nom_item)	VALUES('Espera el tiempo correcto para la lectura según el termómetro utilizado.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,29,19);		
	INSERT INTO items(nom_item)	VALUES('Frecuencia Respiratoria: Tiene en cuenta las características de la respiración (frecuencia, profundidad, ritmo y calidad).');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,30,20);	
	INSERT INTO items(nom_item)	VALUES('Utiliza  el tiempo correcto (60’’).');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,31,21);	
	INSERT INTO items(nom_item)	VALUES('Dolor: Explica el procedimiento.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,32,22);	
	INSERT INTO items(nom_item)	VALUES('Solicita que ubique grado de dolor en la escala numérica.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,33,23);	
	INSERT INTO items(nom_item)	VALUES('Limpia y ordena  los elementos utilizados.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,34,24);	
	INSERT INTO items(nom_item)	VALUES('Informa al usuario los valores obtenidos.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,35,25);	
	INSERT INTO items(nom_item)	VALUES('Se lava las manos al finalizar el procedimiento.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,36,26);	
	INSERT INTO items(nom_item)	VALUES('Registra el procedimiento.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),1,37,27);								

	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Realizar la técnica completa y su registro.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,1);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para leer el caso: 2 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,2);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para preparar los materiales: 3 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,3);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para realizar y registrar la técnica: 10 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),1,4);			

#Examen	
INSERT INTO examenes (id_guia,cod_cat,lu_alu,leg_doc,calificacion,obs_exam) 
		VALUES(1,20018,100233,5201,1,'Esta es una observación general del examen');

	INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item) VALUES (1,1,0,'Esto es una observación');
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES 
		(2,1,1),
		(3,1,0),
		(4,1,1),
		(5,1,0),
		(6,1,1),
		(7,1,1),
		(8,1,1),
		(9,1,1),
		(10,1,0),
		(11,1,1),
		(12,1,1),
		(13,1,0),
		(14,1,1),
		(15,1,0),
		(16,1,0),
		(17,1,1),
		(18,1,1),
		(19,1,1),
		(20,1,1),
		(21,1,1),
		(22,1,0),
		(23,1,1),
		(24,1,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item) VALUES (25,1,-1,'No pudo ser observado');
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES
		(26,1,0),
		(27,1,1),
		(28,1,0),
		(29,1,1),
		(30,1,1),
		(31,1,1),
		(32,1,1),
		(33,1,0),
		(34,1,0),
		(35,1,1),
		(36,1,0),
		(37,1,1);

#Guia medicina
INSERT INTO guias (tit_guia) 
		VALUES('Examen final de carrera - Estación nº 3'); #id: 2
INSERT INTO guias_catedras(id_guia,cod_cat,nro_guia)		
		VALUES(LAST_INSERT_ID(),20059,3);		

	#No hay descripciones

	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Historia clínica',1); #id: 1
		INSERT INTO items(nom_item)	VALUES('Investiga comienzo'); #id: 38
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,1,1,1);
		INSERT INTO items(nom_item)	VALUES('Investiga evolución');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,2,2,1);
		INSERT INTO grupositems(nom_grupoitem,nro_grupoitem) VALUES ('Respecto del dolor abdominal:',3); #id: 2
			INSERT INTO items(nom_item)	VALUES('Localización');
			INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,3,1,2,1);
			INSERT INTO items(nom_item)	VALUES('Irradiación');
			INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,4,2,2,1);
			INSERT INTO items(nom_item)	VALUES('Calma con las comidas');
			INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,5,3,2,1);
			INSERT INTO items(nom_item)	VALUES('Horarios');
			INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,6,4,2,1);
			INSERT INTO items(nom_item)	VALUES('Duración');
			INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem,id_sec) VALUES (LAST_INSERT_ID(),2,7,5,2,1);
		INSERT INTO items(nom_item)	VALUES('Investiga nauseas');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,8,4,1);	
		INSERT INTO items(nom_item)	VALUES('Investiga vomito');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,9,5,1);
		INSERT INTO items(nom_item)	VALUES('Investiga sobre la dieta (debe preguntar sobre tipo de alimentos y cantidad');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,10,6,1);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Examen físico',2); #id: 2
		INSERT INTO items(nom_item)	VALUES('Anuncia que realiza inspección y observa el abdomen por instante (no se penaliza si no observa la contracción muscular o la inspiración profunda)');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,11,1,2);
		INSERT INTO items(nom_item)	VALUES('Realiza palpación superficial (debe comenzar por el lugar opuesto al dolor)');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,12,2,2);
		INSERT INTO items(nom_item)	VALUES('Realiza maniobra de descomprensión abdominal');  #id: 50
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,13,3,2);
		INSERT INTO items(nom_item)	VALUES('Realiza al menos una de las siguientes maniobras (búsqueda del signo de psoas, del obturador, Rovsing) ');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,14,4,2);
		INSERT INTO items(nom_item)	VALUES('Realiza auscultación del abdomen');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,15,5,2);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Pedido de exámenes complementarios. Debe incluir todos',3); #id: 3
		INSERT INTO items(nom_item)	VALUES('Ecografía');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,16,1,3);
		INSERT INTO items(nom_item)	VALUES('Recuento leucocitario o hemograma');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,17,2,3);
		INSERT INTO items(nom_item)	VALUES('Sedimento urinario');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,18,3,3);
		INSERT INTO items(nom_item,solo_texto)	VALUES('Examenes solicitados',TRUE);    #id: 56
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,19,4,3);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('Diagnóstico principal',4); #id: 4
		INSERT INTO items(nom_item)	VALUES('DEBE DECIR Abdomen agudo quirúrgico o Apendicitis aguda o abdomen agudo inflamatorio');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,20,1,4);
		INSERT INTO items(nom_item,solo_texto)	VALUES('¿Qué diagnóstico considera como más probable?',TRUE);  #id: 58
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,21,2,4);
	INSERT INTO secciones(nom_sec,nro_sec) VALUES ('¿Qué recomendación realiza?',5); #id: 5
		INSERT INTO items(nom_item)	VALUES('Internación en observación');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,22,1,5);
		INSERT INTO items(nom_item)	VALUES('Consulta con cirujano de guardia');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,23,2,5);
		INSERT INTO items(nom_item,solo_texto)	VALUES('¿Qué decisión tomaría con el paciente?',TRUE); #id: 61
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_sec) VALUES (LAST_INSERT_ID(),2,24,3,5);	
	

	#No hay itemsestudiante

#Examen	
INSERT INTO examenes (id_guia,cod_cat,lu_alu,leg_doc,calificacion,obs_exam) 
		VALUES(2,20059,102137,10325,0,'Esta es una observación general del examen');

	INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item) VALUES (38,2,0,'Esto es una observación');
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES
		(39,2,1),
		(40,2,0),
		(41,2,1),
		(42,2,0),
		(43,2,1),
		(44,2,1),
		(45,2,1),
		(46,2,1),
		(47,2,0),
		(48,2,1),
		(49,2,1),
		(50,2,0),
		(51,2,1),
		(52,2,0),
		(53,2,0),
		(54,2,1),
		(55,2,1);
	INSERT INTO items_examenes(id_item,id_exam,obs_item) VALUES (56,2,'Bla bla bla'); #solo texto
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (57,2,1);
	INSERT INTO items_examenes(id_item,id_exam,obs_item) VALUES (58,2,'Bla bla bla'); #solo texto
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (59,2,0);
	INSERT INTO items_examenes(id_item,id_exam,estado_item) VALUES (60,2,1);
	INSERT INTO items_examenes(id_item,id_exam,obs_item) VALUES (61,2,'Bla bla bla'); #solo texto


#Consulta de los examanes
#SELECT * FROM guias NATURAL LEFT JOIN items_guias NATURAL LEFT JOIN items NATURAL LEFT JOIN examenes NATURAL LEFT JOIN items_examenes;


#Guia enfermeria id 3
INSERT INTO guias (tit_guia) 
		VALUES('Medición de altura uterina');
INSERT INTO guias_catedras(id_guia,cod_cat,nro_guia)		
		VALUES(LAST_INSERT_ID(),20020,1);

	INSERT INTO descripciones(id_guia,nom_desc,contenido_desc) VALUES
		(3,'Objetivo del taller','El estudiante será capaz de medir la altura uterina.'),
		(3,'Caso clínico','Susana de 23 años, cursa un embarazo de 30 semanas. Concurre al CAP para realizarse el control prenatal. Usted debe medir su altura uterina.'),
		(3,'Escenario','Laboratorio de competencias profesionales.'),
		(3,'Requerimientos','Simulador de embarazada, alcohol en gel, camilla, salea, cinta métrica, hoja de registro y bolígrafo.');		

	#Se lava las manos al inicio del procedimiento. id_item = 1
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (1,3,1,1);
	INSERT INTO grupositems(nom_grupoitem,nro_grupoitem) VALUES ('Prepara material:',2); #id_grupoitem = 3
		#Alcohol en gel. id_item = 7
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (7,3,2,1,3);
		INSERT INTO items(nom_item)	VALUES('Cinta métrica');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),3,3,2,3);
		#Hojas de registro. id_item = 9
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (9,3,4,3,3);
		#Bolígrafo. id_item = 10
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (10,3,5,4,3);
	INSERT INTO items(nom_item)	VALUES('Se presenta al usuario');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,6,3);
	INSERT INTO items(nom_item)	VALUES('Identifica al usuario');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,7,4);
	#Explica el procedimiento a realizar. id_item = 14
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (14,3,8,5);
	INSERT INTO items(nom_item)	VALUES('Coloca a la embarazada decúbito dorsal.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,9,6);
	INSERT INTO items(nom_item)	VALUES('Le pide que se afloje y descienda el pantalón (en caso que lo tenga).');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,10,7);
	INSERT INTO items(nom_item)	VALUES('Cubre la pelvis con la salea.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,11,8);
	INSERT INTO items(nom_item)	VALUES('Palpa la sínfisis pubiana.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,12,9);
	INSERT INTO items(nom_item)	VALUES('Coloca el extremo de la cinta métrica y la sujeta con la mano no hábil.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,13,10);
	INSERT INTO items(nom_item)	VALUES('Con la mano diestra desplaza la cinta hasta la palpación del fondo uterino.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,14,11);
	INSERT INTO items(nom_item)	VALUES('Lee la medición.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,15,12);
	INSERT INTO items(nom_item)	VALUES('Acondiciona a la mujer.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,16,13);
	#Se lava las manos al finalizar el procedimiento.. id_item = 36
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (36,3,17,14);	
	#Registra el procedimiento. id=37
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (37,3,18,15);								

	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Realizar la técnica completa.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),3,1);
	#Tiempo para leer el caso: 2 minutos. id= 2
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (2,3,2);
	#Tiempo para preparar los materiales: 3 minutos. id= 3
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (3,3,3);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para realizar y registrar la técnica: 5 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),3,4);			


#Guia enfermeria id 4
INSERT INTO guias (cod_cat,nro_guia,tit_guia) 
		VALUES(20020,2,'Medición de altura uterina');

	INSERT INTO descripciones(id_guia,nom_desc,contenido_desc) VALUES
		(3,'Objetivo del taller','El estudiante será capaz de medir la altura uterina.'),
		(3,'Caso clínico','Susana de 23 años, cursa un embarazo de 30 semanas. Concurre al CAP para realizarse el control prenatal. Usted debe medir su altura uterina.'),
		(3,'Escenario','Laboratorio de competencias profesionales.'),
		(3,'Requerimientos','Simulador de embarazada, alcohol en gel, camilla, salea, cinta métrica, hoja de registro y bolígrafo.');		

	#Se lava las manos al inicio del procedimiento. id_item = 1
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (1,3,1,1);
	INSERT INTO grupositems(nom_grupoitem,nro_grupoitem) VALUES ('Prepara material:',2); #id_grupoitem = 3
		#Alcohol en gel. id_item = 7
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (7,3,2,1,3);
		INSERT INTO items(nom_item)	VALUES('Cinta métrica');
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (LAST_INSERT_ID(),3,3,2,3);
		#Hojas de registro. id_item = 9
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (9,3,4,3,3);
		#Bolígrafo. id_item = 10
		INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item,id_grupoitem) VALUES (10,3,5,4,3);
	INSERT INTO items(nom_item)	VALUES('Se presenta al usuario');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,6,3);
	INSERT INTO items(nom_item)	VALUES('Identifica al usuario');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,7,4);
	#Explica el procedimiento a realizar. id_item = 14
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (14,3,8,5);
	INSERT INTO items(nom_item)	VALUES('Coloca a la embarazada decúbito dorsal.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,9,6);
	INSERT INTO items(nom_item)	VALUES('Le pide que se afloje y descienda el pantalón (en caso que lo tenga).');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,10,7);
	INSERT INTO items(nom_item)	VALUES('Cubre la pelvis con la salea.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,11,8);
	INSERT INTO items(nom_item)	VALUES('Palpa la sínfisis pubiana.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,12,9);
	INSERT INTO items(nom_item)	VALUES('Coloca el extremo de la cinta métrica y la sujeta con la mano no hábil.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,13,10);
	INSERT INTO items(nom_item)	VALUES('Con la mano diestra desplaza la cinta hasta la palpación del fondo uterino.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,14,11);
	INSERT INTO items(nom_item)	VALUES('Lee la medición.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,15,12);
	INSERT INTO items(nom_item)	VALUES('Acondiciona a la mujer.');
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (LAST_INSERT_ID(),3,16,13);
	#Se lava las manos al finalizar el procedimiento.. id_item = 36
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (36,3,17,14);	
	#Registra el procedimiento. id=37
	INSERT INTO items_guias(id_item,id_guia,pos_item,nro_item) VALUES (37,3,18,15);								

	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Realizar la técnica completa.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),3,1);
	#Tiempo para leer el caso: 2 minutos. id= 2
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (2,3,2);
	#Tiempo para preparar los materiales: 3 minutos. id= 3
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (3,3,3);
	INSERT INTO itemsestudiante(nom_itemest)	VALUES('Tiempo para realizar y registrar la técnica: 5 minutos.');
	INSERT INTO itemsestudiante_guias(id_itemest,id_guia,nro_item) VALUES (LAST_INSERT_ID(),3,4);	