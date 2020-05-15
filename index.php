<?php

require_once("config.php");

//Carrega um usuario
//$consulta = new Usuario();
//$consulta ->loadbyID(1);
//echo $consulta;

//carrega uma lista de usuarios;
//$lista = Usuario::getList();
//echo json_encode($lista);

//carrega uma lista de usuarios buscando pelo login

//$search = Usuario::search("Ra");
//echo json_encode($search);

//carrega um usuario usando o login e a senha

$usuario = new Usuario();
$usuario-> login("Rafael","101010");

echo $usuario;
?>