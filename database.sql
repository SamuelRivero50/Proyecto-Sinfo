-- Create database
CREATE DATABASE IF NOT EXISTS bitacora_crm;
USE bitacora_crm;

-- Create bitacora table
CREATE TABLE IF NOT EXISTS bitacora (
    id INT AUTO_INCREMENT PRIMARY KEY,
    estado VARCHAR(50) NOT NULL,
    temperatura VARCHAR(20) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    valor VARCHAR(255),
    descripcion TEXT,
    adjunto VARCHAR(255),
    oportunidad VARCHAR(255),
    tarea TEXT,
    agregar_tarea BOOLEAN DEFAULT FALSE,
    proxima_accion DATE,
    hora TIME,
    contacto VARCHAR(255),
    fecha_creacion DATETIME NOT NULL,
    fecha_actualizacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; 