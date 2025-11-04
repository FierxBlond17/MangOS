Despliegue del Proyecto con Docker

Este proyecto utiliza Docker y Docker Compose para levantar automáticamente el entorno necesario con PHP 8.2 + Apache y MariaDB 11.

Requisitos Previos

Antes de comenzar, asegurate de tener instaladas las siguientes herramientas:

Docker → https://docs.docker.com/get-docker/

Docker Compose → https://docs.docker.com/compose/install/

Podés comprobar si están instaladas ejecutando en la terminal:

docker -v
docker compose version

Estructura del Proyecto
MangOS/
│
├── Dockerfile
├── docker-compose.yml
├── proyutu.sql                # Script SQL para crear la base de datos
└── mini-framework/            # Código fuente del proyecto

Archivos Principales
Dockerfile

Este archivo define la imagen del contenedor de la aplicación PHP + Apache:

Usa php:8.2-apache como base.

Instala las extensiones necesarias (mysqli, pdo, pdo_mysql).

Activa mod_rewrite (necesario para rutas limpias).

Define /var/www/html como directorio de trabajo.

docker-compose.yml

Define dos servicios:

app → contenedor PHP + Apache.

db → contenedor MariaDB.

Ambos se comunican en una red llamada mangos_net.

Cómo levantar el entorno

Desde la raíz del proyecto (MangOS/), ejecutá:

docker compose up -d --build


Esto:

Construirá la imagen de la app a partir del Dockerfile.

Creará los contenedores mangos_app y mangos_db.

Configurará la base de datos proyutu con el usuario proyutu y la contraseña 12345678.

Importar la Base de Datos

Si tu archivo proyutu.sql contiene la estructura y datos iniciales, podés importarlo fácilmente:

Copiá el archivo dentro del contenedor de la base de datos:

docker cp proyutu.sql mangos_db:/proyutu.sql


Entrá al contenedor de la base de datos:

docker exec -it mangos_db bash


Importá el script:

mysql -u root -p proyutu < /proyutu.sql


(La contraseña es root.)

Salí del contenedor:

exit

Acceder a la Aplicación

Una vez levantado todo, abrí tu navegador y visitá:

http://localhost:8080

Comandos Útiles
Acción	Comando
Ver logs de la app	docker logs mangos_app
Ver logs de la DB	docker logs mangos_db
Apagar contenedores	docker compose down
Reconstruir todo	docker compose up -d --build
Acceder al contenedor de la app	docker exec -it mangos_app bash
Acceder al contenedor de la DB	docker exec -it mangos_db bash
Notas

El proyecto PHP está montado en /var/www/html dentro del contenedor, por lo que cualquier cambio local se refleja automáticamente sin necesidad de reconstruir.

Si ocurre un error de permisos, podés solucionarlo ejecutando:

sudo chmod -R 777 .
