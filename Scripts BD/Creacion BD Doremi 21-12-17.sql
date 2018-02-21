create table Parametros(
	ID int not null auto_increment,
	Item varchar(30) not null,
	Codigo varchar(15) not null,
	Descripcion varchar(40) not null,
	Opcional_1 varchar(60),
	Opcional_2 varchar(60),
	Opcional_3 varchar(60),
	Primary Key(ID)
)engine=innodb;

insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Generos','M','Masculino'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Generos','F','Femenino'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Tipo_Usuario','0','Administrador'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Tipo_Usuario','1','Profesor'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Tipo_Usuario','2','Alumno'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Estados','0','Inactivo'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Estados','1','Activo'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Estados','3','Confirmación Pendiente'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Asistencia','0','Ausente'
);
insert into Parametros(
	Item,Codigo,Descripcion
)
values(
	'Asistencia','1','Presente'
);

create table Usuarios(
	ID int not null auto_increment,
	Rut varchar(15) not null,
	Clave varchar(100) not null,
	Nombre varchar(30) not null,
	Apellido_Paterno varchar(30) not null,
	Apellido_Materno varchar(30),
	Genero int not null,
	Fecha_Nacimiento date not null,
	Email varchar(60),
	Telefono_1 varchar(30) not null,
	Telefono_2 varchar(30),
	Direccion varchar(80),
	Tipo_Usuario int not null,
	Comentarios varchar(250),
	Estado int not null,
	Fecha_Creacion datetime not null,
	Fecha_Modificacion datetime not null,
	Primary Key(ID),
	Foreign Key(Genero) References Parametros(ID),
	Foreign Key(Tipo_Usuario) References Parametros(ID),
	Foreign Key(Estado) References Parametros(ID)
)engine=innodb;

insert into Usuarios(
	Rut,Clave,
	Nombre,Apellido_Paterno,
	Genero,Fecha_Nacimiento,Telefono_1,
	Tipo_Usuario,Estado,
	Fecha_Creacion,Fecha_Modificacion
)
values(
	'19','$2y$12$cR/mSwtKpMXBdPlIvZ1zw.psGIYUQDxsL2Ihsybe9orbE8DjEet.y',
	'systemadmin','admin',
	'1','19920331','+56944041861',
	'3','7',
	now(),now()
);

create table Usuarios_Fotos(
	ID int not null auto_increment,
	ID_Usuario int not null,
	Nombre_Archivo varchar(80) not null,
	Path varchar(60) not null,
	Usuario_Creacion int not null,
	Fecha_Creacion datetime not null,
	Usuario_Modificacion int not null,
	Fecha_Modificacion datetime not null,
	primary Key(ID),
	Foreign Key(ID_Usuario) References Usuarios(ID),
	Foreign Key(Usuario_Creacion) References Usuarios(ID),
	Foreign Key(Usuario_Modificacion) References Usuarios(ID)
)engine=innodb;

insert into Usuarios_Fotos(
	ID_Usuario,Nombre_Archivo,Path,
	Usuario_Creacion,Fecha_Creacion,
	Usuario_Modificacion,Fecha_Modificacion
)
values(
	'1','default_M.png','default_M.png',
	'1',now(),
	'1',now()
);

create table Cursos(
	ID int not null auto_increment,
	Nombre varchar(60) not null,
	Comentarios varchar(150),
	Estado int not null,
	Usuario_Creacion int not null,
	Fecha_Creacion datetime not null,
	Usuario_Modificacion int not null,
	Fecha_Modificacion datetime not null,
	Primary Key(ID),
	Foreign Key(Estado) References Parametros(ID),
	Foreign Key(Usuario_Creacion) References Usuarios(ID),
	Foreign Key(Usuario_Modificacion) References Usuarios(ID)
)engine=innodb;

create table Curso_Profesores(
	ID int not null auto_increment,
	ID_Curso int not null,
	ID_Profesor int not null,
	Primary Key(ID),
	Foreign Key(ID_Curso) References Cursos(ID),
	Foreign Key(ID_Profesor) References Usuarios(ID)
)engine=innodb;

create table Curso_Alumnos(
	ID int not null auto_increment,
	ID_Curso int not null,
	ID_Alumno int not null,
	Primary Key(ID),
	Foreign Key(ID_Curso) References Cursos(ID),
	Foreign Key(ID_Alumno) References Usuarios(ID)
)engine=innodb;

