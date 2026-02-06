CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO usuarios (nombre, email) VALUES 
('Pau Gámez', 'pau.gamez.pacheco@ieselcalamot.com'),
('María García', 'maria@example.com'),
('Carlos Rodríguez', 'carlos@example.com'),
('Ana Martínez', 'ana@example.com');
