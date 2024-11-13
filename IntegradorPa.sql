-- Crear la base de datos y seleccionar
CREATE DATABASE paradigmas;
USE paradigmas;

-- Tabla de usuarios
CREATE TABLE usuario (
    usuario_id INT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    telefono INT,
    direccion VARCHAR(255),
    estado BOOLEAN,
    fecha_alta DATE,
    contraseña VARCHAR(255),
    PRIMARY KEY (usuario_id)
);
ALTER TABLE usuario
MODIFY COLUMN telefono VARCHAR(11);
Select * from usuario;

-- Tabla de cursos
CREATE TABLE curso (
    curso_id INT NOT NULL AUTO_INCREMENT,
    duracion_curso VARCHAR(255),
    descripcion TEXT,
    estado BOOLEAN DEFAULT 1, -- Estado del curso (activo/inactivo)
    nombre_curso VARCHAR(255) NOT NULL,
    precio DECIMAL(10, 2) DEFAULT 0.00, -- Precio del curso
    contenido TEXT, -- Índice de contenido del curso (en formato de texto para almacenamiento)
    PRIMARY KEY (curso_id)
);

-- Tabla de inscripciones
CREATE TABLE inscripcion (
    inscripcion_id INT NOT NULL AUTO_INCREMENT,
    fecha_inscripcion DATE DEFAULT CURRENT_DATE, -- Fecha de inscripción
    estado BOOLEAN DEFAULT 1, -- Estado de la inscripción (activo/inactivo)
    estado_inscripcion VARCHAR(255),
    precio DECIMAL(10, 2), -- Precio de la inscripción si aplica
    Tp1 DECIMAL(10, 2),
    Tp2 DECIMAL(10, 2),
    Parcial DECIMAL(10, 2),
    Integrador DECIMAL(10, 2),
    usuario_id INT, -- Referencia al usuario inscrito
    curso_id INT, -- Referencia al curso en el que se inscribe
    PRIMARY KEY (inscripcion_id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id) ON DELETE CASCADE,
    FOREIGN KEY (curso_id) REFERENCES curso(curso_id) ON DELETE CASCADE
);

select * from inscripcion;

-- Tabla de detalles (para conceptos de inscripción o transacciones)
CREATE TABLE detalle (
    detalle_id INT NOT NULL AUTO_INCREMENT,
    descripcion VARCHAR(255),
    subtotal DECIMAL(10, 2),
    importe DECIMAL(10, 2),
    inscripcion_id INT,
    PRIMARY KEY (detalle_id),
    FOREIGN KEY (inscripcion_id) REFERENCES inscripcion(inscripcion_id) ON DELETE CASCADE
);

-- Tabla de facturas (para pagos relacionados con detalles)
CREATE TABLE factura (
    factura_id INT NOT NULL AUTO_INCREMENT,
    metodo_pago VARCHAR(255),
    estado_cobro VARCHAR(255),
    estado BOOLEAN,
    detalle_id INT,
    PRIMARY KEY (factura_id),
    FOREIGN KEY (detalle_id) REFERENCES detalle(detalle_id) ON DELETE CASCADE
);

-- Tabla para registrar sesiones de usuario
CREATE TABLE sesiones_usuario (
    sesion_id INT AUTO_INCREMENT,
    usuario_id INT,
    hora_inicio DATETIME,
    hora_fin DATETIME,
    duracion_sesion TIME,
    PRIMARY KEY (sesion_id),
    FOREIGN KEY (usuario_id) REFERENCES usuario(usuario_id) ON DELETE CASCADE
);

select * from usuario;

INSERT INTO curso (nombre_curso, descripcion, precio, contenido, estado, imagen) VALUES 
(
    'Mi nueva vida en Cristo',
    'Bienvenido a la familia de Dios. Este estudio puede ser el comienzo de una larga y fructífera relación con Jesús. Si has reconocido a Jesús como Señor y Salvador...',
    0.00,
    '[
        "Introducción",
        "Lección 1: Nuestra Salvación",
        "Lección 2: Conociendo a la persona del Espíritu Santo y su obra",
        "Lección 3: El poder sanador y liberador del perdón",
        "Lección 4: La sanidad de mi ser interior y mi liberación",
        "Lección 5: Conociendo las 4 puertas para la sanidad interior",
        "Lección 6: Las puertas de la Herencia y el pecado",
        "Lección 7: La puerta de las heridas",
        "Lección 8: Intimidad con Dios",
        "Lección 9: La Biblia",
        "Lección 10: Orar",
        "Lección 11: Asistir a una Iglesia",
        "Lección 12: Dar a Dios",
        "Lección 13: El bautismo y la Santa Cena",
        "Lección 14: Ser parte de un grupo pequeño",
        "Lección 15: Ser parte de una iglesia",
        "Exámen evaluatorio"
    ]',
    1,
    'mi_nueva_vida_en_cristo.jpg'
);
select * from usuario;


Select * from inscripcion;

ALTER TABLE usuario ADD COLUMN rol ENUM('usuario', 'administrador') DEFAULT 'usuario';

INSERT INTO usuario (nombre, correo, telefono, direccion, estado, fecha_alta, contraseña, rol)
VALUES ('Admin', 'admin@yiyu.com', '1234567890', 'Dirección de Admin', 1, CURDATE(), '$2y$10$6WXrkoDbuQ3OVmX/ZILuPOvvr47VgsZM.J27koGSbedtYyXnctO5e', 'administrador');

delete from usuario where usuario_id = 2;

ALTER TABLE curso ADD COLUMN imagen VARCHAR(255) DEFAULT '';
Select * from curso;
delete from curso where curso_id = 1;