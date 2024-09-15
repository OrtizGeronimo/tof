#Script para crear la tabla de galeria, relacionada con la tabla de servicio 6/8/2024 16:15hs

CREATE TABLE IF NOT EXISTS galeria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    FK_idServicio INT,
    img VARCHAR(255),
    fec_alta datetime NOT NULL,
    FOREIGN KEY (FK_idServicio) REFERENCES servicio(idServicio)
);