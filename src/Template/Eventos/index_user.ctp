<?php

?>
<nav class="large-3 medium-4 columns" >
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Novo'), ['action' => 'addUser']) ?></li>
    </ul>
</nav>
<div class="eventos index large-9 medium-8 columns content">
    <h3><?= __('Leilões') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id', 'Id') ?></th>
                <th><?= $this->Paginator->sort('nome', 'Nome') ?></th>
                <!-- <th><?= $this->Paginator->sort('img', 'Imagem') ?></th> -->
                <!-- <th><?= $this->Paginator->sort('img2', 'Imagem 2') ?></th> -->
                <th><?= $this->Paginator->sort('data_ini', 'Ínicio') ?></th>
                <th><?= $this->Paginator->sort('data_fim', 'Fim') ?></th>
                <th class="actions"><?= __('Ações') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($eventos as $evento): ?>
            <tr>
                <td><?= $this->Number->format($evento->id) ?></td>
                <td><?= h($evento->nome) ?></td>
                <!-- <td><?= h($evento->img) ?></td> -->
                <!-- <td><?= h($evento->img2) ?></td> -->
                <td><?= h($evento->data_ini) ?></td>
                <td><?= h($evento->data_fim) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'viewUser', $evento->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'editUser', $evento->id]) ?>
                    <?= $this->Form->postLink(__('Excluir'), ['action' => 'deleteUser', $evento->id], ['confirm' => __('Confirmar exclusão do ID # {0}?', $evento->id)]) ?>
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
