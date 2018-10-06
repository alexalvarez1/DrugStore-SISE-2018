-- drop database if exists farmacia;
-- create database farmacia;
-- use farmacia;

drop procedure CANT_VENTAS;

drop procedure if exists LISTA_TIPO_PAGO;

drop procedure if exists FILTRAR_PRODUCTOS;
drop procedure if exists EDITAR_PRODUCTO;
drop procedure if exists BUSCAR_PRODUCTO;
drop procedure if exists LISTAR_PRODUCTOS;
drop procedure if exists CREAR_PRODUCTO;

drop procedure if exists FILTRAR_PROVEEDORES;
drop procedure if exists EDITAR_PROVEEDOR;
drop procedure if exists BUSCAR_PROVEEDOR;
drop procedure if exists LISTAR_PROVEEDORES;
drop procedure if exists CREAR_PROVEEDOR; 

drop procedure if exists FILTRAR_EMPLEADOS;
drop procedure if exists EDITAR_EMPLEADO; 
drop procedure if exists BUSCAR_EMPLEADO; 
drop procedure if exists LISTAR_EMPLEADOS; 
drop procedure if exists CREAR_EMPLEADO;

drop procedure if exists CREAR_CLIENTE;
drop procedure if exists LISTAR_CLIENTES;
drop procedure if exists BUSCAR_CLIENTE;
drop procedure if exists EDITAR_CLIENTE;
drop procedure if exists FILTRAR_CLIENTES;

drop procedure if exists CAMBIAR_CLAVE;
drop procedure if exists INICIAR_SESION;

drop table if exists orden_pedido;
drop table if exists lista_pedido;
drop table if exists producto;
drop table if exists tipo_pago;
drop table if exists proveedor;
drop table if exists empleado;
drop table if exists cliente;
create table cliente
(
	cod_cliente int primary key auto_increment,
    nombre varchar(50),
    direccion varchar(300) default 'Aqui detallamos la direccion de nuestro cliente.',
    telefono char(12) default '+51 1234 456'
);
-- 
insert into cliente(nombre) values('Javier Ignacio Molina Cano');
insert into cliente(nombre) values('Lillian Eugenia Gómez Álvarez');
insert into cliente(nombre) values('Marín Sixto Naranjo');
insert into cliente(nombre) values('Gerardo Emilio Duque Gutiérrez');
insert into cliente(nombre) values('Jhony Alberto Sáenz Hurtado');
insert into cliente(nombre) values('Germán Antonio Lotero Upegui');
insert into cliente(nombre) values('Oscar Darío Murillo González');
insert into cliente(nombre) values('Augusto Osorno Gil');
insert into cliente(nombre) values('César Oswaldo Palacio Martínez');
insert into cliente(nombre) values('Gloria Amparo Alzate Agudelo');

create table empleado
(
	cod_empleado int primary key auto_increment,
    nombre varchar(50),
    dni char(8) unique,
    clave blob,
    nivel_usuario varchar(50) default 'empleado',
    direccion varchar(300) default 'Aqui detallamos la direccion de nuestro empleado.',
    telefono char(12) default '+51 1234 456',
    fecha_entrada datetime default now(),
    sueldo_base decimal(8,2) default 100.00
);

-- EMPLEADO ADMINISTRADOR 
insert into empleado(nombre,dni,clave,nivel_usuario,sueldo_base) values('Jhon Alexander Alvarez Casas','12345678', aes_encrypt('admin','farmacia_copyright_2018_sise') ,'admin',7500.00);
-- EMPLEADOS PARA EL AREA Proyectos
insert into empleado(nombre,dni,clave,nivel_usuario) values('Héctor Iván González Castaño','01252345',aes_encrypt('123','farmacia_copyright_2018_sise'),'empleado');
insert into empleado(nombre,dni,clave,nivel_usuario) values('Beatriz Elena Osorio Laverde','01242150',aes_encrypt('123','farmacia_copyright_2018_sise'),'empleado');
insert into empleado(nombre,dni,clave,nivel_usuario) values('Herman Correa Ramírez','01232012',aes_encrypt('123','farmacia_copyright_2018_sise'),'empleado');
insert into empleado(nombre,dni,clave,nivel_usuario) values('Carlos Mario Montoya Serna','01202362',aes_encrypt('123','farmacia_copyright_2018_sise'),'empleado');
insert into empleado(nombre,dni,clave,nivel_usuario) values('Carlos Augusto Giraldo','01250236',aes_encrypt('123','farmacia_copyright_2018_sise'),'empleado');

