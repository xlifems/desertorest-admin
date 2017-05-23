<?php
error_reporting(E_ALL ^ E_NOTICE);
function route($page){

	switch ($page) {
		case 'registrar_usuario':
		include 'pages/registrar_usuarios.php';
		break;
		case 'listar_usuarios':
		include 'pages/listar_usuarios.php';
		break;
		case 'modificar_usuarios':
		include 'pages/modificar_usuarios.php';
		break;
		case 'registrar_falta':
		include 'pages/registrar_faltas.php';
		break;		
		case 'salir':
		session_start();
		session_unset();
		session_destroy();
		header("Location: index.php");
		break;
		default:
		include 'pages/inicio.php';
		break;
	}
}

?>
