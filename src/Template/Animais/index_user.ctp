<?php

?>
<nav class="large-3 medium-4 columns" >
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Novo'), ['action' => 'add_user']) ?></li>
    </ul>
</nav>
<div class="animais index large-9 medium-8 columns content">
    <h3><?= __('Animais') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th><?= $this->Paginator->sort('Nascimento') ?></th>
                <th><?= $this->Paginator->sort('valor') ?></th>
                <th><?= $this->Paginator->sort('Status') ?></th>
                <th><?= $this->Paginator->sort('Inicio Leilão') ?></th>
                <th><?= $this->Paginator->sort('Fim Leilão') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animais as $animai): ?>
            <tr>
                <td><?= $this->Number->format($animai->id) ?></td>
                <td><?= h($animai->nome) ?></td>
                <td><?= h($animai->data_nasc) ?></td>
                <td><?= $this->Number->format($animai->valor) ?></td>
                <td><?= h($animai->status_2) ?></td>
                <td><?= h($animai->data_leilao_ini) ?></td>
                <td><?= h($animai->data_leilao_fim) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view_user', $animai->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit_user', $animai->id]) ?>
                    <?= $this->Form->postLink(__('Deletar'), ['action' => 'delete_user', $animai->id], ['confirm' => __('Confirmar deletar Animal # {0}?', $animai->id)]) ?>
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
