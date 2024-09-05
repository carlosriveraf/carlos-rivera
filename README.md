Para ejecutar correctamente el proyecto, hay que seguir estos pasos:

### 1. **Clonar el proyecto**

Primero hay que clonar el proyecto, ya sea mediante git o descargando el proyecto en un ZIP

```bash
git clone https://github.com/carlosriveraf/carlos-rivera.git
```

### 2. **Instalar Dependencias de PHP**
Asegúrate de tener instaladas las dependencias del proyecto Laravel. Desde la raíz del proyecto clonado, ejecuta:

   ```bash
   composer install
   ```

### 3. **Copiar el Archivo de Configuración `.env`**
Crear el .env en base a .env.example:

   ```bash
   cp .env.example .env
   ```

### 4. **Configurar el Archivo `.env`**
Abre el archivo `.env` y actualiza los valores según tu entorno local. Asegúrate de configurar lo siguiente:

   - **Base de Datos:**
     ```ini
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nombre_base_datos
     DB_USERNAME=usuario_base_datos
     DB_PASSWORD=contraseña_base_datos
     ```

### 5. **Generar la Clave de la Aplicación**
Genera esta clave con:

   ```bash
   php artisan key:generate
   ```

### 6. **Configurar la Base de Datos**
   - **Crear la Base de Datos**
   - **Migrar las Tablas y poblar datos**

     ```bash
     php artisan migrate --seed
     ```

### 7. **Ejecutar el Servidor**

   ```bash
   php artisan serve
   ```

   El proyecto estará disponible en `http://localhost:8000`.

### 6. **Configurar la Base de Datos**
   - **Crear la Base de Datos**
### 8. **Endpoints**
   - **Login:** nos dará el token en el atributo "token" de la respuesta
   ```bash
    curl --location 'http://127.0.0.1:8000/api/login' \
    --header 'Accept: application/json' \
    --header 'Content-Type: application/json' \
    --data-raw '{
        "email": "admin@delfosti.com",
        "password": "password"
    }'
   ```

   - **Crear pedido:** el código de vendor y repartidor lo obtendremos de la columna **"codigo_trabajador"** en la tabla **"users"**. El endpoint está solo se puede usar mediante el header "Authorization" con Bearer
   ```bash
    curl --location 'http://127.0.0.1:8000/api/orders' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer mi_token_obtenido' \
    --header 'Content-Type: application/json' \
    --data '{
        "vendedor": "0412",
        "repartidor": "042",
        "products": [
            {
                "sku": "PROD-350",
                "nombre": "Pastillas",
                "precio": 24.50,
                "cantidad": 5,
                "unidadMedida": "Tableta"
            },
            {
                "sku": "PROD-351",
                "nombre": "Jarabe",
                "precio": 12.40,
                "cantidad": 1,
                "unidadMedida": "Botella"
            }
        ]
    }'
   ```

   - **Actualizar estado pedido:** indicar el número del pedido y el nuevo estado del pedido. Los estados son Por atender (01) | En proceso (02) | En delivery (03) | Recibido (04). Mayor detalle en la tabla **"status"**. El endpoint está solo se puede usar mediante el header "Authorization" con Bearer
   ```bash
    curl --location 'http://127.0.0.1:8000/api/orders/status' \
    --header 'Accept: application/json' \
    --header 'Authorization: Bearer mi_token_obtenido' \
    --header 'Content-Type: application/json' \
    --data '{
        "nroPedido": "00000010",
        "estado": "02"
    }'
   ```