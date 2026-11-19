<?php

session_start();
// Cadastro e login de moderador

require_once __DIR__ . "/funcoesBD.php";

if (!empty($_POST['inputNome']) &&
    !empty($_POST['inputEmail']) &&
    !empty($_POST['inputSenha']) &&
    !empty($_POST['inputConfirmarSenha'])) {

    $nome = $_POST['inputNome'];
    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];
    $confirmarSenha = $_POST['inputConfirmarSenha'];

    if ($senha != $confirmarSenha) {
        die("As senhas não coincidem!");
    }

    // Criptografa a senha
    $senha = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o moderador no banco
    if (cadastroModerador($nome, $email, $senha)) {

        echo "Cadastro de moderador realizado com sucesso!";

    } else {

        echo "Erro ao realizar cadastro!";

    }

} elseif (!empty($_POST['email']) && !empty($_POST['senha'])) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $moderador = consultarModerador($email);

    if ($moderador && password_verify($senha, $moderador['senha'])) {

        session_regenerate_id(true);

        $_SESSION['id_moderador'] = $moderador['id'];
        $_SESSION['nome_moderador'] = $moderador['nome'];

        header("Location: ../cadastrar_filmes_E_Series.php");
        exit;

    } else {

        echo "E-mail ou senha incorretos!";

    }

} else {

    echo "Preencha todos os campos!";

}

?>
