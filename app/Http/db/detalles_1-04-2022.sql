--Inicio de manipulacion de db con solo consultas
CREATE TABLE detalles (
  id int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  idfactura int(10) UNSIGNED NOT NULL,
  idproducto int(10) UNSIGNED NOT NULL,
  cantidad int(10) NOT NULL,
  precio decimal(11,2) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--Poner el campo id de la tabla factura en unsigned--
ALTER TABLE detalles
ADD CONSTRAINT detalle_factura_fk
FOREIGN KEY (idfactura) REFERENCES facturas(id)
ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE detalles
ADD CONSTRAINT detalle_producto_fk
FOREIGN KEY (idproducto) REFERENCES productos(id)
ON DELETE RESTRICT ON UPDATE RESTRICT;

