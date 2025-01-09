# Prueba técnica

- dejar el proyecto dentro de ~/core-dev/ (generar carpeta si no existe)
- lanzar `make install`
- lanzar test unitarios `make unit-test`
- lanzar test integracíon `make integration-test`
- adjunto coleccion de postman para probar la api, es el fichero 'Wine.postma_collection.json' en la raiz del proyecto, de cualquier forma acceder `wine.test/login` por `POST`
y añadir al cuerpo como raw json `{
    "password": "abc123",
    "email": "ssoler@gmail.com"
}`
- Para conectarnos a la base de datos desde el editor que usemos, utilizar localhost:3306, con el usuario root y la contraseña password.

# ShortCuts
- lanzar migraciones bd local `make migration-apply`
- lanzar migraciones bd test `make migration-apply-test`
- composer install `make composer-install-wine`
- composer update `make composer-update-wine`
- composer clear cache `make composer-cc-wine`
- ssh al php `ssh-php`
- ssh al nginx `ssh-nginx`
- ssh al mysql `ssh-mysql`
# TO DO
- Mover shared y wine a un boundedContext superior que lo englobe todo y valorar si crear un contexto exclusivo para usuarios, de manera que se pueda reutilizar esta prueba en futuras ocasiones.
- Crear tests funcionales.
- Crear test unitarios para los viewMapper
-  documentar los endpoint y que al acceder /api/doc.json se reflejen los cambios, no tengo experiencia previa con esta herramienta