<?php
$usuario = 'tra5';
$contraseña = 'uE5(d[kW02Bq*_*K';
$host = 'localhost';
$base = 'trabajora5';

$conn = mysqli_connect($host,$usuario,$contraseña,$base);

if ($conn) {

    echo "";

} else {

    die("Ha fallado la conexión debido a : ".mysqli_connect_error());

}

?>