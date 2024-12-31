# Prueba técnica

- dejar el proyecto dentro de ~/core-dev/ (generar carpeta si no existe)
- lanzar `make install`
- lanzar `make migration-apply`
- lanzar `make migration-apply-test`
- lanzar test unitarios `make unit-test`
- lanzar test integracíon `make integration-test`
- adjunto coleccion de postman para probar la api, es el fichero 'Wine.postma_collection.json' en la raiz del proyecto, de cualquier forma acceder `wine.test/login` por `POST`
y añadir al cuerpo como raw json `{
    "password": "abc123",
    "email": "ssoler@gmail.com"
}`
- Para conectarnos a la base de datos desde el editor que usemos, utilizar localhost:3306, con el usuario root y la contraseña password.
# TO DO
- Mover shared y wine a un boundedContext superior que lo englobe todo y valorar si crear un contexto exclusivo para usuarios, de manera que se pueda reutilizar esta prueba en futuras ocasiones.
- La contraseña del usuario ha sido creada como un stringValueObject para agilizar los trámites. Es necesario generar un Value Object específico y hashear la contraseña antes de almacenarla.
- Crear tests funcionales.