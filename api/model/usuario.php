<?php
require_once __DIR__ . '/../conexion.php';

class Usuario {
    private $conn;

    public function __construct() {
        $this->conn = conectarDB();
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM usuarios WHERE username = ? AND password = MD5(?) LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_assoc(); // Devuelve null si no hay coincidencias
    }
}   
