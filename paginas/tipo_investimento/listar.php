<?php

require_once("../../conexao.php");

$tabela = 'tipo_investimento';

$query = $pdo->query("SELECT * FROM $tabela ORDER BY id desc");
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
        echo <<<HTML
    <tr class="bg-secondary">
        <td>{$nome}</td>
        <td>
            <a href="#" onclick="editar('{$id}','{$nome}')" title="Editar Dados"><i class="fa fa-edit text-info mx-2"></i></a>

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
    function editar(id, nome) {
        $('#id').val(id);
        $('#nome').val(nome);
        $('#modalForm').modal('show');
        $('#titulo_inserir').text('Editar Registro');
    }

    function limparCampos() {
        $('#nome').val('')
        $('#id').val('')
    }
</script>