create table proveedor
(
	cod_proveedor int primary key auto_increment,
    nombre varchar(50),
    direccion varchar(300) default 'Aqui detallamos la direccion de nuestro proveedor.',
    pagina_web varchar(200) default 'www.miproveedor.domain.com',
    telefono char(12) default '+51 1234 456'
);
insert into proveedor(nombre) values('Arturo Tabares Mora');
insert into proveedor(nombre) values('William de J Ramírez Vásquez');
insert into proveedor(nombre) values('Jaime Lopez Tobón');
insert into proveedor(nombre) values('Gloria Elena Sanclemente Zea');
insert into proveedor(nombre) values('Carlos Alberto Villegas Lopera');

create table tipo_pago
(
	cod_tipo_pago int primary key auto_increment,
    tipo varchar(50) default 'efectivo', -- EFECTIVO Ó TARJETA
    descripcion varchar(250) default 'Aqui detallamos la descripción de como se requiere el tipo de pago.'
);
insert into tipo_pago(tipo) values('efectivo');
insert into tipo_pago(tipo) values('tarjeta');

create table producto
(
	cod_producto int primary key auto_increment,
    cod_referencia varchar(999),
    nombre_producto varchar(50),
    descripcion varchar(300),
    stock int default 100,
    precio decimal(8,2),
    fecha_entrada datetime default now(),
    fecha_vencimiento datetime,
    estado bit default 1,
    rutaImagen varchar(999),
    cod_proveedor int,
    constraint FK_producto_cod_proveedor foreign key(cod_proveedor) references proveedor(cod_proveedor) on update cascade on delete cascade
);

create table lista_pedido
(
	cod_lista_pedido int primary key auto_increment,
	cod_cliente int ,
    cod_empleado int ,
    cod_tipo_pago int ,
    constraint FK_lista_pedido_cod_cliente foreign key(cod_cliente) references cliente(cod_cliente) on update cascade on delete cascade,
    constraint FK_lista_pedido_cod_empleado foreign key(cod_empleado) references empleado(cod_empleado) on update cascade on delete cascade,
    constraint FK_lista_pedido_cod_tipo_pago foreign key(cod_tipo_pago) references tipo_pago(cod_tipo_pago) on update cascade on delete cascade
);
create table orden_pedido
(
	cod_orden_pedido int primary key auto_increment,
    cantidad int,
    cod_producto int,
    cod_lista_pedido int,
    constraint FK_orden_pedido_cod_producto foreign key (cod_producto) references producto(cod_producto) on update cascade on delete cascade,
    constraint FK_orden_pedido_cod_lista_pedido foreign key (cod_lista_pedido) references lista_pedido(cod_lista_pedido) on update cascade on delete cascade
);
-- PROCEDIMIENTOS
drop procedure if exists INICIAR_SESION;
delimiter //
create procedure INICIAR_SESION
(
	_dni char(8),
    _clave varchar(50)
)
begin
	IF exists( select * from empleado where dni = _dni and cast(aes_decrypt(clave,'farmacia_copyright_2018_sise') as char(50)) = binary _clave  ) THEN
		select * , CONCAT('Bienvenido ' , nombre) mensaje from empleado where dni = _dni; 
	ELSE
		select 'Parece que las credenciales ingresadas no son correctas, por facor ingrese datos validos.' mensaje;
    END IF;
end;
//

drop procedure if exists CAMBIAR_CLAVE;
delimiter //
create procedure CAMBIAR_CLAVE
(
    in _cod_empleado int,
    in _dni varchar(50),
    in _clave varchar(50),
    in _nueva_clave varchar(50)
)
begin
	-- EVITAMOS ERRORES PREGUNTANDO SI EXISTE EL EMPLEADO POR SU CODIGO
	if exists(SELECT * FROM empleado where cod_empleado = _cod_empleado) then
		-- DEBEMOS VALIDAR SI LA CLAVE ACTUAL ES IGUAL AL QUE SE INGRESA COMO PARAMETRO
		if exists( select * from empleado where dni = _dni and cast(aes_decrypt(clave , 'farmacia_copyright_2018_sise') as char(50)) = binary _clave  ) then
			if (trim(_clave) != trim(_nueva_clave)) then
				if length(_nueva_clave) >= 5 then
					UPDATE empleado set 
					clave = aes_encrypt(_nueva_clave,'farmacia_copyright_2018_sise')					
					where cod_empleado = _cod_empleado;
					select 'Tu clave ha sido cambiada con exito.' mensaje;
				else
					select 'Su nueva clave debe ser mayor o igual que 5 caracteres.' mensaje;
				end if;
			else
				select 'No hemos actualizado tu clave, por que la nueva clave, es igual a la actual.' mensaje;
            end if;
		else
			select 'La clave actual no es correcta. Asegurate que esté bien escrito.' mensaje;
        end if;			
	else
		select 'Parece que el empleado no existe.' mensaje;
    end if;  
