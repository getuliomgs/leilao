<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $testeLocation->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $testeLocation->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Teste Location'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="testeLocation form large-9 medium-8 columns content">
    <?= $this->Form->create($testeLocation) ?>
    <fieldset>
        <legend><?= __('Edit Teste Location') ?></legend>
        <?php
            echo $this->Form->input('nome');
            echo $this->Form->input('int_t');
            echo $this->Form->input('datea');
            echo $this->Form->input('datetimea');
            echo $this->Form->input('timestampa');
            echo $this->Form->input('timea');
            echo $this->Form->input('yeara');
            echo $this->Form->input('decimala');
            echo $this->Form->input('floata');
            echo $this->Form->input('doublea');
            echo $this->Form->input('reala');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
