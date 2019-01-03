<?php

require_once("config.php");

//CArrega um Usuario
//$root = new Usuario();
//$root->loadById(3);
//echo $root;

//$lista = Usuario::getList();

//echo json_encode($lista);

//$search = Usuario::search("le");

//echo json_encode($search);

$usuario = new Usuario();
$usuario->login("rafa", "123");

echo $usuario;

?>