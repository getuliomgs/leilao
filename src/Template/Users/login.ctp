
<?php

?>
<div class="container">
  <div class="row">
		<div class="col-lg-4 col-md-2 col-sm-2 col- users form">
			
		</div>
		<div class="col-lg-4 col-md-8 col-sm-8 col- users form">
		<?= $this->Flash->render('auth') ?>
		<?= $this->Form->create() ?>
		    <fieldset>
		        <legend><?= __('Área Restrita') ?></legend>
		        <?= $this->Form->input('username' , ['label'=>'Usuário', 'required'=>'true' ]) ?>
		        <?= $this->Form->input('password', ['label'=>'Senha', 'required'=>'true']) ?>
		        <?= $this->Form->hidden('role', ['default'=> 'condomino' ]) ?>
		        <?= $this->Form->hidden('avulso', ['default'=> 'true' ]) ?>
		    </fieldset>
		<?= $this->Form->button(__('Logar')); ?>
		<?php
			echo  $this->Html->link('Cadastro', ['action' => 'cadastro']).'<br />';
			echo  $this->Html->link('Esqueceu senha?', ['action' => 'recuperarSenha']);
			//localhost:8765/users/recuperarSenha
		?>
		<?= $this->Form->end() ?>
		</div>
		<div class="col-lg-4 col-md-2 col-sm-2 col- users form">
			
		</div>
	</div>
</div>
