# Sistema de Bitácora CRM

## Características
- Reconocimiento de voz para entrada de datos
- Interfaz intuitiva y fácil de usar
- Almacenamiento de datos en base de datos MySQL
- Soporte para archivos adjuntos
- Conexión a base de datos MySQL configurable mediante variables de entorno

## Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Navegador web moderno con soporte para reconocimiento de voz
- Servidor web (Apache/Nginx)

## Configuración del Proyecto

### 1. Clonar el repositorio
```bash
git clone [URL_DEL_REPOSITORIO]
cd Proyecto-Sinfo
```

### 2. Configurar la base de datos
1. Crear una base de datos MySQL llamada `bitacora_crm`
2. Importar el archivo `database.sql` en tu servidor MySQL
3. Copiar el archivo `.env.example` a `.env`:
   ```bash
   cp .env.example .env
   ```
4. Editar el archivo `.env` con tus credenciales de base de datos:
   ```
   DB_HOST=tu_host
   DB_USER=tu_usuario
   DB_PASS=tu_contraseña
   DB_NAME=bitacora_crm
   ```

### 3. Configurar el servidor web
- Asegúrate de que el servidor web apunte al directorio del proyecto
- Configura los permisos necesarios para la carpeta `uploads/`

### 4. Acceder a la aplicación
- Abre tu navegador y ve a `http://localhost/Proyecto-Sinfo`

## Estructura del código
- `index.html`: Página principal con el formulario
- `js/voiceRecognition.js`: Lógica de reconocimiento de voz
- `css/styles.css`: Estilos de la aplicación
- `config/database.php`: Configuración de la conexión a la base de datos
- `save_bitacora.php`: Script para guardar los datos en la base de datos
- `uploads/`: Directorio para archivos adjuntos

## Despliegue en Railway
1. Crear una cuenta en Railway
2. Crear un nuevo proyecto
3. Conectar con tu repositorio de GitHub
4. Configurar las variables de entorno en Railway:
   - DB_HOST
   - DB_USER
   - DB_PASS
   - DB_NAME
5. Railway detectará automáticamente que es una aplicación PHP y la desplegará

## Notas y recomendaciones
- Asegúrate de que la base de datos esté correctamente configurada antes de usar la aplicación
- Verifica que la carpeta `uploads/` tenga los permisos correctos (777 para desarrollo, más restrictivos para producción)
- Para desarrollo local, puedes usar los valores por defecto en `config/database.php`
- Para producción, siempre usa variables de entorno para las credenciales de la base de datos
- Railway proporcionará una URL pública para acceder a tu aplicación

## Solución de problemas
- Si la base de datos no se conecta, verifica las credenciales en el archivo `.env`
- Si los archivos no se suben, verifica los permisos de la carpeta `uploads/`
- Si el reconocimiento de voz no funciona, asegúrate de usar un navegador compatible y tener un micrófono conectado