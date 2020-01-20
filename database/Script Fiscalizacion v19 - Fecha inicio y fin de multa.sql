/*==============================================================*/
/* Table: EJERCICIOFISCAL                                       */
/*==============================================================*/
create table ejercicioFiscal
(
	id                   int not null auto_increment,
	anio                 int not null,
	activo               bool,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_ejerciciofiscal primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: USUARIO                                               */
/*==============================================================*/
create table usuario
(
	id                   int(255) auto_increment not null,
	usuario              varchar(150),
	password             varchar(255),
	activo               bool,
	vigencia				   date,
	role                 varchar(50),
	created_at           datetime,
	updated_at           datetime,
	sesionactual			datetime,
	ultimasesion         datetime,
	remember_token       varchar(255),
	CONSTRAINT pk_usuario primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: CONFIGURACIÓN                                       */
/*==============================================================*/
create table configuracion
(
	id 					int not null auto_increment,
	descripcion 		varchar(255),
	valortexto 			varchar(255),
	valornumero 		int,
	created_at 			datetime,
	updated_at 			datetime,
	CONSTRAINT pk_configuracion primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: CONFIGURACIÓN                                       */
/*==============================================================*/
create table encargados
(
	id                   int not null auto_increment,
	nombre               varchar(50),
	apellidopaterno      varchar(30),
	apellidomaterno      varchar(30),
	puesto               varchar(255),
	activo               bool,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_encargados primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: TIPODEINSPECCION                                      */
/*==============================================================*/
create table tipoDeInspeccion
(
	id              	int not null auto_increment,
	clave           	varchar(10),
	nombre          	varchar(50),
	diasvencimiento 	int(3),
	created_at      	datetime,
	updated_at      	datetime,
	CONSTRAINT pk_tipodeinspeccion primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: ESTATUSINSPECCION                                     */
/*==============================================================*/
create table estatusInspeccion
(
	id                   int not null auto_increment,
	clave                varchar(10),
	nombre               varchar(50),
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_estatusinspeccion primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: GIROCOMERCIALES                                       */
/*==============================================================*/
create table giroComercial
(
	id                  int not null auto_increment,
	nombre              varchar(50),
	activo              bool,
	created_at          datetime,
	updated_at          datetime,
	CONSTRAINT pk_girocomercial primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: PAIS                                                  */
/*==============================================================*/
create table pais
(
	id                  int not null auto_increment,
	clave               varchar(10),
	nombre 				varchar(75),
	created_at          datetime,
	updated_at          datetime,
	CONSTRAINT pk_pais primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: DOCUMENTACIONREQUERIDA                                */
/*==============================================================*/
create table documentacionRequerida
(
	id                   int not null auto_increment,
	clave                varchar(10),
	nombre               varchar(255),
	activo               bool,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_documentacionrequerida primary key (id)
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: DIAINHABIL                                            */
/*==============================================================*/
create table diaInhabil
(
	id                  int not null auto_increment,
	ejerciciofiscal_id  int,
	fecha 				date,
	activo              bool,
	created_at          datetime,
	updated_at          datetime,
	CONSTRAINT pk_diainhabil primary key (id),
	CONSTRAINT fk_diainhabil_ejerciciofiscal foreign key (ejerciciofiscal_id) references ejercicioFiscal (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: IMPRESIONDEFORMATOS                                   */
/*==============================================================*/
create table impresionDeFormatos
(
	id                   int not null auto_increment,
	tipoinspeccion_id    int,
	usuario_id           int,
	folioinicio          int,
	foliofin             int,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_impresiondeformatos primary key (id),
	CONSTRAINT fk_impresiondeformatos_tipodeinspeccion foreign key (tipoinspeccion_id) references tipoDeInspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_impresiondeformatos_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: FOLIOXTIPOINSPECCION                                  */
/*==============================================================*/
create table folioPorTipoInspeccion
(
	id                    int not null auto_increment,
	tipoinspeccion_id     int,
	ejerciciofiscal_id    int,
	folioportipo          int,
	created_at            datetime,
	updated_at            datetime,
	CONSTRAINT pk_folioportipoinspeccion primary key (id),
	CONSTRAINT fk_folioportipoinspeccion_tipodeinspeccion foreign key (tipoinspeccion_id) references tipoDeInspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_folioportipoinspeccion_ejerciciofiscal foreign key (ejerciciofiscal_id) references ejercicioFiscal (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: FORMAVALORADA                                         */
/*==============================================================*/
create table formaValorada
(
	id                   int not null auto_increment,
	usuario_id           int,
	tipoinspeccion_id    int,
	ejerciciofiscal_id   int,
	encargado_id     		int,
	folioinicio          int,
	foliofin             int,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_formavalorada primary key (id),
	CONSTRAINT fk_formavalorada_tipodeinspeccion foreign key (tipoinspeccion_id) references tipoDeInspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_formavalorada_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict,
	CONSTRAINT fk_formavalorada_ejerciciofiscal foreign key (ejerciciofiscal_id) references ejercicioFiscal (id) on delete restrict on update restrict,
	CONSTRAINT fk_formavalorada_encargados foreign key (encargado_id) references encargados (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: SUBGIROCOMERCIAL                                      */
/*==============================================================*/
create table subgiroComercial
(
	id                   int not null auto_increment,
	giro_id              int,
	nombre               varchar(50),
	activo               bool,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_subgirocomercial primary key (id),
	CONSTRAINT fk_subgirocomercial_girocomercial foreign key (giro_id) references giroComercial (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: INSPECTOR                                             */
/*==============================================================*/
create table inspector
(
	id                   int not null auto_increment,
	usuario_id            int,
	nombre               varchar(50),
	apellidopaterno      varchar(30),
	apellidomaterno      varchar(30),
	clave                varchar(10),
	hash                 varchar(255),
	estatus              char(1) comment 'A=Activo
													  B=Baja
													  S=Suspendido
													  V=Vigente',
	vigenciainicio 		 date,
	vigenciafin 		 date,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_inspector primary key (id),
	CONSTRAINT fk_inspector_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: GAFETES                                               */
/*==============================================================*/
create table gafetes
(
	id                   int not null auto_increment,
	ejerciciofiscal_id   int,
	inspector_id         int,
	folio                varchar(50),
	vigencia             datetime,
	codigoqr             varchar(255),
	imageninspector      varchar(255),
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_gafetes primary key (id),
	CONSTRAINT fk_gafetes_inspector foreign key (inspector_id) references inspector (id) on delete restrict on update restrict,
	CONSTRAINT Ffk_gafetes_ejerciciofiscal foreign key (ejerciciofiscal_id) references ejercicioFiscal (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: GESTORES                                              */
/*==============================================================*/
create table gestores
(
	id                   int not null auto_increment,
	usuario_id           int,
	nombre               varchar(50),
	apellidopaterno      varchar(30),
	apellidomaterno      varchar(30),
	telefono             varchar(50),
	celular              varchar(50),
	correoelectronico    varchar(75),
	ine                  varchar(30),
	estatus              char(1) comment 'A=Activo
													  B=Baja
													  S=Suspendido
													  V=Vigente',
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_gestores primary key (id),
	CONSTRAINT fk_gestores_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: ESTADO                                                */
/*==============================================================*/
create table estado
(
	id             int not null auto_increment,
	pais_id        int,
	nombre         varchar(75),
	clave          varchar(10),
	created_at     datetime,
	updated_at     datetime,
	CONSTRAINT pk_estado primary key (id),
	CONSTRAINT fk_estado_pais foreign key (pais_id) references pais (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: MUNICIPIO                                             */
/*==============================================================*/
create table municipio
(
	id                  int not null auto_increment,
	estado_id           int,
	nombre              varchar(75),
	clave               int(10),
	created_at     		datetime,
	updated_at     		datetime,
	CONSTRAINT pk_municipio primary key (id),
	CONSTRAINT fk_municipio_estado foreign key (estado_id) references estado (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: COLONIAS                                              */
/*==============================================================*/
create table colonias
(
	id                   int not null auto_increment,
	municipio_id         int,
	nombre 		         varchar(75),
	cp                   varchar(5),
	created_at     		datetime,
	updated_at     		datetime,
	CONSTRAINT pk_colonias primary key (id),
	CONSTRAINT fk_colonias_municipio foreign key (municipio_id) references municipio (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: COMERCIOS                                             */
/*==============================================================*/


create table comercios(
	id                            int not null auto_increment,
	giro_id                       int,
	subgirocomercial_id           int,   
	colonia_id                    int,                     
	rfc                           varchar(20), 
	licenciafuncionamientoid      int(10), 
	licenciafuncionamiento        int(10), 
	propietarioid                 int(10), 
	propietarionombre             varchar(255),
	clavecatastral                varchar(255), 
	denominacion                  varchar(255), 
	nombreestablecimiento         varchar(255), 
	domiciliofiscal               varchar(255), 
	calle                         varchar(255), 
	nointerior                    varchar(10), 
	noexterior                    varchar(10), 
	cp                            varchar(5), 
	colonia                       varchar(150), 
	localidad                     varchar(150), 
	municipio                     varchar(150), 
	estado                        varchar(150), 
	folio                         varchar(20), 
	estatus                       char(1), 
	created_at                    datetime, 
	updated_at                    datetime,
	CONSTRAINT pk_comercios primary key (id),
	CONSTRAINT fk_inspeccion_giro foreign key (giro_id) references giroComercial (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_subgirocomercial foreign key (subgirocomercial_id) references subgiroComercial (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_colonia foreign key (colonia_id) references colonias (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: INSPECCION                                            */
/*==============================================================*/
create table inspeccion
(
	id                   int not null auto_increment,
	formavalorada_id     int,
	comercio_id          int,
	tipoinspeccion_id    int,
	usuario_id           int,
	gestores_id          int,
	ejerciciofiscal_id   int,
	inspector_id         int,
	estatusinspeccion_id int,
	fechaasignada        datetime,
	fechacapturada       datetime,
	fechaprorroga        datetime,
	observacionprorroga  varchar(255),
	fecharealizada       date,
	horarealizada        time,
	comentario           varchar(255),
	folio                varchar(50),
	nombreencargado      varchar(150),
	cargoencargado       varchar(150),
	identificacion       varchar(150),
	folioidentificacion  varchar(150),
	diasvence            int,
	fechavence           date,
	created_at           datetime,
	updated_at           datetime,
	CONSTRAINT pk_inspeccion primary key (id),
	CONSTRAINT fk_inspeccion_formavalorada foreign key (formavalorada_id) references formaValorada (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_tipoinspeccion foreign key (tipoinspeccion_id) references tipoDeInspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_gestores foreign key (gestores_id) references gestores (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_ejerciciofiscal foreign key (ejerciciofiscal_id) references ejercicioFiscal (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_inspector foreign key (inspector_id) references inspector (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_estatusinspeccion foreign key (estatusinspeccion_id) references estatusInspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_inspeccion_comercio foreign key (comercio_id) references comercios (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: DOCUMENTACIONXTIPODEINSPECCION                          */
/*==============================================================*/

create table documentacionPorInspeccion
(
	id                            int not null auto_increment,
	tipoinspeccion_id             int,
	documentacionrequerida_id     int,
	inspeccion_id                 int,
	solicitado                    bool,
	exhibido                      bool,
	observaciones                 varchar(255),
	created_at                    datetime,
	updated_at                    datetime,
	CONSTRAINT pk_documentacionxinspeccion primary key (id),
	CONSTRAINT fk_documentacionxinspeccion_tipodeinspeccion foreign key (tipoinspeccion_id) references tipoDeInspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_documentacionxinspeccion_documentacionrequerida foreign key (documentacionrequerida_id) references documentacionRequerida (id) on delete restrict on update restrict,
	CONSTRAINT fk_documentacionxinspeccion_inspeccion foreign key (inspeccion_id) references inspeccion (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: DOCUMENTACIONXTIPODEINSPECCION                          */
/*==============================================================*/

create table documentacionPorTipoInspeccion
(
	id                            int not null auto_increment,
	tipoinspeccion_id             int,
	documentacionrequerida_id     int,
	created_at                    datetime,
	updated_at                    datetime,
	CONSTRAINT pk_documentacionxtipodeinspeccion primary key (id),
	CONSTRAINT fk_documentacionxtipodeinspeccion_tipodeinspeccion foreign key (tipoinspeccion_id) references tipoDeInspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_documentacionxtipodeinspeccion_documentacionrequerida foreign key (documentacionrequerida_id) references documentacionRequerida (id) on delete restrict on update restrict
)ENGINE = InnoDb;


/*==============================================================*/
/* Table: BITACORADEESTATUS                                     */
/*==============================================================*/
create table bitacoraDeEstatus
(
	id                   int not null auto_increment,
	inspeccion_id        int,
	estatusinspeccion_id int,
	usuario_id           int,
	observacion          varchar(255),
	created_at           datetime, 
	updated_at           datetime,
	CONSTRAINT pk_bitacoradeestatus primary key (id),
	CONSTRAINT fk_bitacoradeestatus_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict,
	CONSTRAINT fk_bitacoradeestatus_inspeccion foreign key (inspeccion_id) references inspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_bitacoradeestatus_estatusinspeccion foreign key (estatusinspeccion_id) references estatusInspeccion (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: BITACORADEPROROGA                                     */
/*==============================================================*/
create table bitacoraDeProroga
(
	id                   int not null auto_increment,
	usuario_id           int,
	inspeccion_id        int,
	folioMulta 			 varchar(75),
	fechavence           datetime,
	diasdeprorroga       int,
	observaciones        varchar(255),
	created_at           datetime, 
	updated_at           datetime,
	CONSTRAINT pk_bitacoradeproroga primary key (id),
	CONSTRAINT fk_bitacoradeproroga_inspeccion foreign key (inspeccion_id) references inspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_bitacoradeproroga_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: BITACORADEINFORMES                                    */
/*==============================================================*/
create table bitacoraDeInformes
(
	id                   int not null auto_increment,
	inspeccion_id        int,
	gestores_id          int,
	usuario_id           int,
	observaciones        varchar(255),
	notas                varchar(255),
	created_at           datetime, 
	updated_at           datetime,
	CONSTRAINT pk_bitacoradeinformes primary key (id),
	CONSTRAINT fk_bitacoradeinformes_gestores foreign key (gestores_id) references gestores (id) on delete restrict on update restrict,
	CONSTRAINT fk_bitacoradeinformes_inspeccion foreign key (inspeccion_id) references inspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_bitacoradeinformes_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict
)ENGINE = InnoDb;

/*==============================================================*/
/* Table: MULTAS                                                */
/*==============================================================*/

create table multas
(
	id 					int not null auto_increment,
	inspeccion_id 		int,
	usuario_id 			int,
	montoMulta 			int,
	valorUma 			float(10,2),
	total 				float(10,2),
	estatus 			varchar(3) comment 'Can=Cancelado, P=Pagado, PP=Pendiente de Pago',
	oficio 				varchar(75),
	expediente 			varchar(75),
	fechacreada 		date,
	fechavence 			date,
	created_at 			datetime,
	updated_at 			datetime,
	CONSTRAINT pk_multas primary key (id),
	CONSTRAINT fk_multas_inspeccion foreign key (inspeccion_id) references inspeccion (id) on delete restrict on update restrict,
	CONSTRAINT fk_multas_usuario foreign key (usuario_id) references usuario (id) on delete restrict on update restrict
)ENGINE = InnoDb;
