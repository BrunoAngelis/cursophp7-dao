<?php

require_once("config.php");

$consulta = new Usuario();

$consulta ->loadbyID(1);

echo $consulta;
?>