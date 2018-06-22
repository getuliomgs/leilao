<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dado'), ['action' => 'edit', $dado->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dado'), ['action' => 'delete', $dado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dado->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dados'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dado'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dados view large-9 medium-8 columns content">
    <h3><?= h($dado->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User') ?></th>
            <td><?= $dado->has('user') ? $this->Html->link($dado->user->username, ['controller' => 'Users', 'action' => 'view', $dado->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Nome Razao') ?></th>
            <td><?= h($dado->nome_razao) ?></td>
        </tr>
        <tr>
            <th><?= __('Logradouro') ?></th>
            <td><?= h($dado->logradouro) ?></td>
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
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($dado->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Cpf Cnpj') ?></th>
            <td><?= $this->Number->format($dado->cpf_cnpj) ?></td>
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
            <th><?= __('Numero') ?></th>
            <td><?= $this->Number->format($dado->numero) ?></td>
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
