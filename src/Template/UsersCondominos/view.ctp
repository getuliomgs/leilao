<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Users Condomino'), ['action' => 'edit', $usersCondomino->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Users Condomino'), ['action' => 'delete', $usersCondomino->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersCondomino->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Users Condominos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Users Condomino'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Condominos'), ['controller' => 'Condominos', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Condomino'), ['controller' => 'Condominos', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="usersCondominos view large-9 medium-8 columns content">
    <h3><?= h($usersCondomino->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $usersCondomino->has('user') ? $this->Html->link($usersCondomino->user->id, ['controller' => 'Users', 'action' => 'view', $usersCondomino->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Condomino') ?></th>
            <td><?= $usersCondomino->has('condomino') ? $this->Html->link($usersCondomino->condomino->Array, ['controller' => 'Condominos', 'action' => 'view', $usersCondomino->condomino->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($usersCondomino->id) ?></td>
        </tr>
    </table>
</div>
