<?php
$servername = "localhost";
$username   = "elemax_app";
$password   = "SUA_SENHA_LOCAL";
$schema     = "eletrodomesticos";

$conexao = mysqli_connect($servername, $username, $password, $schema);

if (!$conexao) {
    die("Falha na conexão com o banco de dados.");
}

mysqli_set_charset($conexao, "utf8mb4");
?>