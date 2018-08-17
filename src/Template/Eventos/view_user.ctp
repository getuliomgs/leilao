<?php

?><nav class="large-3 medium-4 columns" >
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'editUser', $evento->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Excluir'), ['action' => 'deleteUser', $evento->id], ['confirm' => __('Confirmar a exclusão do ID # {0}?', $evento->id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar'), ['action' => 'indexUser']) ?> </li>
        <li><?= $this->Html->link(__('Novo'), ['action' => 'addUser']) ?> </li>
    </ul>
</nav>
<div class="eventos view large-9 medium-8 columns content">
    <h3><?= h($evento->nome) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($evento->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($evento->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Full Banner') ?></th>
            <td><?php echo('<img src="../../uploads/eventos/'.$evento->img.'" width="150" height="150" >') ?></td>
        </tr>
        <tr>
            <th><?= __('Imagem interna') ?></th>
            <td><?php echo('<img src="../../uploads/eventos/'.$evento->img2.'" width="150" height="150" >') ?></td>
        </tr>
        <tr>
            <th><?= __('Data Ínicio') ?></th>
            <td><?= h($evento->data_ini) ?></td>
        </tr>
        <tr>
            <th><?= __('Data Fim') ?></th>
            <td><?= h($evento->data_fim) ?></td>
        </tr>
    </table>
</div>
