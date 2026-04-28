#  MarketFlow

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Status](https://img.shields.io/badge/Status-Development-cyan?style=for-the-badge)

Este repositorio aloja el proyecto **MarketFlow**, desarrollado para las materias de **DevOps** y **RAD**. El objetivo es mantener un flujo de trabajo profesional, estandarizado y colaborativo.

**Creado por los integrantes/desarrolladores:**

* José Manuel Vega Torres
* Angel Uriel Luevano Saavedra
* Luis Fernando Gomez Maldonado
* Luis Julian Hernandez Trejo
---

##  Requisitos del Sistema

Antes de iniciar, asegúrate de tener instalado lo siguiente:

* **PHP:** `^8.4`
* **Composer:** Última versión estable.

Puedes verificar tus versiones ejecutando:
```bash
php -v
composer -v
```

## Instalación y Configuración

Sigue estos pasos para levantar el entorno de desarrollo localmente:

1. Clonar el repositorio:
```bash
git clone git@github.com:LgUebv/MarketFlow_PelonesDev.git
cd MarketFlow
```

2. Instalar dependencias:
```bash
composer install
```

3. Configurar variables de entorno:
Copia el archivo de ejemplo y genera la llave única de la aplicación:
```bash
En Linux/macOS:
cp .env.example .env
En windows:
copy .env.example .env
```

4. Generar la App Key:
```bash
php artisan key:generate
```

5. Levantar el servidor local:
```bash
php artisan serve
```

7. Accede a: http://127.0.0.1:8000

### Estructura de Ramas
* **main**: Código estable y listo para despliegue.
* **develop**: Rama principal de desarrollo. Todos los PRs deben ir aquí.
* **feature/**: Ramas temporales para nuevas tareas (ej. `feature/modulo-ventas`).
* **hotfix/**: Reparaciones de emergencia en producción.

**Proceso de entrega:**
1. `Fork` del repo -> 2. `Checkout develop` -> 3. Crear `feature/` -> 4. `Pull Request` a `develop` -> 5. Revisión de **QA** -> 6. `Merge`.

## Lineamientos de Colaboración (Git Flow)
Para asegurar la calidad del código y evitar conflictos, el equipo seguirá estas reglas:

Forks: Cada integrante debe realizar su propio fork del repositorio principal.

Ramificación (Branching): Es obligatorio crear una nueva rama para cada función o avance. Usa nombres descriptivos (ej. feature/login-sistema o fix/error-migracion).

Pull Requests & QA: Antes de realizar un merge a la rama principal, el código debe ser revisado por los encargados de QA para recibir el visto bueno.

Soporte: Ante cualquier duda técnica o aviso, contactar al Líder Técnico. Si tienes dudas sobre el manejo de GitHub, consulta con el equipo o investiga antes de realizar cambios críticos para evitar pérdida de información.
