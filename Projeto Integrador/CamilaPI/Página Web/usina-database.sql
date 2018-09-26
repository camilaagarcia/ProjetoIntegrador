create table material_reciclado(
id_material Integer NOT NULL,
peso float NOT NULL,
data_hora timestamp NOT NULL,
foreign key(id_material) references material(id_material), 
primary key(id_material)
);