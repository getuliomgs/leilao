<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $animai->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $animai->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Animais'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="animais form large-9 medium-8 columns content">
    <?= $this->Form->create($animai) ?>
    <fieldset>
        <legend><?= __('Edit Animai') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('descricao');
            echo $this->Form->input('sexo');
            echo $this->Form->input('data_nasc');
            echo $this->Form->input('raca');
            echo $this->Form->input('pelagem');
            echo $this->Form->input('localizacao');
            echo $this->Form->input('status_2');
            echo $this->Form->input('link_video');
            echo $this->Form->input('foto_1');
            echo $this->Form->input('foto_2');
            echo $this->Form->input('foto_3');
            echo $this->Form->input('foto_4');
            echo $this->Form->input('geneologia');
            echo $this->Form->input('valor');
            echo $this->Form->input('parcelas');
            echo $this->Form->input('data_leilao_ini', ['empty' => true]);
            echo $this->Form->input('data_leilao_fim', ['empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
