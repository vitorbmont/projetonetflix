<?php

require_once __DIR__ . "/funcoesBD.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['inputEmail'];
    $senha = $_POST['inputSenha'];
    $confirmarSenha = $_POST['inputConfirmarSenha'];

    // Verifica se as senhas são iguais
    if ($senha !== $confirmarSenha) {
        die("As senhas não coincidem. <a href='../redefinirsenha.php'>Voltar</a>");
    }

    // Verifica o tamanho da senha
    if (strlen($senha) < 8) {
        die("A senha precisa ter pelo menos 8 caracteres. <a href='../redefinirsenha.php'>Voltar</a>");
    }

    $conexao = conectarBD();

    // Verifica se o e-mail existe
    $sql = "SELECT id FROM usuarios WHERE email = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "s", $email);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);
    $usuario = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($consulta);

    if (!$usuario) {
        mysqli_close($conexao);
        die("E-mail não encontrado. <a href='../redefinirsenha.php'>Voltar</a>");
    }

    // Criptografa a nova senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Atualiza a senha
    $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "ss", $senhaHash, $email);
    mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    header("Location: ../loginUsuario.php?senha=atualizada");
    exit;
}
