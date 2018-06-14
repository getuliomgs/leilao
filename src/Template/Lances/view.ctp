<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lance'), ['action' => 'edit', $lance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lance'), ['action' => 'delete', $lance->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lance->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lances'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lance'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Animais'), ['controller' => 'Animais', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Animai'), ['controller' => 'Animais', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lances view large-9 medium-8 columns content">
    <h3><?= h($lance->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $lance->has('user') ? $this->Html->link($lance->user->username, ['controller' => 'Users', 'action' => 'view', $lance->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Animai') ?></th>
            <td><?= $lance->has('animai') ? $this->Html->link($lance->animai->id, ['controller' => 'Animais', 'action' => 'view', $lance->animai->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($lance->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($lance->valor) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($lance->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($lance->modified) ?></td>
        </tr>
    </table>
</div>
