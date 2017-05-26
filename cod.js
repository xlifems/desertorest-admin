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
