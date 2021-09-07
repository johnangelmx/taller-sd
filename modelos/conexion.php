
<?php
class Conexion{
static public function conectar(){
   $link = new PDO("mysql:host=bk1ylqbpjxfl0putzt2u-mysql.services.clever-cloud.com;dbname=bk1ylqbpjxfl0putzt2u",
                  "utv9u0bcytgwtgcc",
                  "fX4iBsN3HZ4Z8HX32RZQ");
   $link->exec("set names utf8");
   return $link;
}
}