end;
//

-- PROCEDIMIENOS PARA CLIENTE
drop procedure if exists CREAR_CLIENTE;
delimiter //
create procedure CREAR_CLIENTE
(
	in _nombre varchar(50),
    in _direccion varchar(300),
	in _telefono char(12)
)
begin
	insert into cliente(nombre, direccion, telefono)
    values(_nombre,_direccion,_telefono);
    select 'Registro completo con exito.' mensaje;
end;
//
drop procedure if exists LISTAR_CLIENTES;
delimiter //
create procedure LISTAR_CLIENTES()
begin
	select * from cliente order by cod_cliente desc;
end;
//
drop procedure if exists BUSCAR_CLIENTE;
delimiter //
create procedure BUSCAR_CLIENTE
(
	in _cod_cliente int
)
begin
	if exists(select * from cliente where cod_cliente = _cod_cliente) then
		select *, 'existe' mensaje from cliente where cod_cliente = _cod_cliente;
	else
		select 'Parece que el cliente no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//
drop procedure if exists EDITAR_CLIENTE;
delimiter //
create procedure EDITAR_CLIENTE
(
	in _cod_cliente int,
	in _nombre varchar(50),
    in _direccion varchar(300),
	in _telefono char(12)
)
begin
	if exists(select * from cliente where cod_cliente = _cod_cliente) then
		update cliente set
        nombre = _nombre,
        direccion = _direccion,
        telefono = _telefono
        where cod_cliente = _cod_cliente;
        select 'Registro editado con exito.' mensaje;
	else
		select 'Parece que el cliente no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//
drop procedure if exists FILTRAR_CLIENTES;
delimiter //
create procedure FILTRAR_CLIENTES
(
	in _nombre varchar(50)
)
begin
	if exists(select * from cliente where nombre like concat('%', _nombre, '%')) then
        select *, 'existe' mensaje from cliente where nombre like concat('%', _nombre, '%')  order by cod_cliente desc;
	else
		select 'No hemos encontrado ningún registro con el dato ingresado. Por favor intente con otro dato diferente al actual.' mensaje;
    end if;
end;
//


-- PROCEDIMIENTOS PARA EMPLEADO
drop procedure if exists CREAR_EMPLEADO;
delimiter //
create procedure CREAR_EMPLEADO
(
	in _nombre varchar(50),
    in _dni char(8),
    in _clave blob,
    in _nivel_usuario varchar(50),
    in _direccion varchar(300),
    in _telefono char(12),
    in _sueldo_base decimal(8,2)
)
begin
	if length(_clave) >= 5 then
		if (trim(_nivel_usuario) = 'admin') then
			insert into empleado(nombre, dni, clave, nivel_usuario, direccion, telefono, sueldo_base)
			values(_nombre, _dni, aes_encrypt(_clave,'farmacia_copyright_2018_sise'), _nivel_usuario, _direccion, _telefono, _sueldo_base);
			select 'Registro completo con exito.' mensaje;
		else
			insert into empleado(nombre, dni, clave, direccion, telefono)
			values(_nombre, _dni, aes_encrypt(_clave,'farmacia_copyright_2018_sise'), _direccion, _telefono);
			select 'Registro completo con exito.' mensaje;
		end if;
	else
		select 'La clave debe ser mayor o igual que 5 caracteres.' mensaje;
	end if;
end;
//
drop procedure if exists LISTAR_EMPLEADOS;
delimiter //
create procedure LISTAR_EMPLEADOS()
begin
	select 
    cod_empleado, nombre, dni, nivel_usuario, direccion, telefono, fecha_entrada, sueldo_base
    from empleado order by cod_empleado desc;
end;
//
drop procedure if exists BUSCAR_EMPLEADO; 
delimiter //
create procedure BUSCAR_EMPLEADO
(
	in _cod_empleado int
)
begin
	if exists(select * from empleado where cod_empleado = _cod_empleado) then
		select *, 'existe' mensaje from empleado where cod_empleado = _cod_empleado;
	else
		select 'Parece que el empleado no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//

