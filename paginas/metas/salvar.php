<?php

require_once("../../conexao.php");
@session_start();
$tabela = 'metas';

$nome = $_POST['nome'];
$valor_arrecadado = $_POST['valor_arrecadado'];
$valor_total = $_POST['valor_total'];
$id = $_POST['id'];
$id_usuario =  $_SESSION['id_usuario'];

//validar troca da foto
$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$arquivo = $res[0]['arquivo'];
}else{
	$arquivo = 'sem-foto.jpg';
}

//Validar valor  total
if($valor_arrecadado > $valor_total){
	echo 'O valor arrecadado não pode ser maior do que o valor total!';
	exit();
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/metas/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($arquivo != "sem-foto.jpg"){
				@unlink('../../img/receitas/'.$arquivo);
			}

			$arquivo = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if($id == ""){
    $query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, valor_total = :valor_total, valor_arrecadado = :valor_arrecadado, arquivo = '$arquivo', id_usuario = '$id_usuario'  ");
}else {
    $query = $pdo->prepare("UPDATE $tabela SET nome = :nome, valor_total = :valor_total, valor_arrecadado = :valor_arrecadado, arquivo = '$arquivo', id_usuario = '$id_usuario'  WHERE id = '$id' ");
}


$query->bindValue(":nome", "$nome");
$query->bindValue(":valor_total", "$valor_total");
$query->bindValue(":valor_arrecadado", "$valor_arrecadado");
$query->execute();
echo 'Salvo com Sucesso';


?>