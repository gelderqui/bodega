--Mejoras a la base de datos creada desde diseñador
ALTER TABLE facturas
ADD CONSTRAINT factura_proveedor_fk
FOREIGN KEY (idproveedor) REFERENCES proveedores(id)
ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE facturas
ADD CONSTRAINT factura_usuario_fk
FOREIGN KEY (idusuario) REFERENCES users(id)
ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE facturas CHANGE COLUMN id id INT(10) UNSIGNED NOT NULL;
ALTER TABLE facturas CHANGE COLUMN fecha created_at timestamp NULL DEFAULT NULL;
ALTER TABLE facturas ADD updated_at timestamp NULL DEFAULT NULL AFTER created_at;
ALTER TABLE facturas ADD numero int NULL DEFAULT NULL AFTER idusuario;
ALTER TABLE facturas ADD serie varchar(400) NULL DEFAULT NULL AFTER numero;
ALTER TABLE facturas ADD total decimal(11,2) NOT NULL DEFAULT 0 AFTER serie;