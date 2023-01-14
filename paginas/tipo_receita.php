<?php
@session_start();
require_once("conexao.php");

$pag = 'tipo_receita';
?>

<div class="" style="margin:20px;">
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Novo Tipo</a>
</div>


<div class="bs-example widget-shadow" style="padding:15px ;" id="listar">

</div>


<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-primary"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
			<form action="" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome">
							</div>
						</div>
					</div>
				
					<br>

					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">Salvar</button>
					</div>
					<input type="hidden" name="id" id="id">

					<br>
					<small>
						<div id="mensagem" align="center"></div>
					</small>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var pag = "<?= $pag ?>"
</script>
<script src="js/ajax.js"></script>