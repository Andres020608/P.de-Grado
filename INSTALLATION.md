# Manual de Instalación y Despliegue - Jessica Joyería

Este manual detalla los pasos necesarios para instalar y ejecutar el proyecto **Jessica Joyería** en un nuevo equipo de desarrollo.

## 📋 Prerrequisitos

Asegúrate de tener instaladas las siguientes herramientas en tu sistema:

*   **PHP:** Versión 8.2 o superior (Recomendado: 8.5).
*   **Composer:** Gestor de dependencias de PHP.
*   **Node.js & NPM:** Para la compilación de activos de frontend.
*   **Servidor de Base de Datos:** MySQL o MariaDB.
*   **Servidor Web:** Laragon, XAMPP o puedes usar el servidor integrado de Laravel (`php artisan serve`).

### Extensiones de PHP Requeridas (Entorno Windows)

Dado que esta aplicación está diseñada para ejecutarse en entornos **Windows**, es **obligatorio activar la extensión `zip`** en PHP. De lo contrario, herramientas como Composer fallarán al instalar dependencias clave o al procesar archivos comprimidos.

**¿Cómo encontrar y activar la extensión?**
*   **En Laragon:** Haz clic derecho en cualquier espacio en blanco de la ventana de Laragon, ve a la opción **PHP** > **Quick Settings** y asegúrate de que `zip` tenga un check marcado. (También puedes ir a **PHP** > **php.ini**, buscar la línea `;extension=zip` y borrar el punto y coma `;` inicial).
*   **En XAMPP:** En el panel de control, haz clic en **Config** al lado de Apache, selecciona **PHP (php.ini)**, busca la línea `;extension=zip` y quítale el punto y coma `;`. Guarda el archivo y reinicia Apache.

### Instalación de Paquetes de la Aplicación (PDF y Excel)

La aplicación utiliza dependencias fundamentales que debes tener instaladas:
*   `barryvdh/laravel-dompdf` (Para exportar facturas y documentos en PDF).
*   `maatwebsite/excel` (Para exportar reportes en formato .xls/.xlsx).

> **Aviso sobre versiones recientes de PHP:** Si estás utilizando la última versión de PHP (como PHP 8.4 o 8.5) y te encuentras con errores al hacer `composer install` porque los desarrolladores de estas librerías aún no han marcado compatibilidad oficial con esa versión exacta, puedes forzar la instalación indicándole a Composer que ignore este requisito específico. 

Puedes instalar o actualizar estas extensiones usando el siguiente comando:

```bash
composer require barryvdh/laravel-dompdf maatwebsite/excel --ignore-platform-req=php+
```

---

## 🚀 Pasos para la Instalación

### 1. Clonar el Proyecto
Descarga el código fuente del repositorio o copia la carpeta del proyecto en tu nuevo equipo.

### 2. Instalación de Dependencias de PHP
Abre una terminal en la raíz del proyecto y ejecuta:
```bash
composer install
```

### 3. Configuración del Entorno
Copia el archivo de ejemplo de variables de entorno:
```bash
cp .env.example .env
```
Luego, genera la clave de la aplicación:
```bash
php artisan key:generate
```

### 4. Configuración de la Base de Datos
Abre el archivo `.env` recién creado y configura los datos de tu base de datos local:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Migraciones y Datos Iniciales
Crea las tablas en la base de datos:
```bash
php artisan migrate
```
*(Opcional) Si deseas cargar datos de prueba:*
```bash
php artisan db:seed
```

### 6. Instalación de Dependencias de Frontend
Instala los paquetes de Node.js necesarios (incluyendo Chart.js):
```bash
npm install
```

### 7. Enlace de Almacenamiento (Storage)
Para que las imágenes de los productos y categorías se visualicen correctamente, vincula la carpeta de almacenamiento:
```bash
php artisan storage:link
```

---

## 💻 Ejecución del Proyecto

Para poner en marcha la aplicación, debes tener dos procesos corriendo (o compilar para producción):

### Opción A: Modo Desarrollo (Recomendado)
Abre dos terminales y ejecuta:

**Terminal 1 (Servidor PHP):**
```bash
php artisan serve
```

**Terminal 2 (Compilación de activos en tiempo real):**
```bash
npm run dev
```

### Opción B: Modo Producción
Si no deseas tener `npm run dev` corriendo, compila los activos una sola vez:
```bash
npm run build
php artisan serve
```

---

## 🔑 Acceso al Sistema

1.  **Página Pública:** Accede a `http://127.0.0.1:8000`.
2.  **Registro de Administrador:** Puedes registrarte en `/register` y seleccionar el rol **"Administrador"** para acceder al panel de gestión.
3.  **Panel de Administración:** Una vez logueado como admin, verás el botón de "Panel de Administración" en el menú de tu perfil o puedes entrar directamente a `http://127.0.0.1:8000/dashboard`.

## 🔑 Credenciales por Defecto (Seeders)

Si ejecutaste `php artisan db:seed`, puedes usar las siguientes cuentas para probar el sistema:

### Administrador
*   **Email:** `admin@jessica.com`
*   **Password:** `admin123`

### Cliente
*   **Email:** `cliente@test.com`
*   **Password:** `cliente123`

---
*Manual generado para el equipo de desarrollo de Jessica Joyería.*
