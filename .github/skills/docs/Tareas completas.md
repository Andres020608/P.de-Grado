# Tareas Completadas - Jessica Joyería

## Fecha: 18 de abril de 2026

---

## PÁGINA DE INICIO (Inicio)

- **Archivo:** `resources/views/inicio.blade.php`
- **Descripción:** Página principal pública del sitio
- **Cambios:** Agregado enlace "Panel de Administración" en el dropdown del usuario, visible únicamente para administradores (`@if(auth()->user()->isAdmin())`)

---

## DASHBOARD (Panel de Administración)

- **Ruta:** `/dashboard` → `dashboard` (protegido con middleware `EnsureUserIsAdmin`)
- **Descripción:** Panel principal solo para administradores

---

## CRUD PRODUCTS (Gestión de Productos)

- **Ruta:** `/admin/products`
- **Controlador:** `app/Http/Controllers/Admin/ProductController.php`
- **Modelo:** `app/Models/Product.php`
- **Vistas:**
  - `resources/views/admin/products/index.blade.php` - Lista de productos
  - `resources/views/admin/products/create.blade.php` - Crear producto
  - `resources/views/admin/products/edit.blade.php` - Editar producto
  - `resources/views/admin/products/show.blade.php` - Ver producto

**Cambios realizados:**
- Campo `image_url` (string) cambiado a `image` (archivo) para subir imágenes
- Agregado accessor `getImageUrlAttribute()` para generar URL de imagen
- Fix del checkbox "Activo": agregado `<input type="hidden" name="is_active" value="0">` para que funcione correctamente al desmarcar
- Formularios actualizados con `enctype="multipart/form-data"`
- Input de URL cambiado a `type="file"` con `accept="image/*"`
- Se muestra miniatura de imagen actual en edición

---

## CRUD CATEGORIES (Gestión de Categorías)

- **Ruta:** `/admin/categories`
- **Controlador:** `app/Http/Controllers/Admin/CategoryController.php`
- **Modelo:** `app/Models/Category.php`
- **Vistas:**
  - `resources/views/admin/categories/index.blade.php` - Lista de categorías
  - `resources/views/admin/categories/create.blade.php` - Crear categoría
  - `resources/views/admin/categories/edit.blade.php` - Editar categoría
  - `resources/views/admin/categories/show.blade.php` - Ver categoría

**Cambios realizados:**
- Campo `visual_reference` (string) cambiado a `image` (archivo) para subir imágenes
- Agregado accessor `getImageUrlAttribute()` para generar URL de imagen
- Formularios actualizados con `enctype="multipart/form-data"`
- Input de texto cambiado a `type="file"` con `accept="image/*"`
- Se muestra miniatura de imagen actual en edición

---

## CRUD SUPPLIERS (Gestión de Proveedores)

- **Ruta:** `/admin/suppliers`
- **Controlador:** `app/Http/Controllers/Admin/SupplierController.php`
- **Modelo:** `app/Models/Supplier.php`
- **Vistas:**
  - `resources/views/admin/suppliers/index.blade.php` - Lista de proveedores
  - `resources/views/admin/suppliers/create.blade.php` - Crear proveedor
  - `resources/views/admin/suppliers/edit.blade.php` - Editar proveedor
  - `resources/views/admin/suppliers/show.blade.php` - Ver proveedor

**Sin cambios en esta sesión**

---

## COMPONENTES DE INTERFAZ

### Admin Header (Barra superior)
- **Archivo:** `resources/views/components/admin-header.blade.php`
- **Descripción:** Barra de navegación superior del panel admin
- **Cambios:** Ninguno (solo se ajustó el fondo para consistencia)

### Admin Sidebar (Barra lateral)
- **Archivo:** `resources/views/components/admin-sidebar.blade.php`
- **Descripción:** Menú lateral del panel admin
- **Cambios:** 
  - Fondo igualado al header (`bg-[#fbf9f4]/80`)
  - Texto "Management Suite" en verde oscuro (`text-emerald-900`)

### Layout Admin
- **Archivo:** `resources/views/components/layouts/admin.blade.php`
- **Descripción:** Layout principal que usa header y sidebar

---

## RUTAS CORREGIDAS

**Problema:** Los componentes `admin-header` y `admin-sidebar` referenciaban rutas sin prefijo `admin.` (ej: `products.index` en lugar de `admin.products.index`)

**Archivos corregidos:**
- `admin-header.blade.php`: Enlace "Inventario" → `route('admin.products.index')`
- `admin-sidebar.blade.php`: Todos los enlaces actualizados con prefijo `admin.`

---

## MIGRACIONES CREADAS

1. `2026_04_18_XXXXXX_rename_image_url_to_image_in_products_table` - Renombra columna `image_url` → `image`
2. `2026_04_18_XXXXXX_rename_visual_reference_to_image_in_categories_table` - Renombra columna `visual_reference` → `image`

---

## STORAGE

- Ejecutado `php artisan storage:link`
- Directorio `storage/app/public/images` disponible para imágenes subidas
