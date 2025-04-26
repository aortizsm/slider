# Slider Block

**Versión:** 1.0  
**Requiere:** Moodle 3.11 o inferior  

---

## Descripción

Slider2 es un bloque de Moodle que muestra un carrusel (slider) de hasta 10 imágenes.  
Permite configurar, por instancia de bloque:

- El **intervalo de cambio** (en segundos).  
- Subir hasta **10 imágenes** mediante el file manager de Moodle.

Si se suben menos de 10 imágenes, éstas se repetirán para completar siempre 10 slides.

---

## Requisitos

- Moodle **3.11** o superior.  
- PHP 7.3+ (según requisitos de Moodle 3.11).

---

## Instalación

1. Descarga el archivo `slider.zip`.  
2. Descomprime o mueve la carpeta `slider` a tu directorio de bloques de Moodle:

/ruta/a/tu/moodle/blocks/slider

3. Abre tu navegador y accede a tu sitio Moodle como administrador.  
4. Ve a **Administración del sitio → Notificaciones**.  
5. Moodle detectará el nuevo bloque y mostrará un mensaje de instalación.  
6. Confirma la instalación.  

---

## Añadir el bloque a una página

1. Entra en la **Página Principal**, en un **Curso** o en tu **Dashboard**.  
2. Activa el modo edición: **“Activar edición”**.  
3. En el menú lateral **“Agregar un bloque”**, selecciona **Slider2 Block**.  

---

## Configuración de la instancia

1. Una vez añadido, haz clic en el **ícono de engranaje (⚙️)** del bloque y elige **“Configurar bloque Slider2”**.  
2. En el formulario de configuración verás:

- **Interval (seconds):**  
  Ingresa el número de segundos que debe tardar en cambiar cada slide.  
  > **Por defecto:** 3

- **Slider Images:**  
  Usa el file manager para **subir hasta 10 imágenes**.  
  > Si subes menos de 10, se repetirán las existentes para completar 10.

3. Haz clic en **“Guardar cambios”**.

---

## Uso

- Después de configurar, el bloque mostrará tus imágenes en un carrusel con:
- Flechas ◀ ▶ para navegar manualmente.
- Puntos indicadores para saltar a una slide específica.
- Cambio automático cada X segundos (según tu configuración).
- Pausa al pasar el cursor por encima, se reanuda al retirarlo.

---

## Desinstalación

1. Ve a **Administración del sitio → Plugins → Bloques → Gestionar bloques**.  
2. Busca **Slider Block** y haz clic en **“Desinstalar”**.  
3. Confirma la eliminación.  
4. (Opcional) Borra manualmente la carpeta `/blocks/slider` de tu servidor.

---

## Soporte y contribuciones

Este bloque es de código abierto. Puedes:

- Reportar issues o bugs.  
- Enviar pull-requests con mejoras o nuevas funcionalidades.  
- Solicitar ayuda en los foros de desarrollo de Moodle.

## Desarrollador

Alberto Ortiz para Moodle 3.11 especificamente

¡Gracias por usar Slider Block! 🚀 
