# SAC – Sistema de Administración de Correspondencia

### 1. Descripción del proyecto

SAC es un sistema web desarrollado con Yii Framework 2, orientado a la administración y seguimiento de correspondencia institucional.

El sistema permite gestionar documentos, hojas de ruta, derivaciones, usuarios y otros procesos relacionados con la correspondencia.

### 2. Tecnologías utilizadas

| **Tecnología / Herramienta** | **Versión / Descripción**    |
|:-----------------------------|:-----------------------------|
| **PHP**                      | 7.4.33                    |
| **Yii Framework**            | Yii2                         |
| **PostgreSQL**               | 17                           |
| **Docker**                   | Contenedores para desarrollo |
| **Apache**                   | Apache/2.4.54


### 3. Requisitos previos

3. Requisitos previos

* Para instalar el proyecto se requiere:
* PHP compatible con las dependencias del proyecto.
* Apache con el módulo de reescritura habilitado, si se utilizan URLs amigables.
* PostgreSQL.
* Composer.
* Extensiones PHP necesarias, incluyendo pdo_pgsql y las requeridas por Yii2.
* Git.
* Docker y Docker Compose, si se utiliza la instalación mediante contenedores.

Las versiones exactas deben verificarse en composer.json, Dockerfile y la configuración del servidor.


### 4. Descargar el proyecto
Clonar el repositorio:

```bash
git clone https://github.com/acanqui/sacv2.git
```
Ingresar al directorio:

```bash
cd sacv2
```

### 5. Instalar dependencias PHP
Ejecutar:

```bash
composer install
```
Este comando instalará las dependencias declaradas en composer.lock, incluyendo Yii2 y los paquetes adicionales del sistema.


### 6. Configuración de PostgreSQL
### 6.1. Crear la base de datos

Crear una base de datos para el sistema:

```bash
CREATE DATABASE sac;
```

La estructura de tablas, funciones, triggers y demás objetos debe restaurarse mediante un respaldo o las migraciones oficiales del proyecto.

**Nota:** el repositorio no debe incluir respaldos de producción con datos institucionales.

### 6.2. Configurar la conexión

Crear el archivo:

**config/db.php**

Ejemplo de configuración:

```bash
<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host=localhost;port=5432;dbname=sac',
    'username' => 'USUARIO_BD',
    'password' => 'CONTRASENA_BD',
    'charset' => 'utf8',
];
```

Reemplazar los datos de conexión según el entorno.

Si PostgreSQL se ejecuta en otro servidor o contenedor, modificar host y port según corresponda.

**Seguridad:** el archivo config/db.php contiene credenciales y está excluido del repositorio mediante .gitignore.

Se recomienda mantener un archivo config/db.example.php con valores ficticios como plantilla.

### 7. Instalación mediante Docker

El proyecto incluye archivos de configuración Docker.

Desde la raíz del proyecto, ejecutar:

```bash
docker compose up -d --build
```
Verificar los contenedores:
```bash
docker compose ps
```
Consultar los registros de ejecución:
```bash
docker compose logs
```

Los puertos, volúmenes y servicios disponibles dependen de la configuración de docker-compose.yml.

Si PostgreSQL se ejecuta en el equipo anfitrión y la aplicación PHP dentro de Docker, puede ser necesario configurar un host accesible desde el contenedor, como host.docker.internal en entornos compatibles.

### 8. Instalación sin Docker

1. Instalar PHP, Apache, PostgreSQL y Composer.
2. Clonar el repositorio.
3. Ejecutar composer install.
4. Crear y configurar config/db.php.
5. Restaurar la base de datos o ejecutar las migraciones correspondientes.
6. Configurar el VirtualHost de Apache para que el directorio público sea web/.
7. Habilitar los permisos de escritura necesarios para runtime/ y web/assets/.
8. Iniciar Apache y verificar el funcionamiento del sistema.

Importante: la raíz pública de Apache debe apuntar al directorio web/, no a la raíz completa del proyecto.

### 9. Estructura del proyecto
```bash
sac/
├── assets/
├── commands/
├── config/
├── controllers/
├── mail/
├── models/
├── runtime/
├── tests/
├── views/
├── web/
├── widgets/
├── composer.json
├── composer.lock
├── Dockerfile
├── docker-compose.yml
└── README.md
```

### 10. Seguridad

10. Seguridad

* No subir credenciales de conexión a PostgreSQL.
* No publicar respaldos con información institucional.
* Mantener excluidos los directorios temporales y las dependencias instaladas.
* Utilizar usuarios de base de datos con permisos adecuados.
* Configurar credenciales diferentes para desarrollo y producción.
* Evitar mostrar información técnica sensible en los mensajes de error del entorno de producción.


### 11. Repositorio

**GitHub: https://github.com/acanqui/sacv2**

### 12. Mantenimiento
Las modificaciones al sistema deben realizarse mediante control de versiones Git.

Antes de aplicar cambios en producción, se recomienda probarlos en un entorno de desarrollo y respaldar la base de datos.

**Estado de documentación:** pendiente de completar las versiones exactas del entorno y los procedimientos específicos de restauración de la base de datos.









