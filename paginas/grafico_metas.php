<?php
@session_start();
require_once("conexao.php");

$id_usuario =  $_SESSION['id_usuario'];


$pag = 'metas';

?>



<?php

$query = $pdo->query("SELECT * FROM metas where id_usuario = '$id_usuario' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){ 
    ?>


<div class="container-fluid pt-4 px-4">

    <div class="row">

    <?php 
for($i=0; $i < $total_reg; $i++){
  foreach ($res[$i] as $key => $value){}
  $nome_meta = $res[$i]['nome'];
  $valor_total = $res[$i]['valor_total'];
  $valor_arrecadado = $res[$i]['valor_arrecadado'];
  $percentual = ($valor_arrecadado * 100) / $valor_total;
  $foto = $res[$i]['arquivo'];
  $id = $res[$i]['id'];
  
  $valor_total_formatado = number_format($res[$i]['valor_total'], 2, ',', '.');
  $valor_arrecadado_formatado = number_format($res[$i]['valor_arrecadado'], 2, ',', '.');
  
  ?>
        <div class="col-md-4" style="margin-top: 10px;">
            <div class="bg-secondary rounded h-100 p-4">
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="mb-4"><?php echo $nome_meta ?></h6>
                    </div>
                </div>

                <div class="pg-bar mb-3">
                    <img src="img/metas/<?php echo $foto ?>" width="115px" height="100px">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 style="margin-top: 10px" ;>Valor Arrecadado: R$ <?php echo $valor_arrecadado_formatado ?></h6>
                        </div>
                        <div class="col-md-6">
                            <h6 style="margin-top: 10px" ;>Valor Total: R$ <?php echo $valor_total_formatado ?></h6>
                        </div>
                    </div>

                    <div class="progress" style="margin-top: 10px;">
                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $percentual ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>    
    </div>

</div>


<?php } ?>


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
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Nome" required >
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor Total</label>
                                <input type="text" class="form-control" id="valor_total" name="valor_total" placeholder="Digite o Valor" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor Arrecadado</label>
                                <input type="text" class="form-control" id="valor_arrecadado" name="valor_arrecadado" placeholder="Digite o Valor" required>
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
                    <input type="text" name="id" id="id">
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


