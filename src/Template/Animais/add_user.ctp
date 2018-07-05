<?php 
      
    echo $this->Html->scriptBlock('

        jQuery(function($){
            
            $("#data-nasc").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});

        });
    ',['defer' => true]);
?> 
<nav class="large-3 medium-4 columns" >
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar Animais'), ['action' => 'index_user']) ?></li>
    </ul>
</nav>
<div class="animais form large-9 medium-8 columns content">
    <?= $this->Form->create($animai, ['type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Adicionar Animal') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('descricao');
            echo $this->Form->input(
                'sexo',
                [
                    'type'=>'select',
                    'options'=>$sexo,
                    'empty'=>'Selecione'
                ]
            );
            echo $this->Form->input('data_nasc', ['label'=>'Nascimento', 'type' => 'text']);
            echo $this->Form->input('raca');
            echo $this->Form->input(
                'pelagem', 
                
                    [
                        'type'=>'select',
                        'options' => $pelagem,
                        'empty'=> 'Selecione'
                    ]
                    
            );
            echo $this->Form->input('localizacao');
            echo $this->Form->input(
                'status_2',
                [
                    'type'=>'radio',
                    'value'=>'A',
                    'label'=>'Status',
                    'options' => $status_2,
                    'required'=>false

                ]
            );

            echo $this->Form->input('link_video');
            echo $this->Form->file('foto_1');
            echo $this->Form->file('foto_2');
            echo $this->Form->file('foto_3');
            echo $this->Form->file('foto_4');
            echo $this->Form->input('geneologia', ['type'=>'textarea', 'label'=>'Geneologia']);
            echo $this->Form->input('valor');
            echo $this->Form->input('parcelas');
            echo $this->Form->input('data_leilao_ini', ['empty' => true]);
            echo $this->Form->input('data_leilao_fim', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
