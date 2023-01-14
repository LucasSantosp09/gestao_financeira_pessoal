<?php

require_once("../../conexao.php");
@session_start();

$id_usuario =  $_SESSION['id_usuario'];


$tabela = 'despesas';


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
        <th>Valor</th>	
        <th>Data</th>	
        <th>Tipo Despesa</th>	
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
        $valor = $res[$i]['valor'];
        $data = $res[$i]['data'];
        $tipo_despesa = $res[$i]['tipo_despesa'];
        $arquivo = $res[$i]['arquivo'];
        $dataFormatada = implode('/', array_reverse(explode('-', $res[$i]['data'])));
        $valorFormatado = number_format($res[$i]['valor'], 2, ',', '.');

        $query2 = $pdo->query("SELECT * FROM tipo_despesas where id = '$tipo_despesa'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        $total_reg2 = @count($res2);
        if ($total_reg2 > 0) {
            $nome_tipo_despesa = $res2[0]['nome'];
        } else {
            $nome_cat_tipo_receita = 'Sem Referência!';
        }

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
        <td>R$ {$valorFormatado}</td>
        <td>{$dataFormatada}</td>
        <td>{$nome_tipo_despesa}</td>
        <td><a href="img/despesas/{$arquivo}" target="_blank"><img src="img/despesas/{$tumb_arquivo}" width="27px" class="mr-2"></a></td>
        <td>
            <a href="#" onclick="editar('{$id}','{$nome}', '{$data}', '{$valor}', '{$tipo_despesa}')" title="Editar Dados"><i class="fa fa-edit text-info mx-2"></i></a>

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
    function editar(id, nome, data, valor, tipo_despesa) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#data').val(data);
        $('#valor').val(valor);
        $('#tipo_despesa').val(tipo_despesa).change();
        $('#modalForm').modal('show');
        $('#titulo_inserir').text('Editar Registro');
    }

    function limparCampos() {
        $('#nome').val('')
        $('#data').val('')
        $('#valor').val('')
        $('#id').val('')
    }
</script>