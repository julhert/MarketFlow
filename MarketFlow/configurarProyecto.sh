#!/bin/bash

echo "Iniciando toda la configuración del proyecto.........."

# Aqui lo que se hace es que copia el .env para todo el
# cotorreo de las variables de entorno para la base de datos

echo "Creando los archivos .env"
if [ ! -f .env ]; then cp .env.example .env; fi

echo "Levantando los contenedores (esto puede tardar pa que no se desesperen)........"
docker compose up -d --build

echo "Instalando dependencias de Composer......."
docker exec marketflow_app composer install

echo "Generando llave de seguridad de laravel......."
docker exec marketflow_app php artisan key:generate

echo "Cambiando los permisos....."
# Backend
docker exec marketflow_app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
docker exec marketflow_app chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache


echo "Hay que esperar por que le da ansiedad....."
sleep 20

echo "Ejecutando las migraciones......."
docker exec marketflow_app php artisan migrate

echo "Y listoooooooooo"
echo "Revisa que todo haya funcionado entrando a: "
echo "Aplicación: http://localhost:8080"

# docker exec -it marketflow_container chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
# docker exec -it marketflow_container chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# En dado caso que haya fallado algo pongan este comando:
# docker compose down -v --rmi all
# Borra todo lo que se hizo con el docker compose es como el botón de panico
