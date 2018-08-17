<?php

?>
<nav class="large-3 medium-4 columns" >
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar'), ['action' => 'indexUser']) ?></li>
    </ul>
</nav>
<div class="eventos form large-9 medium-8 columns content">
    <?= $this->Form->create($evento, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Leilões') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->file('img', ['label'=>'Full Banner']);
            echo $this->Form->file('img2', ['label'=>'Imagem interna']);
            echo $this->Form->input('data_ini', ['label'=>'Data Ínicio  (Ano - Mês - dia - hora : minuto)']);
            echo $this->Form->input('data_fim', ['label'=>'Data Fim (Ano - Mês - dia - hora : minuto)']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
