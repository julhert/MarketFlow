<div align="center">

<img src="https://capsule-render.vercel.app/api?type=soft&color=ffffff&stroke=1e3a8a&strokeWidth=2&height=200&section=header&text=MarketFlow&fontSize=80&fontColor=1e3a8a&animation=fadeIn&desc=_________________________________&descAlignY=62&descSize=20&descColor=f59e0b" width="100%" />

### *"Tu mercado, tu flujo, tu control en tiempo real."*
#### "Compren compren, Compren compren compren"

<br />

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Livewire](https://img.shields.io/badge/Livewire-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)

![](https://img.shields.io/badge/Estado-v1.0.0-0078D4?style=flat-square)
![](https://img.shields.io/badge/TSJ-Lagos%20de%20Moreno-8A2BE2?style=flat-square)
![](https://img.shields.io/badge/8vo_Semestre-Sistemas-orange?style=flat-square)

<br />

---

</div>

Este repositorio aloja el proyecto de **MarketFlow**, el cual, es un sistema de gestión robusto desarrollado para las materias de **DevOps** y **RAD**. El proyecto utiliza una arquitectura de microservicios mediante contenedores para asegurar un entorno de desarrollo estandarizado y colaborativo.

**Creado por los integrantes/desarrolladores:**

* José Manuel Vega Torres - Lider Tecnico y DBA
* Angel Uriel Luevano Saavedra - DevOps Engineer y DBA
* Luis Fernando Gomez Maldonado - Diseñador UX/UI
* Luis Julian Hernandez Trejo - Scrum Master
---

##  Requisitos del Sistema

### Antes de iniciar, asegúrate de tener instalado lo siguiente:

Para ejecutar este proyecto mediante la infraestructura de contenedores, necesitas:
* **Docker & Docker Compose** (Esencial para los 2 contenedores: Software y DB).
* **Git** (Para el control de versiones).

Si decides ejecutarlo de forma local (sin Docker):
* **PHP:** `^8.4`
* **Composer:** Última versión estable.

Puedes verificar tus versiones ejecutando:
```bash
php -v
composer -v
```
---

## Instalación y Configuración en contenedores
(Esta es la forma recomendada para evitar problemas de permisos y dependencias)


Sigue estos pasos para levantar el entorno de desarrollo desde docker:

1. Clonar el repositorio:
```bash
git clone git@github.com:LgUebv/MarketFlow_PelonesDev.git
cd MarketFlow
```
2. Permisos del Script (Linux/Fedora):
Antes de ejecutar, concede permisos al script de automatización:
```bash
chmod +x configurarProyecto.sh
```
3. Levantar el Entorno:
Ejecuta el script para configurar variables de entorno y construir los contenedores:
```bash
./configurarProyecto.sh
```
4. Verificar estado:
Si todo se creo con exito, ingresa al siguiente localhost
127.0.0.1:8080

para las credenciales de la DB, sera necesario ponerse en contacto con los encargados de DBA.

Puedes monitorear los contenedores con:
```bash
docker ps
docker ps -a
```
---

## Instalación y Configuración en local
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
