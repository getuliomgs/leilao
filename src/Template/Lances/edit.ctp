<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lance->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lance->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Lances'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Animais'), ['controller' => 'Animais', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Animai'), ['controller' => 'Animais', 'action' => 'add']) ?></li>
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
