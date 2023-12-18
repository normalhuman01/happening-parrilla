# Clon de Restaurante Argentino Happening

Este proyecto es un clon de la parrilla Happening con un sistema de reserva y cancelación.

![Happening_main](./public/imgs/happening_main.png)

## Tecnologías utilizadas

- [Laravel](https://laravel.com/)
- [PHP](https://www.php.net/)
- [Xampp](https://www.apachefriends.org/es/index.html)
- [MySQL](https://www.mysql.com/)
- [Git](https://git-scm.com/)

## Instrucciones

Para utilizar esta aplicación, necesitas tener instalados Xampp, PHP y MySQL. También debes tener Git para clonar el repositorio.

### Configuración

#### Base de Datos

1. En la rama principal del proyecto, crea un archivo llamado `.env` con las siguientes claves:
   - DB_CONNECTION: mysql
   - DB_HOST: localhost
   - DB_PORT: 3306
   - DB_DATABASE: [nombre_de_tu_esquema]
   - DB_USERNAME: [tu_nombre_de_usuario]
   - DB_PASSWORD: [tu_contraseña]

2. Asegúrate de haber creado previamente el esquema de base de datos correspondiente.

#### Email

En el archivo `.env`, agrega estas claves para configurar el correo electrónico:

- MAIL_MAILER: smtp
- MAIL_HOST: smtp.gmail.com (si usas Gmail)
- MAIL_PORT: 587
- MAIL_USERNAME: [tu_email]
- MAIL_PASSWORD: [tu_contraseña_de_aplicación] (generada en tu cuenta de Gmail)
- MAIL_ENCRYPTION: tls
- MAIL_FROM_ADDRESS: [tu_email]
- MAIL_FROM_NAME: [tu_nombre]

### Migraciones

Ejecuta las migraciones y seeders para crear las tablas de la base de datos y agregar datos iniciales:

```bash
php artisan migrate:fresh --seed
```

¡Listo! Ahora puedes utilizar la aplicación.

[EOF]
