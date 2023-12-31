<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cliente</title>
    <link href="../../css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="icon" href="../../css/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/ed891ee09d.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="../../js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>   
</head>
<header>
    <?php include '../../html/header.html'; ?>
</header>

<body>
    <?php
    require_once "../../config/database.php";
    require_once "../classes/UserClass.php";
    require_once "../Dao/UsuarioDAO.php";
    session_start();

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        $password = $_SESSION['password'];
        $usuarioDAO = new UsuarioDAO($pdo);
        $usuario = $usuarioDAO->buscarPorCpf($username, $password);

        $dadosUsuario = array(
            'id' => $usuario['id'],
            'modalnome' => $usuario['nome'],
            'cpf' => $usuario['cpf_cnpj'],
            'idade' => $usuario['idade'],
            'endereco' => $usuario['endereco'],
            'email' => $usuario['email']
        );
    }


    ?>
    <td>
        <p>
        <h1>Paciente</h1>
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
                    <h2>CPF</h2>
                </td>
                <td><?php echo "$dadosUsuario[cpf]" ?> </td>
                </tr>
            <tr>
                <td>
                    <h2>Idade</h2>
                </td>
                <td><?php echo "$dadosUsuario[idade]" ?> </td>
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
    <p> <a href="../telas-users/login.php" class="menu-button2">Voltar</a></p>
    <!-- <table>
    <tr>
            <th><?php echo "$dadosUsuario[modalnome]" ?></th>
                <td>
                    <button class="account-button2" data-nome="<?php echo $usuario->getNome(); ?>"
                            data-cpf="<?php echo $usuario->getCpf(); ?>"
                            data-endereco="<?php echo $usuario->getEndereco(); ?>"
                            data-idade="<?php echo $usuario->getIdade(); ?>"
                            data-saldo="<?php echo $usuario->getSaldo(); ?>"
                            data-status="<?php echo $usuario->isStatus() ? 'Ativada' : 'Desativada'; ?>">
                        Visualizar
                    </button>
                </td>
            </tr>
    </table>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Detalhes do Cliente</h2>
            <p><strong>Nome:</strong> <span id="modal-nome"></span></p>
            <p><strong>CPF:</strong> <span id="modal-cpf"></span></p>
            <p><strong>Endereço:</strong> <span id="modal-endereco"></span></p>
            <p><strong>Idade:</strong> <span id="modal-idade"></span></p>
            <p><strong>Saldo:</strong> <span id="modal-saldo"></span></p>
            <p><strong>Status:</strong> <span id="modal-status"></span></p>
        </div>
    </div>
    <br> <a href="index.html" class="menu-button2">Menu Principal</a>

    <script>
        // Função para abrir o modal com os detalhes do usuario
        function openModal(nome, cpf, endereco, idade, saldo, status) {
            document.getElementById("modal-nome").textContent = nome;
            document.getElementById("modal-cpf").textContent = cpf;
            document.getElementById("modal-endereco").textContent = endereco;
            document.getElementById("modal-idade").textContent = idade;
            document.getElementById("modal-saldo").textContent = saldo;
            document.getElementById("modal-status").textContent = status;
            document.getElementById("myModal").style.display = "block";
        }

        // Função para fechar o modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        // Adicione um evento de clique a todos os botões "Visualizar"
        var viewButtons = document.querySelectorAll(".account-button");
        viewButtons.forEach(function(button) {
            button.addEventListener("click", function() {
                var nome = button.getAttribute("data-nome");
                var cpf = button.getAttribute("data-cpf");
                var endereco = button.getAttribute("data-endereco");
                var idade = button.getAttribute("data-idade");
                var saldo = button.getAttribute("data-saldo");
                var status = button.getAttribute("data-status");
                openModal(nome, cpf, endereco, idade, saldo, status);
            });
        });

        // Adicione um evento de clique ao botão de fechar do modal
        document.querySelector(".close").addEventListener("click", closeModal);

        // Feche o modal se o usuário clicar fora da caixa de diálogo
        window.addEventListener("click", function(event) {
            if (event.target == document.getElementById("myModal")) {
                closeModal();
            }
        });
    </script> -->
    <p>
        <a href="../../html/index.html" class="menu-button2">Voltar</a>
    </p>

</body>

</html>