<?php


$indexForm = true;
include('config/database.php');
include('php/Dao/UsuarioDAO.php');
$userid=$_GET['userid'];


session_start();
if (isset($_GET['userid'])) {

 $usuarioDAO = new UsuarioDAO($pdo);
 $usuario = $usuarioDAO->buscarPorId($userid);
    if ($usuario) {
        $dadosUsuario = [
            'id' => $usuario['id'],
            'modalnome' => $usuario['nome'], 
            'cpf' => $usuario['cpf_cnpj'],
            'idade' => $usuario['idade'],
            'endereco' => $usuario['endereco'],
            'email' => $usuario['email']
        ];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome_medicamento = $_POST['nome_medicamento'];
    $validade = $_POST['validade'];
    $quantidade = $_POST['quantidade'];
    $fornecedor = $_POST['fornecedor'];

    if (isset($_FILES['imagem_medicamento'])) {
        $arquivo = $_FILES["imagem_medicamento"];

        if ($arquivo['error']) {
            die("Falha ao enviar arquivo");
        }

        if ($arquivo['size'] > 2097152) {
            die('Arquivo muito grande! O tamanho máximo é de 2MB.');
        }

        $pasta = "../../css/images/medicamentos/";
        $nomeArquivo = $arquivo['name'];
        $novonomeArquivo = uniqid();
        $extension = strtolower(pathinfo($nomeArquivo, PATHINFO_EXTENSION));

        if ($extension != "jpg" && $extension != 'png') {
            die('Formato de arquivo inválido. Por favor, escolha uma imagem no formato PNG ou JPG.');
        }

        $novonomeArquivoCompleto = $novonomeArquivo . "." . $extension;

        $moove = move_uploaded_file($arquivo["tmp_name"], $pasta . $novonomeArquivoCompleto);
        if ($moove) {
            $dadosMedicamento = [
                'nome' => $nome_medicamento,
                'validade' => $validade,
                'quantidade' => $quantidade,
                'fornecedor' => $fornecedor,
                'imagem' => $pasta . $novonomeArquivoCompleto,
            ];

            $medicamentoDAO = new MedicamentoDAO($pdo);

            if ($medicamentoDAO->cadastro($dadosMedicamento)) {
                echo "Medicamento cadastrado com sucesso!";
            } else {
                echo "Erro ao registrar o medicamento no banco de dados.";
            }
        } else {
            echo "Erro ao fazer upload da imagem.";
        }
    } else {
        echo "Por favor, envie uma imagem do medicamento.";
    }
}
?>

    <td>
        <p>
        <h1>Farmacia</h1>
        </p>
    </td>
    <table>
        <td>
            <tr>
                <td>
                    <h2>Nome</h2>
                </td>
                <td><?php echo "$dadosUsuario[modalnome]" ?> </td>
            </tr>
            <tr>
                <td>
                    <h2>CNPJ</h2>
                </td>
                <td><?php echo "$dadosUsuario[cpf]" ?> </td>
            </tr>
            <tr>
                <td>
                    <h2>Endereço</h2>
                </td>
                <td><?php echo "$dadosUsuario[endereco]" ?> </td>
            </tr>
            <tr>
                <td>
                    <h2>Email</h2>
                </td>
                <td><?php echo "$dadosUsuario[email]" ?> </td>
            </tr>
        </td>
    </table>

    <form method="POST" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <h2>Nome Medicamento</h2>
                </td>
                <td><input type="text" name="nome_medicamento" placeholder="Informe o Nome do medicamento"></td>
            </tr>
            <tr>
                <td>
                    <h2>Validade</h2>
                </td>
                <td><input type="date" name="validade"></td>
            </tr>
            <tr>
                <td>
                    <h2>Quantidade</h2>
                </td>
                <td><input type="number" name="quantidade" placeholder="Informe a quantidade de medicamentos"></td>
            </tr>
            <tr>
                <td>
                    <h2>Fornecedor</h2>
                </td>
                <td><input type="text" name="fornecedor" placeholder="Informe o fornecedor"></td>
            </tr>
            <tr>
                <td>
                    <h2>Imagem do Medicamento</h2>
                </td>
                <td><input type="file" name="imagem_medicamento" id="imagem_medicamento" required style="display: none;"><label for="imagem_medicamento" class="custom-file-input">Escolha uma imagem (PNG ou JPG)</label></td>
                
            </tr>
            <tr>
                <td><input type="submit" value="Adicionar Medicamento" class="account-button"></td>
            </tr>
        </table>
        <p> <a href="?page=index 
        " class="menu-button2">Voltar</a></p>

    </form>
</body>

</html>
