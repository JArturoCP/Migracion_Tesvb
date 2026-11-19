-- SQLite fixture for isolated schedule tests; no production migrations or triggers.

CREATE TABLE `gnral_periodos` (
  `id_periodo` INTEGER PRIMARY KEY,
  `periodo` varchar(50) DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date NOT NULL,
  `ciclo` varchar(30) NOT NULL,
  `year` INTEGER NOT NULL,
  `siglas` varchar(100) NOT NULL,
  `estado` INTEGER NOT NULL
);

CREATE TABLE `in_periodos` (
  `id_periodo_ingles` INTEGER PRIMARY KEY,
  `periodo_ingles` text NOT NULL,
  `fecha_inicio_ingles` date NOT NULL,
  `fecha_final_ingles` date NOT NULL,
  `fecha_inicial_periodo` date NOT NULL,
  `fecha_final_periodo` date NOT NULL,
  `estado_actual` INTEGER NOT NULL,
  `estado_historial` INTEGER NOT NULL
);

CREATE TABLE `men` (
  `id` INTEGER NOT NULL,
  `des` varchar(500) NOT NULL
);

CREATE TABLE `eva_activa_evaluacion` (
  `id` INTEGER PRIMARY KEY,
  `estado` INTEGER NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_tipos_usuario` (
  `id_tipo_usuario` INTEGER PRIMARY KEY,
  `descripcion` varchar(100) DEFAULT NULL
);

CREATE TABLE `gnral_semestres` (
  `id_semestre` INTEGER PRIMARY KEY,
  `descripcion` varchar(20) DEFAULT NULL
);

CREATE TABLE `eva_status_materia` (
  `id_status_materia` INTEGER DEFAULT NULL,
  `nombre_status` varchar(55) DEFAULT NULL
);

CREATE TABLE `eva_tipo_curso` (
  `id_tipo_curso` INTEGER DEFAULT NULL,
  `nombre_curso` varchar(50) DEFAULT NULL
);

CREATE TABLE `gnral_carreras` (
  `id_carrera` INTEGER PRIMARY KEY,
  `nombre` varchar(100) DEFAULT NULL,
  `siglas` varchar(20) NOT NULL,
  `COLOR` varchar(20) DEFAULT NULL,
  `codigo_carrera` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_reticulas` (
  `id_reticula` INTEGER PRIMARY KEY,
  `clave` varchar(20) NOT NULL,
  `id_carrera` INTEGER NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_materias` (
  `id_materia` INTEGER PRIMARY KEY,
  `nombre` varchar(80) DEFAULT NULL,
  `clave` varchar(10) DEFAULT NULL,
  `hrs_practicas` INTEGER DEFAULT NULL,
  `hrs_teoria` INTEGER DEFAULT NULL,
  `id_reticula` INTEGER NOT NULL,
  `id_semestre` INTEGER NOT NULL,
  `creditos` INTEGER NOT NULL,
  `unidades` INTEGER NOT NULL,
  `especial` INTEGER NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_departamentos` (
  `id_departamento` INTEGER PRIMARY KEY,
  `nombre_departamento` varchar(100) DEFAULT NULL
);

CREATE TABLE `gnral_cargos` (
  `id_cargo` INTEGER PRIMARY KEY,
  `cargo` varchar(100) DEFAULT NULL,
  `abre` varchar(20) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_perfiles` (
  `id_perfil` INTEGER PRIMARY KEY,
  `descripcion` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `users` (
  `id` INTEGER PRIMARY KEY,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activated` INTEGER NOT NULL DEFAULT 0,
  `tipo_usuario` INTEGER NOT NULL,
  `info_ok` INTEGER NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
);

CREATE TABLE `gnral_personales` (
  `id_personal` INTEGER PRIMARY KEY,
  `nombre` varchar(60) DEFAULT NULL,
  `id_perfil` INTEGER DEFAULT NULL,
  `id_situacion` INTEGER DEFAULT NULL,
  `esc_procedencia` text NOT NULL,
  `origen_nac` varchar(30) DEFAULT NULL,
  `fch_nac` varchar(10) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `fch_ingreso_tesvb` varchar(10) DEFAULT NULL,
  `nombramiento` varchar(10) DEFAULT NULL,
  `rfc` varchar(13) DEFAULT NULL,
  `fch_recontratacion` varchar(10) DEFAULT NULL,
  `escolaridad` varchar(15) DEFAULT NULL,
  `id_cargo` INTEGER DEFAULT NULL,
  `clave` varchar(11) DEFAULT NULL,
  `horas_maxima` INTEGER NOT NULL,
  `correo` varchar(40) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `cedula` INTEGER NOT NULL,
  `sexo` varchar(5) NOT NULL,
  `maximo_horas_ingles` INTEGER NOT NULL,
  `numero_empleado` varchar(100) NOT NULL,
  `tipo_usuario` INTEGER DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_departamento` INTEGER NOT NULL,
  `estado_docente_inv` INTEGER DEFAULT NULL
);

CREATE TABLE `gnral_materias_perfiles` (
  `id_materia_perfil` INTEGER PRIMARY KEY,
  `id_personal` INTEGER NOT NULL,
  `id_materia` INTEGER NOT NULL,
  `mostrar` INTEGER NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_periodo_carreras` (
  `id_periodo_carrera` INTEGER PRIMARY KEY,
  `id_carrera` INTEGER DEFAULT NULL,
  `id_periodo` INTEGER DEFAULT NULL
);

CREATE TABLE `gnral_horarios` (
  `id_horario_profesor` INTEGER PRIMARY KEY,
  `id_periodo_carrera` INTEGER DEFAULT NULL,
  `id_personal` INTEGER DEFAULT NULL,
  `aprobado` varchar(2) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `hrs_edificios` (
  `id_edificio` INTEGER PRIMARY KEY,
  `nombre` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `hrs_aulas` (
  `id_aula` INTEGER PRIMARY KEY,
  `id_carrera` INTEGER DEFAULT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `id_edificio` INTEGER NOT NULL,
  `comp` INTEGER NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_escuela_procedencia` (
  `id_escuela_procedencia` INTEGER PRIMARY KEY,
  `nombre_escuela` text NOT NULL,
  `estado` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL
);

CREATE TABLE `gnral_instituciones_edu` (
  `id_institucion` INTEGER PRIMARY KEY,
  `cct` text NOT NULL,
  `nombre_escuela` text NOT NULL,
  `domicilio` text NOT NULL,
  `municipio` text NOT NULL,
  `localidad` text NOT NULL,
  `turno` text NOT NULL,
  `servicio` text NOT NULL
);

CREATE TABLE `gnral_seguro_social` (
  `id_seguro_social` INTEGER PRIMARY KEY,
  `descripcion` varchar(100) NOT NULL
);

CREATE TABLE `gnral_grupos` (
  `id_grupo` INTEGER PRIMARY KEY,
  `grupo` INTEGER DEFAULT NULL
);

CREATE TABLE `gnral_alumnos` (
  `id_alumno` INTEGER PRIMARY KEY,
  `cuenta` varchar(20) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apaterno` varchar(50) DEFAULT NULL,
  `amaterno` varchar(50) DEFAULT NULL,
  `genero` varchar(5) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `edad` INTEGER DEFAULT NULL,
  `curp_al` varchar(18) DEFAULT NULL,
  `edo_civil` varchar(45) DEFAULT NULL,
  `nacionalidad` varchar(45) DEFAULT NULL,
  `twiter_al` varchar(45) DEFAULT NULL,
  `correo_al` varchar(45) DEFAULT NULL,
  `facebook_al` varchar(45) DEFAULT NULL,
  `cel_al` varchar(45) DEFAULT NULL,
  `tel_fijo_al` varchar(45) DEFAULT NULL,
  `entidad_nac_al` varchar(45) DEFAULT NULL,
  `grado_estudio_al` varchar(45) DEFAULT NULL,
  `id_carrera` INTEGER DEFAULT NULL,
  `id_semestre` INTEGER DEFAULT NULL,
  `grupo` INTEGER DEFAULT NULL,
  `promedio` double DEFAULT NULL,
  `estado` INTEGER DEFAULT NULL,
  `id_municipio` INTEGER DEFAULT NULL,
  `calle_al` varchar(50) DEFAULT NULL,
  `n_ext_al` varchar(50) DEFAULT NULL,
  `n_int_al` varchar(50) DEFAULT NULL,
  `entre_calle` varchar(50) DEFAULT NULL,
  `y_calle` varchar(50) DEFAULT NULL,
  `otra_ref` varchar(500) DEFAULT NULL,
  `colonia_al` varchar(50) DEFAULT NULL,
  `localidad_al` varchar(50) DEFAULT NULL,
  `cp` varchar(10) DEFAULT NULL,
  `id_usuario` INTEGER NOT NULL,
  `sesion` INTEGER DEFAULT NULL,
  `discapacidad` INTEGER NOT NULL,
  `descripcion_discapacidad` text NOT NULL,
  `lengua` INTEGER NOT NULL,
  `descripcion_lengua` text NOT NULL,
  `id_seguro_social` INTEGER NOT NULL,
  `numero_seguro_social` varchar(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_escuela_procedencia` INTEGER NOT NULL,
  `promedio_preparatoria` double NOT NULL,
  `revalidacion` INTEGER NOT NULL,
  `id_disponible` INTEGER NOT NULL,
  `s_a` INTEGER NOT NULL,
  `id_institucion` INTEGER NOT NULL,
  `folio` varchar(60) NOT NULL,
  `tipo_admision` varchar(45) DEFAULT NULL
);

CREATE TABLE `eva_carga_academica` (
  `id_carga_academica` INTEGER PRIMARY KEY,
  `id_alumno` INTEGER DEFAULT NULL,
  `id_materia` INTEGER DEFAULT NULL,
  `id_status_materia` INTEGER DEFAULT NULL,
  `id_tipo_curso` INTEGER DEFAULT NULL,
  `id_periodo` INTEGER DEFAULT NULL,
  `grupo` INTEGER DEFAULT NULL,
  `tipo_alumno` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `gnral_horas_profesores` (
  `id_hrs_profesor` INTEGER PRIMARY KEY,
  `id_horario_profesor` INTEGER DEFAULT NULL,
  `grupo` INTEGER NOT NULL,
  `id_materia_perfil` INTEGER NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);

CREATE TABLE `hrs_semanas` (
  `id_semana` INTEGER PRIMARY KEY,
  `dia` varchar(10) DEFAULT NULL,
  `hora` varchar(25) DEFAULT NULL
);

CREATE TABLE `hrs_rhps` (
  `id_rhps` INTEGER PRIMARY KEY,
  `id_hrs_profesor` INTEGER DEFAULT NULL,
  `id_semana` INTEGER DEFAULT NULL,
  `id_cargo` varchar(20) NOT NULL,
  `id_aula` INTEGER NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
);