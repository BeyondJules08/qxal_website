-- Creación de tablas para QxalAcademy en SQL Server

-- Tabla de características
CREATE TABLE caracteristicas (
    id INT IDENTITY(1,1) PRIMARY KEY,
    title NVARCHAR(100) NOT NULL,
    description NVARCHAR(500) NOT NULL,
    icon NVARCHAR(10) NOT NULL,
    age_group NVARCHAR(20) NOT NULL
);

-- Tabla de testimonios
CREATE TABLE testimonios (
    id INT IDENTITY(1,1) PRIMARY KEY,
    name NVARCHAR(100) NOT NULL,
    role NVARCHAR(100) NOT NULL,
    text NVARCHAR(1000) NOT NULL,
    rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5)
);

-- Tabla de estadísticas
CREATE TABLE estadisticas (
    id INT IDENTITY(1,1) PRIMARY KEY,
    jugadores INT NOT NULL,
    escuelas INT NOT NULL,
    paises INT NOT NULL
);

-- Insertar datos en características
INSERT INTO caracteristicas (title, description, icon, age_group) VALUES
('Rapidez Mental', 'Juegos de pensamiento rápido que mejoran la agilidad mental y el tiempo de reacción.', '⚡', '8-18 años'),
('Creatividad', 'Juegos que estimulan la imaginación y el pensamiento creativo a través de actividades artísticas y de diseño.', '🎨', '5-15 años'),
('Coordinación', 'Ejercicios que mejoran la coordinación mano-ojo y las habilidades motoras finas.', '🎯', '6-14 años'),
('Lenguaje', 'Actividades que enriquecen el vocabulario y mejoran las habilidades de comunicación.', '📚', '5-16 años'),
('Matemáticas', 'Juegos numéricos que hacen divertido el aprendizaje de conceptos matemáticos básicos y avanzados.', '🔢', '7-18 años');

-- Insertar datos en testimonios
INSERT INTO testimonios (name, role, text, rating) VALUES
('María González', 'Profesora de Primaria', 'Los juegos de QxalAcademy han transformado la manera en que mis estudiantes aprenden. ¡Es increíble ver cómo mejoran su concentración!', 5),
('Carlos Rodríguez', 'Padre de familia', 'Mi hijo ha mejorado notablemente en matemáticas desde que usa estos juegos. Los recomiendo totalmente.', 5),
('Ana Martínez', 'Psicóloga Educativa', 'Una herramienta excelente para el desarrollo cognitivo. Los resultados son visibles en pocas semanas.', 5);

-- Insertar datos en estadísticas
INSERT INTO estadisticas (jugadores, escuelas, paises) VALUES
(15000, 250, 12);