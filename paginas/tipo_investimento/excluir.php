<?php
require_once("../../conexao.php");

$tabela = 'tipo_investimento';


$id = $_POST['id'];

$query2 = $pdo->query("SELECT * FROM investimentos where tipo_investimento = '$id'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$total_reg2 = @count($res2);
if($total_reg2 > 0){
	echo 'Não é possível excluir o registro, pois existem investimentos relacionados a esse tipo de investimentos!';
	exit();
}

$pdo->query("DELETE FROM $tabela WHERE id = '$id' ");

echo 'Excluído com Sucesso';

?>