# Manual de Usuario - Sistema de Gestión "Jessica Joyería"

Bienvenido al manual de usuario del sistema de gestión para **Jessica Joyería**. Este documento detalla las características principales del sistema, cómo utilizar sus módulos y los puntos clave a tener en cuenta, incluyendo las restricciones de negocio y validaciones integradas para garantizar el correcto funcionamiento.

---

## 1. Características Principales

El sistema está diseñado en arquitectura web, accesible desde cualquier navegador, y cuenta con los siguientes módulos:

### 1.1 Autenticación y Roles
- **Acceso Seguro**: Todo el sistema requiere de un inicio de sesión (`login`) con correo electrónico y contraseña.
- **Roles de Usuario**: Existen perfiles definidos en el sistema (Administrador y Cliente).
- **Control de Acceso**: El panel de control (Dashboard) y las funcionalidades de administración, como ventas, configuración de inventario y reportes, están estrictamente protegidos. Solo los usuarios con rol de **Administrador** pueden acceder a ellos.

### 1.2 Dashboard (Panel de Control)
- **Métricas Generales**: Visualización rápida del total del valor del inventario (precio $\times$ stock).
- **Análisis de Ventas**: Datos de ventas semanales y el listado de los productos más vendidos (Top 5).
- **Alertas Visuales**: Los indicadores clave muestran colores específicos para facilitar su rápida identificación.

### 1.3 Módulo de Gestión de Inventario
- **Usuarios, Categorías y Proveedores**: Permite mantener un directorio organizado (CRUD completo) para gestionar los proveedores que surten a la joyería y las categorías a las cuales pertenecen los productos (ej. anillos, collares, etc.).
- **Catálogo de Productos**:
  - Almacena información detallada: SKU (código único), nombre, descripción, precio, cantidad de stock, sello de metal (hallmark) y una imagen representativa.
  - **Semáforo de Stock**: El sistema clasifica el nivel de stock automáticamente en tres estados:
    - **Crítico (Rojo)**: Menos de 5 unidades.
    - **Bajo (Amarillo)**: Entre 5 y 9 unidades.
    - **Bien (Verde o Primario)**: Más de 9 unidades.

### 1.4 Módulo de Ventas
- **Registro Detallado**: Capacidad para registrar información del cliente al momento de la venta (documento, nombre, teléfono, email) junto con notas adicionales de la transacción.
- **Gestión de Estados**: Las ventas pueden cambiar de estado de acuerdo a su progreso:
  - `pendiente`
  - `completado`
  - `cancelado`
- **Facturación y Reportes**:
  - Generación y descarga de la factura de venta en formato **PDF**.
  - Exportación de los datos y reportes de ventas a archivos **Excel**.
- **Registro Histórico (Soft Deletes)**: Las ventas eliminadas no se borran definitivamente de la base de datos de manera inmediata, manteniendo la integridad histórica y facilitando auditorías.

---

## 2. Puntos a Tener en Cuenta y Restricciones del Sistema

Para el correcto uso de la aplicación y para evitar errores en las operaciones diarias, es obligatorio tener presentes las siguientes restricciones:

### Restricciones de Acceso y Seguridad
1. **Rutas Protegidas:** Un usuario que no sea Administrador será redirigido o se le negará el acceso a cualquier URL que comience con `/admin` o el `/dashboard`. 
2. **Cierre de Sesión:** Tras un tiempo prolongado de inactividad, la sesión puede expirar (requiriendo iniciar sesión nuevamente) por razones de seguridad.

### Restricciones de Inventario
1. **Imágenes de Productos:** Las imágenes de los productos deben subirse en formatos válidos. Estas se almacenan en el sistema de archivos local (`storage/`), lo que significa que el sistema debe tener los permisos de lectura/escritura correctos.
2. **Eliminación de Categorías/Proveedores:** No se debería eliminar una categoría o proveedor si existen productos vinculados a estos, ya que podría causar inconsistencias en los registros de los productos.
3. **Valores Numéricos:** El precio de un producto y su stock no pueden ser valores negativos. El sistema maneja los precios con dos cifras decimales.

### Restricciones del Módulo de Ventas
1. **Control de Inventario (Stock):** 
   - No es posible vender productos cuyo stock sea `0` (cero).
   - Al concretar una venta, el inventario del producto se reduce automáticamente en la cantidad vendida.
2. **Estados Estrictos de la Venta:** Al actualizar una venta, el sistema valida estrictamente que el estado introducido sea únicamente `completado`, `pendiente` o `cancelado`. Intentar usar otro estado arrojará un error de validación.
3. **Datos de Facturación:** Para generar adecuadamente un PDF de la factura, la venta debe tener la información del cliente registrada.
4. **Exportación de Reportes:** Los reportes de Excel exportarán la información basándose en el registro actual de la base de datos; si hay ventas canceladas o eliminadas lógicamente (Soft deletes), las reglas del reporte dictarán si son incluidas.

---

## 3. Recomendaciones de Uso
- Revisar periódicamente los productos que se encuentren en estado **Crítico** de stock para planificar reabastecimientos con los proveedores.
- Asegurarse de marcar como `completado` las ventas únicamente cuando el pago ha sido recibido y el producto entregado, para que los cálculos financieros (Top de ventas, Valor total vendido) sean precisos.
- Realizar descargas de Excel de las ventas semanal o mensualmente para llevar un respaldo externo de las finanzas.
