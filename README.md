### Instalación 
*	Clonar el repositorio en la carpaeta htdocs si usas Xampp o en la carpeta www si usas
Laragon
1.	HTPS: https://github.com/OscarGit95/smart-blog.git

2.	SSH: git@github.com:OscarGit95/smart-blog.git
* Instalar PHP en la PC, versión 8.1 o mayor
* Instalar composer https://getcomposer.org/
*	Entrar al directorio cd smart-blog
* Instalar las dependencias del proyecto con el comando *composer install*
* Configurar el archivo .env
*	Crear la base de datos para el proyecto
*	Correr el comando *php artisan key:generate*
* Correr el comando *php artisan migrate*
* Correr el comando *php artisan db:seed*
* Ingresar con las credenciales de administrador:
**usuario: admin@smartblog.com**
**contraseña: smartadmin2023 **

### Documentación 
* Ingresar a la ruta http://127.0.0.1:8000/api/documentation para obtener información de las rutas de la aplicación
