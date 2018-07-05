<?php
?>
<nav class="large-3 medium-4 columns" >
    <ul class="side-nav">
        <li class="heading"><?= __('Ações') ?></li>
        <li><?= $this->Html->link(__('Editar'), ['action' => 'editUser', $lance->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Excluir'), ['action' => 'deleteUser', $lance->id], ['confirm' => __('Confirmar exclusão do lance # {0}?', $lance->id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar'), ['action' => 'indexUser']) ?> </li>
        <li><?= $this->Html->link(__('Novo'), ['action' => 'addUser']) ?> </li>
    </ul>
</nav>
<div class="lances view large-9 medium-8 columns content">
    <h3><?= h($lance->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($lance->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Usuário') ?></th>
            <td>
                <?= $lance->user->username ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Animal') ?></th>
            <td>
                <?= $lance->animai->nome ?>
            </td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($lance->valor) ?></td>
        </tr>
        <tr>
            <th><?= __('Criado') ?></th>
            <td><?= h($lance->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modificado') ?></th>
            <td><?= h($lance->modified) ?></td>
        </tr>
    </table>
</div>
