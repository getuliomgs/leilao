<?php
?><nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Listar'), ['action' => 'indexUser']) ?></li>
    </ul>
</nav>
<div class="lances form large-9 medium-8 columns content">
    <?= $this->Form->create($lance) ?>
    <fieldset>
        <legend><?= __('Adicionar Lance') ?></legend>
        <?php
            echo $this->Form->input('users_id', ['options' => $users]);
            echo $this->Form->input('animais_id', ['options' => $animais]);
            echo $this->Form->input('valor');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>