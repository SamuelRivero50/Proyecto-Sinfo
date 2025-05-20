# Bitácora CRM - MVP de Registro por Voz

**Acceso en línea:** [http://mvpsinfo.free.nf/?i=1](http://mvpsinfo.free.nf/?i=1)

## Descripción
Este proyecto es un MVP de una bitácora para CRM que permite registrar información de prospectos y actividades usando reconocimiento de voz en el navegador. El usuario puede dictar los datos de cada campo o usar un botón para dictar toda la secuencia de campos relevantes.

## Características principales
- Formulario de bitácora con campos: Estado, Temperatura, Nombre, Valor, Descripción, Adjunto, Oportunidad, Tarea, Próxima acción, Hora y Contacto.
- Botón de micrófono en cada campo para dictar solo ese campo.
- Botón principal "Dictar todo" para dictar todos los campos importantes en secuencia.
- Indicaciones visuales claras en la parte superior de la pantalla durante el dictado.
- No requiere backend ni base de datos.
- Solo usa PHP para servir el archivo (no frameworks).
- Compatible con Google Chrome y Microsoft Edge.

## Requisitos
- Google Chrome o Microsoft Edge (la Web Speech API no funciona en Firefox).
- Conexión a internet (la API de voz usa servicios de Google).
- Permitir el acceso al micrófono cuando el navegador lo solicite.
- Servir el proyecto desde `localhost` o HTTPS (no abrir el archivo directamente con `file:///`).
- Tener PHP instalado (para el servidor local).

## Cómo ejecutar el proyecto
1. Descarga o clona este repositorio en tu computadora.
2. Abre una terminal en la carpeta del proyecto.
3. Ejecuta el siguiente comando para iniciar el servidor local de PHP:
   ```sh
   php -S localhost:8000
   ```
4. Abre tu navegador (Chrome o Edge) y visita:
   [http://localhost:8000/index.php](http://localhost:8000/index.php)
5. Permite el acceso al micrófono cuando el navegador lo solicite.
6. Usa los botones de micrófono para dictar cada campo o el botón "Dictar todo" para dictar la secuencia completa.

## Estructura del código
- `index.php`: Contiene el formulario, el diseño y la estructura principal de la interfaz.
- `js/voiceRecognition.js`: Lógica de reconocimiento de voz, manejo de botones, secuencia de dictado y mensajes de estado.
- `README.md`: Este archivo de ayuda.

## Notas y recomendaciones
- Si ves un error de red (network), asegúrate de estar usando `localhost` y no `file:///`.
- Si el reconocimiento de voz no funciona, revisa los permisos del micrófono (icono de candado en la barra de direcciones).
- Si tienes extensiones de privacidad, VPN o firewall, podrían bloquear la API de voz.
- El MVP no guarda datos en ningún lado, solo muestra una alerta de éxito.

## Conexión a la base de datos

En desarrollo local, la conexión a la base de datos se realiza usando XAMPP. Para ello, asegúrate de tener el servidor MySQL de XAMPP corriendo y utiliza la siguiente configuración en tu archivo `config/database.php`:

```php
// Ejemplo de conexión local con XAMPP
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', ''); // Por defecto, sin contraseña en XAMPP
define('DB_DATABASE', 'nombre_de_tu_base_de_datos');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
```

En producción (por ejemplo, en InfinityFree), debes cambiar estos valores por los proporcionados por tu hosting, como se muestra a continuación:

```php
// Ejemplo de conexión en InfinityFree
define('DB_SERVER', 'sql209.infinityfree.com');
define('DB_USERNAME', 'if0_39036584');
define('DB_PASSWORD', '4ydxIY4zUYjV');
define('DB_DATABASE', 'if0_39036584_bitacora_crm');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
```

Asegúrate de subir el archivo `config/database.php` con la configuración adecuada según el entorno donde vayas a desplegar el proyecto.

## Créditos
Desarrollado como MVP para pruebas de funcionalidad de registro por voz en CRM.