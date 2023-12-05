<?php
require_once(__DIR__ . '/../../config/database.php');
require_once "php/classes/ClienteClass.php";
// i: Integer/int (inteiro)
// d: Double
// s: String (texto/varchar)
class ClienteDAO
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function cadastro(array $dados)
    {
        $sql = "INSERT INTO clientes (idcliente, idusuario, retiradas, receitas) VALUES (NULL, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $dados["idusuario"], $dados["retiradas"], $dados["receitas"]);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function atualizar(array $dados)
    {
        $sql = "UPDATE clientes SET retiradas = ?, receitas = ? WHERE idcliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $dados["retiradas"], $dados["receitas"], $dados["idcliente"]);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM clientes WHERE idcliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }

    public function listar()
    {
        $sql = "SELECT * FROM clientes";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM clientes WHERE idcliente = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
?>