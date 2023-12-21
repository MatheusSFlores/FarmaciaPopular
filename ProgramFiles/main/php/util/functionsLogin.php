<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../Dao/UsuarioDAO.php');


if (isset($_GET['email']) && isset($_GET['senha'])) {
    $email = urldecode($_GET['email']);
    $senha = urldecode($_GET['senha']);
    ?>

    <script>
        alert('primeiro if')
    </script> <?php 

    if ($email == 0) {
        echo "<script>alert('Informe um Email!')</script>";
    } else if ($senha == 0) {
        echo "<script>alert('Informe uma Senha!')</script>";
    } else {

        $usuarioDAO = new UsuarioDAO();
        $usuario = $usuarioDAO->buscarPorCpf($email, $senha);

        switch ($usuario['permissao']) {
            case 1:
                header('Location: ../telas-users/screen-clie.php?id=' . $usuario['id']);
                break;
            case 2:
                header('Location: ../telas-users/screen-med.php?id=' . $usuario['id']);
                break;
            case 4:
                header('Location: ../telas-users/screen-farm.php?id=' . $usuario['id']);
                break;
            default:
            
                break;
        }
    }
}

                ?>

<script>
    alert('Não entrou em nada')
</script> <?php 