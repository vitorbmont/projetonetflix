<?php

session_start();

require_once __DIR__ . "/funcoesBD.php";

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Acesso inválido!");
}

// Recebe os dados do formulário
$tipo = $_POST['tipo'] ?? '';
$titulo = trim($_POST['titulo'] ?? '');
$sinopse = trim($_POST['sinopse'] ?? '');
$genero = trim($_POST['genero'] ?? '');
$ano = $_POST['ano'] ?? '';
$classificacao = $_POST['classificacao'] ?? '';
if (!isset($_SESSION['id_moderador'])) {
    die("Apenas moderadores podem cadastrar. <a href='../loginModerador.php'>Fazer login</a>");
}
$moderador_id = (int)$_SESSION['id_moderador'];

// Verifica os campos obrigatórios
if (
    empty($tipo) ||
    empty($titulo) ||
    empty($sinopse) ||
    empty($genero) ||
    empty($ano) ||
    empty($classificacao)
) {
    die("Preencha todos os campos!");
}

// Verifica se uma imagem foi enviada
if (!isset($_FILES['imagem']) || $_FILES['imagem']['error'] != UPLOAD_ERR_OK) {
    die("Erro ao enviar a imagem!");
}

// Limite de 5 MB
if ($_FILES['imagem']['size'] > 5 * 1024 * 1024) {
    die("A imagem deve ter no máximo 5 MB!");
}

// Verifica o tipo real do arquivo
$tiposPermitidos = [
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'image/webp' => 'webp'
];

$arquivoTemporario = $_FILES['imagem']['tmp_name'];

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$tipoImagem = finfo_file($finfo, $arquivoTemporario);
finfo_close($finfo);

if (!isset($tiposPermitidos[$tipoImagem])) {
    die("Formato inválido! Envie JPG, PNG ou WEBP.");
}

// Gera um nome único para a imagem
$extensao = $tiposPermitidos[$tipoImagem];
$nomeImagem = bin2hex(random_bytes(12)) . "." . $extensao;

// Caminho da pasta img na raiz do projeto
$pastaImagens = dirname(__DIR__) . "/img/";

// Verifica se a pasta existe
if (!is_dir($pastaImagens)) {
    die("A pasta de imagens não foi encontrada!");
}

// Move a imagem para a pasta img
$caminhoImagem = $pastaImagens . $nomeImagem;

if (!move_uploaded_file($arquivoTemporario, $caminhoImagem)) {
    die("Não foi possível salvar a imagem!");
}


// CADASTRO DE FILME
if ($tipo == "filme") {

    $duracao = $_POST['duracao'] ?? '';
    $resultado = inserirFilme(
        $titulo,
        $sinopse,
        $genero,
        $ano,
        (int)$duracao,
        $classificacao,
        $nomeImagem,
        $moderador_id
    );

} elseif ($tipo == "serie") {

    $episodios = (int)($_POST['episodios'] ?? 0);

    if ($episodios < 1) {
        unlink($caminhoImagem);
        die("A série precisa ter pelo menos 1 episódio!");
    }

    $resultado = inserirSerie($titulo, $sinopse, $genero, $ano, $episodios, $classificacao, $nomeImagem, $moderador_id);

    if ($resultado) {
        inserirEpisodios($resultado, $episodios);
    }

} else {

    unlink($caminhoImagem);
    die("Tipo de conteúdo inválido!");

}


// Verifica o resultado
if ($resultado) {

    echo "Cadastro realizado com sucesso!";

} else {

    // Remove a imagem caso o cadastro no banco falhe
    if (file_exists($caminhoImagem)) {
        unlink($caminhoImagem);
    }

    echo "Erro ao cadastrar o conteúdo!";

}

?>
 