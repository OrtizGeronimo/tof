#Script para crear la tabla de galeria, relacionada con la tabla de servicio 6/8/2024 16:15hs

CREATE TABLE IF NOT EXISTS galeria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    FK_idServicio INT,
    img VARCHAR(255),
    fec_alta datetime NOT NULL,
    FOREIGN KEY (FK_idServicio) REFERENCES servicio(idServicio)
);

#Script para crear suscripcion, tabla que a guardar el id de la suscripcion cuando se suscribe a un plan, para chequear la fecha y si se necesita validar
#la suscripcion entonces ir a la API de MP a validar la suscripcion 4/10/2024 20.50hs  

CREATE TABLE IF NOT EXISTS suscripcion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    FK_idUsuario INT,
    estado VARCHAR(255),
    id_suscripcion VARCHAR(255),
    fec_suscripcion datetime NOT NULL,
    fec_vencimiento datetime NOT NULL,
    fec_baja datetime,
    FOREIGN KEY (FK_idUsuario) REFERENCES usuario(idUsuario)
);


#Script para añadir columna fec_baja a tabla galeria 6/10/2024 10.41hs

ALTER TABLE galeria ADD fec_baja datetime;