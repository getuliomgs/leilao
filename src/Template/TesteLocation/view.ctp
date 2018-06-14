<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Teste Location'), ['action' => 'edit', $testeLocation->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Teste Location'), ['action' => 'delete', $testeLocation->id], ['confirm' => __('Are you sure you want to delete # {0}?', $testeLocation->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Teste Location'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Teste Location'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="testeLocation view large-9 medium-8 columns content">
    <h3><?= h($testeLocation->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($testeLocation->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($testeLocation->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Int T') ?></th>
            <td><?= $this->Number->format($testeLocation->int_t) ?></td>
        </tr>
        <tr>
            <th><?= __('Decimala') ?></th>
            <td><?= $this->Number->format($testeLocation->decimala) ?></td>
        </tr>
        <tr>
            <th><?= __('Floata') ?></th>
            <td><?= $this->Number->format($testeLocation->floata) ?></td>
        </tr>
        <tr>
            <th><?= __('Doublea') ?></th>
            <td><?= $this->Number->format($testeLocation->doublea) ?></td>
        </tr>
        <tr>
            <th><?= __('Reala') ?></th>
            <td><?= $this->Number->format($testeLocation->reala) ?></td>
        </tr>
        <tr>
            <th><?= __('Datea') ?></th>
            <td><?= h($testeLocation->datea) ?></td>
        </tr>
        <tr>
            <th><?= __('Datetimea') ?></th>
            <td><?= h($testeLocation->datetimea) ?></td>
        </tr>
        <tr>
            <th><?= __('Timestampa') ?></th>
            <td><?= h($testeLocation->timestampa) ?></td>
        </tr>
        <tr>
            <th><?= __('Timea') ?></th>
            <td><?= h($testeLocation->timea) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Yeara') ?></h4>
        <?= $this->Text->autoParagraph(h($testeLocation->yeara)); ?>
    </div>
</div>
