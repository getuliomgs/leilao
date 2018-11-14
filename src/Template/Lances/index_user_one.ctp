<?php

?>
<div class="lances index large-9 medium-8 columns ">
    <h3><?= __('Lances') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th width="15px"><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('users_id') ?></th>
                <th><?= $this->Paginator->sort('animais_id') ?></th>
                <th><?= $this->Paginator->sort('valor') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lances as $lance): ?>
            <tr>
                <td><?= $this->Number->format($lance->id) ?></td>
                <td>
                    <?= $lance->user->username ?>
                </td>
                <td>
                    <?= $lance->animai->nome ?>
                </td>
                <td><?= number_format($lance->valor,2,',','.') ?></td>
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
