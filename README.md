# ZIO

_ZIO es una plataforma cuyo objetivo se basa en ceder a los usuarios un entorno al que subir sus fotografías._


## Comenzando 🚀

_Estas instrucciones te permitirán obtener una copia del proyecto en funcionamiento en tu máquina local para propósitos de desarrollo y pruebas._

Mira **Despliegue** para conocer como desplegar el proyecto.


### Pre-requisitos 📋

_Contar con lo siguiente instalado en tu sistema_

* NPM
* Composer


### Instalación 🔧

_Una vez se tenga clonado el proyecto deberá realizar los siguientes comandos sobre su directorio para instalar las dependencias_

```
composer install
```

```
npm install
```

_Hecho esto deberá duplicar el archivo **.env.example**, renombrarlo como **.env** e incluir los datos de conexión de la base de datos_

-EJ-
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=proyecto_ziobd
DB_USERNAME=root
DB_PASSWORD=
```

_Generamos una clave para el archivo .env_

```
php artisan key:generate
```

_Y por último ejecutamos las migraciones para que se generen las tablas_

```
php artisan migrate
```

## Ejecutando las pruebas ⚙️

_Para ejecutar el seeder y poblar las tablas para pruebas escribimos lo siguiente_

```
php artisan migrate:fresh --seed
```

## Despliegue 📦

_Como hacer deploy_


## Construido con 🛠️

* [Laravel](https://laravel.com/) - Framework del lado servidor
* [Vue](https://vuejs.org/) - Framework del lado cliente
* [XAMPP](https://www.apachefriends.org/es/index.html) - Usado para sustentar la BD y realizar las pruebas con la aplicación desplegada


## Autores ✒️

* **Jesús Sánchez Rodríguez** - [Jesus-RuizGijon](https://github.com/Jesus-RuizGijon)
* **José Antonio Sánchez Andrades** - [josansa02](https://github.com/josansa02)
