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

//Inserindo novo usuario
//$usuario = new Usuario("marthina", "1234", "marthina@gmail.com", "Marthina Sant' Anna Lessa", 1, 5, "admin", 1, 1, 1);
//$usuario->insert();
//echo $usuario;

//Altera Usuário
//$usuario = new Usuario();
//$usuario->loadById(30);
//$usuario->update("rafa", "007", 2, 1, 2, 2, 2);
//echo $usuario;


//Deletando Usuário
$usuario = new Usuario();
$usuario->loadById(30);
$usuario->delete();
echo $usuario;
?>