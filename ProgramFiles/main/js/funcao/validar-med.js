function validarFormMedico() {
    var nome = document.getElementById('nome').value;
    var CPF = document.getElementById('CPF').value;
    var idade = document.getElementById('idade').value;
    var endereco = document.getElementById('endereco').value;
    var email = document.getElementById('email').value;
    var senha1 = document.getElementById('senha1').value;

    if (nome === '' || CPF === '' || idade === '0' || endereco === '' || email === '' || senha1 === '') {
        alert('Por favor, preencha todos os campos obrigatórios.');
        return false;
    }
        return true;
}