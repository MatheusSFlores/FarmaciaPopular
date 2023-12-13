<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../Dao/UsuarioDAO.php');



    if (empty($_POST['CPF'])) {
?> <script>
            alert('Informe um Email')
        </script><?php
                } else {
                    ?> <script>
            alert('1 else')
        </script><?php
                    $cpf = $_POST['CPF'];
                    $usuarioDAO = new UsuarioDAO();
                    $usuario = $usuarioDAO->buscarPorCpf($cpf);

                    if ($usuario && isset($_POST['senha'])) {
                        $senha = $_POST['senha'];

                        if (empty($senha)) {
                    ?> <script>
                    alert('Informe uma Senha!')
                </script><?php
                        } else {
                            ?> <script>
            alert('2 else')
        </script><?php
                            // Comparação de senha aqui
                            if (password_verify($senha, $usuario['senha'])) {
                                // Senha correta
                                session_start();
                                $_SESSION['id'] = $usuario['id'];
                                $_SESSION['permissao'] = $usuario['permissao'];
                                $_SESSION['nome'] = $usuario['nome'];

                                switch ($usuario['permissao']) {
                                    case 1:
                                        header('Location: ../php/telas-users/screen-clie.php?id=' . $usuario['id']);
                                        break;
                                    case 2:
                                        header('Location: ../php/telas-users/screen-med.php?id=' . $usuario['id']);
                                        break;
                                    case 3:
                                        header('Location: ../php/telas-users/screen-farm.php?id=' . $usuario['id']);
                                        break;
                                    default:
                                        break;
                                }
                                ?> <script>
            alert('if mudança')
        </script><?php
                            } else {
                            ?> <script>
                        alert('Senha incorreta!')
                    </script><?php
                            }
                        }
                    } else {
                                ?> <script>
                alert('Usuário não encontrado!')
            </script><?php
                    }
                }

                        ?>

<script>
    alert('Não entrou em nada')
</script>