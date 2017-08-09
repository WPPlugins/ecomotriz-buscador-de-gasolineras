=== Plugin Name ===
Contributors: ecomotriz
Donate link: http://www.ecomotriz.com/
Tags: widget, sidebar, maps
Requires at least: 2.0.2
Tested up to: 3.4.2
Stable tag: 0.9.3

Buscador de las gasolineras más baratas y puntos de recarga para coches eléctricos y motos eléctricas.

Spanish fuel station finder.

== Description ==

Este plugin de Wordpress es un buscador de gasolineras más baratas y punto de recarga eléctrica de coches eléctricos y de motos eléctricas.

Principales características:

*   Precios de más de 9700 gasolineras de toda España
*   Más de 750 puntos de recarga eléctrica, tanto para coches eléctricos como para motos eléctricas
*   Carburantes: gasolina 95, gasolina 98, diésel normal, diésel plus, biodiesel y bioetanol
*   Actualizaciones de precios de gasolina diarias
*   Configurable y *fácil de usar*
*   Muy ligero, no sobrecargará tu blog
*   Idiomas español e inglés
*   Adaptado al sistema gettext para poder traduirse a otros idiomas


== Installation ==

1. Subir `ecomotriz_wpmain.php` a la carpeta `/wp-content/plugins/`
2. Activar el plugin desde el menú de administración de Wordpress
3. Dependiendo de el 'theme' o 'skin' tendrás que añadir el plugin al sidebar usando las opciones de 'visualizacion'

== Frequently Asked Questions ==

= ¿Cómo funciona el widget? =

Escribe la localidad donde quieras buscar dentro del cuadro de texto, selecciona un tipo de carburante o recarga eléctrica en el menú desplegable y pulsa buscar.
Aparecerán unos indicadores donde estén las estaciones de servicio de la localidad seleccionada.

La más barata aparecerá indicada con una bandera blanca con una estrella.
Las siguientes tres más económicas aparecerán en verde.
Las tres más caras en rojo.
El resto saldrán coloreadas en naranja.

= ¿Cómo se guarda la configuración? =

El widget guarda la última localidad buscada, así como el último tipo de carburante seleccionado en una cookie. De esta forma será mucho más cómodo de utilizar para el usuario.

== Screenshots ==

1. Detalle del widget funcionando en el sidebar
2. Acceso al configurador del plugin
3. Panel de administración con las opciones del plugin
4. Panel de administración en inglés

== Changelog ==

= 0.9.3 =
* Añadido un campo para personalizar el título del widget

= 0.9.2 =
* Añadida una opción para limitar la búsqueda a puntos de recarga eléctrica,
* de forma exclusiva
* Añadida opción para que la búsqueda por defecto sea de puntos de recarga,
* pero permitiendo que el usuario utilice también el buscador de gasolineras
* Añadida una opción para que aparezca por defecto una localidad. Útil para
* webs dedicadas a una zona en particular
* Adaptado para multiidioma y creada la traducción al inglés
* Adaptado también el lado del servidor para soportar idioma inglés. Utiliza
* la configuración del navegador para seleccionar uno u otro idioma

= 0.9.1 =
* Cambios en el servidor de la app que pueden proporcionar un tiempo de carga un 15% más rápido
* Corregidos unos problemas con el height y el width del widget que hacían que los tamaños no aparecieran correctamente
* Realizadas algunas modificaciones de usabilidad, ahora se aprovecha un poco mejor el espacio

= 0.9 =
* Añadidas Screen Shots
* Pasada a versión 0.9 para solucionar un error con la versión que aparecía en Wordpress

= 0.8 =
* Sidebar widget funcional, con buscador de carburantes y puntos de recarga
* Panel de configuración para administradores funcional, permite cambiar el acho, alto y marcar la activación del modo 'buscador de puntos de recarga'

== Upgrade Notice ==

= 0.9.1 =
Corregidos varios bugs que afectaban a la visualización del plugin. Además se ha añadido soporte para funcionar correctamente con cualquier 'theme' 
