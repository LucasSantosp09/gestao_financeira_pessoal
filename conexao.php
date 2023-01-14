<?php
$banco = 'controle_financeiro';
$usuario = 'root';
$senha = '';
$servidor = 'localhost';


try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Não conectado ao Banco de Dados! <br><br>' .$e;
}

$url_sistema = "http://localhost/gestao_financeira/"; 

$relatorio_pdf = 'Sim';



?>