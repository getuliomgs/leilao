<?php 
      
    echo $this->Html->scriptBlock('

        jQuery(function($){
            
            $("#data-nasc").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});

        });
    ',['defer' => true]);
?>
<div class="col">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <h2><?= __('CONTATO') ?></h2>
        <p>
            Preencha corretamente TODOS os campos do formulário para que possamos liberar seu cadastro de usuário com maior rapidez.
        </p>
        <br />
        <p>
            ATENÇÃO: Seu cadastro será liberado em até 48 horas.
        </p>
    </nav>
    <div class="animais form large-9 medium-8 columns content">

        <?= $this->Form->create() ?>
        <?php
            echo $this->Form->input('nome_razao', ['label'=>'Razão Social / Nome Completo', 'required'=>true, 'class'=>'form-control']);
            echo $this->Form->input('email',['required'=>true,'class'=>'form-control']);
            echo $this->Form->input('cpf_cnpj',['required'=>true, 'label'=>'CPF/CNPJ', 'class'=>'form-control']);
            echo $this->Form->input('data_nasc',['required'=>true, 'label'=>'Data nascimento', 'class'=>'form-control']);
            echo $this->Form->input('tel', ['label'=>'Telefone', 'class'=>'form-control']);    
            echo $this->Form->input('cel', ['required'=>true, 'label'=>'Celular', 'class'=>'form-control']);    
            echo $this->Form->input('cep', ['required'=>true, 'class'=>'form-control']);    
            echo $this->Form->input('logradouro', ['required'=>true, 'label'=>'Logradouro', 'class'=>'form-control']);    
            echo $this->Form->input('numero', ['required'=>true, 'label'=>'Numero', 'class'=>'form-control']);    
            echo $this->Form->input('complemento', [ 'label'=>'Complemento', 'class'=>'form-control']);    
            echo $this->Form->input('bairro', ['label'=>'Bairro', 'class'=>'form-control']);    
            $estados = array("AC"=>'Acre', "AL"=>'Alagoas', "AM"=>'Amazonas', "AP"=>'Amapá', "BA"=>'Bahia', "CE"=>'Ceará', "DF"=>'Distrito Federal', "ES"=>'Espírito Santo', "GO"=>'Goiás', "MA"=>'Maranhão', "MG"=>'Minas Gerais', "MS"=>'Mato Grosso do Sul', "MT"=>'Mato Grosso', "PA"=>'Pará', "PB"=>'Paraíba', "PE"=>'Pernambuco', "PI"=>'Piauí', "PR"=>'Paraná', "RJ"=>'Rio de Janeiro', "RN"=>'Rio Grande do Norte', "RO"=>'Rondônia', "RR"=>'Roraima', "RS"=>'Rio Grande do Sul', "SC"=>'Santa Catarina', "SE"=>'Sergipe', "SP"=>'São Paulo', "TO"=>'Tocantins');
            echo $this->Form->input('estado', [ 'options'=>$estados, 'empty'=>'Selecione', 'label'=>'Estado', 'type'=>'select', 'required'=>true]);    
            echo $this->Form->input('cidade', ['required'=>true, 'label'=>'Cidade']);    

            echo $this->Form->input('termo', ['label'=>'Termos de Uso', "type"=>"textarea", "class"=>"form-control", "style"=>"font-weight:normal", "rows"=>"6", "value"=>"A sanidade e aspectos clínicos serão de responsabilidade do vendedor, sendo permitido ao comprador ou interessado a solicitação de maiores informações e ou atestados de veterinários. 

Leia com atenção o regulamento de cada evento especificamente, pois eles podem ter alteração de prazos, percentuais e outros. 

O site leiloeira.com.br será apenas o veiculo de transição destas informações, evitando responsabilidade sobre qualquer informação e ou problemas futuros 

Os animais estarão expostos no site, por um período pré determinado em cada Leilão ou Venda Direta, durante este período, receberão lances que serão captados e atualizados automaticamente pelo sistema Leiloeira .com.br. É importante frisar que os cadastros serão sempre consultados para que garantam segurança para todos. 

Os cadastros deverão ser efetuados dentro do www.leiloeira.com.br preenchendo o formulário comercial com os dados que o identifiquem: CPF, RG, referências bancárias e pessoais e demais dados solicitados. A partir de então novas orientações serão dadas para facilitar a sua participação no processo de comercialização. 

Ao efetuar um lance através do site o cliente estará assumindo o compromisso de comprar o animal até a data de enceramento do leilão. Caso não assuma o lance, após ter seu cadastro no sistema do leilão virtual, e ter dado o aceite nos termos deste regulamento, o cliente pagará multa no valor de 15% (quinze por cento) sobre o valor total do negócio, além de estar sujeito a processo judicial, conforme a lei vigente. 

Para os clientes que lançaram na internet e tornaram-se vencedores da negociação após término do leilão presencial, será enviado ao comprador um contrato particular de compra venda com reserva de domínio e uma nota promissória no valor total do negócio realizado que deverão ser assinados e reconhecido firma em cartório e devolvido a leiloeira responsável pelo evento "
]);

        ?>
        <?= $this->Form->checkbox('aceitarTermo', ['hiddenField'=>false, 'value'=>1, 'required'=>true]) ?> Li e aceito os termos de uso acima.
        
        <?= $this->Form->button(__('CADASTRAR')) ?>
        <?= $this->Form->end() ?>

    </div>
</div>
