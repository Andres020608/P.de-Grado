# Manual de Instalación y Despliegue - Jessica Joyería

Este manual detalla los pasos necesarios para instalar y ejecutar el proyecto **Jessica Joyería** en un nuevo equipo de desarrollo.

## 📋 Prerrequisitos

Asegúrate de tener instaladas las siguientes herramientas en tu sistema:

*   **PHP:** Versión 8.2 o superior (Recomendado: 8.5).
*   **Composer:** Gestor de dependencias de PHP.
*   **Node.js & NPM:** Para la compilación de activos de frontend.
*   **Servidor de Base de Datos:** MySQL o MariaDB.
*   **Servidor Web:** Laragon, XAMPP o puedes usar el servidor integrado de Laravel (`php artisan serve`).

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
