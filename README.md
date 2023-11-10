# komei
 TP programacion 2

Trabajo de la Materia Programacion 2 de la Escuela davinci en la carrera Diseño y Programacion Web.

Pauta 
Consigna principal:
Desarrollar un sitio simulando una tienda online de una empresa, ya sea real o ficticia. El tipo de empresa y
productos a vender queda a discreción del alumno/a, pero debe contar con al menos, 15 productos distintos
a la venta. El sitio debe contar, además, con un formulario de contacto (o similar).
El sitio debe estar maquetado utilizando HTML5 y CSS3, programado utilizando PHP y contando con una
base de datos MySql que contenga todo el contenido variable. Todas las secciones que involucren productos
a la venta, deben ser de carácter dinámico.
El alumno puede utilizar frameworks (ej. Bootstrap) para realizar el maquetado del sitio.
Todo el contenido debe estar presentado utilizando español como idioma principal.
La entrega constará de un directorio que contenga:
⮚ Todos los archivos .php correspondiente a la página, correctamente organizados en carpetas.
⮚ Una carpeta que contenga la(s) hoja(s) de estilo .css.
⮚ Una carpeta con todos los elementos gráficos a utilizar. Esta última carpeta va a poder tener tantas
subcarpetas como se considere necesario.
⮚ Un archivo .sql con la totalidad de la base de datos utilizada.
⮚ Una representación grafica de las tablas creadas, incluyendo su relación. (Cualquier formato de
imagen o .pdf es aceptable)
⮚ Una lista de usuarios/contraseñas para poder interactuar con el sistema.
Cada uno de estos archivos debe estar correctamente rotulado y organizado. El directorio debe entregarse
comprimido en un archivo .zip o .rar con el siguiente nombre:
DWN3AV-APELLIDO_ DEL_ALUMNO-PARCIAL_2
Reemplazando los corchetes por el apellido correspondiente, todo en mayúsculas, utilizando _ para
delimitar los espacios y evitando caracteres especiales (Símbolos o tildes).

Programación II

2
do Parcial

DWN3AV – PROGRAMACIÓN II
PROFESOR: JORGE PÉREZ

Detalle del contenido:
El sitio debe contar con una cara publica, destinada a los clientes. Y una cara privada de administración de
contenido, destinada a los empleados. De ahora en adelante se denominará estas caras como Frontend y
Backend respectivamente.
El Frontend de contar con, como mínimo, 7 secciones:
1- Una sección fija, o “Home” que sirve de introducción a la empresa.
2- Una sección que contenga la totalidad de los productos disponibles a la venta, cada producto debe
estar representada por una “pastilla” de contenido que incluya al menos, una imagen ilustrativa, una
descripción y un precio.
3- Tantas secciones como se juzgue necesario que contentan un subgrupo de los productos disponibles
para la venta, seleccionados por algún parámetro que compartan. (Ej. Color, Precio, Género etc.)
4- Una página de detalle de producto, que muestre todos los datos pertinentes a un único producto.
(Esta página debe ser dinámica y funcional para la totalidad del catálogo.)
5- Una página con un formulario de contacto (o Similar).
6- Una sección “Datos del alumno/s” con los datos personales de el o los alumnos responsables del
trabajo.
7- Una página de “Carrito” que muestre todos los productos adquiridos por el cliente.
El Backend debe contar con:
1- Un sistema de autenticación, que solo permita el acceso a usuarios autorizados
2- Tantos paneles con funcionalidad ABM (Altas, Bajas, Modificaciones) como se considere necesario
para el funcionamiento del sitio.

HTML
El sitio debe estar maquetado utilizando etiquetas semánticas y tantas etiquetas div/span como se
consideren necesarias. Adicionalmente, el contenido debe estar organizado con el uso apropiado de
headings para determinar la jerarquía del mismo.
Todo párrafo de texto debe incluir refuerzo semántico.
El sitio debe contar con una etiqueta nav que contenga links a cada una de las secciones del sitio.
El nav debe incluir también un indicador que muestre si un usuario está validado y los botones de
login/logout según sean necesarios.
Todas las imágenes a utilizar deben ser optimizadas en peso y tamaño, respetar buenas prácticas de
nomenclatura y estar organizadas dentro de su propia carpeta.

DWN3AV – PROGRAMACIÓN II
PROFESOR: JORGE PÉREZ

La sección “Datos del alumno/s” debe contener los datos del/los alumnos/as, incluyendo:
● 1 foto de 250px de ancho
● Nombre, Apellido
● Edad (O fecha de nacimiento)
● Correo electrónico
● Redes sociales (Opcional)

