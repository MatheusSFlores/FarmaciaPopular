<?php
require_once(__DIR__ . '/../../config/database.php');
// i: Integer/int (inteiro)
// d: Double
// s: String (texto/varchar)
class UsuarioDAO
{
    private $conn;

    public function connect()
    {
        $this->conn = new mysqli(HOST, USER, PASS, BASE);

        if ($this->conn->connect_error) {
            die("Erro ao conectar ao banco de dados: " . $this->conn->connect_error);
        }
    }

    public function cadastro(array $dadosUsuario)
    {
        $this->connect();

        $sql = "INSERT INTO usuarios (nome, cpf_cnpj, idade, endereco, email, permissao, senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sssssss", $dadosUsuario["nome"], $dadosUsuario["cpf_cnpj"], $dadosUsuario["idade"], $dadosUsuario["endereco"], $dadosUsuario["email"], $dadosUsuario["permissao"], $dadosUsuario["senha"]);

        $stmt->execute();

        return $this->conn->insert_id;
    }

    public function atualizar(array $dados)
    {
        $this->connect();

        $sql = "UPDATE usuarios SET nome = ?, cpf_cnpj = ?, idade = ?, endereco = ?, email = ?, permissao = ?, senha = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("sssssssi", $dados["nome"], $dados["cpf_cnpj"], $dados["idade"], $dados["endereco"], $dados["email"], $dados["permissao"], $dados["senha"], $dados["id"]);

        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function excluir($id)
    {
        $this->connect();

        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        return $stmt->affected_rows;
    }

    public function listar()
    {
        $this->connect();

        $sql = "SELECT * FROM usuarios";
        $result = $this->conn->query($sql);

        $usuarios = $result->fetch_all(MYSQLI_ASSOC);

        return $usuarios;
    }

    public function buscarPorId($id)
    {
        $this->connect();

        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $id);

        $stmt->execute();

        return $stmt->fetch_assoc();
    }

    public function buscarPorCpf($email, $senha)
    {
        $this->connect();

        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $email);
        $stmt->bind_param("i", $senha);
        $stmt->execute();

        return $stmt->fetch_assoc();
    }

    public function __destruct()
    {
        if ($this->conn) {
            $this->conn->close();
        }
    }
    
}
?>