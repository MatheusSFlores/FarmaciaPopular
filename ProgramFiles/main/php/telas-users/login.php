<?php
require_once(__DIR__ . '/../../config/database.php');
require_once(__DIR__ . '/../util/functionsLogin.php');
// include ('php/util/functionsLogin.php');
session_start();
if (isset($_POST['email']) || isset($_POST['senha'])) {
    header('../util/functionsLogin.php');
}
?>


<form action="" method="post">
    <table>
        <input type="hidden" name="action" value="login">
        <p>
        <h1>Login</h1>
        </p>
        <tr>
            <td>
                <h2>Email</h2>
            </td>
            <td>
                <input type="text" name="email" id="email" placeholder="Informe seu Email">
            </td>
        </tr>
        <tr>
            <td>
                <h2>Senha</h2>
            </td>
            <td>
                <input type="password" name="senha" placeholder="Informe sua Senha">
            </td>
        </tr>
    </table>
    <input type="submit" name="logButton" value="Login" class="account-button2">
</form>
<a href="?page=index" class="menu-button2">Voltar</a>
<script src="../../JavaScript/cpf.js"></script>