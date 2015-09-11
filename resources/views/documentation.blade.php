@extends('layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Documentaci&oacute;n</div>
                    <div class="panel-body">
                        <h3>Se debe subir el c&oacute;digo del proyecto a un repositorio GIT online (pj: bitbucket &oacute; github) y dar acceso al mismo.</h3>
                        <p>La direcci&oacute;n del repositorio es la siguiente: <a href="https://github.com/serranozafra/pruebaHectorSerrano">https://github.com/serranozafra/pruebaHectorSerrano</a></p>
                        <h3>Deben de existir 2 scripts de base de datos dentro del c&oacute;digo subido al repositorio GIT, uno con la estructura de base de datos y otro con un conjunto de datos iniciales.</h3>
                        <p>Dentro de la carpeta /sql del directorio raiz del repositorio se pueden encontrar los archivos <b>estructura.sql</b> y <b>datos.sql</b></p>
                        <h3>El proyecto debe de estar online en alg&uacute;n dominio o IP p&uacute;blica de forma que pueda evaluarse sin necesidad de desplegarlo.</h3>
                        <p>Podemos acceder al proyecto mediante la url <a href="http://hectorserrano.pove.com.es/">hectorserrano.pove.com.es</a> </p>
                        <h3>Se entregar&aacute; una documentaci&oacute;n online que incluya:</h3>
                        <ul>
                            <li><u>Esquema Entidad Relaci&oacute;n y descripci&oacute;n de cada tabla de la base de datos.</u></li>
                            <a href="http://hectorserrano.pove.com.es/public/img/entidad-relacion.png"><img src="http://hectorserrano.pove.com.es/public/img/entidad-relacion.png" class="img-thumbnail" ></a>
                            <p>
                                Descripci&oacute;n de las tablas:<br>
                                <b>migrations</b>: Tabla creada por laravel para controlar la creaci&oacute;n de las tablas y sus seedeers (a&ntilde;adiendo --seed)<br>
                                <b>users</b>: Tabla de usuarios, que ser&aacute; necesaria para hacer login en la aplicaci&oacute;n. (Ejemplo de usuario para login: <b>admin@admin.com</b> y pass <a>admin</a><br>
                                <b>products</b>: Tabla de productos. Los campos name y description se encuentran en el idioma por defecto. Posee una clave ajena a Categor&iacute;a <br>
                                <b>categories</b>: Tabla de categor&iacute;as. El campo name se encuentra en el idioma por defecto. <br>
                                <b>colors</b>: Tabla de colores. El campo name se encuentra en el idioma por defecto. <br>
                                <b>languages</b>: Tabla de idiomas. Se incluir&aacute;n todos los idiomas que no sean el por defecto (En nuestro ejemplo, si el idioma por defecto es Espa&ntilde;ol, se a&ntilde;adir&aacute;n Ingl&eacute;s y Alem&aacute;n)<br>
                                <b>products_colors</b>: Tabla que relaciona los productos con sus colores. Contiene una clave ajena a sus respectivas tablas<br>
                                <b>languages_products</b>: Tabla que relaciona los productos con sus traducciones de name y description. Contiene una clave ajena a sus respectivas tablas <br>
                                <b>languages_colors</b>: Tabla que relaciona las categor&iacute;as con sus traducciones. Contiene una clave ajena a sus respectivas tablas <br>
                                <b>languages_categories</b>: Tabla que relaciona los colores con sus traducciones. Contiene una clave ajena a sus respectivas tablas <br>
                            </p>

                            <li><u>Requisitos del proyecto (versiones de PHP, Mysql etc...)</u></li>
                            <p>El proyecto ha sido creado a trav&eacute;s del Framework Laravel 5.1, por lo tanto, tal y como indica la documentaci&oacute;n de Laravel, sus requisitos son:
                                PHP >= 5.5.9<br>
                                OpenSSL PHP Extension<br>
                                PDO PHP Extension<br>
                                Mbstring PHP Extension<br>
                                Tokenizer PHP Extension<br></p>

                            <li><u>Un apartado con una respuesta breve para cada una de las siguientes preguntas:</u>
                                <ul>
                                <li><u>Si se tuviera que a&ntilde;adir un nuevo idioma, Qu&eacute; cambios (si son necesarios) har&iacute;an falta tanto a nivel de PHP como de Base de datos?</u></li>
                                <p>En el cms no habr&iacute;a que realizar ning&uacute;n cambio ni en la estructura de la base de datos ni en el PHP, tan s&oacute;lo habr&iacute;a que insertar un nuevo idioma en base de datos (Desde el cms en Idiomas->insertar) y traducir los datos oportunos (Pinchando en traducir en todos los listados)</p>
                                <li><u>Se nos pide realizar un buscador (dentro de nuestro cms usando
                                    Mysql+PHP) de productos con las condiciones expuestas bajo. Qu&eacute;
                                    query (SQL) o conjunto de ellas usarias? Razona tu respuesta.</u>

                                    <ul>
                                    <li><u>B&uacute;squeda por identificador, precio y categor&iacute;a.</u></li>
                                    <p>Para buscar por categor&iacute;a tenemos que hacer un INNER JOIN de productos con la clase categor&iacute;a:<br>
                                        INNER JOIN categories ON products.id_category = categories.id<br>
                                        Y a&ntilde;adir un where para buscar por todos los par&aacute;metros<br>
                                        WHERE products.id='{id del producto}' AND categories.name LIKE '%{nombre de la categoria}%' and price = '{precio}'<br>
                                        (Si s&oacute;lo se quiere buscar por uno de los par&aacute;metros, se deben quitar las cl&aacute;sulas que no se necesiten del where)
                                    </p>
                                    <li><u>En el listado resultante debe de mostrarse toda la informaci&oacute;n del producto (nombre, descripci&oacute;n, precio, color y categor&iacute;a). </u></li>
                                    <p>Para mostrar toda la informaci&oacute;n del producto, se deben a&ntilde;adir las tablas oportunas mediante INNER JOIN o LEFT JOIN:<br>
                                        SELECT products.*,categories.name as categories, colors.name as colors<br>
                                        FROM products<br>
                                        INNER JOIN categories ON products.id_category = categories.id //En este caso mostrar&iacute;a s&oacute;lo los productos que tienen una categor&iacute;a asignada<br>
                                        INNER JOIN colors ON products.id_color = colors.id //En este caso mostrar&iacute;a s&oacute;lo los productos que tienen un color asignado<br>
                                    </p>
                                    <li><u>Se podr&aacute; ordenar por nombre y precio.</u> </li>
                                    <p>
                                        Para ello usaremos la cl&aacute;usula ORDER BY: <br>
                                        ORDER BY products.name,products.price ASC //Ordenar&iacute;a primero por nombre y luego por precio, en caso de querer que ordene s&oacute;lo por uno, quitar otro
                                    </p>
                                    <li><u>Existen al menos 100.000 productos, 20 categor&iacute;as y 10 colores, cada uno con los datos traducibles en los 3 idiomas indicados.</u></li>
                                    <p>
                                        Para tablas numerosas se recomienda a&ntilde;adir INDEX de los par&aacute;metros que m&aacute;s se buscan.
                                    </p>
                                    <li><u>La b&uacute;squeda se debe realizar en el menor tiempo posible, mostr&aacute;ndose un m&aacute;ximo de 50 resultados por p&aacute;gina.</u></li>
                                    <p>
                                        Para ello a&ntilde;adiremos la cl&aacute;usula LIMIT: <br>
                                        LIMIT {fila desde la que parte},50 // Siendo 50 la cantidad m&aacute;xima de resultados a mostrar
                                    </p>
                                    </ul>

                                    <p>
                                        El resultado de todo lo solicitado ser&iacute;a el siguiente: <br>


                                        SELECT products.*,categories.name as categories, colors.name as colors<br>
                                        FROM products<br>
                                        INNER JOIN categories ON products.id_category = categories.id<br>
                                        INNER JOIN colors ON products.id_category = categories.id<br>
                                        WHERE products.id='{id del producto}' AND categories.name LIKE '%{nombre de la categoria}%' and price = '{precio}'<br>
                                        ORDER BY products.id,products.price ASC<br>
                                        LIMIT {fila desde la que parte},50<br>
                                    </p>

                                </li>
                                </ul>
                            </li>

                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
