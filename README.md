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

## 6. Criar arquivos básicos
```
cd /var/www/html/desafio_final
echo "" > index.php
echo "body { font-family: Arial, sans-serif; }" > style.css
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
