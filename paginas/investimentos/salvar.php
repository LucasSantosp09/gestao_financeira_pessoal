<?php

require_once("../../conexao.php");
@session_start();

$tabela = 'investimentos';

$nome = $_POST['nome'];
$valor = $_POST['valor'];
$data = $_POST['data'];
$id = $_POST['id'];
$tipo_investimento = $_POST['tipo_investimento'];
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


//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['foto']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);

$caminho = '../../img/investimentos/' .$nome_img;

$imagem_temp = @$_FILES['foto']['tmp_name']; 

if(@$_FILES['foto']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip'){ 
	
			//EXCLUO A FOTO ANTERIOR
			if($arquivo != "sem-foto.jpg"){
				@unlink('../../img/investimentos/'.$arquivo);
			}

			$arquivo = $nome_img;
		
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if($id == ""){
    $query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, data = :data, valor = :valor, tipo_investimento = :tipo_investimento, arquivo = '$arquivo', id_usuario = '$id_usuario' ");
}else {
    $query = $pdo->prepare("UPDATE $tabela SET nome = :nome, data = :data, valor = :valor, tipo_investimento = :tipo_investimento, arquivo = '$arquivo'  WHERE id = '$id' ");
}


$query->bindValue(":nome", "$nome");
$query->bindValue(":data", "$data");
$query->bindValue(":valor", "$valor");
$query->bindValue(":tipo_investimento", "$tipo_investimento");
$query->execute();
echo 'Salvo com Sucesso';


?>