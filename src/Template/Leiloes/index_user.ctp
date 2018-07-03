<?php

?><div class="container">
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
			              					echo $this->Form->button("FECHADO", ['class'=>"btn btn-secondary btn-lg btn-block" ]);
			              					echo $this->Form->button("X", ['class'=>"btn btn-dark" ]);
			              				?>
			              			<?php endif; ?>

			              			<?php if($flagLeilao[$key] == "ABE"): ?>		              				
			              				<?php
			              					echo $this->Form->button("LANCE", ['class'=>"btn btn-success btn-lg btn-block" ]);
			              					echo $this->Form->button("O", ['class'=>"btn btn-dark btn-abe" ]);
			              				?>
			              			<?php endif; ?>

			              			<?php if($flagLeilao[$key] == "EMB"): ?>
			              				
			              				<?php
			              					echo $this->Form->button("EM BREVE", ['class'=>"btn btn-warning btn-lg btn-block" ]);
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

       