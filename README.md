# Curso de Bienes Raíces MVC 

1. Instalar: 'composer install' mediante consola.

2. Tenemos que pasar los archivos:
    composer.json / .lock

3. Carpeta de classes y la modificamos a: models.

4. Pasamos: package-lock.json / .json y gulpfile.js

5. Ejecutamos en consola: 'npm i'

6. Ejecutamos en consola: 'gulp'

7. Ejecutar: 'composer update'

8. Cuando modificas o agregas algo al archivo: composer.json debemos ejecutar:
    'composer update'

9. Entramos a Packagist y buscamos PHPMailer, lo instalamos, ingresamos el comando en consola:
    composer require phpmailer/phpmailer

10. Entramos a la página de: Mailtrap
    Email Testing -> Inboxes -> Integrations -> Laravel

11. Pruebas de Testin:
    End To End: Se comporta como usuario, da clicks y llena formularios
    Integración: Revisa que varias partes de la app funcionan bien juntas
    Unitarias: Una parte por si sola funcione bien
    Static: Identificar errores mientras los vas escribiendo

12. ¿Como se realiza el testing?
    Probando formularios, clicks, revisando cada parte del sitio web
    Con herramientas que automatizan las pruebas
    Cypress: herramienta para testear

13. Cypress: permite crear pruebas End To End, comprueba que todos los componentes funcionen
    bien juntos

14. Optimización de contenido:
    *Auditoria para saber si el contenido es importante para los usuarios o falto añadir
    *Ajuste al diseño como son: imágenes, botones o que el sitio sea responsive
    *REvisar que no se consuman recursos adicional o perdidas en memoria del servidor

15. Hostin que soportan PHP y MySql:
    *Vercel
    *AWS
    *Azure
    *BlueHost
    *VPS donde tu instalas todo

16. Una vez realizado el Deplyment:
    Añadir Google Analytics o Fathom

17. Consideraciones si tenemos un sitio con miles de visitas:
    *Hospedar la BD en un servidor aparte, en uno el código y en otro la BD
    *Cachear el contenido, es decir; en lugar de consultar la BD, creamos 
    una versión de HTML que cada que haya cambios regenere el HTML
    *Hospedar imágenes y archivos similares en otro servidor, puede ser un CDN
    *Hospedar el sitio web en diferentes servidores
    
