-- Insertar roles
INSERT INTO rol (nombre_rol) VALUES ('Administrador');
INSERT INTO rol (nombre_rol) VALUES ('Monitor');
INSERT INTO rol (nombre_rol) VALUES ('Supervisor');

-- Insertar usuarios con contraseñas hasheadas (usando bcrypt, común en Laravel)
-- Contraseñas: admin1, admin2, monitor1, monitor2, supervisor1, supervisor2
INSERT INTO usuario (nombre_usuario, contrasena, id_rol) VALUES 
('admin1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1), -- admin1
('admin2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1), -- admin2
('monitor1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2), -- monitor1
('monitor2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 2), -- monitor2
('supervisor1', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3), -- supervisor1
('supervisor2', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 3); -- supervisor2

-- Insertar tipos de calles
INSERT INTO tipo_calle (nombre_tipo_calle) VALUES ('calle');
INSERT INTO tipo_calle (nombre_tipo_calle) VALUES ('avenida');

-- Insertar calles
INSERT INTO calle (nombre_calle, id_tipo_calle) VALUES 
('Calle 1', 1), -- Calle 1
('Calle 2', 1), -- Calle 2
('Avenida 1', 2), -- Avenida 1
('Avenida 2', 2); -- Avenida 2

-- Insertar semáforos
INSERT INTO semaforo (id_calle, tiempo_verde, tiempo_amarillo, tiempo_rojo) VALUES 
(1, 30, 5, 20), -- Semáforo para Calle 1
(2, 30, 5, 20), -- Semáforo para Calle 2
(3, 30, 5, 20), -- Semáforo para Avenida 1
(4, 30, 5, 20); -- Semáforo para Avenida 2

-- Insertar tipos de vehículos
INSERT INTO tipo_vehiculo (nombre_tipo_vehiculo) VALUES 
('carro'),
('microbus'),
('moto'),
('picop'),
('bus parrillero');

-- Insertar tipos de pruebas
INSERT INTO tipo_prueba (nombre_tipo_prueba) VALUES 
('archivo'),
('random');

-- Insertar tipos de estado
INSERT INTO tipo_estado (tipo_estado) VALUES 
('activo'),
('inactivo'),
('en progreso');