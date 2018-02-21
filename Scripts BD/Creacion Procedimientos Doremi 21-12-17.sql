delimiter $$

create procedure sp_Iniciar_Sesion(
	in Rut varchar(15)
)
begin
	select
		ifnull(a.Clave,'') as Pass,
		a.ID,a.Rut,a.Nombre,a.Apellido_Paterno,
		b.Codigo as Genero,c.Descripcion as Tipo_Usuario
	from Usuarios a
		inner join Parametros b
		on(a.Genero=b.ID)
		inner join Parametros c
		on(a.Tipo_Usuario=c.ID)
		inner join Parametros d
		on(a.Estado=d.ID)
	where a.Rut=Rut
		and d.Codigo<>'0';
end$$

create procedure sp_Usuarios_Buscar(
	in ID varchar(10),
	in Rut varchar(15),
	in Nom varchar(30),
	in ApePat varchar(30),
	in ApeMat varchar(30),
	in Gen varchar(10),
	in Tip varchar(10)
)
begin
	set @sqlstr='
		select
			a.ID,a.Rut,a.Nombre,a.Apellido_Paterno,
			a.Apellido_Materno,a.Genero as IDGen,
			b.Descripcion as Genero,
			DATE_FORMAT(a.Fecha_Nacimiento,"%d/%m/%Y") as Fecha_Nacimiento,
			a.Email,a.Telefono_1,a.Telefono_2,a.Direccion,
			a.Tipo_Usuario as IDTipUsu,c.Descripcion as Tipo_Usuario,
			a.Comentarios,a.Estado as IDEst,d.Descripcion as Estado,
			ifnull(e.Path,"") as Path
		from Usuarios a
			inner join Parametros b
			on(a.Genero=b.ID)
			inner join Parametros c
			on(a.Tipo_Usuario=c.ID)
			inner join Parametros d
			on(a.Estado=d.ID)
			left outer join Usuarios_Fotos e
			on(a.ID=e.ID_Usuario)
	';
	
	set @wh=0;
	
	if(ID<>'') then
		set @sqlstr=concat(@sqlstr,'where a.ID="',ID,'"');
		
		set @wh=1;
	else
		if(Rut<>'') then
			if(@wh=0) then
				set @sqlstr=concat(@sqlstr,'where a.Rut="',Rut,'"');
				
				set @wh=1;
			else
				set @sqlstr=concat(@sqlstr,'and a.Rut="',Rut,'"');
			end if;
		end if;
		
		if(Nom<>'') then
			if(@wh=0) then
				set @sqlstr=concat(@sqlstr,'where a.Nombre="',Nom,'"');
				
				set @wh=1;
			else
				set @sqlstr=concat(@sqlstr,'and a.Nombre="',Nom,'"');
			end if;
		end if;
		
		if(ApePat<>'') then
			if(@wh=0) then
				set @sqlstr=concat(@sqlstr,'where a.Apellido_Paterno="',ApePat,'"');
				
				set @wh=1;
			else
				set @sqlstr=concat(@sqlstr,'and a.Apellido_Paterno="',ApePat,'"');
			end if;
		end if;
		
		if(ApeMat<>'') then
			if(@wh=0) then
				set @sqlstr=concat(@sqlstr,'where a.Apellido_Materno="',ApeMat,'"');
				
				set @wh=1;
			else
				set @sqlstr=concat(@sqlstr,'and a.Apellido_Materno="',ApeMat,'"');
			end if;
		end if;
		
		if(Gen<>'') then
			if(@wh=0) then
				set @sqlstr=concat(@sqlstr,'where a.Genero="',Gen,'"');
				
				set @wh=1;
			else
				set @sqlstr=concat(@sqlstr,'and a.Genero="',Gen,'"');
			end if;
		end if;
		
		if(Tip<>'') then
			if(@wh=0) then
				set @sqlstr=concat(@sqlstr,'where a.Tipo_Usuario="',Tip,'"');
				
				set @wh=1;
			else
				set @sqlstr=concat(@sqlstr,'and a.Tipo_Usuario="',Tip,'"');
			end if;
		end if;
	end if;
	
	if(@wh=0) then
		set @sqlstr=concat(@sqlstr,'where d.Codigo="1"');
		
		set @wh=1;
	else
		set @sqlstr=concat(@sqlstr,'and d.Codigo="1"');
	end if;
	
	PREPARE sqlstr FROM @sqlstr;
	EXECUTE sqlstr;
	DEALLOCATE PREPARE sqlstr;
end$$

create procedure sp_Generos_Cbo()
begin
	select
		ID,Descripcion as Genero
	from Parametros
	where Item='Generos';
end$$

create procedure sp_Tipos_Usuario_Cbo()
begin
	select
		ID,Descripcion as Tipo_Usuario
	from Parametros
	where Item='Tipo_Usuario';
end$$

create procedure sp_Estados_Cbo()
begin
	select
		ID,Descripcion as Estados
	from Parametros
	where Item='Estados'
		and Descripcion<>'Confirmación Pendiente';
end$$

