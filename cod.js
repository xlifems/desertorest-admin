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


RequestParams params = new RequestParams();

       params.put("id_usuario", nombre_usuario_falta.getText());
       params.put("falta_motivo", motivo_falta.getText());
       params.put("falta_observacion", observacion_falta.getText());
       params.put("falta_fecha", "2000/01/01");
       params.put("accion", "login_user");

       String str = "";
       AsyncHttpClient client = new AsyncHttpClient();
       String url = "http://192.168.0.18/desertorest-admin/ajax/ajax_actions.php?accion=registrar_faltas";
       //String url = "http://desertorest.flibdig.com/ajax/ajax_actions.php?";
       RequestHandle requestHandle = client.post(url + params , new AsyncHttpResponseHandler() {

#####################################################

SELECT COUNT(*) AS total, usuario_nombres, usuario_apellidos
FROM ins_faltas , ins_usuarios
WHERE `usuario_id` = 5 AND ins_faltas.id_usuario = ins_usuarios.usuario_id


SELECT COUNT(*) AS total, usuario_nombres, usuario_apellidos
FROM ins_faltas , ins_usuarios
WHERE ins_faltas.id_usuario = ins_usuarios.usuario_id


SELECT count(*) AS total,  usuario_nombres, usuario_apellidos
FROM ins_faltas , ins_usuarios
WHERE ins_faltas.id_usuario = ins_usuarios.usuario_id GROUP by ins_usuarios.usuario_id

  <item>Elefante</item>
   <item>Fallecido</item>
   <item>Desertor</item>
   <item>Se caso</item>
   <item>No le gusta el estudio</item>
   <item>Trabaja</item>
   <item>No se tiene informacion aun</item>
   <item>Reprobo el año</item>
   <item>Violencia familiar</item>
   <item>Bulling</item>
   <item>Drogas</item>
   <item>Expulsado </item>
   <item>Otra cual</item>




   CREATE TABLE `ins_docentes` (
  `docentes_id` integer AUTO_INCREMENT,
  `docentes_nickname` varchar(255) DEFAULT NULL,
  `docentes_tidentificacion` varchar(45) DEFAULT NULL,
  `docentes_identificacion` varchar(45) DEFAULT NULL,
  `docentes_nombres` varchar(45) DEFAULT NULL,
  `docentes_apellidos` varchar(45) DEFAULT NULL,
  `docentes_departamento` varchar(255) DEFAULT NULL,
  `docentes_ciudad` varchar(45) DEFAULT NULL,
  `docentes_direccion` varchar(100) DEFAULT NULL,
  `docentes_barrio` varchar(100) DEFAULT NULL,
  `docentes_telefono` int(12) DEFAULT NULL,
  `docentes_correo` varchar(45)DEFAULT NULL,
  `docentes_password` varchar(255)DEFAULT NULL,
   PRIMARY KEY (docentes_id)

)

INSERT INTO `ins_docentes` (`docentes_id`, `docentes_nickname`, `docentes_tidentificacion`, `docentes_identificacion`, `docentes_nombres`, `docentes_apellidos`, `docentes_departamento`, `docentes_ciudad`, `docentes_direccion`, `docentes_barrio`, `docentes_telefono`, `docentes_correo`, `docentes_password`)
VALUES
(1, 'adrianmasapico@gmail.com', '1', '123456', 'Felix Adrian', 'Masa Pico', '6', '205', 'KR 43 A # 16 A SUR - 38', 'chimalito', 2147483647, 'adrianmasapico@gmail.com', '890504'),
(2, 'hmejiaespriella22@gmail.com ', '1', '78025654', 'Hernan manuel', 'mejia espriella', '19', '709', 'kr 16 56 98 ', 'alto kenneddy', 300256987, 'hmejiaespriella22@gmail.com', '1234');

SELECT * FROM `ins_niveles` WHERE `docentes_id` = 1



############################################################
SELECT * FROM ins_usuarios, ins_docentes, ins_niveles
WHERE ins_docentes.docentes_id = ins_niveles.docentes_id AND ins_usuarios.usuario_nivel_id=ins_niveles.id_nivel
AND ins_docentes.docentes_id = 1
