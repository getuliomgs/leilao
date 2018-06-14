<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Animai'), ['action' => 'edit', $animai->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Animai'), ['action' => 'delete', $animai->id], ['confirm' => __('Are you sure you want to delete # {0}?', $animai->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Animais'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Animai'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="animais view large-9 medium-8 columns content">
    <h3><?= h($animai->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($animai->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Descrição') ?></th>
            <td><?= h($animai->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Sexo') ?></th>
            <td><?= h($animai->sexo) ?></td>
        </tr>
        <tr>
            <th><?= __('Raca') ?></th>
            <td><?= h($animai->raca) ?></td>
        </tr>
        <tr>
            <th><?= __('Pelagem') ?></th>
            <td><?= h($animai->pelagem) ?></td>
        </tr>
        <tr>
            <th><?= __('Localizacao') ?></th>
            <td><?= h($animai->localizacao) ?></td>
        </tr>
        <tr>
            <th><?= __('Status 2') ?></th>
            <td><?= h($animai->status_2) ?></td>
        </tr>
        <tr>
            <th><?= __('Link Video') ?></th>
            <td><?= h($animai->link_video) ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 1') ?></th>
            <td><?= h($animai->foto_1) ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 2') ?></th>
            <td><?= h($animai->foto_2) ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 3') ?></th>
            <td><?= h($animai->foto_3) ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 4') ?></th>
            <td><?= h($animai->foto_4) ?></td>
        </tr>
        <tr>
            <th><?= __('Geneologia') ?></th>
            <td><?= h($animai->geneologia) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($animai->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($animai->valor) ?></td>
        </tr>
        <tr>
            <th><?= __('Parcelas') ?></th>
            <td><?= $this->Number->format($animai->parcelas) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Nasc') ?></th>
            <td><?= h($animai->data_nasc) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Leilao Ini') ?></th>
            <td><?= h($animai->data_leilao_ini) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Leilao Fim') ?></th>
            <td><?= h($animai->data_leilao_fim) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($animai->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($animai->modified) ?></td>
        </tr>
    </table>
</div>
