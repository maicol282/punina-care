#!/bin/bash

# ==============================================================================
# SCRIPT DE INSTALACIÓN PARA PUNINA CARE EN VPS (Ubuntu 22.04 LTS)
# ==============================================================================
# Este script instala y configura:
# - Nginx, PHP 8.4, MariaDB, Composer, Node.js
# - Certificado SSL (Let's Encrypt)
# - Jitsi Meet (con autenticación interna)
# - Security Headers en Nginx
# - Configuración de firewall (UFW)
# ==============================================================================

set -e # Detener el script si hay un error

# Variables (CÁMBIALAS ANTES DE EJECUTAR)
DOMINIO="tudominio.com"
DB_PASSWORD="TuContraseñaSegura123!"
JITSI_DOMINIO="meet.tudominio.com"
JITSI_USER="doctor"
JITSI_PASSWORD="ContraseñaJitsiSegura123!"

echo "🚀 Iniciando instalación de Punina Care..."
echo "Dominio: $DOMINIO"
echo "Jitsi: $JITSI_DOMINIO"

# 1. Actualizar el sistema
echo "📦 Actualizando el sistema..."
sudo apt update && sudo apt upgrade -y

# 2. Instalar dependencias básicas
echo "📦 Instalando dependencias básicas..."
sudo apt install -y curl wget git unzip software-properties-common ufw

# 3. Instalar PHP 8.4 (usando el PPA de Ondřej Surý para tener la versión parcheada)
echo "🐘 Instalando PHP 8.4..."
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.4-fpm php8.4-mysql php8.4-xml php8.4-mbstring php8.4-curl php8.4-zip php8.4-gd php8.4-bcmath php8.4-intl

# 4. Instalar Composer
echo "🎼 Instalando Composer..."
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# 5. Instalar Node.js (para Vite)
echo "🟢 Instalando Node.js 22..."
curl -fsSL https://deb.nodesource.com/setup_22.x | sudo -E bash -
sudo apt install -y nodejs

# 6. Instalar MariaDB y configurar
echo "🗄️ Instalando MariaDB..."
sudo apt install -y mariadb-server
sudo mysql -e "CREATE DATABASE bd_historial;"
sudo mysql -e "CREATE USER 'maicol'@'localhost' IDENTIFIED BY '$DB_PASSWORD';"
sudo mysql -e "GRANT ALL PRIVILEGES ON bd_historial.* TO 'maicol'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

# 7. Instalar Nginx
echo "🌐 Instalando Nginx..."
sudo apt install -y nginx

# 8. Clonar el proyecto
echo "📂 Clonando el proyecto..."
sudo mkdir -p /var/www
cd /var/www
sudo git clone https://github.com/maicol282/punina-care.git
cd punina-care

# 9. Instalar dependencias del proyecto
echo "📦 Instalando dependencias de Laravel..."
composer install --no-dev --optimize-autoloader
npm install && npm run build

# 10. Configurar permisos
echo "🔧 Configurando permisos..."
sudo chown -R www-data:www-data /var/www/punina-care
sudo chmod -R 775 /var/www/punina-care/storage
sudo chmod -R 775 /var/www/punina-care/bootstrap/cache

# 11. Configurar Nginx (con Security Headers)
echo "⚙️ Configurando Nginx..."
sudo tee /etc/nginx/sites-available/punina-care << 'NGINX'
server {
    listen 80;
    server_name tudominio.com;
    root /var/www/punina-care/public;

    index index.php;

    # Security Headers
    add_header X-Frame-Options "SAMEORIGIN" always;
    add_header X-Content-Type-Options "nosniff" always;
    add_header Referrer-Policy "strict-origin-when-cross-origin" always;
    add_header Permissions-Policy "camera=(self https://meet.tudominio.com), microphone=(self https://meet.tudominio.com), geolocation=()" always;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.4-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
NGINX

sudo ln -s /etc/nginx/sites-available/punina-care /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl restart nginx

# 12. Configurar SSL con Certbot
echo "🔒 Configurando SSL (Let's Encrypt)..."
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d $DOMINIO --non-interactive --agree-tos --email admin@$DOMINIO

# 13. Configurar Firewall (UFW)
echo "🛡️ Configurando Firewall (UFW)..."
sudo ufw allow OpenSSH
sudo ufw allow 'Nginx Full'
sudo ufw --force enable

# 14. Instalar Jitsi Meet
echo "📹 Instalando Jitsi Meet..."
# (Aquí iría el bloque de instalación de Jitsi, que es más largo y se detalla aparte)

echo "✅ Instalación base completada."
echo "⚠️ Siguiente paso: Configurar el .env de Laravel y ejecutar las migraciones."
echo "⚠️ Luego: Instalar Jitsi Meet y configurar la autenticación interna."
