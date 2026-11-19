
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
    $idSerie = mysqli_insert_id($conexao);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado ? $idSerie : false;
}

function inserirEpisodios($idSerie, $quantidade) {

    $conexao = conectarBD();

    $sql = "INSERT INTO episodios (serie_id, numero, titulo, duracao)
            VALUES (?, ?, ?, ?)";

    $consulta = mysqli_prepare($conexao, $sql);

    $duracao = 45; // duração padrão, em minutos

    for ($i = 1; $i <= $quantidade; $i++) {
        $titulo = "Episódio $i";
        mysqli_stmt_bind_param($consulta, "iisi", $idSerie, $i, $titulo, $duracao);
        mysqli_stmt_execute($consulta);
    }

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);
}

#consultar episodios de uma serie
function consultarEpisodios($idSerie) {

    $conexao = conectarBD();

    $sql = "SELECT * FROM episodios WHERE serie_id = ? ORDER BY numero";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "i", $idSerie);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);
    $episodios = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $episodios;
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

#verificar se um conteudo ja e favorito
function verificarFavorito($usuarioId, $tipo, $conteudoId) {

    $conexao = conectarBD();

    $sql = "SELECT id FROM favoritos WHERE usuario_id = ? AND tipo = ? AND conteudo_id = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "isi", $usuarioId, $tipo, $conteudoId);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);
    $existe = mysqli_fetch_assoc($resultado) ? true : false;

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $existe;
}

#adicionar favorito
function adicionarFavorito($usuarioId, $tipo, $conteudoId) {

    $conexao = conectarBD();

    $sql = "INSERT IGNORE INTO favoritos (usuario_id, tipo, conteudo_id) VALUES (?, ?, ?)";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "isi", $usuarioId, $tipo, $conteudoId);
    $resultado = mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado;
}

#remover favorito
function removerFavorito($usuarioId, $tipo, $conteudoId) {

    $conexao = conectarBD();

    $sql = "DELETE FROM favoritos WHERE usuario_id = ? AND tipo = ? AND conteudo_id = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "isi", $usuarioId, $tipo, $conteudoId);
    $resultado = mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado;
}

#listar favoritos de um usuario (series e filmes juntos)
function consultarFavoritos($usuarioId) {

    $conexao = conectarBD();

    $sql = "SELECT 'serie' AS tipo, s.id, s.titulo, s.imagem AS capa, s.genero, f.data_cadastro
            FROM favoritos f
            JOIN series s ON f.tipo = 'serie' AND f.conteudo_id = s.id
            WHERE f.usuario_id = ?
            UNION ALL
            SELECT 'filme' AS tipo, fi.id, fi.titulo, fi.capa AS capa, fi.genero, f.data_cadastro
            FROM favoritos f
            JOIN filmes fi ON f.tipo = 'filme' AND f.conteudo_id = fi.id
            WHERE f.usuario_id = ?
            ORDER BY data_cadastro DESC";

    $consulta = mysqli_prepare($conexao, $sql);
    mysqli_stmt_bind_param($consulta, "ii", $usuarioId, $usuarioId);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);
    $favoritos = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $favoritos;
}

#salvar ou atualizar a nota de um usuario
function salvarAvaliacao($usuarioId, $tipo, $conteudoId, $nota) {

    $conexao = conectarBD();

    $sql = "INSERT INTO avaliacoes (usuario_id, tipo, conteudo_id, nota)
            VALUES (?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE nota = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "isiii", $usuarioId, $tipo, $conteudoId, $nota, $nota);
    $resultado = mysqli_stmt_execute($consulta);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $resultado;
}

#nota que o usuario deu (0 se ainda nao avaliou)
function consultarNotaUsuario($usuarioId, $tipo, $conteudoId) {

    $conexao = conectarBD();

    $sql = "SELECT nota FROM avaliacoes WHERE usuario_id = ? AND tipo = ? AND conteudo_id = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "isi", $usuarioId, $tipo, $conteudoId);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);
    $linha = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return $linha ? (int)$linha['nota'] : 0;
}

#media e quantidade de avaliacoes de um conteudo
function consultarMediaAvaliacao($tipo, $conteudoId) {

    $conexao = conectarBD();

    $sql = "SELECT AVG(nota) AS media, COUNT(*) AS total FROM avaliacoes WHERE tipo = ? AND conteudo_id = ?";
    $consulta = mysqli_prepare($conexao, $sql);

    mysqli_stmt_bind_param($consulta, "si", $tipo, $conteudoId);
    mysqli_stmt_execute($consulta);

    $resultado = mysqli_stmt_get_result($consulta);
    $linha = mysqli_fetch_assoc($resultado);

    mysqli_stmt_close($consulta);
    mysqli_close($conexao);

    return [
        "media" => $linha['total'] > 0 ? round($linha['media'], 1) : null,
        "total" => (int)$linha['total']
    ];
}

?>
