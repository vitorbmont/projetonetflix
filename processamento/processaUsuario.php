<?php

session_start();

require_once __DIR__ . "/funcoesBD.php";

// CADASTRO
if (!empty($_POST['inputNome']) && !empty($_POST['inputSobrenome']) &&
    !empty($_POST['inputEmail']) && !empty($_POST['inputNascimento']) &&
    !empty($_POST['inputSenha']) && !empty($_POST['inputConfirmarSenha'])) {

    $nome = $_POST['inputNome'];
    $sobrenome = $_POST['inputSobrenome'];
    $email = $_POST['inputEmail'];
    $dtNascimento = $_POST['inputNascimento'];
    $senha = $_POST['inputSenha'];

    if ($senha != $_POST['inputConfirmarSenha']) {
        die("As senhas não coincidem! <a href='../cadastro.php'>Voltar</a>");
    }

    if (strlen($senha) < 8) {
        die("A senha precisa ter pelo menos 8 caracteres. <a href='../cadastro.php'>Voltar</a>");
    }

    if (consultarUsuario($email)) {
        die("Este e-mail já está cadastrado! <a href='../cadastro.php'>Voltar</a>");
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    if (inserirUsuario($nome, $sobrenome, $email, $dtNascimento, $senhaHash)) {
        header("Location: ../loginUsuario.php?cadastro=ok");
        exit;
    }

    die("Erro ao realizar cadastro! <a href='../cadastro.php'>Voltar</a>");

// LOGIN
} elseif (!empty($_POST['email']) && !empty($_POST['senha'])) {

    $usuario = consultarUsuario($_POST['email']);

    if ($usuario && password_verify($_POST['senha'], $usuario['senha'])) {

        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome_usuario'] = $usuario['nome'];

        header("Location: ../principal.php");
        exit;
    }

    header("Location: ../loginUsuario.php?erro=1");
    exit;

} else {
    die("Preencha todos os campos! <a href='../loginUsuario.php'>Voltar</a>");
}