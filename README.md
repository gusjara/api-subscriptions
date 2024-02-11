# Pasos para su uso
## Descripción
Se tomo como que una subscripcion es de un año, desde el momento que se la crea se crea con fecha inicial la fecha de creación y la fecha de fin a un año.
# Deployment en local
- Clonar el repositorio
- crear copiar archivo .env.example y crear uno nuevo llamado .env ```cp .env.example .env``` 
- Correr ```composer install```
- Correr `php artisan key:generate`
- En las variables del .env ```DB_HOST=``` poner el host de la base de datos, ```DB_PORT=``` puerto de mysql, ```DB_DATABASE=``` nombre de la base de datos, ```DB_USERNAME=``` usuario de la conexion, ```DB_PASSWORD=``` password del usuario de la conexion
- Correr `php artisan migrate:fresh --seed` para migrar la base de datos y datos dummies
- Correr `php artisan serve` para correr el proyecto en 127.0.0.1:8000 en local.

# Deployment en local con docker
- Clonar el repositorio
- Correr ```docker compose up``` para hacer pull de la imagen de docker
- Ingresar al docker utilizando ```docker exec -it zenrise bash```
- Dirigirse a ```cd /var/www/html``` y realizar los siguientes pasos
- Cambiar los permisos de las carpetas `/storage y bootstrap` con `chown -R www-data:www-data storage/ bootstrap/` por si arroja un error de permisos de las mismas.
- Copiar el archivo .env.example y crear uno nuevo llamado .env ```cp .env.example .env``` 
- Teniendo mysql en la maquina local, modificar las variables del .env ```DB_HOST=``` poner el host de la base de datos, ```DB_PORT=``` puerto de mysql, ```DB_DATABASE=``` nombre de la base de datos, ```DB_USERNAME=``` usuario de la conexion, ```DB_PASSWORD=``` password del usuario de la conexion
- Correr ```composer install```
- Correr `php artisan key:generate`
- Correr `php artisan migrate:fresh --seed` para migrar la base de datos y datos dummies
- Ingresar a `localhost:8080` para correr el proyecto en 127.0.0.1:8080 en local con docker.

# Requerimientos para instalar el sistema
- tener instalado PHP en version 8.1+, ideal 8.2
- tenes instalado composer v2
- MySQL en version 5.6 u 8
- Servidor web Apache o Nginx

# Endpoints de la API
Hay un archivo en el root del desarrollo `zenrise.postman_collection.json` que puede ser importado en postman para obtener los endpoints
> Planes 
- [get] {url}/api/plans -> obtiene todos los planes hay 3 planes de pruebas en los seeders
- [get] {url}/api/plans/{id} -> obtiene un plan por su id
- [post] {url}/api/plans -> para crear un nuevo plan, ejemplo del body: `{
    "name": "tests",
    "price": "1d5600"
}`

> Clientes
- [get] {url}/api/clients -> obtiene los clientes creados, para datos dummies hay 10 clientes de pruebas
- [get] {url}/api/clients/{id} -> obtiene un cliente por su id, hay 10 clientes de pruebas

> Propiedades
- [get] {url}/api/properties -> obtiene todas las propiedades, hay 10 propiedades de pruebas creada en los seeders
- [get] {url}/api/properties/{id} -> obtiene una propiedad y sus detalles por su id

> Subscripciones
- [get] {url}/api/subscriptions -> obtiene todas las subscripciones
- [get] {url}/api/subscriptions/{id} -> obtiene una subscripcion por su id
- [post] {url}/api/subscriptions -> para crear una nueva subscripcion, se debe enviar ```porperty_id``` obtenido en el endpoint `/properties`, `client_id` obtenido en el endpoint `/clients`, `plan_id` obtenido en el endpoints `plans`. Ejemplo del body
`{
    "property_id": 1,
    "client_id": 7,
    "plan_id":3,
    "payment_type": "card" // debit o card
}`

> Lotes o pagos
- [get] {url}/api/payments -> obtiene todos los lotes o pagos generados.
- [get] {url}/api/payments/{id} -> obtiene un pago o lote o pago por su id.
- [get] {url}/api/payments/code/{lote} -> obtiene un lote o pago por su identificador unico.
- [get] {url}/api/payments/{id}/amounts -> obtiene los montos y la cantidad de subscripciones de un lote o pago por su id.
- [get] {url}/api/payments/code/{lote}/amounts -> obtiene los montos y la cantidad de subscripciones de un lote o pago por su indentificador de lote.
- [post] {url}/api/payments -> crea un lote o pago para las suscripciones que estan activas.

## Comandos por medio de la terminal
- Si el proyecto esta en local sin docker ejecutar `php artisan payments:generate` para generar los lotes o pagos de las subscripciones.
- Si el proyecto esta corriendo con docker en la terminal ejecutar `docker exec -ti zenrise bash` para ingresar al contenedor. Luego `cd /var/www/html` y ejecutar `php artisan payments:generate` para generar los lotes o pagos de las subscripciones.
