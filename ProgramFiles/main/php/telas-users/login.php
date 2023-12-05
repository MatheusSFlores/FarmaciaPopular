<?php
require_once (__DIR__ . '/../../config/database.php');
require_once ('php/util/functionsLogin.php');
// include ('php/util/functionsLogin.php');

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];

    $usuario = autenticarUsuario($cpf);


}
?>


<form action='' method="post">
<table>
        
        <p>
        <h1>Login</h1>
        </p>
        <tr>
            <td>
                <h2>Nome</h2>
            </td>
            <td><input type="text" name="nome" placeholder="Informe seu nome"></td>
        </tr>
        <tr>
            <td>
                <h2>CPF</h2>
            </td>
            <td><input type="text" name="cpf" id="CPF" placeholder="Informe seu CPF (Apenas números!!!)" oninput="atualizarCampoCPF(); validarCPF(); limparAvisoCPF();">
                <div id="cpfWarning" style="color: red;"></div>
            </td>
        </tr>
        <tr>
            <td>
                <h2>Senha</h2>
            </td>
            <td><input type="password" name="senha" placeholder="Informe sua Senha"></td>
        </tr>
    </table>
    <input type="submit" name="logButton" value="Login" class="account-button2">
</form>
<a href="?page=index" class="menu-button2">Voltar</a>
<script src="../../JavaScript/cpf.js"></script>