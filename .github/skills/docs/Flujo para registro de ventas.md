# 🧾 Registro de venta (MEJORADO Y COMPLETO)

## 🎯 Objetivo  
Registrar una venta simulada con control de stock, datos del cliente y generación de comprobante (PDF), métricas (gráficas) y exportación de datos.

---

## 🔄 Flujo principal

1. Admin accede al módulo de ventas  

2. Sistema muestra formulario con:
   - Selector de joya (lista desde BD)  
   - Datos autocompletados de la joya:
     - Nombre  
     - Precio  
     - Stock disponible  
   - Campo de cantidad  
   - Campos del cliente:
     - Nombre  
     - Correo  
     - Teléfono (opcional)  
   - Fecha de compra (automática o editable)  

---

3. Admin selecciona joya  

4. Sistema carga automáticamente:
   - Precio  
   - Stock disponible  

---

5. Admin ingresa cantidad  

6. Sistema valida:
   - Cantidad > 0  
   - Cantidad ≤ stock disponible  
   - Producto existente  

---

7. Sistema calcula automáticamente:
   - Total = precio * cantidad  

---

8. Admin completa datos del cliente  

9. Sistema valida:
   - Campos obligatorios completos  
   - Formato de correo válido  
   - Documento válido (según reglas del sistema)  

---

10. Admin confirma venta  

---

## 💾 Persistencia

11. Sistema guarda en BD:
   - ID producto  
   - Cantidad  
   - Precio unitario (**precio histórico**)  
   - Total  
   - Datos del cliente  
   - Fecha de compra  
   - Número de factura (autogenerado)  
   - Estado de venta (por defecto: **completada**)  

---

12. Sistema actualiza stock:
   - stock = stock - cantidad  

---

13. Sistema aplica:
   - Soft delete en ventas (no eliminar físicamente)  

---

## 📄 Generación de PDF

14. Sistema genera comprobante en PDF con:
   - Información de la tienda  
   - Número de factura  
   - Datos del cliente  
   - Datos de la joya  
   - Cantidad  
   - Precio unitario  
   - Total  
   - Fecha de compra  
   - Estado de la venta  

---

15. Usuario puede:
   - Descargar PDF  
   - Visualizar PDF  

---

## 📊 Integración con reportes

16. Sistema registra la venta para métricas  

17. Datos disponibles para:
   - Ventas por fecha  
   - Ventas por producto  
   - Ingresos totales  
   - Ventas por estado (completadas / anuladas)  

---

## 📊 Generar reporte

1. Admin selecciona módulo de reportes  

2. Sistema permite filtros:
   - Rango de fechas  
   - Producto  
   - Estado de venta  
   - Tipo de reporte  

---

3. Sistema genera:

### 📈 Gráficas:
- Ventas por día  
- Productos más vendidos  
- Ingresos  
- Comparativa por estado de ventas  

---

### 📄 Archivos:
- PDF con resumen  
- Exportación a Excel  

---

4. Administrador puede:
   - Descargar PDF  
   - Descargar Excel  

---

## 🔄 Gestión de estado de venta

1. Admin puede cambiar estado de venta:
   - completada → anulada  

2. Sistema valida:
   - Que la venta exista  
   - Que no esté ya anulada  

3. Sistema realiza:
   - Reversión de stock:
     - stock = stock + cantidad  

---

## ⚠️ Reglas y validaciones obligatorias

- ❌ Nunca permitir ventas sin stock  
- 🔒 El stock debe actualizarse en transacción (atomicidad)  
- ⚠️ No confiar en el frontend → validar siempre en backend  
- 💰 Guardar precio histórico (no depender del producto actual)  
- 🚫 Evitar ventas con cantidad ≤ 0  
- 🔁 Manejar correctamente la anulación de ventas (devolver stock)  
- 🧾 Generar número de factura único y automático  
- 🗑️ Usar soft delete para mantener historial  

---


## 🧠 Mejores prácticas

- Usar transacciones en BD  
- Separar lógica en:
  - Controlador  
  - Servicios  
- Validaciones en backend (FormRequest si usas Laravel)  
- No mezclar lógica en vistas  
