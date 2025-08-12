<?php
session_start();
require_once __DIR__ . '/../model/tarjeta.php';

if (!isset($_SESSION['usuario_id'])) {
    echo json_encode(['success' => false, 'message' => 'No autenticado']);
    exit;
}

$tarjeta = new Tarjeta();
$usuario_id = $_SESSION['usuario_id'];
$tarjetas = $tarjeta->obtenerTarjetasPorUsuario($usuario_id);

echo json_encode(['success' => true, 'tarjetas' => $tarjetas]);
