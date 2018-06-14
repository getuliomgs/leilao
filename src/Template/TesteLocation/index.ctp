<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Teste Location'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="testeLocation index large-9 medium-8 columns content">
    <h3><?= __('Teste Location') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th><?= $this->Paginator->sort('int_t') ?></th>
                <th><?= $this->Paginator->sort('datea') ?></th>
                <th><?= $this->Paginator->sort('datetimea') ?></th>
                <th><?= $this->Paginator->sort('timestampa') ?></th>
                <th><?= $this->Paginator->sort('timea') ?></th>
                <th><?= $this->Paginator->sort('decimala') ?></th>
                <th><?= $this->Paginator->sort('floata') ?></th>
                <th><?= $this->Paginator->sort('doublea') ?></th>
                <th><?= $this->Paginator->sort('reala') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($testeLocation as $testeLocation): ?>
            <tr>
                <td><?= $this->Number->format($testeLocation->id) ?></td>
                <td><?= h($testeLocation->nome) ?></td>
                <td><?= $this->Number->format($testeLocation->int_t) ?></td>
                <td><?= h($testeLocation->datea) ?></td>
                <td><?= h($testeLocation->datetimea) ?></td>
                <td><?= h($testeLocation->timestampa) ?></td>
                <td><?= h($testeLocation->timea) ?></td>
                <td><?= $this->Number->format($testeLocation->decimala) ?></td>
                <td><?= $this->Number->format($testeLocation->floata) ?></td>
                <td><?= $this->Number->format($testeLocation->doublea) ?></td>
                <td><?= $this->Number->format($testeLocation->reala) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $testeLocation->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $testeLocation->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $testeLocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testeLocation->id)]) ?>
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
