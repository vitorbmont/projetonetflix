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

if (!empty($_POST['email']) && !empty($_POST['senha'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $usuario = consultarUsuario($email);

    if ($usuario && password_verify($senha, $usuario['senha'])) {

    session_regenerate_id(true);

    $_SESSION['id_usuario'] = $usuario['id'];
    $_SESSION['nome_usuario'] = $usuario['nome'];
    $_SESSION['email_usuario'] = $usuario['email'];

    header("Location: ../principal.php");
    exit;

} else {
    echo "E-mail ou senha incorretos!";
}

} else {

    echo "Preencha todos os campos!";

}



?>