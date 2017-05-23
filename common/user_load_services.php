<?php
header('Content-Type: application/json; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', '1');

include 'principal.php';
$principal = new Principal;

$cli = $principal->load_clientes();
echo json_encode($cli);

 ?>
