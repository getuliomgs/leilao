<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Novo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="animais index large-9 medium-8 columns content">
    <h3><?= __('Animais') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('nome') ?></th>
                <th><?= $this->Paginator->sort('sexo') ?></th>
                <th><?= $this->Paginator->sort('data_nasc') ?></th>
                <th><?= $this->Paginator->sort('raca') ?></th>
                <th><?= $this->Paginator->sort('pelagem') ?></th>
                <th><?= $this->Paginator->sort('localizacao') ?></th>
                <th><?= $this->Paginator->sort('status_2') ?></th>
                <th><?= $this->Paginator->sort('link_video') ?></th>
                <th><?= $this->Paginator->sort('foto_1') ?></th>
                <th><?= $this->Paginator->sort('foto_2') ?></th>
                <th><?= $this->Paginator->sort('foto_3') ?></th>
                <th><?= $this->Paginator->sort('foto_4') ?></th>
                <th><?= $this->Paginator->sort('geneologia') ?></th>
                <th><?= $this->Paginator->sort('valor') ?></th>
                <th><?= $this->Paginator->sort('parcelas') ?></th>
                <th><?= $this->Paginator->sort('data_leilao_ini') ?></th>
                <th><?= $this->Paginator->sort('data_leilao_fim') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('modified') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animais as $animai): ?>
            <tr>
                <td><?= $this->Number->format($animai->id) ?></td>
                <td><?= h($animai->nome) ?></td>
                <td><?= h($animai->sexo) ?></td>
                <td><?= h($animai->data_nasc) ?></td>
                <td><?= h($animai->raca) ?></td>
                <td><?= h($animai->pelagem) ?></td>
                <td><?= h($animai->localizacao) ?></td>
                <td><?= h($animai->status_2) ?></td>
                <td><?= h($animai->link_video) ?></td>
                <td><?= h($animai->foto_1) ?></td>
                <td><?= h($animai->foto_2) ?></td>
                <td><?= h($animai->foto_3) ?></td>
                <td><?= h($animai->foto_4) ?></td>
                <td><?= h($animai->geneologia) ?></td>
                <td><?= $this->Number->format($animai->valor) ?></td>
                <td><?= $this->Number->format($animai->parcelas) ?></td>
                <td><?= h($animai->data_leilao_ini) ?></td>
                <td><?= h($animai->data_leilao_fim) ?></td>
                <td><?= h($animai->created) ?></td>
                <td><?= h($animai->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $animai->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $animai->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $animai->id], ['confirm' => __('Are you sure you want to delete # {0}?', $animai->id)]) ?>
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