drop procedure if exists EDITAR_EMPLEADO;
delimiter //
create procedure EDITAR_EMPLEADO
(
	in _cod_empleado int,
    in _nombre varchar(50),
    in _dni char(8),
    in _direccion varchar(300),
    in _telefono char(12)
)
begin
	if exists(select * from empleado where cod_empleado = _cod_empleado) then
		update empleado set
        nombre = _nombre,
        dni = _dni,
        direccion = _direccion,
        telefono = _telefono
        where cod_empleado = _cod_empleado;
        select 'Registro editado con exito.' mensaje;
	else
		select 'Parece que el empleado no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//
drop procedure if exists FILTRAR_EMPLEADOS;
delimiter //
create procedure FILTRAR_EMPLEADOS
(
	in _nombre varchar(50),
    in _dni char(8)
)
begin
	if exists(select * from empleado where nombre like concat('%', _nombre, '%') and dni like concat('%', _dni, '%')  ) then
        select 
         cod_empleado, nombre, dni, nivel_usuario, direccion, telefono, fecha_entrada, sueldo_base,
        'existe' mensaje from empleado  where nombre like concat('%', _nombre, '%') and dni like concat('%', _dni, '%')  order by cod_empleado desc;
	else
		select 'No hemos encontrado ningún registro con el dato ingresado. Por favor intente con otro dato diferente al actual.' mensaje;
    end if;
end;
//


-- PROCEDIMIENTOS PROVEEDOR
drop procedure if exists CREAR_PROVEEDOR;
delimiter //
create procedure CREAR_PROVEEDOR 
(
	in _nombre varchar(50),
    in _direccion varchar(300),
    in _pagina_web varchar(200),
    in _telefono char(12)
)
begin
	insert into proveedor(nombre, direccion, pagina_web, telefono)
    values(_nombre, _direccion, _pagina_web, _telefono);
    select 'Registro completo con exito.' mensaje;
end;
//
drop procedure if exists LISTAR_PROVEEDORES;
delimiter //
create procedure LISTAR_PROVEEDORES()
begin
	select * from proveedor order by cod_proveedor desc;
end;
//
drop procedure if exists BUSCAR_PROVEEDOR;
delimiter //
create procedure BUSCAR_PROVEEDOR
(
	in _cod_proveedor int
)
begin
	if exists(select * from proveedor where cod_proveedor = _cod_proveedor) then
		select *, 'existe' mensaje from proveedor where cod_proveedor = _cod_proveedor;
	else
		select 'Parece que el proveedor no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//
drop procedure if exists EDITAR_PROVEEDOR;
delimiter //
create procedure EDITAR_PROVEEDOR
(
	in _cod_proveedor int,
	in _nombre varchar(50),
    in _direccion varchar(300),
    in _pagina_web varchar(200),
    in _telefono char(12)
)
begin
	if exists(select * from proveedor where cod_proveedor = _cod_proveedor) then
		update proveedor set
        nombre = _nombre,
        direccion = _direccion,
        pagina_web = _pagina_web,
        telefono = _telefono
        where cod_proveedor = _cod_proveedor;
        select 'Registro editado con exito.' mensaje;
	else
		select 'Parece que el proveedor no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//
drop procedure if exists FILTRAR_PROVEEDORES;
delimiter //
create procedure FILTRAR_PROVEEDORES
(
	in _nombre varchar(50)
)
begin
	if exists(select * from proveedor where nombre like concat('%', _nombre, '%')) then
        select *, 'existe' mensaje from proveedor where nombre like concat('%', _nombre, '%')  order by cod_proveedor desc;
	else
		select 'No hemos encontrado ningún registro con el dato ingresado. Por favor intente con otro dato diferente al actual.' mensaje;
    end if;
end;
//



