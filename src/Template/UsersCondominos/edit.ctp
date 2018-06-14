<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $usersCondomino->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $usersCondomino->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users Condominos'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Condominos'), ['controller' => 'Condominos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Condomino'), ['controller' => 'Condominos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersCondominos form large-9 medium-8 columns content">
    <?= $this->Form->create($usersCondomino) ?>
    <fieldset>
        <legend><?= __('Edit Users Condomino') ?></legend>
        <?php
            echo $this->Form->input('users_id', ['options' => $users]);
            echo $this->Form->input('condominos_id', ['options' => $condominos]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