create procedure sp_Usuarios_Grabar(
	in ID int,
	in Rut varchar(15),
	in Pas varchar(100),
	in Nom varchar(30),
	in ApePat varchar(30),
	in ApeMat varchar(30),
	in Gen int,
	in FecNac varchar(10),
	in Ema varchar(60),
	in Tel1 varchar(30),
	in Tel2 varchar(30),
	in Dir varchar(80),
	in TipUsu int,
	in Com varchar(250),
	in Est int,
	in Path varchar(60),
	in IDUsu int
)
begin
	select
		Codigo into @CodGen
	from Parametros
	where ID=Gen;
	
	if(Path='' and @CodGen='M') then
		set Path='default_M.png';
	else
		set Path='default_F.png';
	end if;
	
	if(ID='') then
		insert into Usuarios(
			Rut,Clave,Nombre,Apellido_Paterno,Apellido_Materno,
			Genero,Fecha_Nacimiento,Email,Telefono_1,Telefono_2,
			Direccion,Tipo_Usuario,Comentarios,Estado,Fecha_Creacion,
			Fecha_Modificacion
		)
		values(
			Rut,Pas,Nom,ApePat,ApeMat,
			Gen,FecNac,Ema,Tel1,Tel2,
			Dir,TipUsu,Com,Est,now(),
			now()
		);
		
		set @ID=last_insert_id();
		
		insert into Usuarios_Fotos(
			ID_Usuario,Nombre_Archivo,Path,
			Usuario_Creacion,Fecha_Creacion,
			Usuario_Modificacion,Fecha_Modificacion
		)
		values(
			@ID,Path,Path,
			IDUsu,now(),
			IDUsu,now()
		);
		
		select @ID as Resp;
	else
		update Usuarios a
		set a.Nombre=Nom,a.Apellido_Paterno=ApePat,a.Apellido_Materno=ApeMat,
			a.Genero=Gen,a.Fecha_Nacimiento=FecNac,a.Email=Ema,
			a.Telefono_1=Tel1,a.Telefono_2=Tel2,a.Direccion=Dir,
			a.Tipo_Usuario=TipUsu,a.Comentarios=Com,a.Estado=Est,
			a.Fecha_Modificacion=now()
		where a.ID=ID;
		
		update Usuarios_Fotos a
		set a.Nombre_Archivo=Path,a.Path=Path,
			Usuario_Modificacion=IDUsu,
			Fecha_Modificacion=now()
		where a.ID_Usuario=ID;
			
		select '1' as Resp;
	end if;
end$$

create procedure sp_Usuarios_Grabar(
	in ID int,
	in Rut varchar(15),
	in Pas varchar(100),
	in Nom varchar(30),
	in ApePat varchar(30),
	in ApeMat varchar(30),
	in Gen int,
	in FecNac varchar(10),
	in Ema varchar(60),
	in Tel1 varchar(30),
	in Tel2 varchar(30),
	in Dir varchar(80),
	in TipUsu int,
	in Com varchar(250),
	in Est int,
	in Path varchar(60),
	in IDUsu int
)
begin
	select
		Codigo into @CodGen
	from Parametros a
	where a.ID=Gen;
	
	if(Path='' and @CodGen='M') then
		set Path='default_M.png';
	else
		set Path='default_F.png';
	end if;
	
	if(ID='') then
		insert into Usuarios(
			Rut,Clave,Nombre,Apellido_Paterno,Apellido_Materno,
			Genero,Fecha_Nacimiento,Email,Telefono_1,Telefono_2,
			Direccion,Tipo_Usuario,Comentarios,Estado,Fecha_Creacion,
			Fecha_Modificacion
		)
		values(
			Rut,Pas,Nom,ApePat,ApeMat,
			Gen,FecNac,Ema,Tel1,Tel2,
			Dir,TipUsu,Com,Est,now(),
			now()
		);
		
		set @ID=last_insert_id();
		
		insert into Usuarios_Fotos(
			ID_Usuario,Nombre_Archivo,Path,
			Usuario_Creacion,Fecha_Creacion,
			Usuario_Modificacion,Fecha_Modificacion
		)
		values(
			@ID,Path,Path,
			IDUsu,now(),
			IDUsu,now()
		);
		
		select @ID as Resp;
	else
		update Usuarios a
		set a.Nombre=Nom,a.Apellido_Paterno=ApePat,a.Apellido_Materno=ApeMat,
			a.Genero=Gen,a.Fecha_Nacimiento=FecNac,a.Email=Ema,
			a.Telefono_1=Tel1,a.Telefono_2=Tel2,a.Direccion=Dir,
			a.Tipo_Usuario=TipUsu,a.Comentarios=Com,a.Estado=Est,
			a.Fecha_Modificacion=now()
		where a.ID=ID;
		
		update Usuarios_Fotos a
		set a.Nombre_Archivo=Path,a.Path=Path,
			Usuario_Modificacion=IDUsu,
			Fecha_Modificacion=now()
		where a.ID_Usuario=ID;
			
		select '1' as Resp;
	end if;
end$$

delimiter ;