<?php
$servername = "localhost";
$username = "usuario";
$password = "senha";
$dbname = "desafio_final";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
echo "Conexão bem-sucedida!";
?>
