<?php
$servername = "localhost";
$username   = "elemax_app";
$password   = "CONFIGURAR_SENHA";
$schema     = "eletrodomesticos";

$conexao = new mysqli($servername, $username, $password, $schema, 3306);

if ($conexao->connect_error) {
    die("Falha na conexão com o banco de dados.");
}

$conexao->set_charset("utf8mb4");
?>