-- PROCEDIMIENTO PARA PRODUCTOS
drop procedure if exists CREAR_PRODUCTO;
delimiter //
create procedure CREAR_PRODUCTO
(
	in _cod_referencia varchar(999),
    in _nombre_producto varchar(50),
    in _descripcion varchar(300),
    in _stock int,
    in _precio decimal(8,2),
    in _fecha_vencimiento datetime,    
    in _rutaImagen varchar(999),
    in _cod_proveedor int
)
begin	
	if (_stock > 0) then
		if (_precio >= 1) then
			if (date_format( _fecha_vencimiento, '%Y-%m-%d') > date_format(now(), '%Y-%m-%d') ) then
				insert into producto(cod_referencia, nombre_producto, descripcion, stock, precio, fecha_vencimiento, rutaImagen, cod_proveedor)
				values(_cod_referencia, _nombre_producto, _descripcion, _stock, _precio, _fecha_vencimiento, _rutaImagen, _cod_proveedor);
				select 'Registro completo con exito.' mensaje;
			else
				if (date_format( _fecha_vencimiento, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d') ) then
					select 'Parece que hoy se vence el producto y no es posible registrarla' mensaje;
				else
					select 'Parece que la fecha ingresada es menor a la fecha actual.' mensaje;
				end if;
            end if;			
		else
			select 'Le recordamos que el precio minimo es de 1 nuevo sol.' mensaje;
        end if;
    else
		select 'Le recordamos que la minima unidad es 1.' mensaje;
    end if;	
end;
//
select date_format(now(), '%Y-%m-%d');
drop procedure if exists LISTAR_PRODUCTOS;
delimiter //
create procedure LISTAR_PRODUCTOS()
begin
	select * from producto order by cod_producto desc;
end;
//
drop procedure if exists BUSCAR_PRODUCTO;
delimiter //
create procedure BUSCAR_PRODUCTO
(
	in _cod_producto int
)
begin
	if exists(select * from producto where cod_producto = _cod_producto) then
		select *, 'existe' mensaje from producto where cod_producto = _cod_producto;
	else
		select 'Parece que el producto no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//
drop procedure if exists EDITAR_PRODUCTO;
delimiter //
create procedure EDITAR_PRODUCTO
(
	in _cod_producto int,
	in _cod_referencia varchar(999),
    in _nombre_producto varchar(50),
    in _descripcion varchar(300),
    in _stock int,
    in _precio decimal(8,2),
    in _fecha_vencimiento datetime,    
    in _rutaImagen varchar(999),
    in _cod_proveedor int
)
begin
	if exists(select * from producto where cod_producto = _cod_producto) then
		if (_stock > 0) then
			if (_precio >= 1) then
				if (date_format( _fecha_vencimiento, '%Y-%m-%d') > date_format(now(), '%Y-%m-%d') ) then
					update producto set
					cod_referencia = _cod_referencia,
					nombre_producto = _nombre_producto,
					descripcion = _descripcion,
					stock = _stock,
					precio = _precio,
					fecha_vencimiento = _fecha_vencimiento,
					rutaImagen = _rutaImagen,
					cod_proveedor = _cod_proveedor
					where cod_producto = _cod_producto;
					select 'Registro editado con exito.' mensaje;
				else
					if (date_format( _fecha_vencimiento, '%Y-%m-%d') = date_format(now(), '%Y-%m-%d') ) then
						select 'Parece que hoy se vence el producto y no es posible editarla. Motivo: no esta permitido vender cosas que se vencen el presente día o menores a el.' mensaje;
					else
						select 'Parece que la fecha ingresada es menor a la fecha actual.' mensaje;
					end if;
				end if;
			else
				select 'Le recordamos que el precio minimo es de 1 nuevo sol.' mensaje;
			end if;
		else
			select 'Le recordamos que la minima unidad es 1.' mensaje;
		end if;
	else
		select 'Parece que el producto no existe sobre la cartelera actual.' mensaje;
    end if;
end;
//
drop procedure if exists FILTRAR_PRODUCTOS;
delimiter //
create procedure FILTRAR_PRODUCTOS
(
	in _cod_referencia varchar(999),
    in _nombre_producto varchar(50)
)
begin
	if exists(select * from producto where cod_referencia like concat('%', _cod_referencia, '%') and nombre_producto like concat('%', _nombre_producto, '%')) then
        select *, 'existe' mensaje from producto where cod_referencia like concat('%', _cod_referencia, '%') and nombre_producto like concat('%', _nombre_producto, '%')  order by cod_producto desc;
	else
		select 'No hemos encontrado ningún registro con el dato ingresado. Por favor intente con otro dato diferente al actual.' mensaje;
    end if;
end;
//

-- PROCEDIMEINTO PARA TIPO DE PAGO
drop procedure if exists LISTA_TIPO_PAGO;
delimiter //
CREATE PROCEDURE LISTA_TIPO_PAGO()
begin
	select * from tipo_pago order by cod_tipo_pago;
end;
//

-- PROCEDIMIENTO GENERALES
drop procedure CANT_VENTAS;
delimiter //
create procedure CANT_VENTAS()
begin
	select count(*) cantidad from lista_pedido;
end;
//


