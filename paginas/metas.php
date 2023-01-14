<?php
@session_start();
require_once("conexao.php");

$pag = 'metas';
?>

<div class="" style="margin:20px;">
	<a class="btn btn-primary" onclick="inserir()" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i> Nova Meta</a>
</div>


<div class="bs-example widget-shadow" style="padding:15px ;" id="listar">

</div>


<!-- Modal Inserir-->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title text-primary"><span id="titulo_inserir"></span></h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="" id="form">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="exampleInputEmail1">Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome" required>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Valor Arrecadado</label>
								<input type="text" class="form-control" id="valor_arrecadado" name="valor_arrecadado" placeholder="Digite o Valor" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="exampleInputEmail1">Valor Total</label>
								<input type="text" class="form-control" id="valor_total" name="valor_total" placeholder="Digite o Valor" required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label>Arquivo</label>
								<input class="form-control" type="file" name="foto" onChange="carregarImg();" id="foto">
							</div>
						</div>
						<div class="col-md-4">
							<div id="divImg">
								<img src="img/metas/sem-foto.jpg" width="80px" id="target" class="mt-2">
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


<!-- Modal Relatório !-->
<div class="modal fade" tabindex="-1" id="modalRelatorio">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title text-primary">Relatório de Receitas</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form action="../gestao_financeira/rel/relReceitas_class.php" method="POST" target="_blank">
				<div class="modal-body">

					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-3">
								<label>Data Inicial</label>
								<input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1" name="dataInicial">
							</div>
						</div>
						<div class="col-md-6">

							<div class="form-group mb-3">
								<label>Data Final</label>
								<input value="<?php echo date('Y-m-d') ?>" type="date" class="form-control mt-1" name="dataFinal">
							</div>


						</div>

						<div class="col-md-6">

							<div class="form-group mb-3">
								<label>Tipo Receita</label>
								<select class="form-select mt-1" name="status">
									<option value="">Todas</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">

							<div class="form-group mb-3">
								<label>Ordenar</label>
								<select class="form-select mt-1" name="ordenacao">
									<option value="data">Data</option>
									<option value="nome">Nome Despesa</option>
									<option value="valor">Valor</option>
									<option value="tipo_receita">Tipo Receita</option>
								</select>
							</div>
						</div>




					</div>

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Gerar Relatório</button>
					<input type="hidden" name="usu" id="usu" value="<?php echo $id_usuario ?>">
				</div>
		</div>

		</form>
	</div>
</div>



<script type="text/javascript">
	$(document).ready(function() {
		$('.sel2').select2({
			dropdownParent: $('#modalForm')
		});
	});
</script>

<script type="text/javascript">
	function carregarImg() {
		var target = document.getElementById('target');
		var file = document.querySelector("#foto").files[0];


		var arquivo = file['name'];
		resultado = arquivo.split(".", 2);

		if (resultado[1] === 'pdf') {
			$('#target').attr('src', "img/pdf.png");
			return;
		}

		if (resultado[1] === 'rar' || resultado[1] === 'zip') {
			$('#target').attr('src', "img/rar.png");
			return;
		}



		var reader = new FileReader();

		reader.onloadend = function() {
			target.src = reader.result;
		};

		if (file) {
			reader.readAsDataURL(file);

		} else {
			target.src = "";
		}
	}
</script>



<script type="text/javascript">
	var pag = "<?= $pag ?>"
</script>
<script src="js/ajax.js"></script>

<script>
	function imprimir() {
		$('#modalRelatorio').modal('show');
	}
</script>