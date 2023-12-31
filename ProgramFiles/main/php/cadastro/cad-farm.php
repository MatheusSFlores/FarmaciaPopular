 <?php

    $indexForm = true;
    include('config/database.php');
    include('php/Dao/UsuarioDAO.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<script>
            var cpfValido = validarCPF("' . $_POST["cpf"] . '");
            var emailValido = validarEmail("' . $_POST["email"] . '");
            var senhaValida = validarSenha("' . $_POST["senha1"] . '");

            if (!cpfValido || !emailValido || !senhaValida) {
                alert("Por favor, corrija os campos antes de enviar o formulário.");
                return false;
            }
         </script>';
        $dados = array(
            "nome" => $_POST["nome"],
            "cpf_cnpj" => $_POST["cnpj"],
            "idade" => 0,
            "endereco" => $_POST["endereco"],
            "email" => $_POST["email"],
            "permissao" => 4,
            "senha" => $_POST["senha1"]
        );


        $usuarioDAO = new UsuarioDAO;
        $usuarioDAO->cadastro($dados);
        header('Location: index.php');
        exit;
    }
    if ($indexForm) { ?>
     <form action="" method="post" class="password-form" data-tipo-formulario="farmacia" onsubmit="return onSubmitForm(this); validarCPF(document.getElementById('cpf').value); limparAvisoCPF();">
         <p>
         <h1>Cadastro de Farmacias</h1>
         </p>
         <table>
             <input type="hidden" name="funcao" value="cadastrar-farma">
             <td>
                 <tr>
                     <td>
                         <h2>Nome</h2>
                     </td>
                     <td><input type="text" name="nome" placeholder="Informe o nome"></td>
                 </tr>
                 <tr>
                     <td>
                         <h2>Endereço</h2>
                     </td>
                     <td><input type="text" name="endereco" placeholder="Informe o endereço"></td>
                 </tr>
                 <tr>
                     <td>
                         <h2>Email</h2>
                     </td>
                     <td><input type="text" name="email" id="email" placeholder="Informe seu Email" oninput="showSuggestions()">
                         <div id="suggestions"></div>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         <h2>CNPJ</h2>
                     </td>
                     <td><input type="text" name="cnpj" id="CPF" placeholder="Informe seu CNPJ (Apenas números!!!)" oninput="atualizarCampoCPF(); validarCPF(); limparAvisoCPF();">
                         <div id="cpfWarning" style="color: red;"></div>
                     </td>
                 </tr>
                 <tr>
                     <td>
                         <h2>Senha</h2>
                     </td>
                     <td><input type="password" name="senha1" id="senha1" placeholder="Crie uma senha"></td>
                     <td>
                 </tr>
                 <tr>
                     <td>
                         <h2>Senha</h2>
                     </td>
                     <td><input type="password" name="senha2" id="senha2" placeholder="Confirme sua senha">
                     </td>
                 </tr>
             </td>
             <input type="hidden" id="tipoFormulario" name="tipoFormulario" value="farmacia">
         </table>
         <p class="password-error" style="color: red;"></p>
         <input type="submit" name="cadButton" value="Cadastrar" class="account-button2">
     </form>
 <?php } ?>

 <a href="?page=cadastro" class="menu-button2">Voltar</a>

 <script src="../../js/funcao/cpf.js"></script>
 <script src="../../js/funcao/email.js"></script>
 <script src="../../js/funcao/senha.js"></script>
 <script src="../../js/funcao/onsubmit.js"></script>
 <script src="../../js/funcao/validar-farm.js"></script>