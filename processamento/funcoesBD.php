
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

#cadastro de usuario
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
#cadstrar moderador
function cadastroModerador($nome, $email, $senha) {

    $conexao = conectarBD();

    $sql = "INSERT INTO moderadores (nome, email, senha)
            VALUES (?, ?, ?)";

    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $consulta,
        "sss",
        $nome,
        $email,
        $senha
    );

    $resultado = mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado;
}

#login de mod
function consultarModerador($email) {
    $conexao = conectarBD();

    $sql = "SELECT * FROM moderadores WHERE email = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "s", $email);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);
    $moderador = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $moderador;
}

#login de usuario
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

#cadastro de filme
function inserirFilme($titulo, $sinopse, $genero, $ano, $duracao, $classificacao, $capa, $moderador_id) {

    $conexao = conectarBD();

    $sql = "INSERT INTO filmes
            (titulo, sinopse, genero, ano_lancamento, duracao, classificacao_indicativa, capa, moderador_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $consulta,
        "ssssissi",
        $titulo,
        $sinopse,
        $genero,
        $ano,
        $duracao,
        $classificacao,
        $capa,
        $moderador_id
    );

    $resultado = mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado;
}

#cadastro de series
function inserirSerie($titulo, $sinopse, $genero, $ano, $episodios, $classificacao, $imagem, $moderador_id) {

    $conexao = conectarBD();

    $sql = "INSERT INTO series
            (titulo, sinopse, genero, ano_lancamento, qtd_episodios, classificacao_indicativa, imagem, moderador_id)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param(
        $consulta,
        "ssssissi",
        $titulo,
        $sinopse,
        $genero,
        $ano,
        $episodios,
        $classificacao,
        $imagem,
        $moderador_id
    );

    $resultado = mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado;
}

#consultar series
function consultarSeries() {

    $conexao = conectarBD();

    $sql = "SELECT * FROM series ORDER BY data_cadastro DESC";

    $consulta = mysqli_query($conexao, $sql);

    $series = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

    mysqli_close($conexao);

    return $series;
}


#consultar filmes
function consultarFilmes() {

    $conexao = conectarBD();

    $sql = "SELECT * FROM filmes ORDER BY data_cadastro DESC";

    $consulta = mysqli_query($conexao, $sql);

    $filmes = mysqli_fetch_all($consulta, MYSQLI_ASSOC);

    mysqli_close($conexao);

    return $filmes;
}

?>
