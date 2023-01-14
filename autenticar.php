<?php
@session_start();
require("conexao.php");

$email = $_POST['usuario'];
$senha = $_POST['senha'];


$query = $pdo->prepare("SELECT * from usuarios where email = :email and senha = :senha");
$query->bindValue(":email", "$email");
$query->bindValue(":senha", "$senha");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);


$_SESSION['id_usuario'] = $res[0]['id'];

$total_reg = @count($res);
if($total_reg > 0){
		echo "<script>window.location='index.php'</script>";
}else{
	echo "<script>window.alert('Usuário ou Senha Incorretos!')</script>";
	echo "<script>window.location='login.php'</script>";
}

?>