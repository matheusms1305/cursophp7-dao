<?php 
    require_once("config.php");

    $sql = new sql();

    $usuarios = $sql->execSelect("SELECT * FROM tb_usuarios");

    echo json_encode($usuarios);





?>