DROP DATABASE IF EXISTS automovilismo;
CREATE DATABASE IF NOT EXISTS automovilismo;
USE automovilismo;

DROP TABLE IF EXISTS noticias;

CREATE TABLE IF NOT EXISTS noticias(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    titulo VARCHAR(120) NOT NULL,
    descripcion TEXT NOT NULL,
    imagen VARCHAR(60) NOT NULL,
    fecha DATE NOT NULL,
    link VARCHAR(80) NOT NULL,
    PRIMARY KEY (id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS marcas;

CREATE TABLE IF NOT EXISTS marcas(
    id TINYINT(1) UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(80) NOT NULL,
    biografia TEXT NOT NULL,
    imagen VARCHAR(60) NOT NULL,
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS pilotos;

CREATE TABLE IF NOT EXISTS pilotos(
    id TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(60) NOT NULL,
    biografia  TEXT NOT NULL,
    equipo VARCHAR(60) NOT NULL,
    imagen VARCHAR(60) NOT NULL,
    nacimiento DATE NOT NULL,
    edad TINYINT(2) NOT NULL,
    numero SMALLINT(3) NOT NULL,
    casco VARCHAR(60) NOT NULL,
    marca TINYINT(2) UNSIGNED NOT NULL,
    link VARCHAR(50) NOT NULL,
    FOREIGN KEY(marca) REFERENCES marcas(id) ON DELETE CASCADE,
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS usuarios;

CREATE TABLE IF NOT EXISTS usuarios(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    usuario VARCHAR(40) NOT NULL UNIQUE,
    nombre VARCHAR(40) NOT NULL,
    apellido VARCHAR(40) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(250) NOT NULL,
    nacimiento DATE,
    isAdmin TINYINT(1) NOT NULL,
    Voto TINYINT(1) NOT NULL,
    icono TINYINT(1) UNSIGNED NOT NULL,
    FOREIGN KEY(icono) REFERENCES marcas(id),
    piloto_id TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(piloto_id) REFERENCES pilotos(id),
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS comentarios;

CREATE TABLE IF NOT EXISTS comentarios(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    comentario VARCHAR(255) NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    usuario_id INT UNSIGNED NOT NULL,
    FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    noticia_id INT UNSIGNED NOT NULL,
    FOREIGN KEY(noticia_id) REFERENCES noticias(id) ON DELETE CASCADE,
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS marcas_has_noticias;

CREATE TABLE IF NOT EXISTS marcas_has_noticias(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    marca TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(marca) REFERENCES marcas(id) ON DELETE CASCADE,
    noticia INT UNSIGNED NOT NULL,
    FOREIGN KEY(noticia) REFERENCES noticias(id) ON DELETE CASCADE,
    PRIMARY KEY(id)
)ENGINE=innoDB;

DROP TABLE IF EXISTS pilotos_has_noticias;

CREATE TABLE IF NOT EXISTS pilotos_has_noticias(
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    piloto TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(piloto) REFERENCES pilotos(id) ON DELETE CASCADE,
    noticia INT UNSIGNED NOT NULL,
    FOREIGN KEY(noticia) REFERENCES noticias(id) ON DELETE CASCADE,
    PRIMARY KEY(id)
)ENGINE=innoDB;

INSERT INTO marcas (id, nombre, biografia, imagen) 
VALUES 
(1,'Chevrolet','<p>Chevrolet es una marca de automóviles y camiones con sede en Estados Unidos perteneciente al grupo General Motors. Nació de la alianza de Louis Chevrolet y William Crapo Durant el 3 de noviembre de 1911​ en los Estados Unidos, fabricando automóviles robustos. </p>','chevroletLogo.png'),
(2,'Ford','<p>Ford Motor Company, más conocida como Ford, es una empresa multinacional de origen estadounidense, especializada en la industria automotriz. Con su sede central ubicada en Dearborn, Estado de Michigan, la empresa se expandió a nivel mundial destacándose principalmente en el rubro de producción de automóviles</p>','fordLogo.png'),
(3,'Torino','<p>El IKA Torino (luego llamado Renault Torino) es un automóvil de turismo producido por el fabricante argentino de automotores Industrias Kaiser Argentina entre los años 1966 y 1975, y por Renault Argentina S.A. (la filial argentina del Groupe Renault) entre 1975 y 1981. Era un automóvil compacto del segmento E, y si bien su diseño estaba basado en el modelo americano Rambler American, fue rediseñado y desarrollado íntegramente en Argentina. </p>','torinoLogo.png'),
(4,'Dodge','<p>Dodge es una marca de automóviles estadounidense, llamada originalmente Dodge Brothers Motor Vehicle Company (1900-1927). Chrysler adquirió la compañía Dodge en 1928 de la que sigue formando parte del FCA US LLC</p>','dodgeLogo.png');


INSERT INTO pilotos (id, nombre, biografia, equipo, imagen, nacimiento, edad, numero, casco, link, marca) 
VALUES 
(1,'Agustín Canapino','<p>Agustín es hijo del famoso preparador de Arrecifes, Alberto Canapino, multicampeón en varias categorías. Se coronó campeón en la Copa Megane; debutó en el TC Pista, en 2008, y ese mismo año se proclamó campeón, a bordo de una Chevy del HAZ Racing. En 2009 debutó en Turismo Carretera bajo la estructura del Dole Racing, en el que compartió equipo con Carlos Okulovich. Ese año ocupó un lugar en el podio, terminando tercero en la fecha inaugural de Mar de Ajó.</p><p>Al año siguiente, Agustín Canapino logró una hazaña en la categoría: con 20 años se consagró campeón del Turismo Carretera, temporada en la que logró una sola victoria (última fecha - Buenos Aires). En 2011 consiguió la primera victoria del año en Mar de Ajó, pero no tuvo la posibilidad de ingresar a la Copa de Oro. Al año próximo volvió a recuperar protagonismo y clasificó a la Copa de Oro. Iba en búsqueda del bicampeonato, pero culminó 8º en la temporada. Nuevamente, en 2013, inició el campeonato con una victoria en la primera fecha del calendario, en Mar de Ajó, con el Chevrolet asistido por su padre Alberto, y con los motores a cargo de Jonhy Laboritto.</p><p>En 2014 logró una sola victoria en Junín, pero culminó 16º. En 2015, el joven de Arrecifes ganó en Neuquén e ingresó a la Copa de Oro, pero no logró alzarse con la corona: finalizó 6º. En 2017 tuvo su año de gloria: se coronó campeón de Turismo Carretera en la última fecha, en La Plata, tras arribar en el cuarto lugar y finalizar puntero en la Copa de Oro, a sólo 0,25 puntos del escolta Facundo Ardusso. Además consiguió su segundo título en La Máxima. Lo hizo a bordo de la Chevy alistada por su propio equipo, teniendo a su padre, Alberto, como director. La única victoria que obtuvo fue en el circuito callejero de La Pedrera, en San Luis. El 2018 también lo encontró protagonista: pudo ganar los 1000 kilómetros de Buenos Aires junto a sus pilotos invitados (Martín Ponte y Federico Alonso) y lideró durante dos fechas el certamen. Aunque llegó tercero a la última cita del calendario, detrás de Rossi y Ardusso. En la final, luego de haber sufrido un toque en la serie, largó casi último con gomas de lluvia cuano la mayoría de sus rivale lo hizo con neumáticos de piso seco. Esa estrategia, elaborada junto a su padre Alberto, le permitió terminar segundo la carrera y festejar, en el Autódromo San Nicolás Ciudad, su tercer título de TC con el Chevrolet del Speedagro Racing.</p><p>En 2019 no tuvo su mejor comienzo de temporada. Para Rafaela, la sexta cita del año, presentó un nuevo Chevrolet y, rápidamente, volvió a los primeros planos tras conseguir un meritorio segundo puesto. Repitió podio en la fecha que cerró la etapa regular -el Desafío de las Estrellas en San Juan- lo que le permitió clasificarse a la Copa de Oro. Y apareció el "Titán": obtuvo la victoria en Rafaela (segunda visita en el año) y luego en San Nicolás, llegando como líder a la última fecha del año, en Neuquén. De esta manera consiguió su cuarto título en Turismo Carretera, su tercero de forma consecutiva.</p>','Canapino Sport','canapinoPerfil.png','1995-11-13',30,1,'canapinoCasco.png','agustin-canapino',1),
(2,'Matias Rossi','<p>En 2003, en el Autódromo de Buenos Aires, debutó en Turismo Carretera con una Chevy que manejó Juan María Traverso. En 2007 consiguió sus primeras victorias en La Máxima, y con tres finales alcanzó el subcampeonato detrás del líder absoluto de la temporada, Christian Ledesma. En 2009 retornó al protagonismo tras adueñarse la clasificación a la Copa de Oro. En 2011 arribó al equipo JP Carrera. El piloto de Del Viso consiguió la victoria en San Luís. Además llegó a la definición en Buenos Aires como puntero junto a José María López de la Copa de Oro, con apenas medio punto sobre Guillermo Ortelli. Durante la temporada 2012 se incorporó al Donto Racing, bajo el ala técnica de Ricardo Gliemmo y la motorización de Fabio Martínez. Allí consigue el triunfo en el veloz trazado de Rafaela. También alcanza la clasificación para la Copa de Oro. Volvió a ganar en San Luis, pero no pudo adueñarse del título.</p><p>En 2013 consigue un buen comienzo de temporada junto al Chevolet del Donto Racing con el cuál obtiene la victoria en la competencia final de Olavarría. Uno de los mejores años de Matías Rossi fue en 2014, cuando se consagra Campeón Argentino de Turismo Carretera, a bordo del Chevrolet del Donto Racing y la motorización de Jonnhy Laborito. Logró cinco victorias en la temporada demostrando un gran nivel a largo de las 16 competencias. Al año próximo se coronó sub campeón junto al Chevrolet del Donto Racing.</p><p>En 2016 consigue dos triunfos en Concordia (4º fecha) y Olavarría (5º fecha), convirtiéndose en uno de los grandes candidatos para quedarse con la etapa regular. En 2017, Rossi comenzó la temporada a bordo de un Ford alistado por el Nova Racing. Ganó su primera carrera con la marca en la tercera fecha del calendario, en el Autódromo Hermanos Emiliozzi, de Olavarría. En ese campeonato finalizó 15°. En 2018, el piloto de Del Viso logró tres podios y se adjudicó una victoria en Paraná. De esta manera llegó al final de la temporada con claras chances de adueñarse del título, pero el factor climático complejizó la competencia y culminó 5° en la temporada.</p><p>La sanción aplicada para 2019 le impidió comenzar la temporada en Viedma. Recién estuvo presente en la segunda fecha, en Neuquén. Pero el ritmo de su Ford, alistado por el Nova Racing, rápidamente lo colocó en puestos de vanguardia. En la quinta cita del calendario, en Rosario, festejó en lo más alto del podio, en la primera incursión de la categoría en la ciudad santafesina.</p>','Rossi Racing','rossiPerfil.png','1989-01-13',29,15,'rossiCasco.png','matias-rossi',2),
(3,'Facundo Ardusso','<p>El joven de Las Parejas comenzó la temporada 2012 ganando la carrera de Trelew con un Ford alistado por el equipo Werner Competición, y esa campeonato lo culminó en el cuarto lugar. En 2013, decidió incursionar por primera vez dentro del Turismo Carretera y lo hizo con un Dodge del MVD Racing. En 2014 realizó una buena temporada junto a la Dodge del Lincoln Sport Group, finalizando en el 3º lugar del campeonato general. Además consiguió una victoria en la competencia de Termas de Río Hondo.</p><p>En 2015 se sumó al Trotta Racing para regalarle el primer triunfo al equipo en la cuarta fecha de la temporada, en Viedma, a bordo de una Dodge. Ese año, el santafesino concluyó el campeonato en la tercera posición. Idéntico fue su resultado en el 2016, con una Dodge, pero del JP Carrera. En 2017 pasó a ser, junto a Emiliano Spataro, uno de los dos representantes del Renault Sport Torino Team. A bordo de su Torino consiguió cinco podios y una victoria, en el circuito de Toay en la décimo tercera fecha del campeonato, la cual lo convirtió en un serio candidato al título. Pero no pudo contra el potencial de la Chevy de Agustín Canapino, quien terminaría siendo el campeón. El nacido en Las Parejas culminó segundo en el certamen, a tan sólo 0,25 puntos del arrecifeño.</p><p>En 2018, Ardusso continuó en el equipo Renault Sport Torino Team. Conquistó dos victorias (Posadas y San Juan), que le permitieron ingresar a la Copa de Oro y pelear por el título. Sin embargo una definición épica en San Nicolás lo dejó fuera de la obtención del campeonato. En 2019, nuevamente bajo el ala del equipo Renault Sport Torino Team, abrió la temporada en Viedma con una victoria, requisito fundamental para conquistar el título a fin de año. Además fue 3° en Concepción del Uruguay, 2° en Posadas y 2° en San Juan, resultados que le pemritieron clasificarse a la Copa de Oro.</p>','Renault Sport Torino Team','ardussoPerfil.png','2020-01-20',32,3,'ardussoCasco.png','facundo-ardusso',3),
(4,'Jonatan Castellano','<p>Jonatan Castellano aprendió todo lo que da el automovilismo desde pequeño acompañando a su padre Oscar, tricampeón del Turismo Carretera. Comenzó en zonales y luego compitió en Fórmula Renault, logrando buenos resultados. El Pinchito, como se lo apoda, se consagró campeón de TC Pista en 2005, a bordo de una Dodge alistada por el equipo de su padre. En 2008 y 2009 fueron años regulares para Castellano. En 2011, el equipo Castellano Power Team, con Jonatan Castellano al mando, consiguió la victoria en Posadas, y alcanzó el segundo lugar en Rafaela.</p><p>En 2012, el Pinchito consiguió clasificar al play off, pero finalizó 10º en la temporada. Al año siguiente logró un triunfo en Comodoro Rivadavia, que le permitió involucrarse en la lucha por el título, aunque culminó 8º. En 2014 no logró ninguna victoria en la temporada, pero sin embargo arribó 5º, cerca de obtener grandes chances de conquistar el campeonato. El año pasado nuevamente ingresó a la Copa de Oro, y finalizó 11º en el campeonato. En 2017 compitió a bordo de la Dodge de su propia estructura. Consiguió una victoria en la séptima fecha, que se llevó a cabo en Paraná y, además, fue el ganador de la Copa Entre Ríos, por sus rendimientos en los tres circuitos de la provincia.</p><p>El 2018 lo erigió como serio candidato porque se impuso en dos de las primeras cuatro fechas: Neuquén y Concepción del Uruguay. Y, además, sumó cuatro podios en el año, siendo el ganador de la etapa regular. Llegó a la última fecha, en San Nicolás, como uno de los principales contendientes al título, pero no pudo coronarse ante el buen rendimiento del Chevrolet de Canapino. De todas maneras, culminó como uno de los grandes animadores del certamen, y con el número "2" en los laterales de su Dodge. En 2019, comenzó el torneo bajo la misma estructura, con base en Lobería, aunque con altibajos que no le permitieron subir al podio en las primeras citas y que no lo llevaron a clasificarse a la Copa de oro, más allá de ser el ganador de la fecha que cerró la etapa regular: el Desafío de las Estrellas en San Juan.</p>','Castellano Power Team','castellanoPerfil.png','1990-01-20',35,11,'castellanoCasco.png','jonatan-castellano',4),
(5,'Leonel Pernía','<p>Es hijo de Vicente Pernía, subcampeón de Turismo Carretera y marcador de punta derecho de Boca durante las décadas del ´70 y ´80. Enseguida demostró su estilo aguerrido al volante, tal cual su padre, y comenzó a ser seguido por hinchas que antes alentaban al Tano de Tandil. El Tanito corrió en TC Pista en 2006 y 2007 y en 2008 decidió debutar en Turismo Carretera, claro que con poco presupuesto y solo disputó 7 competencias. En 2010 volvió más armado a la máxima categoría del automovilismo argentino con una Chevy y como compañero de Esteban Tuero dentro de una estructura nueva, proveniente de Bahía Blanca, dirigida por Pablo Arana.</p><p>En 2010 volvió más armado a la máxima categoría del automovilismo argentino con una Chevy y como compañero de Esteban Tuero dentro de una estructura nueva, proveniente de Bahía Blanca, dirigida por Pablo Arana. Desde su arribo al equipo JP Racing a principios del 2011, se transformó en protagonista habitual del Turismo Carretera, consiguiendo su primer triunfo en La Máxima durante la competencia de Termas de Río Hondo. Para la temporada 2012, recaló en el equipo JP Las Toscas Racing, consiguiendo un triunfo brilante durante la presentación de La Máxima en Paraná. En el 2014,Leonel Pernía, mantuvo un buen nivel junto al Chevrolet del Coiro Dole Racing finalizando el campeonato general en el puesto 11º.</p><p>En 2016 tuvo un muy buen comienzo de temporada, en la cual consiguió la victoria en la 1º fecha del calendario junto al Chevrolet alistado por el equipo Las Toscas Racing, pero no pudo concluir la temporada completa y terminó en la 30° ubicación. En 2017 recaló, a bordo de su Chevrolet, en las filas del Christian Dose Competición aunque no pudo obtener los buenos resultados a los que acostumbró a todos sus seguidores.</p><p>En el 2018 dio un cambio de rumbo: llegó al equipo Laboritto Jrs. con un Torino. Tan buena fue su adaptación que ganó en la tercera fecha, en San Luis, y se autopostuló como candidato a la pelea por el título. Ingresó a la Copa de Oro y finalizó 7°. Su muy buen redimiento a bordo del Torino del Maquin Parts le permitió mostrarse como candidato en la primera mitad de 2019: en la cita de Posadas se subió al podio y, tan sólo una fecha después, además ganó la carrera de Concordia (lo que, además de clasificarlo a la Copa de Oro le permitió cumplir con el requisito del triunfo obligatorio para pelear por el campeonato).</p>','Alifraco Sport','perniaPerfil.png','1985-03-22',40,6,'perniaCasco.png','leonel-pernia',3),
(6,'Juan Cruz Benvenuti','<p>Este año debutó en Turismo Carretera, también a bordo de un Torino del equipo Laboritto Jrs. Y en la tercera fecha del año, en Concepción del Uruguay, cumplió su sueño: ganar en La Máxima.</p><p>El piloto de Villa La Angostura se consagró campeón de TC Pista en 2018. Logró dos victorias en dicha temporada, a bordo de un Torino del Laboritto Jrs.</p>', 'Laborito Jrs', 'benvenutiPerfil.png', '1999-07-30', 20, 96, 'benvenutiCasco.png', 'juan-benvenuti', 3),
(7,'Juan Bautista DeBenedictis','<p>Pamperito es hijo de Jhonny, gloria de los 80 del Turismo Carretera, hoy motorista de la categoría. Juan Bautista comenzó corriendo en karting zonal y en 1995 debutó con un título incluido en el TC Mouras . División Top Race. Al año siguiente y siempre con los colores verdes en su Ford, al igual que su padre cuando competía, Debenedicits debutó en TC Pista y también se quedó con el campeonato con una contundencia sorprendente.</p><p>En la máxima debutó en 2007 y dos años después alcanzó su primer triunfo, en Potrero de los Funes, San Luis, en la primera visita de la categoría a este circuito semipermanente que sueña algún día con traer a la Argentina a la Fórmula 1. El pibe de Necochea sigue soñando con obtener su primer título en la máxima categoría del automovilismo argentino, siempre bajo la puesta en pista del equipo Rush Racing aunque para 2012 anunció su llegada al GPG Racing, compartiendo equipo con Mauro Giallombardo, Gabriel Ponce de León y Néstor Girolami.</p><p>Obtiene su victoria en la competencia que la máxima desarrolló sobre el circuito de Rio Cuarto por encima de Guillermo Ortelli quien se ubicó segundo y Omar Martínez que concluyó tercero. Y volvió a ganar en la temporada con la inauguración del nuevo autódromo Provincia de La Pampa y llegó a la última fecha con chances de ser campeón, aunque no pudo ser ya que la corona quedó para Mauro Giallombardo. En la temporada 2013, consigue la victoria en el circuito de San Martín Mendoza y busca conservar su protagonismo a lo largo de todo el calendario anual.</p><p>El joven de Necochea será otro de los grandes protagonistas en la definición de campeonato y también arranca con 8 puntos tras su victoria en Mendoza. En 2018, Juan Bautista De Benedictis regresó al Turismo Carretera. Lo hizo con un Ford del equipo de Mauro Giallombardo. Ese año culminó 16°. Este año se sumó al equipo del Martínez Competición, también a bordo de un Ford. Logró un podio en la tercera fecha, en Concepción del Uruguay.</p>','Maquin Parts Racing','debenedictisPerfil.png','1991-10-11',30,7,'debenedictisCasco.png','juan-debenedictis',2),
(8,'Jose Manuel Urcera','<p>En 2012 debutó en el TC Mouras con un Chevrolet del JP Racing, año en el que consiguió un triunfo en la cuarta fecha, en La Plata.  En 2013 incursionó en TC Pista y TC Mouras bajo la misma marca y estructura, y consiguió tres triunfos en cada divisional. En 2014 afrontó su segunda temporada en TC Pista, clasificó a la Copa de Plata Río Uruguay Seguro y finalizó la temporada como subcampeón de la telonera, siempre piloteando el Chevrolet alistado por el JP Racing.</p><p>En 2015 debutó en el Turismo Carretera con un Torino y culminó en la 26°posición. Su primer triunfo llegó en el 2016, con un Chevrolet de Las Toscas Racing, en la última cita del año en el Autódromo Roberto Mouras de La Plata. En el 2017 se subió al podio de una cita histórica, los 1000 kilómetros de Buenos Aires celebrados por los 80 años de la categoría. Y, además, se clasificó por primera vez en su carrera a la Copa de Oro Río Uruguay Seguros.</p><p>El 2018 lo mostró con altibajos y cambios de marca. Luego de un comienzo irregular, volvió al JP Carrera y pudo retomar su ritmo competitivo para entrar entre los "3 de último minuto" y, en el campeonato general, ocupar el 11° puesto. Dio un salto de calidad en 2019: en las primeras cuatro citas sumó dos pole positions y dos podios, lo que le permitió ubicarse, rápidamente, como la referencia del certamen. Y el triunfo no tardó en llegar, ya que pudo festejar en la sexta fecha, en Rafaela, en la Carrera de los dos Millones.</p>','JP Carrera','urceraPerfil.png','1987-05-12',31,2,'urceraCasco.png','manuel-urcera',1); 

INSERT INTO noticias (id, titulo, descripcion, imagen, fecha, link)
VALUES
(1, 'Agustín Canapino se consagra campeón de la copa de oro','<p>El piloto Agustín Canapino, con Chevrolet, se quedó este domingo con el título por cuarta vez en su historia, la tercera en forma consecutiva, en el Turismo Carretera, tras arribar en el cuarto lugar de la competencia, que se llevó a cabo en el autódromo Centenario de Neuquén, por la última fecha de la Copa de Oro.</p><p>La carrera la ganó Juan Manuel Silva con Ford, seguido por el marplatense Lionel Ugalde (Torino) y Valentín Aguirre (Dodge).</p><p>Canapino había logrado su primer campeonato en 2010, mientras que luego hilvanó tres seguidos en 2017, 2018 y 2019, siempre con Chevrolet.</p>','noticia01.png','2019-10-20','Canapino-Campeon'),
(2, 'Benvenuti ganó en concordia','<p>Un nuevo nombre se inscribió en el historial de ganadores del Turismo Carretera en la tercera ronda efectuada en Concepción de Uruguay, donde el joven Juan Cruz Benvenuti se llevó los más altos honores en una carrera dominada de punta a punta por el piloto de Laboritoo Jrs.</p><p>A bordo de su Renault Torino, Benvenuti tomó la victoria la mañana del domingo en la serie más rápida, lo que le permitió tomar la primera plaza para la carrera final. Desde ahí controló la competencia ante los ataques de Gastón Mazzacane, quien partía segundo, pero que cruzó la meta en el sexto sitio.</p><p>El ritmo del puntero fue de inmediato acelerador a fondo, y en apenas su tercer giro ya tenía cuatro segundos de diferencia sobre Juan Bautista De Benedictis, quien destacó desde la jornada del sábado.</p>','noticia02.png','2019-05-02','benvenuti-gana-concordia'),
(3, 'Impactante choque multiple en la pedrera','<p>Durante la final del Turismo Carretera en La Pedrera se vivió un intenso accidente entre varios autos. Emanuel Moriatis y Carlos Okulovich, dos de los involucrados, fueron los que más sufrieron aunque su salud nunca corrió peligro.</p><p>Ambos se encuentran recuperándose aunque al que más tiempo le llevará será a Okulovich, quien sufrió una fractura en la pelvis.</p><iframe width="560" height="315" src="https://www.youtube.com/embed/gYzb5CX0nBw" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>','noticia03.png','2019-03-27','choque-multiple-pedrera'),
(4, 'De Benedictis Gana la serie n°3 en Buenos Aires','<p>La batería tuvo un inicio complicado ya que al ingresar en la primera chicana, un toque entre Spataro y Trucco dejaba al piloto de Dodge sin las chances de pelear por la victoria. En ese momento, De Benedictis y el pelotón aprovechaba para sortear esa situación y comenzar su carrera. Con De Benedictis al frente, Mazzacane fue su perseguidor junto a Ponce de León que finalmente sería superado por Urcera para ser el 3°. </p><p>Trucco quedó tirado a un costado de la pista mientras que Nicolás Trosset abandonaba en el inicio. Finalmente, el de Necochea se quedaba con la victoria parcial escoltado por los defensores de la marca del moño, Gastón Mazzacane y Manuel Urcera. En esa serie, Ortelli lograba finalizar en el 5° lugar. </p>','noticia04.png','2019-07-11','benvenuti-ganaserie-buenosaires'),
(5, 'Urcera acusa que el fallo de su motor fue un sabotaje','<p>Una de las noticias del viernes en el TC fue la rotura del motor de José Manuel Urcera, quien arrancó como puntero de la Copa de Oro. Con lo ocurrido el de Chevrolet se alejaba de la posibilidad de plear de lleno por la competencia. El recargo de seis décimas caería sobre él después de la clasificación por el remplazo de la planta impulsora. La cosa no quedó ahí y se analizó cuál fue la problemática en el motor, el cual es alistado por Claudio Garófalo</p><p>Finalmente, se pudo comprobar que había una tuerca en la admisión. Un elemento que lejos está de poder estar en ese lugar posicionado. Esto cambió radicalmente el ánimo del piloto sureño, quien se mostró muy enojado por la situación y expresó abiertamente que cree que fue un sabotaje. Escuchá a continuación la palabra completa de Urcera:</p>','noticia05.png','2019-08-01','urcera-acusadesabotaje');

INSERT INTO marcas_has_noticias(id, marca, noticia)
VALUES
(1, 1, 1),
(2, 3, 2),
(3, 4, 3),
(4, 2, 3),
(5, 3, 3),
(6, 2, 4),
(7, 1, 5);

INSERT INTO pilotos_has_noticias(id, piloto, noticia)
VALUES
(1,1,1),
(2,6,2),
(3,3,3),
(4,4,3),
(5,2,3),
(6,5,3),
(7,7,4),
(8,8,5);

DROP TABLE IF EXISTS encuestas;

CREATE TABLE IF NOT EXISTS encuestas(
    id TINYINT(2) UNSIGNED NOT NULL AUTO_INCREMENT,
    votos INT NOT NULL,
    piloto TINYINT(2) UNSIGNED NOT NULL,
    FOREIGN KEY(piloto) REFERENCES pilotos(id) ON DELETE CASCADE,
    PRIMARY KEY(id)
)ENGINE=innoDB;

INSERT INTO encuestas(id, votos, piloto)
VALUES
(1,132,1),
(2,121,2),
(3,122,3);