create table Clases(
	ID int not null auto_increment,
	ID_Curso int not null,
	Fecha date not null,
	Hora_Inicio time not null,
	Hora_Termino time,
	Comentarios varchar(150),
	Usuario_Creacion int not null,
	Fecha_Creacion datetime not null,
	Usuario_Modificacion int not null,
	Fecha_Modificacion datetime not null,
	Primary Key(ID),
	Foreign Key(ID_Curso) References Cursos(ID),
	Foreign Key(Usuario_Creacion) References Usuarios(ID),
	Foreign Key(Usuario_Modificacion) References Usuarios(ID)
)engine=innodb;

create table Clase_Asistencia_Alumnos(
	ID int not null auto_increment,
	ID_Clase int not null,
	ID_Alumno int not null,
	Asistencia int not null,
	Comentarios varchar(150),
	Usuario_Creacion int not null,
	Fecha_Creacion datetime not null,
	Usuario_Modificacion int not null,
	Fecha_Modificacion datetime not null,
	Primary Key(ID),
	Foreign Key(ID_Clase) References Clases(ID),
	Foreign Key(ID_Alumno) References Usuarios(ID),
	Foreign Key(Asistencia) References Parametros(ID),
	Foreign Key(Usuario_Creacion) References Usuarios(ID),
	Foreign Key(Usuario_Modificacion) References Usuarios(ID)
)engine=innodb;

create table Clase_Asistencia_Alumnos_Certificados(
	ID int not null auto_increment,
	ID_Asistencia int not null,
	Nombre_Archivo varchar(80) not null,
	Path varchar(60) not null,
	Primary Key(ID),
	Foreign Key(ID_Asistencia) References Clase_Asistencia_Alumnos(ID)
)engine=innodb;

create table Clase_Asistencia_Profesores(
	ID int not null auto_increment,
	ID_Clase int not null,
	ID_Profesor int not null,
	Asistencia int not null,
	Comentarios varchar(150),
	Usuario_Creacion int not null,
	Fecha_Creacion datetime not null,
	Usuario_Modificacion int not null,
	Fecha_Modificacion datetime not null,
	Primary Key(ID),
	Foreign Key(ID_Clase) References Clases(ID),
	Foreign Key(ID_Profesor) References Usuarios(ID),
	Foreign Key(Asistencia) References Parametros(ID),
	Foreign Key(Usuario_Creacion) References Usuarios(ID),
	Foreign Key(Usuario_Modificacion) References Usuarios(ID)
)engine=innodb;

create table Clase_Asistencia_Profesores_Certificados(
	ID int not null auto_increment,
	ID_Asistencia int not null,
	Nombre_Archivo varchar(80) not null,
	Path varchar(60) not null,
	Primary Key(ID),
	Foreign Key(ID_Asistencia) References Clase_Asistencia_Profesores(ID)
)engine=innodb;

create table Clase_Bitacora_Alumnos(
	ID int not null auto_increment,
	ID_Clase int not null,
	ID_Alumno int not null,
	Comentarios varchar(250),
	Usuario_Creacion int not null,
	Fecha_Creacion datetime not null,
	Usuario_Modificacion int not null,
	Fecha_Modificacion datetime not null,
	Primary Key(ID),
	Foreign Key(ID_Clase) References Clases(ID),
	Foreign Key(ID_Alumno) References Usuarios(ID),
	Foreign Key(Usuario_Creacion) References Usuarios(ID),
	Foreign Key(Usuario_Modificacion) References Usuarios(ID)
)engine=innodb;

create table Noticias(
	ID int not null auto_increment,
	Fecha date not null,
	Titulo varchar(30) not null,
	Bajada varchar(100),
	Contenido varchar(450),
	Fecha_Vencimiento date,
	Estado int not null,
	Usuario_Creacion int not null,
	Fecha_Creacion datetime not null,
	Usuario_Modificacion int not null,
	Fecha_Modificacion datetime not null,
	Primary Key(ID),
	Foreign Key(Estado) References Parametros(ID),
	Foreign Key(Usuario_Creacion) References Usuarios(ID),
	Foreign Key(Usuario_Modificacion) References Usuarios(ID)
)engine=innodb;

create table Noticia_Imagenes(
	ID int not null auto_increment,
	ID_Noticia int not null,
	Nombre_Archivo varchar(80) not null,
	Path varchar(60) not null,
	Tipo_Imagen int not null,
	Primary Key(ID),
	Foreign Key(ID_Noticia) References Noticias(ID)
)engine=innodb;