<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Dado'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dados index large-9 medium-8 columns content">
    <h3><?= __('Dados') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('users_id') ?></th>
                <th><?= $this->Paginator->sort('nome_razao') ?></th>
                <th><?= $this->Paginator->sort('cpf_cnpj') ?></th>
                <th><?= $this->Paginator->sort('data_nasc') ?></th>
                <th><?= $this->Paginator->sort('tel') ?></th>
                <th><?= $this->Paginator->sort('cel') ?></th>
                <th><?= $this->Paginator->sort('cep') ?></th>
                <th><?= $this->Paginator->sort('logradouro') ?></th>
                <th><?= $this->Paginator->sort('numero') ?></th>
                <th><?= $this->Paginator->sort('complemento') ?></th>
                <th><?= $this->Paginator->sort('bairro') ?></th>
                <th><?= $this->Paginator->sort('estado') ?></th>
                <th><?= $this->Paginator->sort('cidade') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
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
                <td><?= h($dado->data_nasc) ?></td>
                <td><?= $this->Number->format($dado->tel) ?></td>
                <td><?= $this->Number->format($dado->cel) ?></td>
                <td><?= $this->Number->format($dado->cep) ?></td>
                <td><?= h($dado->logradouro) ?></td>
                <td><?= $this->Number->format($dado->numero) ?></td>
                <td><?= h($dado->complemento) ?></td>
                <td><?= h($dado->bairro) ?></td>
                <td><?= h($dado->estado) ?></td>
                <td><?= h($dado->cidade) ?></td>
                <td><?= h($dado->created) ?></td>
                <td><?= h($dado->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dado->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dado->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dado->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dado->id)]) ?>
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
