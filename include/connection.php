<?php
$host = "localhost";
$db   = "domaci1";
$user = "root";
$pass = "";

$_connection = new mysqli($host,$user,$pass,$db);

if ($_connection->connect_errno){
    exit("Nauspesna konekcija: greska> ".$_connection->connect_error.", err kod>".$_connection->connect_errno);
}

?>