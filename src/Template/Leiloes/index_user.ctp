<?php

?>
<?php
  echo $this->Html->scriptBlock(' 
  
    jQuery(function($){

       var YY = '.$eventos->data_fim->year.';
		var MM = '.$eventos->data_fim->month.';
		var DD = '.$eventos->data_fim->day.';
		var HH = '.$eventos->data_fim->hour.';
		var MI = '.$eventos->data_fim->minute.';
		var SS = '.$eventos->data_fim->second.'; 

		
    var HojeServidorYY = '.$time->year.';
    var HojeServidorMM = '.$time->month.' - 1;
    var HojeServidorDD = '.$time->day.';
    var HojeServidorHH = '.$time->hour.';
    var HojeServidorMI = '.$time->minute.';
    var HojeServidorSS = '.$time->second.'; 

    var alertEncerramento = true;

    var testeHoje = new Date();
    var testeHojeServidor = new Date(HojeServidorYY,HojeServidorMM,HojeServidorDD,HojeServidorHH,HojeServidorMI,HojeServidorSS);
    //alert(testeHoje.getTimezoneOffset().);
    //alert("Servidor: '.$time.$time->second.'microtime "+testeHojeServidor.getTime()+" navegador: "+testeHoje+"microtime "+testeHoje.getTime());

    var diferencaHorario = parseInt((testeHojeServidor.getTime() - testeHoje.getTime()) / 3600000);

    //alert(diferencaHorario);

    function atualizaContador() {


    var hoje = new Date();


    hoje.setHours(hoje.getHours() + diferencaHorario);

   
    var futuro = new Date(YY,MM-1,DD,HH,MI,SS); 

    var HojeServidor = new Date(HojeServidorYY,HojeServidorMM,HojeServidorDD,HojeServidorHH,HojeServidorMI,HojeServidorSS); 

    var ss = parseInt((futuro - hoje)  / 1000);
    var mm = parseInt(ss / 60);
    var hh = parseInt(mm / 60);
    var dd = parseInt(hh / 24); 

    ss = ss - (mm * 60);
    mm = mm - (hh * 60);
    hh = hh - (dd * 24); 

    var faltam = "Faltam ";
    faltam += (dd && dd > 1) ? dd+" dias, " : (dd==1 ? "1 dia, " : "");
    faltam += (toString(hh).length) ? hh+"h : " : "";
    faltam += (toString(mm).length) ? mm+"m : " : "";
    faltam += ss+"s"; 
    faltam += " para o encerramento. "; 

      if (dd+hh+mm+ss > 0) {
        document.getElementById("contador").innerHTML = faltam;
        setTimeout(atualizaContador,1000);
      } else {
        document.getElementById("contador").innerHTML = "ENCERRADO!!!!";
        setTimeout(atualizaContador,1000);
        if(alertEncerramento) {
          alert("Leilão ENCERRADO!");
          alertEncerramento = false;
        }
      }
    }
    atualizaContador();

        

    });
  ' ,  ['defer' => true])
?>

<div class="container">

	<div class="eventos row">
		<div class="col-	col-sm-	col-md-	col-lg-	col-xl-4" >
			<?php echo $this->html->image('../uploads/eventos/'.$eventos->img2, ['width'=>"100%"]); ?> 
		</div>
		<div class="col-	col-sm-	col-md-	col-lg-	col-xl-8"  >
			<?php
				$meses = array(1=>'janeiro',2=>'fevereiro', 3=>'março',4=>'abril',5=>'maio',6=>'junho',7=>'julho',8=>'agosto',9=>'setembro',10=>'outubro',11=>'novembro',12=>'dezembro' );
				echo "<h2>".'<strong>'.$eventos->nome.'</strong>';
				echo "<br /><strong>Início:</strong> ".$eventos->data_ini->day." de ".$meses[$eventos->data_ini->month];
				echo "<br /><strong>Encerramento: </strong> ".$eventos->data_fim->day." de ".$meses[$eventos->data_fim->month]." | ".$eventos->data_fim->hour."hs</h2>";
			?>
			<h3>
				<strong>
					<span id="timerLeilao15" class="contador"></span>
        			<span  style="color: red; " id="contador" class="contador border border-danger"></span>
        		</strong>
        	</h3>
		</div>        
    </div>
    <hr>
  	<div class="row">
  		<?php foreach($listarAnimais as $key => $value): ?>
			<div class="col-md-4">

		    	<div class="card mb-4 box-shadow">
		        	<div class="card-body">
		        		<p ><h4><?= h($value->nome) ?></h4></p>
						<img class="card-img-top" src="../uploads/animais/<?= h($value->foto_1) ?>" data-src="a<?= h($value->foto_1) ?>" alt="Card image cap">
						<p class="card-text">
							<?php echo nl2br($value->descricao); ?>
						</p>
						<p class="card-text">
							LOTE: <strong><?php echo $value->id ?></strong>
						</p>
						<div class="card-lance-atual">						
							Lance atual
							<?php if(count($lances[$value->id]) <= 0) { ?>
							<div class="card-lance-atual-valor">
								<samp style="font-size: small;"><?= h($value->parcelas) ?>x de </samp><strong>R$ <?= h(number_format($value->valor, 2, ",", ".")) ?></strong>
							</div>
							<?php } else { ?>
								<div class="card-lance-atual-valor">
									<?= h($value->parcelas) ?>x de <strong>R$ <?= h(number_format($lances[$value->id]->valor, 2, ",", ".")) ?></strong>
								</div>
							<?php }; ?>
						</div>
		          		<div class="d-flex justify-content-between align-items-center">
		            		
		            		<?= $this->Form->create(null, ['url'=>['controller'=>'animais', 'action'=>'leilao/'.$value->id], 'type'=>'post']); ?>
		            			<div class="btn-group">	            			
			            			<?php if($flagLeilao[$key] == "FEC"): ?>
			              				<?php
			              					echo $this->Form->button("DETALHES", ['class'=>"btn btn-secondary btn-lg btn-block" ]);
			              					echo $this->Form->button("X", ['class'=>"btn btn-dark" ]);
			              				?>
			              			<?php endif; ?>

			              			<?php if($flagLeilao[$key] == "ABE"): ?>		              				
			              				<?php
			              					echo $this->Form->button("DETALHES", ['class'=>"btn btn-success btn-lg btn-block" ]);
			              					echo $this->Form->button("O", ['class'=>"btn btn-dark btn-abe" ]);
			              				?>
			              			<?php endif; ?>

			              			<?php if($flagLeilao[$key] == "EMB"): ?>
			              				
			              				<?php
			              					echo $this->Form->button("DETALHES", ['class'=>"btn btn-warning btn-lg btn-block" ]);
			              					echo $this->Form->button("#", ['class'=>"btn btn-dark btn-emb" ]);
			              				?>
			              			<?php endif; ?>		              			
		            			</div>
		            		<?= $this->Form->end(); ?>
		          		</div>
		        	</div>
		      	</div>
		    </div>
		<?php endforeach; ?>
	</div>
</div>

       