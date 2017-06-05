<?php
class Principal {
  private $_bdh;
  function __construct (){
    try {
      //mysql:unix_socket=/cloudsql/INSTANCE_CONNECTION_NAME;
      $this->_bdh = new PDO('mysql:host=104.155.171.0;dbname=desertorest','root', 'famp52845');
      // $this->_bdh = new PDO('mysql:host=localhost;dbname=desertorest','root', '');
      $this->_bdh->exec("SET NAMES utf8");
      $this->_bdh->exec("SET CHARACTER SET utf8");
      $this->_bdh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->_bdh->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    } catch (PDOException $e) {
      echo "Error:" . $e->getMessage();
    }
  }

  function login_user($user, $password){
    try {
      $query = $this->_bdh->prepare("SELECT * FROM ins_docentes WHERE docentes_nickname = :user");
      $query->execute(array(':user' => $user));
      if ($query->rowCount() == 1) {
        $row = $query->fetch();
        $savedPasswordHash = $row['docentes_password'];

        if($savedPasswordHash == $password){
          session_start();
          $_SESSION["nickname"]  = $row["docentes_nickname"];
          $_SESSION["nombres"]   = $row["docentes_nombres"]." ".$row["docentes_apellidos"];
          $_SESSION["id"]        = $row["docentes_id"];
          return $row;
        }
      }
      $this->_bdh = null;
    } catch (PDOException $e) {
      echo "Error!." . $e->getMessage();
    }
  }

  function load_municipios($id_dep){
    try {
      $query = $this->_bdh->prepare("SELECT * FROM ins_municipios WHERE id_departamento = :id_dep");
      $query->execute(array('id_dep'=>$id_dep));
      return $query->fetchAll(PDO::FETCH_ASSOC);
      $this->_bdh = null;
    } catch (PDOException $e) {
      echo "Error:" . $e->getMessage();
    }
  }

  function load_clientes(){
    try {
      $query = $this->_bdh->prepare("SELECT * FROM ins_usuarios");
      $query->execute();
      $array_usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
      return $this->respuesta_jsonarray("200", "Informacion encontrada", $array_usuarios);
      $this->_bdh = null;
    } catch (PDOException $e) {
      echo "Error:" . $e->getMessage();
    }
  }

