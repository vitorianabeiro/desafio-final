# Playbook de Provisionamento LAMP no Ubuntu Server

Este documento contém a lista completa de comandos para configurar um ambiente LAMP (Linux, Apache, MariaDB/MySQL, PHP) no Ubuntu Server, partindo do zero, incluindo diferenças em relação ao Amazon Linux.

## 1. Atualizar o sistema
```
sudo apt update && sudo apt upgrade -y
```
> Amazon Linux: sudo dnf update -y ou sudo yum update -y

## 2. Instalar Apache
```
sudo apt install apache2 -y
sudo systemctl enable apache2
sudo systemctl start apache2
sudo systemctl status apache2
```
> Amazon Linux: sudo dnf install httpd -y
> sudo systemctl enable httpd
> sudo systemctl start httpd

## 3. Instalar MariaDB
```
sudo apt install mariadb-server mariadb-client -y
sudo systemctl enable mariadb
sudo systemctl start mariadb
sudo systemctl status mariadb
sudo mysql_secure_installation
```
> Amazon Linux: sudo dnf install mariadb-server -y

## 4. Instalar PHP
```
sudo apt install php libapache2-mod-php php-mysql -y
php -v
```
> Amazon Linux: sudo dnf install php php-mysqlnd -y
> sudo systemctl restart httpd

## 5. Configurar permissões da pasta do projeto
```
sudo mkdir -p /var/www/html/desafio_final
sudo chown -R $USER:$USER /var/www/html/desafio_final
sudo chmod -R 755 /var/www/html/desafio_final
```

## 6. Criar database, usuário e senha, e conceder permissoes
```
sudo mariadb
CREATE DATABASE desafio;
CREATE USER 'sisd'@'localhost' IDENTIFIED BY 'senha';
GRANT ALL PRIVILEGES ON desafio.* TO 'sisd'@'localhost';
EXIT;
```

## 7. Criar estrutura de arquivos
```
cd /var/www/html/desafio_final
sudo nano index.php
```
Dentro do arquivo PHP adicone:
```
<?php
echo "Desafio Final LAMP funcionando!";
?>
```

## 8. Configurar conexão com banco
```
sudo nano conexao.php
```
Dentro do arquivo PHP adicone:
```
<?php
$servername = "localhost";
$username = "sisd";
$password = "senha";
$dbname = "desafio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Conexão falhou: " . $conn->connect_error);
}
echo "Conexão bem-sucedida!";
?>
```

## 9. Criar tabelas do banco
```
sudo mariadb
USE desafio;
CREATE TABLE  clientes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  telefone VARCHAR(20)
);
EXIT;
```

## 10. Testar inserção e leitura de dados
```
sudo nano teste_db.php
```
Dentro do arquivo PHP adicone:
```
<?php
include 'conexao.php';

$sql = "INSERT INTO clientes (nome, email, telefone) VALUES ('Viória', 'vitoria@gmail.com', '11999999999')";

if ($conn->query($sql) === TRUE) {
  echo "Novo registro inserido com sucesso";
} else {
  echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
```

## 11. Finalizando
Sempre que criar ou editar PHP, reinicie o Apache:
```
sudo systemctl restart apache2
```

## Observações e diferenças entre Amazon Linux e Ubuntu Server

- Gerenciador de pacotes:  
  - Ubuntu: `apt`  
  - Amazon Linux: `dnf` ou `yum`

- Apache:  
  - Ubuntu: pacote `apache2`, serviço `apache2`  
  - Amazon Linux: pacote `httpd`, serviço `httpd`

- PHP integrado ao Apache:  
  - Ubuntu: pacote `libapache2-mod-php`, depois reiniciar `apache2`  
  - Amazon Linux: pacote `php`, depois reiniciar `httpd`

- MariaDB/MySQL:  
  - Ubuntu: `mariadb-server mariadb-client`  
  - Amazon Linux: `mariadb-server`

- Comandos de atualização do sistema:  
  - Ubuntu: `sudo apt update && sudo apt upgrade -y`  
  - Amazon Linux: `sudo dnf update -y` ou `sudo yum update -y`
