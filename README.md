# Prueba-Solstar
Aplicación web que permite realizar las operaciones CRUD con información de cantantes. Desarrollada con la lógica del fontend (Html - Javascript - CSS) y backend (PHP - Codeigniter) por separado, se utiliza Fetch para las llamadas a la API.
## Comenzando 🚀
1. Clonar el repositorio o escargar el zip del proyecto en su directorio raiz "www" o "htdocs" del servidor web.
```
gh repo clone CamiloDiza/Prueba-Solstar
```
2. Descomprimir el fichero zip.
3. Modificar el fichero application/config/database.php con los datos de su BD.
```
'hostname' => 'localhost',
'username' => '',
'password' => '',
'database' => 'siners_crud_db',
'dbdriver' => 'mysqli',
```
4. Ejecute la siguiente consulta SQL en su BD para crear las tablas requeridas para el proyecto:
```
CREATE TABLE `singers` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL,
	`birthday` DATE NULL,
	`biography` VARCHAR(255) NULL,
	`photo` VARCHAR(50) NULL DEFAULT NULL,
	`gender` VARCHAR(50) NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `id` (`id`)
) COLLATE='utf8mb3_bin';
```
5. Ejecutar la aplicación desde la carpeta Backend.
```
php spark serve
```