  function load_estudiantes_android($docentes_id){
    try {
      $query = $this->_bdh->prepare("SELECT `usuario_id`,`usuario_nickname`, `usuario_tidentificacion`, `usuario_identificacion`, `usuario_nombres`, `usuario_apellidos`, `usuario_departamento`, `usuario_ciudad`, `usuario_direccion`, `usuario_barrio`, `usuario_telefono`, `usuario_correo`, `usuario_password`, `usuario_nivel_id`
        FROM ins_usuarios, ins_docentes, ins_niveles
        WHERE ins_docentes.docentes_id = ins_niveles.docentes_id AND ins_usuarios.usuario_nivel_id=ins_niveles.id_nivel
        AND ins_docentes.docentes_id = :docentes_id ");
        $query->execute(array('docentes_id'   => $docentes_id));
      $array_usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
      return $this->respuesta_jsonarray("200", "Informacion encontrada", $array_usuarios);
      $this->_bdh = null;
    } catch (PDOException $e) {
      echo "Error:" . $e->getMessage();
    }
  }

  function registrar_usuario($data){
    try {
      session_start();
      $query = $this->_bdh->prepare("INSERT INTO `ins_usuarios` (`usuario_nickname`, `usuario_tidentificacion`, `usuario_identificacion`, `usuario_nombres`, `usuario_apellidos`, `usuario_departamento`, `usuario_ciudad`, `usuario_direccion`, `usuario_barrio`, `usuario_telefono`, `usuario_correo`, `usuario_password`, `usuario_nivel_id`) VALUES (:usuario_nickname, :usuario_tidentificacion, :usuario_identificacion, :usuario_nombres, :usuario_apellidos, :usuario_departamento, :usuario_ciudad, :usuario_direccion, :usuario_barrio, :usuario_telefono, :usuario_correo, :usuario_password, :usuario_nivel_id)");
      $res = $query->execute(array(
        'usuario_nickname'   => $data[0]['value'],
        'usuario_tidentificacion'  => $data[1]['value'],
        'usuario_identificacion'   => $data[2]['value'],
        'usuario_nombres'  => $data[3]['value'],
        'usuario_apellidos'  => $data[4]['value'],
        'usuario_departamento'   => $data[5]['value'],
        'usuario_ciudad'   => $data[6]['value'],
        'usuario_direccion'  => $data[7]['value'],
        'usuario_barrio'   => $data[8]['value'],
        'usuario_telefono'   => $data[9]['value'],
        'usuario_correo'   => $data[10]['value'],
        'usuario_password'   => $data[11]['value'],
        'usuario_nivel_id'   => $data[13]['value']
      ));
      return $res;
    } catch (PDOException $e) {
      echo "Error!" . $e->getMessage();
    }
  }

  function registrar_docente($data){
    try {
      session_start();
      $query = $this->_bdh->prepare("INSERT INTO `ins_docentes` (`docentes_nickname`, `docentes_tidentificacion`, `docentes_identificacion`, `docentes_nombres`, `docentes_apellidos`, `docentes_departamento`, `docentes_ciudad`, `docentes_direccion`, `docentes_barrio`, `docentes_telefono`, `docentes_correo`, `docentes_password`) VALUES (:docentes_nickname, :docentes_tidentificacion, :docentes_identificacion, :docentes_nombres, :docentes_apellidos, :docentes_departamento, :docentes_ciudad, :docentes_direccion, :docentes_barrio, :docentes_telefono, :docentes_correo, :docentes_password)");
      $res = $query->execute(array(
        'docentes_nickname'   => $data[0]['value'],
        'docentes_tidentificacion'  => $data[1]['value'],
        'docentes_identificacion'   => $data[2]['value'],
        'docentes_nombres'  => $data[3]['value'],
        'docentes_apellidos'  => $data[4]['value'],
        'docentes_departamento'   => $data[5]['value'],
        'docentes_ciudad'   => $data[6]['value'],
        'docentes_direccion'  => $data[7]['value'],
        'docentes_barrio'   => $data[8]['value'],
        'docentes_telefono'   => $data[9]['value'],
        'docentes_correo'   => $data[10]['value'],
        'docentes_password'   => $data[11]['value']
      ));
      return $res;
    } catch (PDOException $e) {
      echo "Error!" . $e->getMessage();
    }
  }

  function eliminar_usuarios($usuario_id){
    try {
      session_start();
      $sql = "DELETE FROM `ins_usuarios` WHERE `usuario_id` = :usuario_id ";
      $query = $this->_bdh->prepare($sql);
      $res = $query->execute(array(":usuario_id" => $usuario_id));
      return $res;
    } catch (PDOException $e) {
      echo "Error!" . $e->getMessage();
    }
  }

  function cargar_datos_usuario($usuario_id){
    try {
      $query = $this->_bdh->prepare("SELECT * FROM ins_usuarios WHERE `usuario_id` = :usuario_id");
      $query->execute(array(":usuario_id" => $usuario_id));
      return $query->fetch();
      $this->_bdh = null;
    } catch (PDOException $e) {
      echo "Error:" . $e->getMessage();
    }
  }

  function modificar_usuario($data, $usuario_id){
    try {
      $sql = "UPDATE ins_usuarios SET `usuario_nickname`  = :usuario_nickname,  `usuario_tidentificacion` = :usuario_tidentificacion, `usuario_identificacion` = :usuario_identificacion ,
      `usuario_nombres`   = :usuario_nombres,   `usuario_apellidos` = :usuario_apellidos , `usuario_departamento` = :usuario_departamento , `usuario_ciudad` = :usuario_ciudad ,
      `usuario_direccion` = :usuario_direccion, `usuario_barrio` = :usuario_barrio, `usuario_telefono` = :usuario_telefono , `usuario_correo` = :usuario_correo,
      `usuario_password`  = :usuario_password , `usuario_tipo`= :usuario_tipo WHERE `usuario_id` = :usuario_id";
      $query = $this->_bdh->prepare($sql);
      $res = $query->execute(array(
        'usuario_nickname'   => $data[0]['value'],
        'usuario_tidentificacion'  => $data[1]['value'],
        'usuario_identificacion'   => $data[2]['value'],
        'usuario_nombres'  => $data[3]['value'],
        'usuario_apellidos'  => $data[4]['value'],
        'usuario_departamento'   => $data[5]['value'],
        'usuario_ciudad'   => $data[6]['value'],
        'usuario_direccion'  => $data[7]['value'],
        'usuario_barrio'   => $data[8]['value'],
        'usuario_telefono'   => $data[9]['value'],
        'usuario_correo'   => $data[10]['value'],
        'usuario_password'   => $data[11]['value'],
        'usuario_tipo'   => $data[12]['value'],
        "usuario_id" => $usuario_id
      ));
      return $res;
    } catch (PDOException $e) {
      echo "Error:" . $e->getMessage();
    }
  }

  function registrar_progreso($nivel_id, $usuario_id){
    try {
      $sql = "INSERT INTO `ins_niveles_usuarios` ( `nivel_id`, `usuario_id`) VALUES (:nivel_id, :usuario_id)";
      $query = $this->_bdh->prepare($sql);
      $res = $query->execute(array(
        'nivel_id'  => $nivel_id,
        'usuario_id' => $usuario_id ));
        return $res;
      } catch (PDOException $e) {
        echo "Error!" . $e->getMessage();
      }
    }

    function consultar_progreso($usuario_id)  {
      try {
        $sql= "SELECT DISTINCT nivel_id, nombre_nivel FROM ins_niveles_usuarios , ins_niveles WHERE `usuario_id` =:usuario_id AND ins_niveles.id_nivel = ins_niveles_usuarios.nivel_id ";
        $query = $this->_bdh->prepare($sql);
        $query->execute(array('usuario_id' => $usuario_id ));
        return $query->fetchAll(PDO::FETCH_ASSOC);
        $this->_bdh = null;
      } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
      }
    }

