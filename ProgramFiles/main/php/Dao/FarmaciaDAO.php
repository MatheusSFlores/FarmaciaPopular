<?php
require_once(__DIR__ . '/../../config/database.php');
require_once "php/classes/FarmaciaClass.php";
// i: Integer/int (inteiro)
// d: Double
// s: String (texto/varchar)
class FarmaciaDAO
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function cadastro(int $idUsuario)
    {
            $sql = "INSERT INTO farmacias (idusuario) VALUES (?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idUsuario);
            $stmt->execute();
            return $stmt->insert_id;
    }

    public function getAll()
    {
        $sql = "SELECT * FROM farmacias";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($idfarmacia)
    {
        $sql = "SELECT * FROM farmacias WHERE idfarmacia = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idfarmacia);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function delete($idfarmacia)
    {
        $sql = "DELETE FROM farmacias WHERE idfarmacia = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idfarmacia);
        $stmt->execute();
    }
}
?>

