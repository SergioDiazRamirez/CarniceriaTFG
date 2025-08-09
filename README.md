# 📦 Carnicería App - TFG Ingeniería Informática

Aplicación móvil multiplataforma para una carnicería, desarrollada como Trabajo Fin de Grado en Ingeniería Informática (Universidad de Cádiz). Incluye una app para clientes y un panel de administración web para la gestión por parte de la empresa.

---

## 📱 Aplicación Móvil (Ionic + Angular)

Funcionalidades principales:
- Autenticación de usuarios (registro, login, perfil).
- Visualización y filtrado de productos.
- Carrito de compra y selección de método de entrega (recogida o envío).
- Elección de fecha y hora para el pedido.
- Pago online (integración pendiente).
- Seguimiento de pedidos y estado en tiempo real.
- Notificaciones push sobre pedidos y promociones.
- Historial de pedidos anteriores.

---

## 🖥️ Panel de administración (Laravel + Filament)

Panel de gestión para empleados:
- Gestión de productos, usuarios, empleados, pedidos y horarios.
- Visualización y cambio del estado de los pedidos.
- Control de stock y disponibilidad por franjas horarias.
- Envío manual o automático de notificaciones a clientes.
- Interfaz BREAD (Browse, Read, Edit, Add, Delete) para entidades clave.

---

## 🛠️ Tecnologías usadas

### Frontend (App)
- Ionic
- Angular
- Capacitor
- Typescript

### Backend
- Laravel
- FilamentPHP 
- MySQL 
- Composer

---

## 🚀 Cómo ejecutar el proyecto

### 1. Clona el repositorio
```bash
git clone https://github.com/SergioDiazRamirez/CarniceriaTFG.git
```

### 2. Instalación del Backend (Laravel)
```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
# Configura tu base de datos en el .env
php artisan migrate --seed
php artisan serve
```

### 3. Instalación del Frontend (Ionic)
```bash
cd ../frontend
npm install
npm install -g @ionic/cli
ionic serve
```

> Asegúrese de tener **Node.js**, **Composer** y **XAMPP** instalados y configurados correctamente.

---

## 📂 Estructura del proyecto

```
CarniceriaTFG/
├── backend/         
├── frontend/       
├── README.md
```

---


## 👤 Autor

**Sergio Díaz Ramírez**  
Estudiante de Ingeniería Informática – Universidad de Cádiz  
sergio.diazra@alum.uca.es