CREATE VIEW v_datos_usuario as 
select * from personal p join usuario u using(id_usuario) join cargo c using(id_cargo) join rol r 
using(id_rol) order by u.usuario;