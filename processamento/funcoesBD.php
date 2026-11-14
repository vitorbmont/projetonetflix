
<?php

function conectarBD() {

    $conexao = mysqli_connect(
        "localhost",
        "root",
        "",
        "fatecflix_bd"
    );

    if (!$conexao) {
        die("Erro ao conectar com o banco de dados: " . mysqli_connect_error());
    }

    return $conexao;
}


function inserirUsuario($nome, $sobrenome, $email, $nascimento, $senha) {

    $conexao = conectarBD();

    $sql = "INSERT INTO usuarios
            (nome, sobrenome, email, data_nascimento, senha)
            VALUES (?, ?, ?, ?, ?)";

    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $consulta,
        "sssss",
        $nome,
        $sobrenome,
        $email,
        $nascimento,
        $senha
    );

    $resultado = mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado;
}

function consultarUsuario($email) {

    $conexao = conectarBD();

    $sql = "SELECT * FROM usuarios WHERE email = ?";

    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "s", $email);

    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);

    $usuario = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $usuario;
}

?>
