<?php
session_start();
include("conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nome']));
$usuario = mysqli_real_escape_string($conexao, trim($_POST['usuario']));
$senha = mysqli_real_escape_string($conexao, trim(md5($_POST['senha'])));
$biografia = mysqli_real_escape_string($conexao, trim($_POST['biografia']));
$genero = mysqli_real_escape_string($conexao, trim($_POST['genero']));
$maioridade = mysqli_real_escape_string($conexao, trim($_POST['maioridade']));

$sql = "select count(*) as total from usuario where usuario = '$usuario'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);


if ($row['total'] == 1) {
    $_SESSION['usuario_existe'] = true;
    header('Content-Type: application/json; charset=utf-8');
    $conexao->close();
    echo json_encode($_SESSION);
    exit;
}

$sql = "INSERT INTO usuario (nome, usuario, senha, biografia, data_cadastro, genero, maioridade) VALUES ('$nome', '$usuario', '$senha', '$biografia', NOW(), '$genero', '$maioridade')";

if($conexao->query($sql) === true) {
    $_SESSION['status_cadastro'] = true;
}

$conexao->close();

header('Content-Type: application/json; charset=utf-8');
echo json_encode($_SESSION);
exit;
?>