    function registrar_falta($data){
      try {
        session_start();
        $query = $this->_bdh->prepare("INSERT INTO `ins_faltas`( `id_usuario`, `falta_motivo`, `falta_observacion`,  `falta_fecha`) VALUES (:id_usuario, :falta_motivo, :falta_observacion, :falta_fecha) ");
        $res = $query->execute(array(
          'id_usuario'   => $data[0]['value'],
          'falta_motivo'   => $data[1]['value'],
          'falta_observacion'  => $data[2]['value'],
          'falta_fecha'  => $data[3]['value']
        ));
        return $res;
      } catch (PDOException $e) {
        echo "Error!" . $e->getMessage();
      }
    }

    function registrar_falta_android($id_usuario, $falta_motivo, $falta_observacion, $falta_fecha){
      try {
        session_start();
        $query = $this->_bdh->prepare("INSERT INTO `ins_faltas`( `id_usuario`, `falta_motivo`, `falta_observacion`,  `falta_fecha`) VALUES (:id_usuario, :falta_motivo, :falta_observacion, :falta_fecha) ");
        $res = $query->execute(array(
          'id_usuario'   => $id_usuario,
          'falta_motivo'   => $falta_motivo,
          'falta_observacion'  => $falta_observacion,
          'falta_fecha'  => $falta_fecha
        ));
        return $res;
      } catch (PDOException $e) {
        echo "Error!" . $e->getMessage();
      }
    }

    function registrar_desertor($usuario_id, $desertor_motivo, $desertor_observacion, $desertor_fecha){
      try {
        session_start();
        $query = $this->_bdh->prepare("INSERT INTO `ins_desertores`( `usuario_id`, `desertor_motivo`, `desertor_observacion`,  `desertor_fecha`) VALUES (:usuario_id, :desertor_motivo, :desertor_observacion, :desertor_fecha) ");
        $res = $query->execute(array(
          'usuario_id'   => $usuario_id,
          'desertor_motivo'   => $desertor_motivo,
          'desertor_observacion'  => $desertor_observacion,
          'desertor_fecha'  => $desertor_fecha
        ));
        return $res;
      } catch (PDOException $e) {
        echo "Error!" . $e->getMessage();
      }
    }

    function consultar_faltas($usuario_id)  {
      try {
        $sql= "SELECT falta_fecha, falta_motivo, falta_observacion FROM ins_faltas , ins_usuarios WHERE `usuario_id` = :usuario_id AND ins_faltas.id_usuario = ins_usuarios.usuario_id";
        $query = $this->_bdh->prepare($sql);
        $query->execute(array('usuario_id' => $usuario_id ));
        return $query->fetchAll(PDO::FETCH_ASSOC);
        $this->_bdh = null;
      } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
      }
    }


    function count_faltas()  {
      try {
        $sql= "SELECT count(*) AS total,  ins_usuarios.usuario_nombres, ins_usuarios.usuario_apellidos, ins_usuarios.usuario_id FROM ins_faltas , ins_usuarios WHERE ins_faltas.id_usuario = ins_usuarios.usuario_id GROUP by ins_usuarios.usuario_id";
        $query = $this->_bdh->prepare($sql);
        $query->execute();
        $array_usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->respuesta_jsonarray("200", "Informacion encontrada", $array_usuarios);
        $this->_bdh = null;
      } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
      }
    }

    function consultar_niveles($docentes_id)  {
      try {
        $sql= "SELECT * FROM `ins_niveles` WHERE `docentes_id` = :docentes_id ";
        $query = $this->_bdh->prepare($sql);
        $query->execute(array('docentes_id' => $docentes_id ));
        $array_niveles =  $query->fetchAll(PDO::FETCH_ASSOC);
        return $this->respuesta_jsonarray("200", "Informacion Niveles", $array_niveles);
        $this->_bdh = null;
      } catch (PDOException $e) {
        echo "Error:" . $e->getMessage();
      }
    }

    function respuesta_jsonarray($codigo, $descripcion, $data) {
      // respuesta en formato JsonArray
      return array(
        "codigo" => $codigo,
        "descripcion" => $descripcion,
        "data" => $data
      );
    }



  }
  ?>
