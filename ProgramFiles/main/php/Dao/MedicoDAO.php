<?php
require_once(__DIR__ . '/../../config/database.php');
require_once "php/classes/MedicoClass.php";
// i: Integer/int (inteiro)
// d: Double
// s: String (texto/varchar)
class MedicoDAO
{
    private $conn;

    public function connect()
    {
        $this->conn = new mysqli(HOST, USER, PASS, BASE);

        if ($this->conn->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $this->conn->connect_error);
        }
    }

    public function cadastro(array $dadosMedico)
    {
        $sql = "INSERT INTO medicos (idmedico, idusuario, registro, prescricoes) VALUES (NULL, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iis", $dadosMedico["idusuario"], $dadosMedico["registro"], $dadosMedico["prescricoes"]);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function atualizar(array $dados)
    {
        $sql = "UPDATE medicos SET registro = ?, prescricoes = ? WHERE idmedico = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $dados["registro"], $dados["prescricoes"], $dados["id"]);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM medicos WHERE idmedico = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function listar()
    {
        $sql = "SELECT * FROM medicos";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM medicos WHERE idmedico = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>
