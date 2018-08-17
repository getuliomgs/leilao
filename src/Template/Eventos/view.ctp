<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Evento'), ['action' => 'edit', $evento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Evento'), ['action' => 'delete', $evento->id], ['confirm' => __('Are you sure you want to delete # {0}?', $evento->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Eventos'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Evento'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="eventos view large-9 medium-8 columns content">
    <h3><?= h($evento->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($evento->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Img') ?></th>
            <td><?= h($evento->img) ?></td>
        </tr>
        <tr>
            <th><?= __('Img2') ?></th>
            <td><?= h($evento->img2) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($evento->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Ini') ?></th>
            <td><?= h($evento->data_ini) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Fim') ?></th>
            <td><?= h($evento->data_fim) ?></td>
        </tr>
    </table>
</div>
