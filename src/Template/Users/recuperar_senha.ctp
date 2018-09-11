<?php 
      
?>
<div class="col">
    <nav class="large-3 medium-4 columns">
        
    </nav>
    <div class="animais form large-9 medium-8 columns ">
        <h3><?= __('RECUPERAR SENHA') ?></h3>
        <p>
            Preencha o campo abaixo com seu e-mail de login.
        </p>
        <br />
        <?= $this->Form->create() ?>
        <?php      
            echo $this->Form->input('email',['required'=>true,'class'=>'form-control']);

        ?>
        <?= $this->Form->button(__('RECUPERAR')) ?>
        <?= $this->Form->end() ?>

    </div>
</div>
