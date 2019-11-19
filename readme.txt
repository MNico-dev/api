1-Ejecutar los scripts dentro de la carpeta "scripts" para la creacion de las bases de datos

2-Sobre proyecto api, ejecutar en la terminal "php artisan serve" para iniciarlo

3-Ingresar a aplicacion museum 
http://localhost/museum/public/login
e iniciar sesion con 
usuario : museo@gmail.com
password : 123456

4-Luego ir a seccion de "Cuadros" e iniciar sesion para conectarse a la api y administrar el recurso "cuadro" con
usuario : api@gmail.com
password: 123456

Para buscador de cuadros utilizar postman por ejemplo
Ej 127.0.0.1:8000/api/buscarCuadros?filter['id']=2&fields=painter,name

Realizado con 
Laravel version 5.7 
PHP >= 7.1.3
