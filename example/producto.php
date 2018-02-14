<?php
require_once "../lib/nusoap.php";
//Metodo que retorna los libros indicados en el return
function getProd($categoria) {
   if ($categoria == "libros") {
      return join(",", array(
         "El señor de los anillos",
         "Los limites de la Fundación",
         "The Rails Way"));
   } else {
      return "No hay productos de esta categoría";
   }
}
//Creamos sevicio soap
$server = new nusoap_server();
$server->configureWSDL("producto", "urn:producto");
$server->register("getProd",
   array("categoria" => "xsd:string"),
   array("return" => "xsd:string"),
   "urn:producto",
   "urn:producto#getProd",
   "rpc",
   "encoded",
   "Nos da una lista de productos de cada categoría");
//es un flujo de sólo lectura que permite leer datos del cuerpo solicitado. En el caso de peticiones POST, es preferible usar php://input en vez de $HTTP_RAW_POST_DATA
$post = file_get_contents('php://input');
$server->service($post);