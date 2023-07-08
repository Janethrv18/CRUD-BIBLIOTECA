
<?php
/*INTEGRANTES: BARAHONA NICOLE, BARRAGAN EILYN, RUIZ JANETH*/
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud-biblioteca";



$conexion = mysqli_connect($servername, $username, $password, $database);
if (!$conexion) {
    die("Conexión fallo: " . mysqli_connect_error());
}
?>
