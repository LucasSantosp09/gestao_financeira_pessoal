<?php

require_once("../../conexao.php");

$tabela = 'tipo_despesas';

$nome = $_POST['nome'];
$id = $_POST['id'];

if($id == ""){
    $query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome ");
}else {
    $query = $pdo->prepare("UPDATE $tabela SET nome = :nome WHERE id = '$id' ");
}


$query->bindValue(":nome", "$nome");
$query->execute();
echo 'Salvo com Sucesso';


?>