<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dado->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dado->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dados'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dados form large-9 medium-8 columns content">
    <?= $this->Form->create($dado) ?>
    <fieldset>
        <legend><?= __('Edit Dado') ?></legend>
        <?php
            echo $this->Form->input('users_id', ['options' => $users]);
            echo $this->Form->input('nome_razao');
            echo $this->Form->input('cpf_cnpj');
            echo $this->Form->input('data_nasc');
            echo $this->Form->input('tel');
            echo $this->Form->input('cel');
            echo $this->Form->input('cep');
            echo $this->Form->input('logradouro');
            echo $this->Form->input('numero');
            echo $this->Form->input('complemento');
            echo $this->Form->input('bairro');
            echo $this->Form->input('estado');
            echo $this->Form->input('cidade');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
