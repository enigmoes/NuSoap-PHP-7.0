<?php
require_once "../lib/nusoap.php";
//Recogemos datos de un servicio soap
$cliente = new nusoap_client("http://localhost/nusoap/example/producto.php?wsdl");
//Comprobamos errores
$error = $cliente->getError();
if ($error) {
   echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}
//Invocamos al metodo que nos retorna los libros
$result = $cliente->call("getProd", array("categoria" => "libros"));
//Comprobamos fallos
if ($cliente->fault) {

   echo "<h2>Fault</h2><pre>";
   print_r($result);
   echo "</pre>";

} else {
//Comprobamos errores
   $error = $cliente->getError();
   if ($error) {
      echo "<h2>Error</h2><pre>" . $error . "</pre>";
   } else {
      //Si no hay errores imprimimos los libros almacenados en $result
      echo "<h2>Libros</h2><pre>";
      echo $result;
      echo "</pre>";
   }

}