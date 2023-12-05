<?php

require_once(__DIR__ . '/../../config/database.php');
require_once "../classes/ClienteClass.php";
// i: Integer/int (inteiro)
// d: Double
// s: String (texto/varchar)
class MedicamentoDAO
{
    private $conn;

    public function __construct(mysqli $conn)
    {
        $this->conn = $conn;
    }

    public function cadastro(array $dadosMedicamento)
    {
        $sql = "INSERT INTO medicamentos (nome, fornecedor, validade, quantidade, imagem) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sssss", $dadosMedicamento["nome"], $dadosMedicamento["fornecedor"], $dadosMedicamento["validade"], $dadosMedicamento["quantidade"], $dadosMedicamento["imagem"]);

        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM medicamentos WHERE idmedicamento = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM medicamentos WHERE idmedicamento = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows;
    }
}
?>
