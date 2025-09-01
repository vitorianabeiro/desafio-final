<?php include 'conexao.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuários</title>
</head>
<body>
    <h1>Usuários</h1>
    <a href="create.php">Adicionar Usuário</a>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM clientes";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['email']}</td>
                    <td>
                        <a href='update.php?id={$row['id']}'>Editar</a> | 
                        <a href='delete.php?id={$row['id']}'>Excluir</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
