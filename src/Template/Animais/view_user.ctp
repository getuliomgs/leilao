<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Editar animal'), ['action' => 'edit', $animai->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Deletar animal'), ['action' => 'delete', $animai->id], ['confirm' => __('Confirmar deletar animail # {0}?', $animai->id)]) ?> </li>
        <li><?= $this->Html->link(__('Listar animais'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('Novo Animal'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="animais view large-9 medium-8 columns content">
    <h3><?= h($animai->nome) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($animai->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Nome') ?></th>
            <td><?= h($animai->nome) ?></td>
        </tr>
        <tr>
            <th><?= __('Descrição') ?></th>
            <td><?= h($animai->descricao) ?></td>
        </tr>
        <tr>
            <th><?= __('Sexo') ?></th>
            <td><?= h($animai->sexo) ?></td>
        </tr>
        <tr>
            <th><?= __('Raca') ?></th>
            <td><?= h($animai->raca) ?></td>
        </tr>
        <tr>
            <th><?= __('Pelagem') ?></th>
            <td><?= h($animai->pelagem) ?></td>
        </tr>
        <tr>
            <th><?= __('Localização') ?></th>
            <td><?= h($animai->localizacao) ?></td>
        </tr>
        <tr>
            <th><?= __('Status') ?></th>
            <td><?= h($animai->status_2) ?></td>
        </tr>
        <tr>
            <th><?= __('Link Vídeo') ?></th>
            <td><?= h($animai->link_video) ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 1') ?></th>
            <td><?php echo('<img src="../../uploads/animais/'.$animai->foto_1.'" width="150" height="150" >') ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 2') ?></th>
            <td><?php echo('<img src="../../uploads/animais/'.$animai->foto_2.'" width="150" height="150" >') ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 3') ?></th>
            <td><?php echo ('<img src="../../uploads/animais/'.$animai->foto_3.'" width="150" height="150" >') ?></td>
        </tr>
        <tr>
            <th><?= __('Foto 4') ?></th>
            <td><?php echo("<img src='../../uploads/animais/".$animai->foto_4."' width='150' height='150' >") ?></td>
        </tr>
        <tr>
            <th><?= __('Geneologia') ?></th>
            <td><?php echo $animai->geneologia  ?></td>
        </tr>
        <tr>
            <th><?= __('Valor') ?></th>
            <td><?= $this->Number->format($animai->valor) ?></td>
        </tr>
        <tr>
            <th><?= __('Parcelas') ?></th>
            <td><?= $this->Number->format($animai->parcelas) ?></td>
        </tr>
        <tr>
            <th><?= __('Nascimento') ?></th>
            <td><?= h($animai->data_nasc) ?></td>
        </tr>
        <tr>
            <th><?= __('Início do leilão') ?></th>
            <td><?= h($animai->data_leilao_ini) ?></td>
        </tr>
        <tr>
            <th><?= __('Fim do leilão') ?></th>
            <td><?= h($animai->data_leilao_fim) ?></td>
        </tr>
    </table>
</div>
