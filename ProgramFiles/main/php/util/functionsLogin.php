<?php
require_once (__DIR__ . '/../../config/database.php');
require_once (__DIR__ . '/../dao/UsuarioDAO.php');

function autenticarUsuario($cpf)
{
    $usuarioDAO = new UsuarioDAO();
    $usuario = $usuarioDAO->buscarPorCpf($cpf);

    if ($usuario) {
        $usuario = [
            'id' => $usuario['id'],
            'permissao' => $usuario['permissao'],
            'nome' => $usuario['nome'],  
            'cpf' => $usuario['cpf_cnpj'],
            'idade' => $usuario['idade'],
            'endereco' => $usuario['endereco'],
            'email' => $usuario['email']
        ];
        switch ($usuario['permissao']) {
            case 1:
                header('Location: php/telas-users/screen-clie.php?id=' . $usuario['id']);
                break;
            case 2:
                header('Location: php/telas-users/screen-med.php?id=' . $usuario['id']);
                break;
            case 3:
                header('Location: php/telas-users/screen-farm.php?id=' . $usuario['id']);
                break;
            default:
                break;
        }

        return $usuario;
    } else {
        return null;
    }
}
?>
