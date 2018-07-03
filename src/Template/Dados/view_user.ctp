<?php
?><nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'editUser', $dado->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Exluir'), ['action' => 'deleteUser', $dado->id], ['confirm' => __('Cofirmar exclusão do id # {0}?', $dado->id)]) ?> </li>
        <li><?= $this->Html->link(__('Litar'), ['action' => 'indexUser']) ?> </li>
    </ul>
</nav>
<div class="dados view large-9 medium-8 columns content">
    <h3><?= h($dado->nome_razao) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($dado->id) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $dado->has('user') ? $this->Html->link($dado->user->username, ['controller' => 'Users', 'action' => 'view', $dado->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('CPF ou CNPJ') ?></th>
            <td><?= $this->Number->format($dado->cpf_cnpj) ?></td>
        </tr>
        <tr>
            <th><?= __('Logradouro') ?></th>
            <td><?= h($dado->logradouro) ?></td>
        </tr>
        <tr>
            <th><?= __('Numero') ?></th>
            <td><?= $this->Number->format($dado->numero) ?></td>
        </tr>
        <tr>
            <th><?= __('Complemento') ?></th>
            <td><?= h($dado->complemento) ?></td>
        </tr>
        <tr>
            <th><?= __('Bairro') ?></th>
            <td><?= h($dado->bairro) ?></td>
        </tr>
        <tr>
            <th><?= __('Estado') ?></th>
            <td><?= h($dado->estado) ?></td>
        </tr>
        <tr>
            <th><?= __('Cidade') ?></th>
            <td><?= h($dado->cidade) ?></td>
        </tr>
        <tr>
            <th><?= __('Tel') ?></th>
            <td><?= $this->Number->format($dado->tel) ?></td>
        </tr>
        <tr>
            <th><?= __('Cel') ?></th>
            <td><?= $this->Number->format($dado->cel) ?></td>
        </tr>
        <tr>
            <th><?= __('Cep') ?></th>
            <td><?= $this->Number->format($dado->cep) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Nasc') ?></th>
            <td><?= h($dado->data_nasc) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($dado->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($dado->modified) ?></td>
        </tr>
    </table>
</div>
