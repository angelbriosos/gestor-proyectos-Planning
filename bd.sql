-- Crear base de datos
CREATE DATABASE IF NOT EXISTS gestor;
USE gestor;

-- Tabla de cuentas para login
CREATE TABLE IF NOT EXISTS cuentas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(50) UNIQUE NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL
);

-- Tabla de proyectos
CREATE TABLE IF NOT EXISTS proyectos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    estado ENUM('sin empezar', 'en curso', 'finalizado') NOT NULL,
    progreso INT DEFAULT 0
);

-- Tabla de equipos
CREATE TABLE IF NOT EXISTS equipos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_equipo VARCHAR(100),
    id_proyecto INT,
    FOREIGN KEY (id_proyecto) REFERENCES proyectos(id)
);

-- Tabla de miembros del equipo
CREATE TABLE IF NOT EXISTS equipo_usuarios (
    id_equipo INT,
    id_usuario INT,
    PRIMARY KEY (id_equipo, id_usuario),
    FOREIGN KEY (id_equipo) REFERENCES equipos(id),
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

-- Tabla de tareas
CREATE TABLE IF NOT EXISTS tareas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_proyecto INT,
    descripcion TEXT,
    estado ENUM('sin empezar', 'en curso', 'finalizado') NOT NULL,
    FOREIGN KEY (id_proyecto) REFERENCES proyectos(id)
);

-- Datos iniciales para login (usuarios: ana, carlos, luisa)
INSERT INTO cuentas (usuario, contrasena) VALUES
('ana', '$2y$10$CcyMZBiMfH.QtwQ4x5VW7eEGNnEd.9DAwTYSG2GUyzO3SYYul65NK'), -- claveana
('carlos', '$2y$10$0FARzJAK8BaK1jVOmc/JFO3Q2pPccwMD8BoS7yC35oqDR6/cBiWyW'), -- clavecarlos
('luisa', '$2y$10$dCrOx7LoH8He7z0Efsu8zuVmc/NLYbDkJP/1erHQCAk7ZbtIozQ7C'); -- claveluisa

-- Datos de usuarios
INSERT INTO usuarios (nombre) VALUES
('Ana'), ('Carlos'), ('Luisa'), ('Marta'), ('Javier'), ('Sofía');

-- Proyectos de ejemplo

