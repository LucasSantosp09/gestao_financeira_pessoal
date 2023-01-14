<?php
require('conexao.php');

$nome = $_POST['nome'];
$senha = $_POST['senha'];
$confirma_senha = $_POST['confirma_senha'];
$email = $_POST['email'];

//validar Usuário
$query2 = $pdo->query("SELECT * FROM usuarios where email = '$email' ");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if (@count($res2) > 0 ){
    echo "<script>window.alert('Email já cadastrado!')</script>";
    echo "<script>window.location='cadastro.php'</script>";
    exit();
}



if ($senha != $confirma_senha ){
    echo "<script>window.alert('Senha não confere!')</script>";
    echo "<script>window.location='cadastro.php'</script>";
}else {
    $res = $pdo->prepare("INSERT INTO usuarios SET email = :email, senha = :senha, nome = :nome, foto = 'sem-foto.jpg' ");
	$res->bindValue(":email", $email);
	$res->bindValue(":senha", $senha);
    $res->bindValue(":nome", $nome);
    $res->execute();
   
    echo "<script>window.alert('Cadastrado com Sucesso!')</script>";
    echo "<script>window.location='login.php'</script>";
}


?>