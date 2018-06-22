<?php
    echo $this->Html->scriptBlock('

        jQuery(function($){
            $( "form" ).submit(function() {
                if($("#password").val() != $("#confirmar").val() ){
                    alert("Senha não confore!");
                }else{
                    //return false;    
                }
            });
            $("#confirmar").change(
                function(){
                    if($("#password").val() != $("#confirmar").val() ){
                        alert("Senha não confere!");
                    }
                }
            );
        });
    ',['defer' => true]);
?> 
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Editar Usuários') ?></legend>
        <?php
            echo $this->Form->input('username', ['label' => 'Usuário', 'disabled']);
            echo $this->Form->input('password', ['label' => 'Senha']);
            echo $this->Form->input('confirmar', ['type'=>'password', 'label' => 'Confirmar Senha', 'required' => true ]);
            //echo $this->Form->input('role', ['options' => $optRole, 'label' => 'Credencial']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Salvar')) ?>
    <?= $this->Form->end() ?>
</div>
