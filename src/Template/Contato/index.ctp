<?php
?>
<div class="col">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
    	<h2><?= __('CONTATO') ?></h2>
	    <p>
	    	Gostamos sempre de ouvir a opinião de nossos clientes. Fique a vontade para entrar em contato, tirar suas dúvidas ou dar sugestões.
	    </p>
	    <br />
	    <p>
			Ideídes (Gerente):
			(71) 99699-1728
		</p>
		<br />
		<p>
			Rodrigo Vilas Boas (Administrador):
			(71) 99958-6750
		</p>
		<br />
		<p>
			E-mail: harasluanda@gmail.com
		</p>
		<br />
		<p>
			Av. Alphaville, nº 522, Quadra F4
			Lote 01, Ed. Alpha Business
			3º Andar, Sala 302, Alphaville I
			Salvador - Bahia - Brasil
			CEP: 41701-015
		</p>
	</nav>
	<div class="animais form large-9 medium-8 columns content">
		<?= $this->Form->create() ?>
		<?php
            echo $this->Form->input('nome');
            echo $this->Form->input('email');
            echo $this->Form->input('telefone');	
            echo $this->Form->input('mensagem', ['rows'=>5, 'cols'=>5, 'label' => 'Mensagem']);	
        ?>
		<?= $this->Form->button(__('ENVIAR')) ?>
		<?= $this->Form->end() ?>

	</div>
</div>