# 🗓️ Sistema de Reservas por Horarios para Negocios

Este proyecto es una aplicación web desarrollada en **Laravel** que permite a negocios configurar sus horarios disponibles y a los usuarios reservar franjas horarias (*slots*) según su disponibilidad y créditos.

## 🚀 Características principales

- Gestión de reservas por franjas horarias (slots)
- Visualización diaria de disponibilidad por negocio
- Etiquetas visuales: slots pasados vs. activos
- Relación entre negocios, horarios (`schedules`) y reservas (`bookings`)
- Sistema de créditos para limitar reservas por usuario
- Comando Artisan para generación automática de slots
- Interfaz adaptable a modo claro/oscuro (Tailwind CSS + Blade)

## 🧱 Tecnologías utilizadas

- Laravel 10+
- PHP 8.2+
- MySQL
- Tailwind CSS
- Blade Components
- Laravel Artisan Commands

## ⚙️ Instalación

1. Clona el repositorio:  
`git clone https://github.com/tu-usuario/tu-proyecto.git && cd tu-proyecto`

2. Instala las dependencias:  
`composer install && npm install && npm run dev`

3. Copia el archivo de entorno y genera la clave:  
`cp .env.example .env && php artisan key:generate`

4. Configura tu base de datos en el archivo `.env` y luego ejecuta:  
`php artisan migrate --seed`

5. Inicia el servidor:  
`php artisan serve`

## 🛠️ Comando personalizado

Este comando genera automáticamente los *slots* futuros de cada negocio según su configuración de horarios:  
`php artisan app:generate-business-slots`

## 📁 Estructura del proyecto

app/  
├── Models/  
│   ├── Business.php  
│   ├── Slot.php  
│   ├── Booking.php  
│   └── Schedule.php  
├── Console/Commands/GenerateBusinessSlots.php  
├── Http/Controllers/...  
resources/  
└── views/  
    ├── bookings/index.blade.php  
    └── business/slots.blade.php  
routes/  
└── web.php

## 📄 Licencia

Este proyecto está licenciado bajo la licencia MIT.  
Desarrollado con ❤️ por [Tu Nombre o Equipo].
