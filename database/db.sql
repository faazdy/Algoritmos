CREATE TABLE Sedes(
    idSede INT PRIMARY KEY AUTO_INCREMENT,
    nombreSede VARCHAR(100),
    direccion VARCHAR(100),
    telefono VARCHAR(12)
);
CREATE TABLE Meseros(
    idMesero INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(20),

    idSede INT,

    FOREIGN KEY (idSede) REFERENCES Sedes(idSede)
);

CREATE TABLE Cajeros(
    idCajero INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(20),

    idSede INT,

    FOREIGN KEY (idSede) REFERENCES Sedes(idSede)
);

CREATE TABLE Admins(
    idAdmin INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
<<<<<<< HEAD:database/db.sql
    telefono VARCHAR(20)
=======
    telefono VARCHAR(20),

    idSede INT,

    FOREIGN KEY (idSede) REFERENCES Sedes(idSede)
>>>>>>> 60206ea7ebf737e2412952d2f9eb86caec73179a:info/db.sql
);

CREATE TABLE Usuarios(
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL,
    pass VARCHAR(255) NOT NULL,
    rol ENUM('mesero', 'cajero', 'admin'),
    
    idAdmin INT,
    idCajero INT,
    idMesero INT,

    FOREIGN KEY (idAdmin) REFERENCES Admins(idAdmin),
    FOREIGN KEY (idCajero) REFERENCES Cajeros(idCajero),
    FOREIGN KEY (idMesero) REFERENCES Meseros(idMesero)
);

<<<<<<< HEAD:database/db.sql
=======

>>>>>>> 60206ea7ebf737e2412952d2f9eb86caec73179a:info/db.sql


CREATE TABLE SedeUsuario(
    idSedeUsuario INT PRIMARY KEY AUTO_INCREMENT,

    idSede INT,
    idUsuario INT,

    FOREIGN KEY (idSede) REFERENCES Sedes(idSede),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(idUsuario)
);

CREATE TABLE Mesas(
    idMesa INT PRIMARY KEY AUTO_INCREMENT,
    numeroMesa INT,
<<<<<<< HEAD:database/db.sql
    disponible ENUM('disponible', 'ocupada'),
=======
    disponible ENUM('disponible', 'ocupada')
);
>>>>>>> 60206ea7ebf737e2412952d2f9eb86caec73179a:info/db.sql

    idSede INT,
    FOREIGN KEY (idSede) REFERENCES Sedes(idSede)
);


CREATE TABLE Pedidos(
    idPedido INT PRIMARY KEY AUTO_INCREMENT,
    fecha DATE,
    estado ENUM('abierto', 'cerrado'),
    idMesa INT,
    idMesero INT,
    idCajero INT,
    FOREIGN KEY (idMesa) REFERENCES Mesas(idMesa),
    FOREIGN KEY (idMesero) REFERENCES Meseros(idMesero),
    FOREIGN KEY (idCajero) REFERENCES Cajeros(idCajero)
);

CREATE TABLE Productos(
    idProducto INT PRIMARY KEY AUTO_INCREMENT,
    nombreProducto VARCHAR(100),
    precio FLOAT,
    costo FLOAT,
    cantidad INT
);

CREATE TABLE ProductoSede(
    idProductoSede INT PRIMARY KEY AUTO_INCREMENT,
    cantidad INT,
    idProducto INT,
    idSede INT,
    FOREIGN KEY (idProducto) REFERENCES Productos(idProducto),
    FOREIGN KEY (idSede) REFERENCES Sedes(idSede)
);

CREATE TABLE PedidoProducto(
    idPedidoProducto INT PRIMARY KEY AUTO_INCREMENT,
    cantidad INT,
    idPedido INT,
    idProducto INT,
    FOREIGN KEY (idPedido) REFERENCES Pedidos(idPedido),
    FOREIGN KEY (idProducto) REFERENCES Productos(idProducto)
);

CREATE TABLE Pagos(
    idPago INT PRIMARY KEY AUTO_INCREMENT,
    monto FLOAT,
    fechaPago DATE,
    metodoPago ENUM('efectivo', 'tarjeta'),
    idPedido INT,
    idCajero INT,
    FOREIGN KEY (idPedido) REFERENCES Pedidos(idPedido),
    FOREIGN KEY (idCajero) REFERENCES Cajeros(idCajero)
);