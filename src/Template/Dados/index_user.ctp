<?php
?>
<nav class="large-3 medium-4 columns">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
    </ul>
</nav>
<div class="dados index large-9 medium-8 columns ">
    <h3><?= __('Dados') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="30px"><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('users_id') ?></th>
                <th><?= $this->Paginator->sort('nome_razao') ?></th>
                <th><?= $this->Paginator->sort('cpf_cnpj') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados as $dado): ?>
            <tr>
                <td><?= $this->Number->format($dado->id) ?></td>
                <td><?= $dado->has('user') ? $this->Html->link($dado->user->username, ['controller' => 'Users', 'action' => 'view', $dado->user->id]) : '' ?></td>
                <td><?= h($dado->nome_razao) ?></td>
                <td><?= $this->Number->format($dado->cpf_cnpj) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'viewUser', $dado->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'editUser', $dado->id]) ?>
                    <?= $this->Form->postLink(__('Excluir'), ['action' => 'deleteUser', $dado->id], ['confirm' => __('Confirmar excluisão do id # {0}?', $dado->id)]) ?>
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
