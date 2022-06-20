#!/bin/bash

# variables base de datos
user="debianDB"
password="debianDB"
sql="time_track"
data="time_track.sql"

# permisos
#### COMPROBAR el html esta borrado ####
ln -s proyecto/public/ ../html
chown -R www-data:www-data /var/www/html
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Ahora vamos a precompilar todas las vistas de Blade:
# php artisan view:cache

echo Crear base de datos
sleep 2s
mysqladmin -u $user -p$password create $sql
mysql -u $user -p$password  $sql < database/$data
echo Creada e importada base de datos
sleep 2s

# copiar y renombrar env
echo renombrar env.example por env y copiar
sleep 2s
sudo cp .env.example .env
php artisan key:generate

sudo php artisan storage:link
sudo php artisan config:clear
sudo php artisan cache:clear
sudo php artisan livewire:publish --assets
sudo php artisan key:generate
sudo systemctl reload apache2

echo composer install y npm install
sleep 2s
composer install -n

npm install -y
echo finish
sleep 2s

# copiando archivo necesario para la ruta de url
echo copiando archivo necesario para la ruta de url
sleep 2s

sudo rm -rf /etc/apache2/sites-available/000-default.conf
sudo cp 000-default.conf /etc/apache2/sites-available/
sudo a2enmod rewrite
sudo systemctl restart apache2
