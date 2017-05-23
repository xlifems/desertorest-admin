private String id;
private String nickname;
private String tidentificacion;
private String identificacion;
private String nombres;
private String apellidos;
private String departamento;
private String ciudad;
private String direccion;
private String barrio;
private String telefono;
private String correo;
private String password;
private String tipo;


INSERT INTO `ins_niveles` (`id_nivel`, `nombre_nivel`) VALUES (NULL, 'Quinto');
INSERT INTO `ins_faltas`(`falta_id`, `falta_motivo`, `falta_observacion`, `id_usuario`, `falta_fecha`)
VALUES (?,?,?,?,?)

############################################################
SELECT COUNT(*) FROM ins_faltas , ins_usuarios
WHERE `usuario_id`=6
AND ins_faltas.id_usuario = ins_usuarios.usuario_id
##############################################################
SELECT falta_fecha, falta_motivo, falta_observacion FROM ins_faltas , ins_usuarios
WHERE `usuario_id`=6
AND ins_faltas.id_usuario = ins_usuarios.usuario_id
