#!/bin/bash

echo "Iniciando toda la configuración del proyecto.........."

# Aqui lo que se hace es que copia el .env para todo el
# cotorreo de las variables de entorno para la base de datos

if [! -f .env]; then
    echo "Archivo creado correctamente"
    cp .env.example .env
else
    echo "El archivo ya existe, el script lo va a saltar"
fi


echo "Levantando los contenedores (esto puede tardar pa que no se desesperen)........"
docker compose up -d --build

echo "Instalando dependencias de Composer......."
docker exec -it marketflow_container composer install

echo "Generando llave de seguridad de laravel......."
docker exec -it marketflow_container php artisan key:generate

echo "Hay que esperar por que le da ansiedad....."
sleep 20

echo "Ejecutando las migraciones......."
docker exec -it marketflow_container php artisan migrate

echo "Y listoooooooooo"
echo  "Revisa que todo haya funcionado entrando a: http://localhost:8080"


# En dado caso que haya fallado algo pongan este comando:
# docker compose down -v --rmi all
# Borra todo lo que se hizo con el docker compose es como el botón de panico
