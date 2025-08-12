<?php
require_once __DIR__ . '/../conexion.php';

class Tarjeta {
    private $conn;

    public function __construct() {
        $this->conn = conectarDB();
    }

    public function obtenerTarjetasPorUsuario($usuario_id) {
        $sql = "SELECT t.*, ut.fecha_obtencion, ut.nivel_carta, ut.experiencia_carta, ut.favorita
                FROM tarjetas t
                INNER JOIN usuario_tarjetas ut ON t.id = ut.tarjeta_id
                WHERE ut.usuario_id = ?
                ORDER BY ut.fecha_obtencion DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
