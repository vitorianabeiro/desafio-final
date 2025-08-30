<?php
include 'conexao.php';

$sql = "INSERT INTO clientes (nome, email, telefone) VALUES ('Vitória', 'vitoria@example.com', '11999999999')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro inserido com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
