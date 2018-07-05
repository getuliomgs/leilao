<?php

?>
<nav class="large-3 medium-4 columns">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'deleteUser', $lance->id],
                ['confirm' => __('Confirmar exclusão de lance # {0}?', $lance->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar Lances'), ['action' => 'indexUser']) ?></li>
    </ul>
</nav>
<div class="lances form large-9 medium-8 columns content">
    <?= $this->Form->create($lance) ?>
    <fieldset>
        <legend><?= __('Edit Lance') ?></legend>
        <?php
            echo $this->Form->input('users_id', ['options' => $users]);
            echo $this->Form->input('animais_id', ['options' => $animais]);
            echo $this->Form->input('valor');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