CSS
El sitio debe presentar estilización en CSS, con un diseño que esté acorde al contenido. Pueden utilizar
frameworks de CSS para ayudarse (ej. Bootstrap), pero debe incluir estilización personalizada por parte del o
el/los alumnos/as. Si el trabajo entregado es muy similar a los estilos básicos de un framework (o a los
ejemplos trabajados en clase) se podrán descontar puntos.
El sitio debe ser responsive o por lo menos, poder visualizarse de manera aceptable en dispositivos móviles.
MYSQL
La totalidad del contenido variable del sitio debe provenir de una base de datos mysql/mariadb. La misma
debe contener, como mínimo:
1- Una tabla principal de productos.
2- Una tabla relacional con algún parámetro referenciado en la tabla principal que requiera datos
propios.
3- Una tabla pívot que genere una relación de muchos a muchos entre la tabla principal y otra tabla
(Puede ser nueva, o la generada en el punto 2)
4- Una tabla de usuarios que contenga los nombres de usuarios, emails, contraseñas (correctamente
cifradas) y permisos de los clientes.
Esta lista representa un mínimo, se pueden tener tantas tablas como se considere necesario.
PHP
El sitio debe implementar una carga de secciones dinámica en un template de base vía parámetros por GET,
cada producto y función debe contar una clase que contenga todas sus propiedades y métodos. Todo
contenido dinámico, ya sea perteneciente al Frontend o al Backend debe ser controlado por las clases antes
mencionadas. La información de todo contenido dinámico debe provenir de la base de datos mediante el
uso de una conexión PDO (Controlada por su propia clase) y el uso apropiado de Queries de SQL, utilizando
holders e incluyendo, como mínimo, ejemplos de consultas con SELECT, INSERT, UPDATE y DELETE.
Cada producto a la venta debe tener, al menos, 7 parámetros individuales incluyendo aquellos que
correspondan a la(s) tabla(s) relacional(es) y la tabla pívot (Ej, etiquetas, géneros, etc.)

DWN3AV – PROGRAMACIÓN II
PROFESOR: JORGE PÉREZ

Qué se evaluará:
✔ Que el código HTML sea válido, que la estructura del directorio sea correcta, esté bien organizada y que
los nombres de archivo cumplan con los lineamientos y buenas prácticas para su uso en la web. *
✔ Que se haya incluido la totalidad del contenido requerido. *
✔ Que el contenido esté organizado correctamente en lo que respecta a su jerarquía y su estructura con el
correcto uso de etiquetas semánticas. *
✔ Que la navegación del sitio sea funcional. *
✔ El uso apropiado de PHP en lo que respecta a contenido dinámico y funciones.
✔ El uso apropiado de Clases y Métodos para acceder, crear y modificar la información de productos y
tablas relacionales.
✔ La confección de la base de datos MySQL, tanto es su diseño como es su funcionamiento.
✔ El uso correcto de la clase PDO, Queries y Holders para la manipulación de datos.
✔ La confección y complejidad de las secciones y manipulación de datos utilizados.
✔ El correcto uso de formularios, tanto para contacto como para carga y manipulación de datos.
✔ La estilización del sitio.
✔ La prolijidad y presentación del código, tanto PHP como HTML y CSS.
✔ Los tamaños y el peso de las imágenes utilizadas.
(*) Estos puntos son OBLIGATORIOS para que el parcial se considere aprobado.
Puntos extra:
✔ Contar con secciones que hagan uso de métodos propios para manipular datos (Listar por rango de
precio, por características en común, por etiquetas, etc).
✔ Guardar en la base de datos las compras realizadas por cada cliente.
✔ El uso de clases complejas que contengan datos provistos por otras clases.
✔ Validación de campos y comunicación con el usuario (Mediante alertas u otros recursos)
✔ Utilización de consultas complejas de MySQL (JOIN, GROUP BY, LIKE, GROUP_CONCAT, etc.)

La entrega se evaluará en una PC corriendo Windows 10 y utilizando los

exploradores Google Chrome y Mozilla Firefox.

DWN3AV – PROGRAMACIÓN II
PROFESOR: JORGE PÉREZ

Notas adicionales:
El alumno/a tiene que ser capaz de defender de manera oral todas y cada una de las decisiones tomadas
durante el desarrollo de la entrega. Si algo no puede ser justificado, se pueden perder los puntos de esa
categoría. Absténganse de utilizar cualquier técnica o tecnología que no hayamos visto en clase.
De ser posible, el alumno debería poder hostear su trabajo para que pueda ser accedido desde internet.
Hacer esto no significa que no tengan que entregar sus archivos.
La fecha de entrega del parcial es ESTRICTA. De no haber subido su entrega para la fecha y hora estipuladas,
el parcial se considerará incompleto y el alumno/a debería rendir recuperatorio. Las únicas excepciones
serán de fuerza mayor, tras aprobación de la oficina de alumnos.****
