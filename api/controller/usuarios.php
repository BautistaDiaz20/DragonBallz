<?php
session_start();
require_once __DIR__ . '/../model/usuario.php';

$usuario = new Usuario();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    $usuario_data = $usuario->login($username, $password);

    if ($usuario_data) {
        $_SESSION['usuario_id'] = $usuario_data['id'];
        $_SESSION['username'] = $usuario_data['username'];
        echo json_encode(['success' => true, 'message' => 'Login exitoso']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Credenciales inválidas']);
    }
}
