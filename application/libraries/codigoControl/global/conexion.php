<?php
$servername = "capressocafe.com";
$database = "capresso_BDFACTURACION";
$username = "capresso_facturacion";
$password = "Facturacion2020";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);
?>