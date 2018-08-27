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
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'deleteUser', $animai->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $animai->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Animais'), ['action' => 'indexUser']) ?></li>
    </ul>
</nav>
<div class="animais form large-9 medium-8 columns content">
    <?= $this->Form->create($animai, [ 'type'=>'file']) ?>
    <fieldset>
        <legend><?= __('Edit Animai') ?></legend>
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
            echo $this->Form->input('data_nasc', ['label'=>'Nascimento', 'type' => 'text', 'value'=>$animai->data_nasc->format("d/m/Y")]);
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
            echo $this->Form->label('', ['label'=>'Fotos em .jpg']);
            echo $this->Form->file('foto_1');
            if(!empty($animai->foto_1)){
                echo '<img src="../../uploads/animais/'.$animai->foto_1.'" width="150" height="150" >';    
            }
            echo $this->Form->file('foto_2');
            if(!empty($animai->foto_2)){
                echo '<img src="../../uploads/animais/'.$animai->foto_2.'" width="150" height="150" >';    
            }
            echo $this->Form->file('foto_3');
            if(!empty($animai->foto_3)){
                echo '<img src="../../uploads/animais/'.$animai->foto_3.'" width="150" height="150" >';    
            }
            echo $this->Form->file('foto_4');
            if(!empty($animai->foto_4)){
                echo $this->html->image("../../uploads/animais/".$animai->foto_4, ["height"=>"150" ,'width'=>"150"]);
            }
            echo $this->Form->input('geneologia', ['type'=>'textarea', 'label'=>'Geneologia']);
            echo $this->Form->label('', ['label'=>'Fotos em .jpg']);
            echo $this->Form->file('geneologia_img');
            if(!empty($animai->geneologia_img)){
                
                echo $this->html->image("../../uploads/animais/".$animai->geneologia_img, ["height"=>"150" ,'width'=>"150"]);
            }
            echo $this->Form->input('valor');
            echo $this->Form->input('parcelas');
            echo $this->Form->input('data_leilao_ini', ['empty' => true]);
            echo $this->Form->input('data_leilao_fim', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
