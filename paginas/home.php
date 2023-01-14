<?php
@session_start();

require_once('conexao.php');

$id_usuario =  $_SESSION['id_usuario'];
$hoje = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$dataInicioMes = $ano_atual."-".$mes_atual."-01";




    $query = $pdo->query("SELECT * from receitas where id_usuario = '$id_usuario' and data >= '$dataInicioMes' and data <= curDate() ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);

    if($total_reg > 0){ 

        for($i=0; $i < $total_reg; $i++){
            foreach ($res[$i] as $key => $value){	}

            @$totalReceitasMes += $res[$i]['valor'];
            $totalReceitasMesFormadata = number_format($totalReceitasMes, 2, ',', '.');

        }
    }

    
    $query = $pdo->query("SELECT * from despesas where id_usuario = '$id_usuario' and data >= '$dataInicioMes' and data <=  curDate() ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);

    if($total_reg > 0){ 

        for($i=0; $i < $total_reg; $i++){
            foreach ($res[$i] as $key => $value){	}

            @$totalDespesasMes += $res[$i]['valor'];
            
            $totalDespesasFormadata = number_format($totalDespesasMes, 2, ',', '.');
            

        }
    }

    
    
    $query = $pdo->query("SELECT * from investimentos where id_usuario = '$id_usuario' and data >= '$dataInicioMes' and data <=  curDate() ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);

    if($total_reg > 0){ 

        for($i=0; $i < $total_reg; $i++){
            foreach ($res[$i] as $key => $value){	}

            @$totalInvestimentosMes += $res[$i]['valor'];
            $totalInvestimentosFormadata = number_format($totalInvestimentosMes, 2, ',', '.');

        }
    }

    @$resultado_mesal = $totalReceitasMes - $totalDespesasMes;
    $resultado_mesal_formatado = number_format($resultado_mesal, 2, ',', '.');

    if ($resultado_mesal < 0){
        $classe_resultado = 'text-primary';
    }else {
        $classe_resultado = 'text-info';
    }

 

?>
  
  <!-- Sale & Revenue Start -->
  <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-line fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-info">Receitas ( Mensal )</p>
                                <h6 class="mb-0 text-info">R$ <?php echo @$totalReceitasMesFormadata?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-bar fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-primary">Despesas ( Mensal )</p>
                                <h6 class="mb-0 text-primary">R$ <?php echo @$totalDespesasFormadata?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 text-success">Investimentos(Mensal)</p>
                                <h6 class="mb-0 text-success">R$ <?php echo @$totalInvestimentosFormadata?></h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-primary"></i>
                            <div class="ms-3">
                                <p class="mb-2 <?php echo $classe_resultado?>">Resultado ( Mensal )</p>
                                <h6 class="mb-0 <?php echo $classe_resultado?>">R$ <?php echo $resultado_mesal_formatado?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->


            <!-- Sales Chart Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-12">
                    <div class="col-sm-12 col-xl-12">
                        <div class="bg-secondary text-center rounded p-4">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <h6 class="mb-0">Saldo do Ano</h6>
                            </div>
                            <canvas id="worldwide-sales"></canvas>
                        </div>
                    </div>     
                </div>
            </div>
            <!-- Sales Chart End -->


            
