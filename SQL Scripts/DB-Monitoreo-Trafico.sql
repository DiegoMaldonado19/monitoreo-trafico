CREATE DATABASE monitoreo_trafico;

USE monitoreo_trafico;

-- Tabla para roles de usuarios
CREATE TABLE rol (
    id_rol INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(60) NOT NULL UNIQUE
);

-- Tabla para usuarios
CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(60) NOT NULL,
    contrasena VARCHAR(60) NOT NULL,
    id_rol INT,
    FOREIGN KEY (id_rol) REFERENCES rol(id_rol)
);

-- Tabla para tipos de calles (calle, avenida, etc.)
CREATE TABLE tipo_calle (
    id_tipo_calle INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo_calle VARCHAR(60) NOT NULL UNIQUE
);

-- Tabla para calles
CREATE TABLE calle (
    id_calle INT AUTO_INCREMENT PRIMARY KEY,
    nombre_calle VARCHAR(100) NOT NULL,
    id_tipo_calle INT,
    FOREIGN KEY (id_tipo_calle) REFERENCES tipo_calle(id_tipo_calle)
);

-- Tabla para semáforos
CREATE TABLE semaforo (
    id_semaforo INT AUTO_INCREMENT PRIMARY KEY,
    id_calle INT,
    tiempo_verde INT NOT NULL,
    tiempo_amarillo INT NOT NULL,
    tiempo_rojo INT NOT NULL,
    FOREIGN KEY (id_calle) REFERENCES calle(id_calle)
);

-- Tabla para tipos de vehículos (carro, microbús, moto, etc.)
CREATE TABLE tipo_vehiculo (
    id_tipo_vehiculo INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo_vehiculo VARCHAR(60) NOT NULL UNIQUE
);

-- Tabla para flujo vehicular general
CREATE TABLE flujo_vehicular (
    id_flujo INT AUTO_INCREMENT PRIMARY KEY,
    id_semaforo INT,
    fecha_hora TIMESTAMP NOT NULL,
    velocidad_promedio FLOAT NOT NULL,
    FOREIGN KEY (id_semaforo) REFERENCES semaforo(id_semaforo)
);

-- Tabla para detalles del flujo vehicular (cantidad de vehículos por tipo)
CREATE TABLE flujo_vehicular_detalle (
    id_flujo_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_flujo INT,
    id_tipo_vehiculo INT,
    cantidad_vehiculos INT NOT NULL,
    FOREIGN KEY (id_flujo) REFERENCES flujo_vehicular(id_flujo),
    FOREIGN KEY (id_tipo_vehiculo) REFERENCES tipo_vehiculo(id_tipo_vehiculo)
);

-- Tabla para tipos de pruebas (archivo, random, etc.)
CREATE TABLE tipo_prueba (
    id_tipo_prueba INT AUTO_INCREMENT PRIMARY KEY,
    nombre_tipo_prueba VARCHAR(60) NOT NULL UNIQUE
);

-- Tabla para pruebas realizadas
CREATE TABLE prueba (
    id_prueba INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT,
    fecha_hora_inicio TIMESTAMP NOT NULL,
    fecha_hora_fin TIMESTAMP NOT NULL,
    id_tipo_prueba INT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_tipo_prueba) REFERENCES tipo_prueba(id_tipo_prueba)
);

-- Tabla para estados de las pruebas (activo, inactivo, etc.)
CREATE TABLE tipo_estado (
    id_tipo_estado INT AUTO_INCREMENT PRIMARY KEY,
    tipo_estado VARCHAR(10) NOT NULL
);

-- Tabla para el estado de las pruebas (relación entre prueba y estado)
CREATE TABLE prueba_estado (
    id_prueba_estado INT AUTO_INCREMENT PRIMARY KEY,
    id_prueba INT,
    id_tipo_estado INT,
    id_tipo_vehiculo INT,
    cantidad_vehiculos INT NOT NULL,
    velocidad_promedio FLOAT NOT NULL,
    FOREIGN KEY (id_prueba) REFERENCES prueba(id_prueba),
    FOREIGN KEY (id_tipo_estado) REFERENCES tipo_estado(id_tipo_estado),
    FOREIGN KEY (id_tipo_vehiculo) REFERENCES tipo_vehiculo(id_tipo_vehiculo)
);

-- Tabla para reportes generados
CREATE TABLE reporte (
    id_reporte INT AUTO_INCREMENT PRIMARY KEY,
    id_prueba INT,
    fecha_hora TIMESTAMP NOT NULL,
    FOREIGN KEY (id_prueba) REFERENCES prueba(id_prueba)
);

-- Tabla para detalles de los reportes (cantidad de vehículos por tipo en el reporte)
CREATE TABLE reporte_detalle (
    id_reporte_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_reporte INT,
    id_tipo_vehiculo INT,
    cantidad_vehiculos INT NOT NULL,
    velocidad_promedio FLOAT NOT NULL,
    FOREIGN KEY (id_reporte) REFERENCES reporte(id_reporte),
    FOREIGN KEY (id_tipo_vehiculo) REFERENCES tipo_vehiculo(id_tipo_vehiculo)
);

-- Tabla para manejar el flujo vehicular durante las pruebas
CREATE TABLE flujo_vehicular_prueba (
    id_flujo_prueba INT AUTO_INCREMENT PRIMARY KEY,
    id_prueba INT,
    id_semaforo INT,
    fecha_hora TIMESTAMP NOT NULL,
    velocidad_promedio FLOAT NOT NULL,
    FOREIGN KEY (id_prueba) REFERENCES prueba(id_prueba),
    FOREIGN KEY (id_semaforo) REFERENCES semaforo(id_semaforo)
);

-- Tabla para detalles del flujo vehicular durante las pruebas
CREATE TABLE flujo_vehicular_prueba_detalle (
    id_flujo_prueba_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_flujo_prueba INT,
    id_tipo_vehiculo INT,
    cantidad_vehiculos INT NOT NULL,
    FOREIGN KEY (id_flujo_prueba) REFERENCES flujo_vehicular_prueba(id_flujo_prueba),
    FOREIGN KEY (id_tipo_vehiculo) REFERENCES tipo_vehiculo(id_tipo_vehiculo)
);