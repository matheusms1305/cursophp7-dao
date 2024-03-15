<?php 
    require_once("config.php");
    /*$sql = new sql();
    $usuarios = $sql->execSelect("SELECT * FROM tb_usuarios");
    echo json_encode($usuarios);*/


  //carrega um usuario
  //$root = new Usuario();
  //$root->loadByid(2);
  //echo $root;

  //carrega uma lista de usuários
  //$lista = Usuario::getList();
  //echo json_encode($lista);


  //carrega uma lista de usuários pelo login
    //$search = Usuario::search("us");
    //echo json_encode($search);
    
//carrega um usuario pelo login e senha
//$usuario = new Usuario();
//$usuario->login("jose", "123456");

//echo $usuario;

//INSERINDO DADOS
//$aluno = new Usuario();
//$aluno->insert();
//echo $aluno;

//atualizando o usuario
$usuario = new Usuario();

$usuario->loadByid(2);
$usuario->update("professor", "54321")


  /* $root = new Usuario();

   $root->loadByid(3);

   echo $root;*/



?>