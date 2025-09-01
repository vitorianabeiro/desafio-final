<?php
include 'conexao.php'; // conexão com o banco
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Cadastro de Usuários</h1>

    <!-- Formulário em HTML -->
    <form action="index.php" method="POST">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">E-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit" name="cadastrar">Cadastrar</button>
    </form>

    <hr>

    <!-- Aqui listamos os usuários cadastrados -->
    <h2>Usuários cadastrados</h2>
    <ul>
        <?php
        // Exibe registros já salvos
        $sql = "SELECT nome, email FROM usuarios ORDER BY id DESC";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>" . $row['nome'] . " - " . $row['email'] . "</li>";
            }
        } else {
            echo "<li>Nenhum usuário cadastrado ainda.</li>";
        }
        ?>
    </ul>

</body>
</html>

<?php
// Processa os dados enviados pelo formulário
if (isset($_POST['cadastrar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    $sql = "INSERT INTO usuarios (nome, email) VALUES ('$nome', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p>Cadastro realizado com sucesso!</p>";
        // recarrega a página para mostrar o novo usuário
        header("Refresh:0");
    } else {
        echo "<p>Erro: " . $conn->error . "</p>";
    }
}
?>
