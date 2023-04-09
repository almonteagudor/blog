## Blog

### Desplegando en local por primera vez

Una vez descargado el proyecto se deben ejecutar los siguientes comandos

- make start
- make prepare

En sucesivas ocasiones se usará "make start" y "make stop" para levantar y bajar el contenedor.

En el archivo Makefile se pueden revisar otros comandos de utilidad.

### Consideraciones

La prueba se ha realizado con arquitectura hexagonal. Dejando el núcleo de la aplicación en el directorio src. Hay definidos dos contextos, el Blog y el Shared.
En la capa de dominio del contexto Shared, existe un leve acoplamiento con la librería "Ramsey\Uuid". Este acoplamiento, en teoría no debería darse, pero creo los beneficios de la librería lo justifica. Además lo he movido al contexto Shared para no ensuciar el contexto principal con acoplamientos.

Se han usado value objects con las validaciones encapsuladas para que en ningún momento se genere un dato que no esté contemplado en las reglas de dominio. Asegurando así tambien las entidades de dominio, ya que en nuestro código no se podrá construir ninguna con datos erróneos. Se han incluido validaciones básicas, pero queda definido el espacio donde incluir todas las que se necesiten.

En la capa de aplicación, se han definido los distintos casos de uso, con command/queries y sus manejadores. En el caso del getAllPosts, la query está vacía, se ha creado de todos modos para que, más adelante, se pueda automatizar con un bus, ya sea el de Laravel o uno propio.

### Links de aplicación

http://localhost:8080/post

http://localhost:8080/post/0678d558-d633-11ed-afa1-0242ac120002

### Links de api

[GET] http://localhost:8080/api/post (Todos Los posts)

[POST] http://localhost:8080/api/post (Crear un nuevo post con los datos "title", "body", "authorId")
