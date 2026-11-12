<?php

//Cadastro de usuario fatecflix

require_once "funcoesBD.php";

if (!empty($_POST['inputNome']) && !empty($_POST['inputSobrenome']) &&
    !empty($_POST['inputEmail']) && !empty($_POST['inputNascimento']) &&
    !empty($_POST['inputSenha']) && !empty($_POST['inputConfirmarSenha'])){

    $nome = $_POST['inputNome'];
    $sobrenome = $_POST['inputSobrenome'];
    $email = $_POST['inputEmail'];
    $dtNascimento = $_POST['inputNascimento'];
    $senha = $_POST['inputSenha'];
    $confirmarsenha = $_POST['inputConfirmarSenha'];

    if ($senha != $confirmarsenha) {
        die("As senhas não coincidem!");
    }

    // Criptografa a senha
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o usuário no banco
    if (inserirUsuario($nome, $sobrenome, $email, $dtNascimento, $senha)) {

        echo "Cadastro realizado com sucesso!";

    } else {

        echo "Erro ao realizar cadastro!";

    }

} else {

    echo "Preencha todos os campos!";

}



?>