<?php
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Menu Usuário') ?></li>
        <li><?= $this->Form->postLink(
                __('Excluir'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Excluir? # {0}?', $user->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('Listar'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Editar Usuários') ?></legend>
        <?php
            echo $this->Form->input('username', ['label' => 'Usuário']);
            echo $this->Form->input('password', ['label' => 'Senha']);
            echo $this->Form->input('status', ['label' => 'status', 'options'=>['A'=>'Ativo', 'I'=>'Inativo', 'P'=>"Pendente"]]);
            echo $this->Form->input('role', ['options' => $optRole, 'label' => 'Credencial']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
