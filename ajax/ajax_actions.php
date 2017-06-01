<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');

require '../common/principal.php';
$principal = new Principal;

switch ($_REQUEST['accion']) {

	case 'cargar_municipios';
		$mun = $principal -> load_municipios($_REQUEST['id']);
		echo json_encode($mun);
		break;

	case 'cargar_clientes';
		$cli = $principal -> load_clientes();
		echo json_encode($cli);
		break;

	case 'registrar_usuario':
		$usu = $principal -> registrar_usuario($_POST['data']);
		echo $usu;
		break;

	case 'registrar_docente':
		$usu = $principal -> registrar_docente($_POST['data']);
		echo $usu;
		break;

	case 'modificar_usuario':
		$usu = $principal -> modificar_usuario($_POST['data'], $_REQUEST['usuario_id']);
		echo $usu;
		break;

	case 'eliminar_usuario':
		$res = $principal ->eliminar_usuarios($_REQUEST['usuario_id']);
		echo $res;
		break;

	case 'cargar_datos_usuario';
		$cli = $principal -> cargar_datos_usuario($_REQUEST['usuario_id']);
		echo json_encode($cli);
		break;

	case 'guardar_progreso';
		$cli = $principal -> registrar_progreso ($_REQUEST['nivel_id'], $_REQUEST['usuario_id']);
		echo json_encode($cli);
		break;

	case 'consultar_progreso';
		$cli = $principal -> consultar_progreso ( $_REQUEST['usuario_id']);
		echo json_encode($cli);
		break;

	case 'consultar_faltas';
		$cli = $principal -> consultar_faltas ($_REQUEST['usuario_id']);
		echo json_encode($cli);
		break;

	case 'login_user':
		$user = trim($_REQUEST['usuario']);
		$pass = $_REQUEST['password'];
		$login = $principal -> login_user($user, $pass);
		echo json_encode($login);
		break;

	case 'registrar_faltas':
		$usu = $principal -> registrar_falta($_POST['data']);
		echo $usu;
		break;

	case 'registrar_faltas_android':
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$usu = $principal -> registrar_falta_android($obj->{'id_usuario'},$obj->{'falta_motivo'},$obj->{'falta_observacion'},$obj->{'falta_fecha'} );
		echo $usu;
		break;

	case 'registrar_desertor_android':
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$usu = $principal -> registrar_desertor($obj->{'usuario_id'},$obj->{'desertor_motivo'},$obj->{'desertor_observacion'},$obj->{'desertor_fecha'} );
		echo $usu;
		break;

	case 'count_faltas_android':
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$res = $principal -> count_faltas();
		echo json_encode($res);
		break;

	case 'consultar_niveles':
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$res = $principal -> consultar_niveles($obj->{'docentes_id'});
		echo json_encode($res);
		break;

	case 'load_estudiantes_android':
		$json = file_get_contents('php://input');
		$obj = json_decode($json);
		$res = $principal -> load_estudiantes_android($obj->{'docentes_id'});
		echo json_encode($res);
		break;
	default:
		# code...
		break;
}

 ?>
