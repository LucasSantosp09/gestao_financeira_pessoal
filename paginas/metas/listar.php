<?php

require_once("../../conexao.php");
@session_start();

$tabela = 'metas';



$id_usuario =  $_SESSION['id_usuario'];
$query = $pdo->query("SELECT * FROM $tabela where id_usuario = '$id_usuario' ORDER BY id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if ($total_reg > 0) {
    echo <<<HTML
	<small>
    <div class="bg-secondary rounded h-100 p-4">
        <table class="table table-hover" id="example">
        <thead> 
        <tr class="text-primary"> 
        <th>Nome</th>	
        <th>Valor Arrecadado</th>	
        <th>Valor Total</th>	
        <th>Arquivo</th>
        <th>Ações</th>
        </tr> 
        </thead> 
        <tbody>	
HTML;

    for ($i = 0; $i < $total_reg; $i++) {
        foreach ($res[$i] as $key => $value) {
        }
        $id = $res[$i]['id'];
        $nome = $res[$i]['nome'];
        $valor_arrecadado = $res[$i]['valor_arrecadado'];
        $valor_total = $res[$i]['valor_total'];
        $arquivo = $res[$i]['arquivo'];
        $valorArrecadadoFormatado = number_format($res[$i]['valor_arrecadado'], 2, ',', '.');
        $valorTotalFormatado = number_format($res[$i]['valor_total'], 2, ',', '.');

        $ext = pathinfo($arquivo, PATHINFO_EXTENSION);
        if ($ext == 'pdf') {
            $tumb_arquivo = 'pdf.png';
        } else if ($ext == 'rar' || $ext == 'zip') {
            $tumb_arquivo = 'rar.png';
        } else {
            $tumb_arquivo = $arquivo;
        }

        echo <<<HTML
    <tr class="bg-secondary">
        <td>{$nome}</td>
        <td>R$ {$valorArrecadadoFormatado}</td>
        <td>R$ {$valorTotalFormatado}</td>
        <td><a href="img/metas/{$arquivo}" target="_blank"><img src="img/metas/{$tumb_arquivo}" width="27px" class="mr-2"></a></td>
        <td>
            <a href="#" onclick="editar('{$id}','{$nome}','{$valor_total}', '{$valor_arrecadado}')" title="Editar Dados"><i class="fa fa-edit text-info mx-2"></i></a>

            <li class="dropdown head-dpdn2" style="display: inline-block;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-trash text-danger"></i></a>

            <ul class="dropdown-menu" style="margin-left:-230px;">
            <li>
            <div class="notification_desc2">
            <p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
            </div>
            </li>										
            </ul>
            </li>
		</td>
    </tr>
HTML;
    }

    echo <<<HTML
    </tbody>
        <small><div align="center" id="mensagem-excluir"></div></small>
    </table>
    </div>    
    </small>
HTML;
} else {
    echo 'Não possui nenhum registro Cadastrado!';
}

?>


<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable({
            "ordering": true,
            retrieve: true
        });
    });
</script>



<script>
    function editar(id, nome,valor_arrecadado, valor_total) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#valor_arrecadado').val(valor_arrecadado);
        $('#valor_total').val(valor_total);
        $('#modalForm').modal('show');
        $('#titulo_inserir').text('Editar Registro');
    }

    function limparCampos() {
        $('#nome').val('')
        $('#valor_arrecadado').val('')
        $('#valor_total').val('')
        $('#target').attr('src', 'img/metas/sem-foto.jpg');
        $('#id').val('')
    }
</script>