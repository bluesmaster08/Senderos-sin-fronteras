USE id22221643_bd_senderos_sin_fronteras;

CREATE DATABASE IF NOT EXISTS BD_Senderos_sin_fronteras;
USE BD_Senderos_sin_fronteras;
-- -----------------------------------------------------------------------------
-- Tabla tblavion--CRUD
CREATE TABLE
    IF NOT EXISTS tblavion (
        id_avion INT AUTO_INCREMENT PRIMARY KEY,
        numero_serie VARCHAR(255),
        modelo VARCHAR(255),
        capacidad_asientos INT NOT NULL,
        empresa_propietaria VARCHAR(255)
    );

-- Tabla tbltranspterrestre-- CRUD
CREATE TABLE
    IF NOT EXISTS tbltranspterrestre (
        id_transpterrestre INT AUTO_INCREMENT PRIMARY KEY,
        tipo_transporte VARCHAR(255),
        placa VARCHAR(255),
        capacidad_pasajeros INT,
        año_fabricacion INT,
        empresa_propietaria VARCHAR(255)
    );

-- Tabla tbltipodestino-- CRUD
CREATE TABLE
    IF NOT EXISTS tbltipodestino (
        id_tipodestino INT AUTO_INCREMENT PRIMARY KEY,
        nombre_destino VARCHAR(255) NOT NULL,
        actividades_populares VARCHAR(255) NOT NULL,
        epoca_sugerida VARCHAR(255) NOT NULL
    );

-- Tabla tblcliente --CRUD
CREATE TABLE
    IF NOT EXISTS tblcliente (
        id_cliente INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        apellido_paterno VARCHAR(255) NOT NULL,
        apellido_materno VARCHAR(255),
        sexo ENUM ('Hombre', 'Mujer') NOT NULL,
        entidad_federativa VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        nombre_usuario VARCHAR(255) NOT NULL,
        password_cliente VARCHAR(255) NOT NULL,
        rfc VARCHAR(13) NOT NULL,
        curp VARCHAR(18) NOT NULL,
        fecha_nacimiento DATE NOT NULL, --
        fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

-- Tabla tblbitacora
CREATE TABLE
    IF NOT EXISTS tblbitacora (
        id_bitacora INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT NOT NULL,
        rol_usuario ENUM ('cliente', 'administrador') NOT NULL,
        fecha_ingreso DATETIME NOT NULL,
        FOREIGN KEY (id_usuario) REFERENCES tblcliente (id_cliente) ON DELETE CASCADE -- Referencia al ID del cliente
    );

-- Tabla tbldestino-- CRUD
CREATE TABLE
    IF NOT EXISTS tbldestino (
        id_destino INT AUTO_INCREMENT PRIMARY KEY,
        id_tipodestino INT,
        id_avion1 INT,
        id_avion2 INT,
        id_transpterrestre1 INT,
        id_transpterrestre2 INT,
        id_cliente INT, -- Agregar columna para el id del cliente
        país VARCHAR(255),
        reseña VARCHAR(255),
        coordenadas VARCHAR(255),
        imagen_destino LONGBLOB, -- Columna para almacenar la imagen como tipo BLOB
        FOREIGN KEY (id_tipodestino) REFERENCES tbltipodestino (id_tipodestino),
        FOREIGN KEY (id_avion1) REFERENCES tblavion (Id_avion),
        FOREIGN KEY (id_avion2) REFERENCES tblavion (Id_avion),
        FOREIGN KEY (id_transpterrestre1) REFERENCES tbltranspterrestre (id_transpterrestre),
        FOREIGN KEY (id_transpterrestre2) REFERENCES tbltranspterrestre (id_transpterrestre),
        FOREIGN KEY (id_cliente) REFERENCES tblcliente (id_cliente)
    );