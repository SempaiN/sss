Aplicaciones necesarias: servicio Apache, BBDD MySQL, composer, npm
Lo primero que debemos hacer es activar Apache y la BBDD. Seguido de esto deberemos abrir el proyecto y correr el comando composer install.
Hecho esto deberemos seguir una serie de comandos en este orden
    - npm install
    - php artisan migrate para crear las tablas 
    - php artisan db:seed para añadir datos a la BBDD
    - npm run dev y en otra terminal php artisan serve

Por último para acceder a la página utilizaremos el puerto 8000

La contraseña de todos los usuarios será password
