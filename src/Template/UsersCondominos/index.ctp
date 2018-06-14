<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Users Condomino'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Condominos'), ['controller' => 'Condominos', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Condomino'), ['controller' => 'Condominos', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="usersCondominos index large-9 medium-8 columns content">
    <h3><?= __('Users Condominos') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('users_id') ?></th>
                <th><?= $this->Paginator->sort('condominos_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usersCondominos as $usersCondomino): ?>
            <tr>
                <td><?= $this->Number->format($usersCondomino->id) ?></td>
                <td><?= $usersCondomino->has('user') ? $this->Html->link($usersCondomino->user->id, ['controller' => 'Users', 'action' => 'view', $usersCondomino->user->id]) : '' ?></td>
                <td><?= $usersCondomino->has('condomino') ? $this->Html->link($usersCondomino->condomino->Array, ['controller' => 'Condominos', 'action' => 'view', $usersCondomino->condomino->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $usersCondomino->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $usersCondomino->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $usersCondomino->id], ['confirm' => __('Are you sure you want to delete # {0}?', $usersCondomino->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
