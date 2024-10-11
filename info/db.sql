CREATE TABLE Meseros(
    idMesero INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(20),
);

CREATE TABLE Cajeros(
    idCajero INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(20),
);

CREATE TABLE Admins(
    idAdmin INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellido VARCHAR(100),
    telefono VARCHAR(20),
);

CREATE TABLE Usuarios(
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL,
    pass VARCHAR(50) NOT NULL,
    
    idAdmin INT,
    idCajero INT,
    idMesero INT,

    FOREIGN KEY (idAdmin) REFERENCES Admins(idAdmin),
    FOREIGN KEY (idCajero) REFERENCES Cajeros(idAdmin),
    FOREIGN KEY (idMesero) REFERENCES Meseros(idMesero)
);

CREATE TABLE Sedes(
    idSede INT PRIMARY KEY AUTO_INCREMENT,
    nombreSede VARCHAR(100),
    direccion VARCHAR(100),
    telefono VARCHAR(12)
);

CREATE TABLE SedeMesero(
    idSedeMesero INT PRIMARY KEY AUTO_INCREMENT,
    sede INT,
    mesero INT,
    FOREIGN KEY (sede) REFERENCES Sedes(idSede),
    FOREIGN KEY (mesero) REFERENCES Meseros(idMesero)
);

CREATE TABLE Mesas(
    idMesa INT PRIMARY KEY AUTO_INCREMENT,
    numeroMesa INT,
    disponible BOOLEAN
);

CREATE TABLE MesaSede(
    idMesaSede INT PRIMARY KEY AUTO_INCREMENT,
    idMesa INT,
    idSede INT,
    FOREIGN KEY (idMesa) REFERENCES Mesas(idMesa),
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
    precioUnitario FLOAT,
    costoVenta FLOAT
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