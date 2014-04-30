<?php

$curcesLevelsNineSemOne = array("Lengua Española", "Matemática", "Historia de la Civilización/Geografía Mundial", "Ciencias de la Naturaleza: Biología", "Inglés", "Francés", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Física", "Introducción a la Informática", "Educación Moral y Cívica");

$curcesLevelsNineSemTwo = array("Lengua Española", "Matemática", "Historia de la Civilización/Geografía Mundial", "Ciencias de la Naturaleza: Química", "Inglés", "Francés", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Física", "Informática", "Educación Moral y Cívica");

$curcesLevelsTenSemOne = array("Lengua Española", "Matemática", "Geografía e Historia de América y los Pueblos del Caribe", "Ciencias de la Naturaleza: Biología", "Inglés", "Francés", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Física", "Informática", "Educación Moral y Cívica");

$curcesLevelsTenSemTwo = array("Lengua Española", "Matemática", "Geografía e Historia de América y los Pueblos del Caribe", "Ciencias de la Naturaleza: Física", "Inglés", "Francés", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Física", "Nociones de Electricidad", "Educación Moral y Cívica");

$curcesLevelsElevenSemOne = array("Lengua Española", "Matemática", "Historia y Geografía Dominicana Siglo XIX y XX", "Ciencias de la Naturaleza: Biología", "Francés", "Informática", "Educación Física", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Moral y Cívica");

$curcesLevelsElevenSemTwo = array("Lengua Española", "Matemática", "Historia y Geografía Dominicana Siglo XIX y XX", "Ciencias de la Naturaleza: Química", "Inglés", "Educación Física", "Educación Agropecuaria", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Moral y Cívica");

$curcesLevelsTwelveSemOne = array("Lengua Española", "Matemática", "La República Dominicana Hoy", "Ciencias de la Naturaleza: Química", "Francés", "Educación Física", "Educación Comercial", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Moral y Cívica");

$curcesLevelsTwelveSemTwo = array("Lengua Española", "Matemática", "La República Dominicana Hoy", "Ciencias de la Naturaleza: Física", "Inglés", "Educación Física", "Informática", "Formación Integral Humana y Religiosa", "Educación Artística", "Educación Moral y Cívica");

$subject_countsArr = array('9_sem_1' => count($curcesLevelsNineSemOne), '9_sem_2' => count($curcesLevelsNineSemTwo), '10_sem_1' => count($curcesLevelsTenSemOne), '10_sem_2' => count($curcesLevelsTenSemTwo), '11_sem_1' => count($curcesLevelsElevenSemOne), '11_sem_2' => count($curcesLevelsElevenSemTwo), '12_sem_1' => count($curcesLevelsTwelveSemOne), '12_sem_2' => count($curcesLevelsTwelveSemTwo));
$tandaList = array("Matutina", "Vespertina", "Nocturna", "Otra (especifique): ");
$sectorList = array("Público", "Privado", "Semi-Oficial");
$zoneList = array("Rural", "Urbana", "Otra");
$reportTitleArr = array('9' => 'Primer Ciclo - Primer Grado', '10' => 'Primer Ciclo - Segundo Grado', '11' => 'Segundo Ciclo - Primer Grado', '12' => 'Segundo Ciclo - Segundo Grado');

$examgroupLevelSemOne = array("1ra Evaluación", "2da Evaluación", "3ra Evaluación", "4ta Evaluación", "1er Sem. Examen Final", "1er Sem. Examen Completivo", "1er Sem. Examen Extraordinario", "1er Examen Asignaturas Pendientes");

$examgroupLevelSemTwo = array("1ra Evaluación", "2da Evaluación", "3ra Evaluación", "4ta Evaluación", "2do Sem. Examen Final", "2do Sem. Examen Completivo", "2do Sem. Examen Extraordinario", "2do Examen Asignaturas Pendientes");

$lang_submitBtn = array("1" => "Enviar", "2" => "Proceder");
$lang_cpyright = "&copy;COLERED 2014. Derechos Reservados. Material provisto solamente para fines informativos. COLERED no se hace legalmente responsable por errores en los cálculos o en la data.";
$lang_title = "INFORMES COLERED";
$lang_Text = "Idioma";
$lang_Eng = "Inglés";
$lang_Frch = "Francés";
$lang_Esp = "Español";
$lang_formOneText = "Introduzca la Dirección Web (URL) de su Colegio y el Access Token (contacte su Administrador si no conoce o no tiene el Access Token)";
$lang_schUrl = "URL Colegio";
$lang_api = "Access Token";
$lang_AccessTokenError = "Acceso Inválido: Access Token o URL del Colegio incorrecto(s). Introduzca valores válidos!";
$lang_formTwoText = "Introduzca la información adicional requerida para el Reporte";
$lang_centrName = "Nombre del Centro";
$lang_regAddrs = "Dirección Regional";
$lang_eduDist = "Distrito Educativo";
$lang_codeCentr = "Código del Centro";
$lang_schYear = "Año Escolar";
$lang_tanda = "Tanda";
$lang_slctTanda = "Seleccione Tanda";
$lang_sector = "Sector";
$lang_slctSector = "Seleccione Sector";
$lang_zona = "Zona";
$lang_slctZona = "Seleccione Zona";
$lang_formThreeText = "Seleccione el Curso, el Nivel y el Grupo para el Reporte";
$lang_level = "Nivel";
$lang_slctlevel = "Seleccione el Nivel";
$lang_cursName = "Nombre del Curso";
$lang_slctCourse = "Seleccione el Curso";
$lang_btach = "Grupo";
$lang_slctBatch = " Seleccione el Grupo";
$lang_formFourText = "Seleccione las asignaturas de su colegio que corresponden a las Asignaturas Oficiales (Acta de Notas MINERD)";
$lang_slctClsLevelError = "Por favor seleccione un curso en el paso anterior";
$lang_semOne = "Semestre 1";
$lang_semTwo = "Semestre 2";
$lang_slctSub = "Seleccione Asignatura";
$lang_formFiveText = "Seleccione las evaluaciones de su colegio que corresponden a las Evaluaciones Oficiales (Acta de Notas MINERD)";
$lang_slctExamGrp = "Seleccione la Evaluación";
$lang_noBtach = "No encontramos el Grupo";
$lang_noExam = "No encontramos la Evaluación para este Grupo";
$lang_noSubject = "No encontramos Asignatura para este Grupo";
$lang_loadingText = "Espere mientras procesamos su Acta De Notas... <br/>Por favor, no cierre esta ventana ...";
$lang_validateDwnldText = "Para validar los datos y cálculos generados en su Acta de Notas,<br/>por favor haga click en - Descargar Archivo -  para ver los detalles.";
$lang_downloadFileText = "Descargar Archivo";
$courseLvl_9 = array("Primer Grado Nivel Medio Primer Ciclo");
$courseLvl_10 = array("Segundo Grado Nivel Medio Primer Ciclo");
$courseLvl_11 = array("Primer Grado Nivel Medio Segundo Ciclo");
$courseLvl_12 = array("Segundo Grado Nivel Medio Segundo Ciclo");
$selectedExamGroupSem1 = array("Septiembre", "Octubre", "Noviembre", "Diciembre", "Examen adicional");
$selectedExamGroupSem2 = array("Enero", "Febrero", "Marzo", "Mayo", "Examen adicional");
$textHeader = "Generador de Acta de Notas MINERD";
$lang_schReq = "Dirección Web (URL) del colegio es requerida";
$lang_accTknReq = "Access Token es requerido";
$lang_stpTwoFldReq = "Por favor, complete este campo";
$lang_levelReq = "Por favor, seleccione el Nivel";
$lang_courseReq = "Por favor, seleccione el nombre del Curso";
$lang_batchReq = "Por favor, seleccione el Grupo";
$lang_ckbStuReq = "Por favor, seleccione al menos un estudiante antes de proceder";
$lang_ckbExamGrpReq = "Por favor, seleccione al menos una Evaluación antes de proceder";

$lang_postErr = "Dirección Web (URL) colegio o Access token no es accesible, por favor intente de nuevo";
$lang_noStudentErr = "No encontramos estudiantes en el Grupo";
$lang_noMraksErr = "No encontramos las notas, por favor verifique la información introducida";
$lang_mrkLess70PerCompErr1 = "Necesita seleccionar la evaluación para el Examen Completivo en el Paso 5, ya que los estudiantes con número de admisión";
$lang_mrkLess70PerCompErr2 = "tienen promedio de notas con menos de 70%";
$lang_mrkLess70PerExtraErr1 = "Necesita seleccionar la evaluación para el Examen Extraordinario en el Paso 5, ya que los estudiantes con número de admisión";
$lang_mrkLess70PerExtraErr2 = "tienen promedio de notas con menos de 70%, incluyendo el Examen Completivo";
$lang_noExamErr = "No encontramos la Evaluación, por favor verifique la información introducida";
$lang_apiErr = "No pudimos conectarnos con el servidor de Fedena, por favor verifique la información introducida";

$lang_slctStuParent = "Seleccione Estudiante(s) para el Boletín de Notas";
$lang_slctExamGrpParent = "Seleccione las Evaluaciones para el Boletín de Notas";
$welcomeMessage = "Sistema de Generación de Reportes. Por favor, elija una opción para continuar";

$lang_slctStuParent = "Seleccione Estudiante(s) para el Boletín de Notas";
$lang_slctExamGrpParent = "Seleccione las Evaluaciones para el Boletín de Notas";

$techSubNineSemOne = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$techSubNineSemTwo = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$techSubTenSemOne = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$techSubTenSemTwo = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$techSubElevenSemOne = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$techSubElevenSemTwo = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$techSubTwleveSemOne = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$techSubTwelveSemTwo = array("Asignatura1", "Asignatura2", "Asignatura3", "Asignatura4", "Asignatura5", "Asignatura6", "Asignatura7", "Asignatura8", "Asignatura9", "Asignatura10", "Asignatura11");
$thankyouMess = "Gracias por utilizar nuestra aplicación. <br> Si usted desea generar más informes, por favor haga click en el logo de COLERED";

$lang_stpTwoParentDate = "Por favor, seleccione un rango válido de fechas";
$lang_examGrpReq = "Por favor, seleccione al menos una Evaluación de la lista";

$lang_badLogoUrlErr = "error: Dir. Web (URL) inválida,...";
$lang_noServiceErr = "... Error: no hay página, no hay permisos o no hay servicio ...";
$lang_noSubjectErr = "No encontramos asignaturas";
$lang_apiTknErr = "No podemos generar el informe, por favor, inténtelo de nuevo";
$lang_subReqParent = "Por favor, elija al menos una asignatura";
$lang_schoolErr = "No encontramos el Nombre del Colegio";

$lang_nameParent = "Nombre";
$lang_courseParent = "Curso";
$lang_reprtGrdParent = "Grado";
$lang_acadmcStsParent = "Estado General Académico ";
$lang_subjParent = "Asignatura";
$lang_fstSemParent = "Primer Semestre";
$lang_secSemParent = "Segundo Semestre";
$lang_teachComntParent = "Comentarios del Maestro(a)";
$lang_absncParent = "Ausencias";
$lang_signofDirector = "Firma del Director(a)";
$lang_teachSignParent = "Firma del Maestro(a)";
$lang_slctAllParent = "Seleccione todos";
$lang_stp6comntParent = "Seleccione las Asignaturas correspondientes";
$lang_marksAvg = "Promedio";

$lang_forParent = "BN Padres";
$lang_forMinistry = "MINERD";
$lang_backButton = "Atrás";
$lang_proceedButton = "Continuar";
$lang_homePageLink = "Inicio";
$lang_levelParent = "Grado";
$lang_dateRange = "Date";

$lang_achieved = 'Logrado';
$lang_processing = 'En Proceso';
$lang_nomade = 'No Logrado';
$lang_stpblw3ParentErr = "Por favor, seleccione al menos un título de proceder";
//data for ministry report below level 3 ends
$lang_form5txtParent = "Seleccione los examenes necesarios para producir el Reporte de MINERD";
$lang_form5txtMinistry = "Seleccione los examenes necesarios para producir el Reporte de MINERD";



//data for ministry report below level 3 starts
// zero grade array
$zero_grade_title = array("DIMENSIÓN INTELECTUAL", "DIMENSIÓN DE LA EXPRESIÓN Y COMUNICACIÓN", "DIMENSIÓN SOCIOEMOCIONAL");

$zero_grade = array(
    "DIMENSIÓN INTELECTUAL" => array(
        "Conversa sobre la importancia de los elementos que componen la naturaleza y el universo, como aspectos fundamentales para los seres vivos.",
        "Conoce los componentes de la Tierra.",
        "Pregunta sobre el agua, sus funciones y beneficios.",
        "Identifica las características del Sol y la Luna.",
        "Hace preguntas sobre los fenómenos climatológicos.",
        "Conversa sobre el calentamiento global de la Tierra.",
        "Identifica los estados del tiempo (soleado, nublado, lluvioso).",
        "Plantea soluciones para prevenir la deforestación y la contaminación.",
        "Aporta ideas para proteger la fauna y la flora del medio circundante.",
        "Identifica características de animales y plantas.",
        "Establece relación entre las plantas y los animales, sus necesidades, beneficios y la peligrosidad que representan algunos para el ser humano.",
        "Agrupa las plantas atendiendo a sus características.",
        "Clasifica los animales de acuerdo a su alimentación, forma de reproducción y hábitat.",
        "Plantea hipótesis sobre procesos naturales, físicos y químicos.",
        "Participa en los procesos de experimentación: (congelar agua, quemar papel, germinar una planta, cría de animales, preparación de huerto).",
        "Describe procesos observados o experimentados.",
        "Reconoce algunos oficios y profesiones realizados por los miembros de la comunidad.",
        "Diferencia las características entre oficios y profesiones.",
        "Hace preguntas sobre las festividades que se celebran en su comunidad local y nacional.",
        "Conversa sobre los orígenes de las festividades de su comunidad local y nacional.",
        "Indaga sobre las diferentes organizaciones sociales de su comunidad.",
        "Nombra los principales productos agrícolas y comerciales de su comunidad.",
        "Identifica algunos alimentos y productos propios de su comunidad local y nacional.",
        "Menciona características de los comercios.",
        "Hace preguntas sobre las instituciones y los servicios que  se ofrecen en su comunidad. ",
        "Dialoga sobre los beneficios que se obtienen al utilizar los servicios de su comunidad.",
        "Hace preguntas sobre los fenómenos de la naturaleza.",
        "Conversa sobre qué hacer en caso de inundaciones, temblores, ciclones y otros. ",
        "Nombra características de algún fenómeno de la naturaleza.",
        "Identifica características de las viviendas de su comunidad.",
        "Nombra los materiales que se utilizan para la construcción de viviendas.",
        "Establece diferencias entre un tipo de vivienda y otra.",
        "Nombra las dependencias que componen una vivienda.",
        "Identifica los recursos tecnológicos que utilizan los miembros de su familia en el hogar.",
        "Establece diferencias entre los recursos tecnológicos utilizados en los trabajos que se realizan en el campo y en la ciudad.",
        "Investiga sobre los recursos tecnológicos que se utilizaban anteriormente y los que se utilizan en la actualidad.",
        "Identifica las instituciones de la comunidad que ofrecen servicios tecnológicos.",
        "Hace preguntas sobre objetos y su utilidad.",
        "Hace comparaciones entre diferentes objetos.",
        "Clasifica los objetos atendiendo a diferentes características: forma, tamaño, color, textura, entre otros.",
        "Realiza secuencias con diferentes objetos.",
        "Nombra diferentes objetos de su entorno escolar.",
        "Describe objetos de su entorno escolar y familiar atendiendo a: forma, tamaño, color, textura.",
        "Relaciona los objetos de acuerdo a su utilidad.",
        "Compara objetos estableciendo semejanzas y diferencias entre ellos.",
        "Relaciona objetos de su entorno escolar con las figuras geométricas.",
        "Ubica los objetos en relación a la posición de su cuerpo (delante, detrás, a los lados).",
        "Identifica el lugar donde se encuentra de acuerdo a los objetos que le rodean.",
        "Se ubica en el espacio en relación a objetos, personas, animales y otros elementos.",
        "Establece relación espacial de objetos, personas, animales y otros elementos.",
        "Establece relaciones espaciales entre personas, objetos, animales y otros elementos en materiales representativos (láminas, fotografías, afiches, letreros, otros).",
        "Nombra diferentes medios de comunicación.",
        "Establece relación entre los medios de comunicación atendiendo a sus características, tipos y funciones.",
        "Conversa sobre la importancia de los medios de comunicación para los seres humanos.",
        "Narra hechos ocurridos en la comunidad.",
        "Interpreta un cuento escuchado.",
        "Conversa sobre hechos y situaciones ocurridos en su comunidad local, nacional e internacional.",
        "Relata hechos ocurridos sobre algunos fenómenos naturales. ",
        "Narra cuentos.",
        "Conversa sobre algunas leyendas de su comunidad local y nacional.",
        "Identifica personajes históricos y legendarios de su comunidad local y nacional.",
        "Menciona algunos lugares históricos de su comunidad local y nacional.",
        "Narra situaciones vividas, vistas o escuchadas en su entorno familiar y escolar.",
        "Conversa sobre las actividades que realiza con su familia (paseos, visitas, reuniones, celebraciones, entre otros).",
        "Responde preguntas relacionadas a textos leídos por otras personas.",
        "Dialoga sobre datos y noticias leídas por otras personas.",
        "Narra cuentos que han sido leídos por otras personas.",
        "Emite sus ideas sobre un cuento escuchado.",
        "Comenta hechos vistos en un programa televisivo.",
        "Describe su programa favorito, televisivo o radial.",
        "Narra una película.",
        "Nombra personajes que aparecen en programas televisivos, radiales, artículos, entre otros.",
        "Hace chistes escuchados en programas (televisivos, radiales, a través de internet, entre otros).",
        "Conversa sobre eventos realizados en su entorno escolar, familiar y comunitario.",
        "Expresa experiencias vividas en eventos familiares.",
        "Identifica diferentes personas que participan en eventos de su entorno comunitario.",
        "Interpreta canciones escuchadas en algunos eventos de su entorno escolar.",
        "Representa a través de diversas formas, eventos y actividades que se realizan en su comunidad.",
        "Expresa sus ideas en relación a un hecho ocurrido durante un evento de su entorno comunitario.",
        "Agrupa objetos de igual color, tamaño, olor, sabor, textura, uso,  entre otros.",
        "Compara características de los seres vivos y los objetos.",
        "Ordena la secuencia del proceso de gestación y transformación de los seres vivos.",
        "Ordena el principio y el final de una historia.",
        "Ordena de mayor a menor y viceversa.",
        "Dice cuál es el anterior y posterior de una secuencia dada.",
        "Describe características de la materia viva y la materia inerte.",
        "Hace comparaciones entre materia viva y materia inerte.",
        "Identifica elementos compuestos por materia inerte (rocas, objetos, entre otros).",
        "Identifica elementos compuestos por materia viva (seres humanos, animales, plantas, entre otros).",
        "Dice la relación lógica entre personas, objetos y situaciones.",
        "Establece correspondencia entre los seres vivos, objetos y situaciones.",
        "Resuelve problemas a partir de deducciones simples.",
        "Asocia números con cantidades.",
        "Cuenta objetos.",
        "Establece diferencia entre mucho-poco.",
        "Forma conjuntos atendiendo a diferentes criterios: (forma, tamaño, textura, color, cantidades, entre otros).",
        "Establece relación entre seres vivos y objetos atendiendo a criterios de:  volumen, peso, dimensiones, distancias y posiciones.",
        "Identifica cantidades en material concreto y semiconcreto.",
        "Realiza sumas y restas utilizando objetos concretos con diferentes cantidades.",
        "Clasifica objetos atendiendo a diferentes criterios: forma, color, tamaño, textura.",
        "Identifica diferentes instrumentos y técnicas de medición.",
        "Establece relación entre los instrumentos y técnicas de medición con su vida diaria y el entorno.",
        "Conversa sobre el valor de las monedas y sus características.",
        "Identifica diferentes sellos e insignias de instituciones públicas y privadas.",
        "Establece relación entre los distintivos nacionales (sellos, monedas e insignias).",
        "Conversa sobre la utilidad e importancia de los diferentes distintivos nacionales (sellos, monedas e insignias).",
        "Conversa sobre la importancia y función de los medios de transporte.",
        "Identifica los medios de transporte que se utilizan en su comunidad, en el país y en otros lugares del mundo.",
        "Agrupa los medios de transporte de acuerdo a sus características (forma, color, tamaño).",
        "Establece diferencias entre los medios de transporte utilizados en épocas pasadas y en la actualidad.",
        "Clasifica los medios de transporte atendiendo a las vías de tránsito (aéreos, terrestres y acuáticos).",
        "Identifica las diferentes señales de tránsito de la zona rural y la zona urbana.",
        "Conversa sobre la importancia y función de las señales de tránsito.",
        "Establece relación entre las señales de tránsito y los medios de transporte.",
        "Conversa sobre las normas de tránsito establecidas para transitar en vehículos o como peatón en las vías públicas.",
        "Plantea soluciones para evitar el peligro en las vías públicas.",
        "Reconoce situaciones de peligro en su entorno natural y social.",
        "Aporta soluciones para la conservación del medio ambiente.",
        "Aporta ideas para solucionar problemas que se le presenten en su entorno natural y social.",
        "Conversa sobre problemas que existen en su comunidad y plantea las posibles soluciones.",
        "Identifica situaciones de peligro y reacciona frente a ellas (comunidad, hogar, escuela).",
        "Conversa sobre la seguridad personal.",
        "Identifica las situaciones de peligro en las vías de tránsito.",
        "Nombra las partes del cuerpo y las de sus compañeros y compañeras.", "Compara su cuerpo con el de otras personas estableciendo semejanzas y diferencias.",
        "Describe características de su cuerpo.",
        "Conversa sobre su cuerpo.",
        "Señala izquierda y derecha en relación a su cuerpo.",
        "Establece diferencias entre las vestimentas de personas del sexo femenino y del sexo masculino.",
        "Agrupa niños y niñas según sexo.",
        "Conversa sobre el sexo de cada niño y niña.",
        "Compara características estableciendo semejanzas y diferencias entre personas del sexo masculino y del sexo femenino.",
        "Compara el color de su piel con el de otras personas.",
        "Realiza mediciones utilizando su cuerpo y el de los y las demás.",
        "Agrupa personas atendiendo a diferentes criterios: tamaño, color, raza, edad, peso y volumen.",
        "Establece diferencias étnicas y  otras atendiendo a las características de su cuerpo y el de los y las demás.",
        "Nombra las diferentes partes externas del cuerpo y sus funciones.",
        "Nombra algunos órganos internos del cuerpo y sus funciones.",
        "Compara los órganos externos con los internos.",
        "Conversa sobre las actividades que se desarrollan en el día y la noche.",
        "Identifica vestimentas y objetos que se utilizan para las actividades del día y la noche.",
        "Clasifica los lugares que se visitan durante el día y los que se visitan durante la noche.",
        "Identifica en material representativo situaciones y eventos que realiza con su cuerpo en diferentes momentos del día.",
        "Nombra los órganos de los sentidos.",
        "Conoce las funciones de los órganos sensoriales.",
        "Experimenta utilizando los órganos sensoriales.",
        "Describe emociones, sentimientos, sensaciones a partir de la utilización de los órganos sensoriales. ",
        "Realiza asociaciones entre las etapas del ser humano (infancia, niñez, adolescencia, adultez y vejez).",
        "Conversa sobre el nacimiento y los cambios físicos del cuerpo durante la vida del ser humano.",
        "Identifica diferentes necesidades de su cuerpo (sueño, hambre, sed, entre otros).",
        "Establece  diferencias entre hambre, sed, sueño, orinar, evacuar.",
        "Nombra características de los miembros de su familia (color de pelo, piel, sexo, entre otros).",
        "Establece relaciones de parentesco entre los miembros de su familia (padremadre, abuelo-abuela, tío-sobrino, cuñada, nuera, entre otros.)",
        "Conversa sobre causas y consecuencias de hechos y situaciones de su entorno familiar.",
        "Organiza imágenes en secuencia temporal, en las que se representan gráfi-camente hechos, situaciones.",
        "Habla de hechos y experiencias tomando en cuenta el ayer, el hoy y el mañana.",
        "Establece relaciones en sus conversaciones entre personas, objetos y situaciones,  del pasado del presente y del futuro.",
        "Organiza hechos en secuencia lógica."
    ),
    "DIMENSIÓN DE LA EXPRESIÓN Y COMUNICACIÓN" => array(
        "Hace formas tridimensionales combinando formas básicas con diversos materiales (masilla, barro,  yeso, entre otros).",
        "Dibuja tomando en cuenta los detalles de la figura humana y otros objetos de la realidad.",
        "Le pone nombre a sus dibujos.",
        "Cuando se le pregunta habla sobre lo que produjo gráfica o plásticamente.",
        "Utiliza diferentes manifestaciones artísticas para representar eventos que se realizan en su comunidad: pintura, collage, baile, maquetas, entre otros.",
        "Establece conexión entre los elementos de su composición gráfica (relación entre objetos, personas y  animales que dibuja).",
        "Construye collages representando la realidad.",
        "Utiliza elementos del medio para enriquecer sus creaciones (hojas, caracoles, arena, plásticos, hilo, tapas, entre otros).",
        "Crea imágenes gráfico-plásticas partiendo de estimulaciones auditivas, visuales, olfativas, entre otras.",
        "Representa personas, animales, objetos por medio de diferentes técnicas gráfico-plásticas.",
        "Utiliza adecuadamente palabras nuevas relacionadas con los proyectos de aula, unidades didácticas, centros de interés y actividades desarrolladas.",
        "Expresa emociones a través de gestos y movimientos.",
        "Presenta equilibrio de su cuerpo (al caminar sobre bordes, cuerdas, pararse en un solo pie, al subir y bajar escaleras, entre otros).",
        "Se mueve en diferentes direcciones manteniendo el control de su cuerpo (corriendo, saltando, marchando).",
        "Baila al compás de diferentes ritmos.",
        "Reproduce canciones cortas con movimientos corporales.",
        "Mueve su cuerpo al ritmo de diferentes velocidades e intensidades.",
        "Reconoce y utiliza diferentes instrumentos musicales.",
        "Dramatiza acciones utilizando instrumentos musicales conocidos.",
        "Gesticula con facilidad al representar cuentos y canciones, coordinando movimientos y mímicas.",
        "Realiza actividades corporales sincronizando los movimientos a partir de la música.",
        "Disfruta al expresarse con su cuerpo.",
        "Representa cuentos, canciones y experiencias de su vida utilizando la dramatización.", "Conversa sobre las sensaciones y sentimientos que experimenta al contemplar o  escuchar una obra artística.",
        "Participa en conversaciones grupales.",
        "Hace y responde preguntas de manera espontánea.",
        "Es coherente en sus diálogos con los demás.",
        "Relata experiencias vividas relacionadas con el tema de la conversación o de vivencias   personales.",
        "Nombra los personajes de un cuento.",
        "Realiza dramatizaciones relacionadas con su contexto social.",
        "Declama poesías conocidas o creadas por él o ella.",
        "Participa en la elaboración de guiones para dramatización.",
        "Escribe mensajes utilizando palabras y frases cortas.",
        "Escribe el nombre de objetos que están a su alrededor.",
        "Transcribe palabras observadas en portadores de texto (revistas, libros, periódicos, entre otros).",
        "Reconoce su nombre y el de sus compañeros y compañeras en tarjetas y lo escribe.",
        "Camina laberintos en la dirección indicada al participar en juegos motóricos organizados.",
        "Se desplaza encima de una línea sin salirse de ella.",
        "Se desplaza saltando obstáculos.",
        "Camina en diferentes direcciones según el mandato indicado.",
        "Salta con los dos pies.",
        "Baja y sube escaleras alternando los pies.",
        "Salta con un solo pie.",
        "Camina con objetos en la cabeza manteniendo el equilibrio postural.",
        "Lanza objetos en diferentes direcciones y velocidades.",
        "Participa en competencias de saltos y carreras.",
        "Marcha al ritmo de la música.",
        "Comunica mensajes gestuales con las partes del cuerpo.",
        "Tira y apara objetos.",
        "Lanza objetos hacia una meta.",
        "Empuja objetos con un peso acorde a su fuerza física.",
        "Hala una cuerda al realizar juegos de competencia.",
        "Carga objetos relativamente pesados.",
        "Corre alrededor de objetos siguiendo instrucciones.",
        "Trota en diferentes direcciones atendiendo a las instrucciones dadas (correr hacia el frente,  hacia los lados, entre otros).",
        "Mueve su cuerpo al ritmo de palmadas y música (hacia la izquierda, hacia la derecha, hacia adelante, hacia atrás). ",
        "Mueve partes de su cuerpo siguiendo instrucciones (piernas, brazos, cabeza, otros), hacia diferentes direcciones.",
        "Marcha a un ritmo marcado integrado a su grupo y respetando el espacio total.",
        "Se organiza en fila respetando el espacio de otros.",
        "Camina en una dirección indicada.",
        "Marcha en direcciones derecha-izquierda siguiendo instrucciones.",
        "Se mueve en ambas direcciones siguiendo el ritmo de una canción o de palmadas.",
        "Coloca objetos a la derecha y a la izquierda de otros.",
        "Participa en actividades de expresión corporal utilizando adecuadamente la lateralidad de su cuerpo en relación a su entorno.",
        "Salta las cuerdas en forma coordinada.",
        "Camina con equilibrio sobre líneas (recta, curva, ondulada, quebrada).",
        "Imita movimientos de animales y plantas.",
        "Realiza juegos de movimientos con diferentes segmentos de su cuerpo.",
        "Realiza movimientos coordinados con las extremidades superiores e inferiores de su cuerpo.",
        "Se desplaza a diferentes velocidades.",
        "Adopta diferentes posturas en actividades dirigidas.",
        "Realiza trazos de izquierda a derecha.",
        "Traza líneas rectas y curvas de arriba hacia abajo.",
        "Utiliza la tijera adecuadamente al recortar figuras complejas.",
        "Ensarta con facilidad objetos como botones, cuentas, entre otros.",
        "Utiliza y agarra el lápiz con la pinza de los dedos.",
        "Toma en cuenta los límites gráficos en sus creaciones artísticas.",
        "Utiliza con precisión utensilios de la vida diaria (vasos, cubiertos, peines, entre otros). ",
        "Maneja con precisión todo tipo de cierre al vestirse o desvestirse, comer, destapar envases,  abotonar, desabotonarse, abrir y cerrar zipper, entre otros."
    ),
    "DIMENSIÓN SOCIOEMOCIONAL" => array(
        "Acoge con agrado a todos los niños y niñas.",
        "Respeta las normas del grupo.",
        "Acepta la opinión de los compañeros y compañeras.",
        "Cuida los productos de su trabajo y el de sus compañeros y compañeras.",
        "Muestra seguridad en las actividades que realiza y en las decisiones que toma.",
        "Muestra actitud de satisfacción en las actividades que realiza.",
        "Expresa sus ideas con seguridad en sí mismo.",
        "Toma iniciativa en la realización de algunas actividades.",
        "Sabe defenderse manifestando desacuerdos y soluciona sus conflictos.",
        "Se acepta como es con sus fortalezas y limitaciones.",
        "Se siente a gusto cuando le llaman por su nombre.",
        "Manifiesta sentirse feliz de pertenecer a una familia y a una nación.",
        "Muestra diferentes estados de ánimo (alegría, tristeza, enojo, rechazo).",
        "Acepta manifestaciones de afecto de los demás.",
        "Conversa sobre la importancia de la higiene.",
        "Echa la basura al zafacón.",
        "Mantiene su cuerpo limpio.",
        "Expresa cuando siente algún malestar.",
        "Conversa sobre la importancia de las vacunas.",
        "Practica hábitos de higiene siempre que sea necesario (antes y después de comer, luego de ir al baño, entre otros).",
        "Manifiesta una actitud de higiene y cuidado en sus vestimentas y útiles escolares.",
        "Come sin derramar los alimentos.",
        "Usa el baño sin ayuda de un adulto.",
        "Se viste sin ayuda.",
        "Conversa sobre sus estados de ánimo con relación a otros cuando está alegre, enojado, preocupado.",
        "Comparte sus pertenencias con otros compañeros y compañeras.",
        "Ayuda a los demás cuando es necesario.",
        "Reconoce el trabajo de los y las demás.",
        "Muestra sentimientos de amor a los y las demás.",
        "Expresa en sus conversaciones sentimientos de afecto hacia su familia.",
        "Juega espontáneamente con los niños y niñas que presentan necesidades educativas especiales.",
        "Manifiesta actitud de respeto y cuidado por el entorno natural y social.",
        "Respeta los símbolos patrios, héroes nacionales y conmemoraciones patrias.",
        "Escucha a los y las demás cuando aportan ideas relacionadas con la elaboración y cumplimiento de las normas del grado.",
        "Hace uso de las normas del grado en la solución de conflictos en su entorno escolar.",
        "Conversa sobre el funcionamiento del grupo.",
        "Aporta ideas para solucionar problemas en el grupo.",
        "Saluda al llegar.",
        "Pide turno al participar en conversaciones.",
        "Escucha mientras los y las demás hablan.",
        "Pide permiso para usar las pertenencias de los y las demás.",
        "Devuelve lo que toma prestado.",
        "Pide disculpas cuando el caso lo amerita.",
        "Da las gracias en las ocasiones que lo amerite.",
        "Pide por favor cuando es necesario.",
        "Se despide al finalizar la jornada del día.",
        "Muestra actitud de liderazgo.",
        "Reconoce el derecho de igualdad entre ambos sexos.",
        "Espera su turno para hablar.",
        "Pide permiso para intervenir en una conversación.",
        "Habla de la utilidad del grupo.",
        "Participa aportando ideas y sugerencias para la toma de desiciones en grupo.",
        "Coopera con las actividades realizadas en el entorno escolar.",
        "Cumple con las tareas asignadas.",
        "Organiza los materiales del salón.",
        "Participa en la jornada de limpieza de la escuela.",
        "Lleva y devuelve mensajes de la escuela a la casa y viceversa.",
        "Emite juicios sobre acontecimientos ocurridos de manera individual y colectiva.",
        "Relata experiencias familiares, personales y del entorno.",
        "Nombra los personajes involucrados en un hecho.",
        "Emite su opinión sobre hechos históricos ocurridos en su comunidad local y nacional.",
        "Se desempeña con libertad en determinadas situaciones que se le presentan.",
        "Expresa ideas sobre diferentes formas de proteger su cuerpo ante amenazas y peligros.",
        "Opina sobre la preservación de su persona frente a peligros en su entorno escolar y familiar.",
        "Emite juicios y demuestra sus sentimientos sobre hechos ocurridos.",
        "Muestra respeto por las banderas de otros países.",
        "Conversa sobre los alimentos típicos de otros países.",
        "Conversa sobre la forma de vida de las comunidades de otros países.",
        "Se integra en las actividades  de su comunidad (religiosas, culturales, patronales, patrióticas, entre otros).",
        "Participa en la organización de las actividades de su entorno escolar.",
        "Participa en las actividades religiosas y festivas de su familia.",
        "Se interesa por conocer el carnaval dominicano.",
        "Participa en el izado de la bandera.",
        "Conversa sobre la Independencia Nacional y los aportes de los padres de la Patria a  nuestro país.",
        "Muestra respeto al cantar o escuchar el Himno Nacional.",
        "Cuida los animales y plantas de su entorno escolar.",
        "Participa en la preparación de huertos.",
        " Cuida el mobiliario y materiales del centro educativo.",
        "Cuida sus pertenencias personales.",
        "Conversa sobre la importancia de los recursos tecnológicos.",
        "Conversa sobre la importancia del cuidado de los animales y las plantas."
    )
);

$first_grade = array(
    "LENGUA ESPAÑOLA" => array(
        "Comunicación oral" => array(
            "Comprensión oral" => array(
                "Comprende los actos de habla que escucha: narrar, describir, identificar, preguntar, responder, afirmar, negar, dar y recibir instrucciones.",
                "Comprende en textos orales el orden y la secuencia de las acciones.", "Comprende y aprecia textos de la literatura oral: canciones, refranes, juegos, trabalenguas y adivinanzas."
            ),
            "Expresión oral" => array(
                "Dialoga  sobre temas cotidianos en forma creativa.",
                "Expresa con claridad sus opiniones sobre algún tema cotidiano, respetando las normas de interacción social.",
                "Aplica normas del diálogo, tales como: saludar al llegar y al partir, agradecer, pedir permiso y excusas, esperar turnos en la conversación."
            )
        ),
        "Comunicación escrita" => array(
            "Comprensión lectora" => array(
                "Identifica el mismo sonido en diferentes palabras habladas.",
                "Comprende la idea general de textos escritos breves y sencillos, cuando lee.",
                "Lee en voz alta, para otras personas, y de manera silenciosa, textos sencillos, aunque no siempre en forma convencional.",
                "Identifica la estructura de textos que lee: del cuento (inicio, desarrollo y final), de la carta (fecha, destinatario, cuerpo, despedida, firma), de la noticia periodística (qué, cuándo, dónde, quién, cómo), entre otros.",
                "Explica con seguridad el significado de palabras en textos sencillos que lee.",
                "Identifica la escritura de su nombre propio o apodo en tarjetas, listas y objetos."
            ),
            "Expresión escrita" => array(
                "Escribe textos sencillos como: etiquetas, tarjetas, rótulos, listas, letreros y afiches; empleando palabras legibles.",
                "Escribe historietas, cuentos, cartas y noticias; siguiendo el procedimiento de la escritura, apoyándose en organizadores gráficos.",
                "Escribe al dictado, listas de nombres y de compras (colmados, supermercados, farmacias, entre otras), en situaciones de comunicación auténticas.",
                "Escribe tomando en cuenta la linealidad (izquierda-derecha), la direccionalidad (arriba-abajo), espacios (entre letras y palabras) y la disposición de lo escrito.",
                "Escribe en forma legible las letras mayúsculas de nombres propios y al inicio de la oración."
            )
        )
    ),
    "MATEMÁTICA" => array(
        "Números y operaciones" => array(
            "Lee y escribe en forma correcta números naturales hasta el 99.",
            "Utiliza de manera correcta números naturales para resolver situaciones de la vida cotidiana.",
            "Representa correctamente números naturales menores que 99, usando el valor de posición de las unidades y las decenas",
            "Calcula, en forma correcta, la suma de los números naturales con resultados menores que 99, sin reagrupación y con reagrupación de unidades a decenas, utilizando y sin utilizar material concreto.",
            "Resuelve y formula, en forma correcta,  situaciones problemáticas del entorno, aplicando adición de números naturales.",
            "Calcula, de manera correcta, la diferencia de números naturales de uno y dos dígitos, sin reagrupación y con reagrupación de decenas a unidades, utilizando y sin utilizar material concreto.",
            "Utiliza, de manera adecuada, números ordinales para ordenar secuencias de hasta 10 elementos.",
            "Reconoce y representa, con precisión, fracciones de un medio, un tercio y un cuarto de una región."
        ),
        "Geometría" => array(
            "Identifica, de manera correcta, las figuras geométricas básicas: rectángulo, cuadrado, círculo y triángulo, usando  material concreto y semiconcreto, describiéndolas.",
            "Identifica, con autonomía, objetos con forma de  prisma cuadrangular, rectangular, pirámide, cono, cilindro y esfera."
        ),
        "Medición" => array(
            "Utiliza, con precisión, el centímetro como unidad de medida para medir longitud.",
            "Utiliza, en forma adecuada, la balanza para comparar la masa de objetos del entorno.",
            "Compara en forma directa la capacidad de diferentes recipientes, utilizando unidades arbitrarias (jarros, ollas, vasos, botellas, otros...) y las estandarizadas como: tazas, pintas,  cuarto de galón y galón.",
            "Utiliza, con entusiasmo,  el calendario para la programación de actividades y eventos escolares.",
            "Utiliza, correctamente, en sus diálogos cotidianos los conceptos relacionados con el transcurso del tiempo: antes, ahora, después, hoy, anterior, posterior, ayer y mañana."
        ),
        "Maneja datos estadísticos (recolección, organización y  análisis de d atos)" => array(
            "Selecciona y clasifica objetos, en forma correcta,  de acuerdo a una característica común (forma, color, tamaño, otro).",
            "Distribuye de manera adecuada datos clasificados en tablas de conteo.",
            "Lee, con facilidad, los datos representados en tablas de conteo y pictogramas."
        )
    ),
    "CIENCIAS SOCIALES" => array(
        "Dimensión espacial" => array(
            "Se orienta con seguridad, utilizando los puntos cardinales.",
            "Se orienta en su entorno por medio de mapas y planos, utilizando referentes espaciales: arriba-abajo, derecha-izquierda y dentrofuera."
        ),
        "Dimensión económica" => array(
            "Identifica las actividades económicas relacionadas con el trabajo en su familia y en la comunidad, estableciendo semejanzas y diferencias entre estas actividades económicas y los servicios comunitarios.",
            "Usa de forma racional los alimentos y artículos de higiene personal en su vivienda y en la escuela.", "Coopera con dedicación, en  labores de limpieza e higiene en su familia y en la escuela.",
            "Utiliza de forma racional los recursos de su entorno."
        ),
        "Dimensión sociocultural" => array(
            "Identifica personajes históricos de su comunidad, en diversas fuentes gráficas.",
            "Muestra  respeto por sí mismo y por los demás, sin importar los rasgos  físicos, raciales y familiares.",
            "Se involucra en actividades  en donde se valoran los símbolos patrios."
        ),
        "Dimensión ciudadana" => array(
            "Muestra en sus actuaciones, una actitud solidaria con otros niños y niñas.",
            "Conoce y respeta sus derechos y los de los demás,  en los ambientes de su cotidianidad.",
            "Participa en  actividades de su medio social y cultural,  siguiendo normas democráticas sencillas.",
            "Conoce y respeta las señales de tránsito en las calles, carreteras y avenidas (colores del semáforo, señalizaciones, paso de peatón).",
            "Participa en actividades en las que se promueve el cuidado de los elementos culturales y naturales de su entorno."
        )
    ),
    "CIENCIAS DE LA NATURALEZA" => array(
        "Seres vivos" => array(
            "Describe, con exactitud,   las características de su cuerpo y las funciones que realizan algunos órganos internos.",
            "Usa adecuadamente los órganos de los sentidos, en el conocimiento de su cuerpo y de su entorno.",
            "Nombra con  facilidad,  alimentos de su dieta diaria y algunas vitaminas que le aportan.",
            "Aplica con claridad, algunas normas básicas de nutrición  al consumir los alimentos."
        ),
        "Higiene y salud" => array(
            "Comunica con facilidad sus ideas sobre los daños que ocasiona la acumulación de basura al  medio ambiente y a la salud",
            "Aplica   con entusiasmo  hábitos de higiene, como forma de evitar enfermedades y de mantener la salud.",
            "Adopta, con regularidad, medidas preventivas sobre enfermedades contagiosas, virales e infecciosas, sin rechazo a los y las demás.",
            "Acepta con naturalidad, la aplicación de las vacunas como forma de prevenir enfermedades.",
            "Explica con propiedad los cuidados que deben tenerse  con los envases de agua, para evitar enfermedades como el dengue, cólera, entre otros."
        ),
        "Prevención de riesgos" => array(
            "Identifica con facilidad, espacios seguros frente a una situación de emergencia en su casa y en la escuela.",
            "Sigue con atención, instrucciones de sus padres, madres, maestros, maestras, radio, televisión y comunicados de la Defensa Civil, frente a desastres naturales."
        ),
        "Uso racional de los recursos naturales" => array(
            "Muestra una actitud de cuidado y respeto por las especies vegetales y animales de su entorno.",
            "Describe, de manera sencilla, características del aire, del agua y del suelo."
        ),
        "Uso de la tecnología" => array(
            "Aprovecha las tecnologías disponibles, comunicándose de diferentes maneras con los demás.",
            "Usa recursos tecnológicos en la realización de diferentes actividades de la escuela y de su hogar."
        )
    ),
    "EDUCACIÓN FÍSICA" => array(
        "Educación psicomotriz" => array(
            "Nombra y toca con las manos las diferentes partes del cuerpo: cabeza, cuello, hombros, extremidades y articulaciones, realizando juegos y cantos.",
            "Moviliza los segmentos corporales: ambas extremidades, tronco, cabeza; independientemente unos de otros, durante la realización de actividades motrices.",
            "Lanza, recibe, empuja y golpea objetos como balones y otros, con los segmentos del cuerpo (cabeza, tronco y extremidades), cuidando su cuerpo, el de los demás y su entorno.",
            "Se coloca arriba-abajo, dentro-fuera, delante-detrás, a la izquierda- a la derecha, cerca-lejos, con relación a personas y objetos en movimientos.",
            "Se desplaza, se detiene, acelera y desacelera con ritmo lento, moderado y rápido en forma libre o controlada.",
            "Identifica su lateralidad predominante y su direccionalidad en la realización de acciones motrices."
        ),
        "Recreación educativa" => array(
            "Conoce, defiende, ejerce y respeta su derecho y el de las demás personas, a participar en juegos individuales y de grupo.",
            "Valora y disfruta participar en juegos sensoriales y en juegos tradicionales individuales y colectivos, con o sin uso de objetos e instrumentos.",
            "Sigue instrucciones, reglas y normas en la realización de actividades motrices diversas."
        ),
        "Higiene y salud" => array(
            "Se asea, correctamente, después de realizar sus actividades físicas, según sus posibilidades.",
            "Utiliza indumentarias apropiadas (uniforme y calzado) cuando realiza actividades físicas, según sus posibilidades."
        )
    ),
    "EDUCACIÓN ARTÍSTICA" => array(
        "Expresión y creación artística" => array(
            "Representa gráficamente, objetos del entorno, ideas, sentimientos y aspectos de su imaginación, a través del dibujo y la pintura, transformándolos libremente.",
            "Se expresa plásticamente utilizando diversos instrumentos y materiales (pincel, lápiz, crayones, carboncillo, masilla o computador, entre otros).",
            "Baila diferentes ritmos musicales, aunque sus movimientos sean diferentes a la forma tradicional.",
            "Manipula títeres y recita poesías en sus expresiones artísticas.",
            "Canta canciones escolares, patrióticas, tradicionales, populares y del medio que le rodea."
        ),
        "Apreciación artística" => array(
            "Expresa sus emociones al observar una obra de teatro, danzas, títeres, películas, imágenes, música y programas de televisión.",
            "Muestra interés por el arte popular y folklórico dominicano.",
            "Identifica elementos artísticos en su comunidad.",
            "Identifica signos, símbolos, el Himno Nacional y canciones escolares y patrias."
        )
    ),
    "FORMACIÓN INTEGRAL HUMANA Y RELIGIOSA" => array(
        "Relación consigo mismo, misma" => array(
            "Habla con agrado acerca de la bondad y utilidad de las partes de su cuerpo.",
            "Comunica situaciones de violencia, abuso, riesgo físico y sexual, en su familia y en el medio que le rodea."
        ),
        "Relación con los y las demás" => array(
            "Participa con entusiasmo en actividades grupales, aportando ideas, realizando acciones solidarias.",
            "Valora su familia como núcleo de crecimiento, convivencia, cuidado y protección.", "Sigue  reglas de cortesía al hablar y al escuchar  en sus relaciones cotidianas."
        ),
        "Relación con la naturaleza" => array(
            "Distingue las cosas creadas por Dios de las hechas por las personas.",
            "Participa en actividades dirigidas al cuidado y protección de la naturaleza como obra creada por Dios."
        ),
        "Relación con Dios" => array(
            "Identifica los símbolos religiosos en láminas y en su contexto.",
            "Respeta momentos de oración y diálogo con Dios.",
            "Agradece a Dios por el regalo de la creación, a través de palabras, dibujos y canciones."
        )
    )
);

$second_grade = array(
    "LENGUA ESPAÑOLA" => array(
        "Comunicación oral" => array(
            "Comprensión oral" => array(
                "Comprende en forma global los actos de habla.",
                "Sigue la secuencia del diálogo: escuchar, entender, intervenir.",
                "Comprende y aprecia canciones, refranes, trabalenguas.",
                "Comprende textos leídos por otros."
            ),
            "Expresión oral" => array(
                "Produce de manera oral ideas completas, relacionadas mediante",
                "uso de sintaxis, vocabulario sencillo y adecuada entonación.",
                "Expresa  sus  opiniones  con  respeto,  sin  discriminar  por  razón  de género y raza.",
                "Describe de manera correcta y sencilla personas, objetos, animales, lugares y situaciones.",
                "Responde  adecuadamente  a  preguntas  sobre  textos  escuchados  o leídos")
        ),
        "Comunicación escrita" => array(
            "Comprensión lectora" => array(
                "Comprende  el  sentido  global  de  textos  escritos  con  diferentes intenciones comunicativas.",
                "Responde a preguntas de comprensión literal, inferencial y crítica, después de escuchar o leer textos. ",
                "Identifica la estructura de los textos que lee para comprenderlos: cuentos  (inicio,  desarrollo  y  desenlace),  historieta  (inicio, desarrollo,  desenlace),  leyenda  (inicio,   noticia  periodística  (qué,  cómo,  cuándo,  dónde,  quién),  fábulas desarrollo  y  desenlace), (inicio, desarrollo, desenlace, moraleja), instructivos (instrucciones y procedimientos) y recetas (ingredientes y preparación).",
                "Muestra  interés  en  leer   y  escribir  varios  tipos  de  textos,  tales como:  historietas,  cartas,  tarjetas,  afiches,  etiquetas,  listas,  juegos, calendarios, diarios de vida, Reconoce palabras claves o temáticas en textos que lee.leyendas, fábulas, poemas, instrucciones, recetas.periódicos, revistas, canciones, cuentos, ",
                "Utiliza el diccionario con o sin ayuda, para garantizar la comprensión del significado y uso adecuado de las palabras al expresarse.",
                "Identifica  y  produce  todas  las  correspondencias  letras-sonidos, incluyendo la combinación de consonantes y vocales.",
                "Combina correctamente sonidos, utilizando el conocimiento de las correspondencias letras y sonidos para leer palabras multisilábicas desconocidas.",
                "Identifica los elementos convencionales y formales de la escritura: letras mayúscula, guión, coma, punto y coma, punto final, signos de interrogación (¿?) y signos de exclamación (¡!) en textos que lee.",
                "Identifica en forma correcta, párrafos, oraciones, palabras y sílabas en textos que lee."
            ),
            "Expresion escrita" => array(
                "Escribe  cartas,  cuentos,  fábulas,  poesías,  historietas,  respetando  su  estructura    (introducción,  desarrollo  y   conclusión), apoyándose en organizadores gráficos. ",
                "Produce  con  precisión,  textos  sencillos,  tales  como:   etiquetas, afiches, leyendas, fábulas, cuentos, asociados   a  dibujos  o  imágenes  con  intenciones  comunicativas   diversas. ",
                "Escribe de acuerdo a su nivel, siguiendo el procedimiento   de  la  escritura  (pensar,  escribir,  borrador,  corregir,   editar, publicar). ",
                "Escribe textos breves de un párrafo, por lo menos de   dos oraciones simples, empleando en forma correcta la  coma y el punto.",
                "Escribe  oraciones  en  orden  lógico  y  las  organiza  en  párrafos."
            )
        )
    ),
    "MATEMÁTICA" => array(
        "Números y operaciones" => array(
            "Lee y escribe en forma correcta números naturales hasta el 999, siguiendo  diferentes  patrones  (uno  en  uno,  dos  en  dos,  cinco  en cinco...) en forma ascendente y descendente. ",
            "Representa con corrección y pulcritud números naturales hasta el 999 en la recta numérica y en tablas de valor posicional.",
            "Calcula  con  rigor  la  suma  de  números  naturales   con  resultados menores que 999 sin reagrupación y con reagrupación de decenas a centenas.",
            "Calcula, correctamente, la diferencia de cantidades de dos y tres dígitos sin reagrupación (sin llevar) y con reagrupación (llevando) de decena a centena.",
            "Multiplica  con  exactitud  por  2  y  por  utilizando  material concreto.",
            "Explica   con  claridad  la  división  como  una  partición  en  partes iguales (entre 2 y ) utilizando material concreto.",
            "Utiliza correctamente los números ordinales para ordenar secuencias de hasta 0 elementos del entorno.",
            "Explica  lógicamente  las  soluciones  de  operaciones  y  problemas con números naturales.",
            "Resuelve  y  formula  en  forma  correcta  la  diferencia  de  números naturales menores que 999.",
            "Resuelve  y  formula  en  forma  correcta  situaciones  problemáticas del entorno, aplicando adición de números naturales menores que 999."
        ),
        "Geometría" => array(
            "Clasifica  con  claridad  las  figuras  geométricas  básicas   (círculos, rectángulos, cuadrados, y triángulos).",
            "Completa  y  crea  con  facilidad  patrones  y  mosaicos  con  figuras geométricas.",
            "Clasifica  con  precisión  los  cuerpos  sólidos,  identificando  sus características."
        ),
        "Medición" => array(
            "Compara masas de objetos en libras utilizando la balanza.",
            "Mide  en  forma  adecuada  longitudes,  utilizando  unidades arbitrarias. ",
            "Resuelve  y  formula  con  propiedad  situaciones  problemáticas del  entorno  que  involucren  adición  y  sustracción  de  medidas  de longitud.",
            "Estima y compara con interés masas de objetos usando unidades arbitrarias.",
            "Identifica correctamente el litro como unidad de medir capacidad.",
            "Estima y mide de forma directa capacidades de diferentes recipientes utilizando medidas arbitrarias.",
            "Estima  y  mide  con  interés  capacidades  utilizando  el  litro  como unidad de medida.",
            "Lee  con  precisión  la  hora  en  punto,  en  relojes  de  manecillas  y digitales.",
            "Establece  en  forma  adecuada  relaciones  de  equivalencia  entre  el día y las horas, las horas y los minutos.",
            "Utiliza  correctamente  el  calendario  para planificar  actividades  y  eventos,  en  fechas  de importancia personal.",
            "Utiliza de manera correcta monedas de 1; ; 10; y 2pesos de uso nacional en algunas actividades de compra y venta.",
            "Establece  correctamente  equivalencias  entre monedas y billetes hasta 00 pesos.",
            "Incentiva el buen uso del dinero y el valor del ahorro.",
            "Maneja datos estadísticos (recolección, organización y análisis de datos) ",
            "Selecciona y clasifica con propiedad objetos de acuerdo a una característica común.",
            "Elabora con corrección y estética pictogramas, tablas de conteo y gráficos de barras.",
            "Lee datos representados en tablas de conteo, en pictogramas y gráficos de barras.")
    ),
    "CIENCIAS SOCIALES" => array(
        "Dimensión espacial" => array(
            "Ubica los espacios de su vivienda, de la escuela y la comunidad, a partir de la direccionalidad (derecha, izquierda, arriba, abajo).",
            "Identifica con precisión, los lugares de su comunidad que se encuentran en los diferentes puntos cardinales. ",
            "Ubica en un mapa político de la República Dominicana las secciones y parajes que conforman los municipios de su provincia."
        ),
        "Dimensión económica" => array(
            "Nombra con interés algunos recursos renovables y no renovables de su comunidad, sección o paraje.",
            "Identifica, los oficios y actividades productivas que se realizan en su familia y en su comunidad."
        ),
        "Dimensión sociocultural" => array(
            "Socializa  con  interés   las  informaciones  obtenidas   sobre  hechos históricos ocurridos en su comunidad, y las publica en el mural del aula y de la escuela.",
            "Reconoce personajes históricos de su comunidad, en diversas fuentes gráficas.",
            "Participa  con  entusiasmo  de  actividades  escolares  que  valoren  las tradiciones culturales.",
            "Se involucra en actividades en donde se valoran los símbolos patrios.",
            "Conoce sus derechos y deberes y el de los demás, manifestándolos por medio de expresiones orales, dibujos y dramatizaciones.",
            "Muestra respeto por las normas de convivencia ciudadana.",
            "Se integra con entusiasmo a procesos democráticos sencillos.",
            "Participa en actividades de búsqueda de soluciones a problemas que afectan su escuela, su familia y su comunidad.",
            "Cumple con las medidas y normas de tránsito en las calles, caminos y carreteras."
        )
    ),
    "CIENCIAS DE LA NATURALEZA" => array(
        "Seres vivos" => array(
            "Clasifica de manera correcta alimentos de la dieta diaria, procedentes de plantas o de animales.",
            "Presenta de manera sencilla grupos de alimentos naturales y procesados en organizadores gráficos.",
            "Comprueba con experimentos sencillos, que las plantas necesitan sol, agua y tierra en su desarrollo.",
            "Reconoce con claridad los beneficios del sol como fuente de energía para las plantas y las personas."
        ),
        "Higiene y salud" => array(
            "Práctica   adecuadamente  medidas  higiénicas  en  el  consumo  y manipulación de los alimentos.",
            "Explica de manera clara las consecuencias del consumo excesivo de alimentos azucarados y el daño de éstos sobre los dientes.",
            "Demuestra con entusiasmo una actitud de cooperación en la limpieza del hogar, la escuela y su entorno.",
            "Responde  adecuadamente  preguntas  sobre  cómo  mantener   los envases con agua para evitar la reproducción de insectos."
        )
        ,
        "Materia y energía" => array(
            "Identifica con precisión algunos de los estados en que se presenta la materia.",
            "Describe  con  seguridad  objetos  según  su  forma,  tamaño,  dureza,temperatura y textura.",
            "Explica con facilidad la utilidad de las máquinas simples en la vida cotidiana.",
            "Reconoce con claridad los beneficios del Sol como fuente de energía para las plantas, las personas y los animales.",
            "Comprueba con experimentos sencillos, que las plantas necesitan Sol, agua y tierra en su desarrollo."
        ),
        "Uso racional de los recursos naturales" => array(
            "Reconoce con entusiasmo los beneficios que producen las plantas en el mantenimiento de su entorno.",
            "Contribuye con interés al ahorro de agua y de energía en su escuela, en su vivienda y en su comunidad.",
            "Participa con entusiasmo en campañas de reforestación en la escuela y en su comunidad."
        ),
        "Uso de la tecnología" => array(
            "Se  comunica   con  facilidad  utilizando  diferentes  instrumentos tecnológicos."
        ),
        "Prevención de riesgos" => array(
            "Identifica con facilidad espacios seguros frente a una situación de emergencia en su casa, en la escuela y en la comunidad.",
            "Sigue   con  atención  recomendaciones  de  fuentes  informativas confiables, frente a desastres naturales."
        )
    ),
    "EDUCACIÓN ARTÍSTICA" => array(
        "Expresión y creación artística" => array(
            "Recrea  en  sus  pinturas,  ilustraciones  y  modelados,  imágenes  de  su cotidianidad, de textos literarios, de su entorno, de su cultura y de las otras personas.",
            "Produce y reproduce sonidos utilizando diferentes partes de su cuerpo o con objetos sonoros en las manos.",
            "Reconoce y baila diferentes ritmos musicales populares.",
            "Realiza dibujos, pinturas y collages, para expresarse creativamente con materiales del entorno (como tarjetas, cajas, portalápices, entre otros).",
            "Representa personajes de relatos (cuentos, historias cortas o leyendas de su entorno) eligiendo sus roles con libertad y mostrando sus características físicas (vestuario, forma de caminar o gesticular)."
        ),
        "Apreciación artística" => array(
            "Distingue sonidos de su entorno.",
            "Identifica sonidos de instrumentos musicales que caracterizan la cultura dominicana.",
            "Reconoce algunas manifestaciones artísticas populares y folklóricas.",
            "Respeta las producciones artísticas de sus compañeros, y compañeras y del arte en general.",
            "Identifica  y  comenta  de  forma  sencilla  símbolos  e  himnos  patrios  y canciones escolares y patrias."
        )
    ),
    "EDUCACIÓN FÍSICA" => array(
        "Educación Psicomotriz" => array(
            "Mueve  sus  extremidades  superiores  e  inferiores  alternando  y combinando derecha e izquierda con y sin desplazamientos.",
            "Lanza, empuja y golpea con precisión objetos como balones y otros con los segmentos del cuerpo (cabeza, tronco y extremidades) cuidando su cuerpo, el de los demás y su entorno.",
            "Se desplaza en diferentes direcciones y trayectorias (curva, rectilíneas y en zig-zag), se detiene, acelera y desacelera con ritmo lento, moderado y rápido, en forma libre o controlada.",
            "Corre libremente en distintas direcciones y velocidades, en espacios abiertos que no le representan riesgos a su seguridad ni a la de los y las demás.",
            "Equilibra en diferentes posiciones, sobre un solo pie, sobre diferentes superficies planas, sosteniendo objetos o implementos.",
            "Salta (horizontal y verticalmente) a diferentes alturas y distancias."
        ),
        "Recreación Educativa" => array(
            "Valora  y  disfruta  participar  en:  juegos  sensorio-motores,  juegos tradicionales individuales y colectivos, rondas, bailes y otros, con y sin objetos e implementos.",
            "Conoce, defiende y respeta su derecho y el de las demás personas, a participar en juegos individuales y de grupo.",
            "Higiene y Salud",
            "Se asea correctamente después de realizar sus actividades físicas.",
            "Utiliza indumentarias (uniforme y calzado apropiado) cuando realiza actividades físicas."
        ),
        "Relación consigo mismo, misma." => array(
            "Manifiesta conocimiento de su cuerpo, lo cuida y exige respeto en su entorno familiar y social.",
            "Identifica  su  familia  y  sus  características,  y  se  siente  parte  de  la misma."
        ),
        "Relación con los y las demás" => array(
            "Distingue acciones que una familia debe realizar para cuidar y proteger a sus integrantes. ",
            "Respeta las diferencias individuales y es tolerante con sus compañeros y compañeras.",
            "Trata a sus compañeros y compañeras con cortesía y cariño, sin distinción de creencias religiosas, sexo, raza y nacionalidad."
        ),
        "Relación con la naturaleza" => array(
            "Reconoce  su  medio  natural  como  el  espacio  regalado  por  Dios  para vivir en familia.",
            "Contribuye al cuidado y protección de su entorno.",
            "Expresa agradecimiento a Dios por el regalo de la naturaleza."
        ),
        "Relación con Dios" => array(
            "Participa en momentos de oración y diálogo con Dios.",
            "Escucha relatos de la vida de Jesús y dramatiza los principales hechos de su vida.",
            "Agradece  a  Dios  con  palabras  y  gestos,  todas  las  cosas  buenas  que puede hacer con su cuerpo."
        )
    )
);

$lang_Datefrom = "Fecha Desde";
$lang_Dateto = "Fecha Para";
$lang_noSubjectErr = "No Subject Encontrado";
?>
