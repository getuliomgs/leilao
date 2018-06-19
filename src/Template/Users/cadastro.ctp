<?php
?>
<div class="col">
    <nav class="large-3 medium-4 columns" id="actions-sidebar">
        <h2><?= __('CONTATO') ?></h2>
        <p>
            Gostamos sempre de ouvir a opinião de nossos clientes. Fique a vontade para entrar em contato, tirar suas dúvidas ou dar sugestões.
        </p>
        <br />
        <p>
            Ideídes (Gerente):
            (71) 99699-1728
        </p>
        <br />
        <p>
            Rodrigo Vilas Boas (Administrador):
            (71) 99958-6750
        </p>
        <br />
        <p>
            E-mail: harasluanda@gmail.com
        </p>
        <br />
        <p>
            Av. Alphaville, nº 522, Quadra F4
            Lote 01, Ed. Alpha Business
            3º Andar, Sala 302, Alphaville I
            Salvador - Bahia - Brasil
            CEP: 41701-015
        </p>
    </nav>
    <div class="animais form large-9 medium-8 columns content">
        <?= $this->Form->create() ?>
        <?php
            echo $this->Form->input('nome', ['label'=>'Razão Social / Nome Completo', 'required'=>true]);
            echo $this->Form->input('email',['required'=>true]);
            echo $this->Form->input('cpf-cnpj',['required'=>true, 'label'=>'CPF/CNPJ']);
            echo $this->Form->input('data-nasc',['required'=>true, 'label'=>'Data nascimento']);
            echo $this->Form->input('tel', ['required'=>true, '']);    
            echo $this->Form->input('cel', ['required'=>true]);    
            echo $this->Form->input('mensagem', ['rows'=>5, 'cols'=>5, 'label' => 'Mensagem']); 
        ?>
        <?= $this->Form->button(__('ENVIAR')) ?>
        <?= $this->Form->end() ?>

    </div>
</div>

<?php
?>
<div class="content">
    

<style>
    .field-validation-error {
        color: red;
        font-weight: normal;
    }
    .validation-summary-errors {
        color: red;
        font-weight: normal;
    }
    .fields label {
        margin-bottom: 10px;
    }
</style>
<div class="container">
    <h2><strong>Cadastre-se</strong> aqui.</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
            <p>Preencha corretamente <mark>TODOS</mark> os campos do formulário para que possamos liberar seu cadastro de usuário com maior rapidez.</p>
            <p><mark>ATENÇÃO:</mark> Seu cadastro será liberado em até 48 horas.</p>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
<form action="/Account/Cadastro" id="contact-form" method="post"><input name="__RequestVerificationToken" type="hidden" value="jNS5czpIM9tIrZAYzCC33uZVaG3NEIzeqy4xYjE1wqVOA42dCtcbr9sMxOhkwSF9_6F1O-rucaVVoXuGZjW_6ZXSH4SYfRVlydzLBV3xbTM1" />                <div class="contact-form-loader"></div>
                <fieldset class="fields">
                    <label class="name col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <span id="spanRazaoNome">RAZÃO SOCIAL / NOME COMPLETO*:</span>
                        <input autocomplete="name" data-val="true" data-val-maxlength="Nome inválido, preencha o Nome/Razão completo" data-val-maxlength-max="128" data-val-minlength="Nome inválido, preencha o Nome/Razão completo" data-val-minlength-min="5" data-val-required="Favor preencher Nome/Razão" id="Nome" name="Nome" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Nome" data-valmsg-replace="true"></span>
                    </label>
                    <label class="name col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <span>CNPF/CPF*:</span>
                        <input class="cpfcnpj" data-val="true" data-val-maxlength="Cpf/Cnpj inválido" data-val-maxlength-max="18" data-val-minlength="Cpf/Cnpj inválido" data-val-minlength-min="11" data-val-required="Cpf/Cnpj deve ser preenchido!" id="CpfCnpj" name="CpfCnpj" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="CpfCnpj" data-valmsg-replace="true"></span>

                    </label>
                    <label id="lblDataNascimento" class="name col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <span>Data de Nascimento:</span>
                        <input autocomplete="bday" class="date" data-val="true" data-val-date="The field Nascimento/Constituição must be a date." data-val-required="Favor preencher Nascimento/Constituição" id="DataNascimento" name="DataNascimento" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="DataNascimento" data-valmsg-replace="true"></span>

                    </label>
                    <label id="lblContato" style="display:none;" class="name col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <span>Contato:</span>
                        <input data-val="true" data-val-maxlength="Nome inválido, preencha o Contato completo" data-val-maxlength-max="128" data-val-minlength="Nome inválido, preencha o Contato completo" data-val-minlength-min="5" id="ContactName" name="ContactName" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="ContactName" data-valmsg-replace="true"></span>

                    </label>
                    <label class="col-xs-12 col-sm-12 col-md-12  col-md-6 col-lg-6">
                        <span>E-mail*:</span>
                        <input autocomplete="email" id="UserName" name="UserName" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="UserName" data-valmsg-replace="true"></span>

                    </label>
                    <label class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <span>Telefone:</span>
                        <input class="phonenumber" data-val="true" data-val-maxlength="Telefone inválido" data-val-maxlength-max="18" data-val-minlength="Telefone inválido. Preencha o telefone com DDD" data-val-minlength-min="10" data-val-required="Favor preencher Telefone" id="Telefone" name="Telefone" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Telefone" data-valmsg-replace="true"></span>
                    </label>
                    <label class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <span>Celular:</span>
                        <input autocomplete="tel" class="phonenumber" data-val="true" data-val-maxlength="Celular inválido" data-val-maxlength-max="18" data-val-minlength="Celular inválido. Preencha o Celular com DDD" data-val-minlength-min="10" id="Celular" name="Celular" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Celular" data-valmsg-replace="true"></span>
                    </label>
                    <label class="name col-xs-12 col-sm-5 col-md-3 col-lg-4">
                        <span>CEP*:</span>
                        <input autocomplete="postal-code" class="postalcode" data-val="true" data-val-maxlength="Cep inválido" data-val-maxlength-max="10" data-val-minlength="Cep inválido. Preencha o Cep com DDD" data-val-minlength-min="8" id="Cep" name="Cep" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Cep" data-valmsg-replace="true"></span>

                    </label>
                    <label class="name col-xs-12 col-sm-7 col-md-7 col-lg-6">
                        <span>Logradouro*:</span>
                        <input autocomplete="address-line1" data-val="true" data-val-required="Favor preencher Logradouro" id="Logradouro" name="Logradouro" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Logradouro" data-valmsg-replace="true"></span>

                    </label>
                    <label class="col-xs-6 col-sm-5 col-md-2 col-lg-2">
                        <span>Numero*:</span>
                        <input autocomplete="address-line2" data-val="true" data-val-required="Favor preencher Número" id="Numero" name="Numero" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Numero" data-valmsg-replace="true"></span>

                    </label>
                    <label class="col-xs-6 col-sm-7 col-md-5 col-lg-5">
                        <span>Complemento:</span>
                        <input autocomplete="address-line3" id="Complemento" name="Complemento" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Complemento" data-valmsg-replace="true"></span>

                    </label>
                    <label class="col-xs-12 col-sm-12 col-md-7 col-lg-7">
                        <span>Bairro*:</span>
                        <input autocomplete="address-level3" data-val="true" data-val-required="Favor preencher o Bairro" id="Bairro" name="Bairro" type="text" value="" />
                        <span class="field-validation-valid" data-valmsg-for="Bairro" data-valmsg-replace="true"></span>

                    </label>
                    <label class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <span>Estado*:</span>
                        <select autocomplete="address-level1" data-val="true" data-val-required="Favor preencher Uf" id="UfSigla" name="UfSigla"><option value=""> -- Selecione Uf --</option>
<option value="AC">Acre</option>
<option value="AL">Alagoas</option>
<option value="AM">Amazonas</option>
<option value="AP">Amap&#225;</option>
<option value="BA">Bahia</option>
<option value="CE">Cear&#225;</option>
<option value="DF">Distrito Federal</option>
<option value="ES">Esp&#237;rito Santo</option>
<option value="GO">Goi&#225;s</option>
<option value="MA">Maranh&#227;o</option>
<option value="MG">Minas Gerais</option>
<option value="MS">Mato Grosso do Sul</option>
<option value="MT">Mato Grosso</option>
<option value="PA">Par&#225;</option>
<option value="PB">Para&#237;ba</option>
<option value="PE">Pernambuco</option>
<option value="PI">Piau&#237;</option>
<option value="PR">Paran&#225;</option>
<option value="RJ">Rio de Janeiro</option>
<option value="RN">Rio Grande do Norte</option>
<option value="RO">Rond&#244;nia</option>
<option value="RR">Roraima</option>
<option value="RS">Rio Grande do Sul</option>
<option value="SC">Santa Catarina</option>
<option value="SE">Sergipe</option>
<option value="SP">S&#227;o Paulo</option>
<option value="TO">Tocantins</option>
</select>
                        <span class="field-validation-valid" data-valmsg-for="UfSigla" data-valmsg-replace="true"></span>
                    </label>
                    <label class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <span>Cidade*:</span>
                        <select autocomplete="address-level2" data-val="true" data-val-number="The field Cidade must be a number." data-val-required="Favor preencher a Cidade" id="CidadeId" name="CidadeId"></select>
                        <span class="field-validation-valid" data-valmsg-for="CidadeId" data-valmsg-replace="true"></span>
                    </label>
                    
                    <label class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span>Termos de Uso*:</span>
                        <textarea class="form-control" style="font-weight:normal" rows="6">A sanidade e aspectos clínicos serão de responsabilidade do vendedor, sendo permitido ao comprador ou interessado a solicitação de maiores informações e ou atestados de veterinários. 

Leia com atenção o regulamento de cada evento especificamente, pois eles podem ter alteração de prazos, percentuais e outros. 

O site leiloeira.com.br será apenas o veiculo de transição destas informações, evitando responsabilidade sobre qualquer informação e ou problemas futuros 

Os animais estarão expostos no site, por um período pré determinado em cada Leilão ou Venda Direta, durante este período, receberão lances que serão captados e atualizados automaticamente pelo sistema Leiloeira .com.br. É importante frisar que os cadastros serão sempre consultados para que garantam segurança para todos. 

Os cadastros deverão ser efetuados dentro do www.leiloeira.com.br preenchendo o formulário comercial com os dados que o identifiquem: CPF, RG, referências bancárias e pessoais e demais dados solicitados. A partir de então novas orientações serão dadas para facilitar a sua participação no processo de comercialização. 

Ao efetuar um lance através do site o cliente estará assumindo o compromisso de comprar o animal até a data de enceramento do leilão. Caso não assuma o lance, após ter seu cadastro no sistema do leilão virtual, e ter dado o aceite nos termos deste regulamento, o cliente pagará multa no valor de 15% (quinze por cento) sobre o valor total do negócio, além de estar sujeito a processo judicial, conforme a lei vigente. 

Para os clientes que lançaram na internet e tornaram-se vencedores da negociação após término do leilão presencial, será enviado ao comprador um contrato particular de compra venda com reserva de domínio e uma nota promissória no valor total do negócio realizado que deverão ser assinados e reconhecido firma em cartório e devolvido a leiloeira responsável pelo evento 
</textarea>
                        <br/>
                        <div class="col-md-12">
                            <input type="checkbox" id="chkTermos" name="Termos" value="aceito"> Li e Aceito os termos de uso acima
                            <span class="field-validation-valid" data-valmsg-for="Termos" data-valmsg-replace="true"></span>
                        </div>
                        
                    </label>

                    <br clear="all" />
                    <br clear="all" />
                    <div class="validation-summary-valid" data-valmsg-summary="true"><ul><li style="display:none"></li>
</ul></div>

                    <!-- <label class="recaptcha"><span class="empty-message">*This field is required.</span></label> -->
                    <div class="btns col-md-6">
                        <input type="submit" value="Enviar" id="btnEnviar" class="btn-default btn4" />
                    </div>
                    <br clear="all"/>
                    <br clear="all"/>
                </fieldset>
</form>
        </div>
    </div>
</div>



</div>
<!--footer-->
<footer>
    <div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 maxheight4">
            <div class="box_inner">
                <h2><strong>Quem somos</strong></h2>
                <ul class="list3">
                    <li><a href="/Home/QuemSomos">Quem Somos</a></li>
                    
                    <li><a href="/Home/Contato">Contatos</a></li>
                    <li>E-mail: contato@leiloeira.com.br</li>
                    <li>Telefone: (31) 2555-8900</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 maxheight4">
            <div class="box_inner">
                <h2><strong>Ajuda</strong></h2>
                <ul class="list3">
                    <li><a href="/Home/ComoFunciona">Como Funciona?</a></li>
                    <li><a href="/Home/ComoVender">Como Vender?</a></li>
                    <li><a href="/Home/Politicas">Políticas</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 maxheight4">
            <div class="box_inner">
                <h2><strong>Parceiros</strong></h2>
                <ul class="list3">
                    <li><a href="http://www.livraoassessoria.com.br" target="_blank">Livrão Assessoria</a></li>
                    <li><a href="http://www.atmainterativa.com.br" target="_blank">Atma Interativa</a></li>
                    
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 maxheight4">
            <div class="box_inner">
                <h2><strong>Facebook</strong></h2>
                <div class="fw_facebook" style="padding:10px;">
                    <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fleiloeira%2F&width=150&layout=standard&action=like&size=small&show_faces=true&share=true&height=80&appId" width="100%" height="80" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe> 
                </div>
            </div>
        </div>
    </div>
    <div class="copyright text-right">
        <p class="privacy">by © <a href="http://www.atmainterativa.com.br"><em id="copyright-year">Atma</em></a></p>
    </div>
</div>

    <!-- {%FOOTER_LINK} -->
</footer>


    

<a href="#" id="toTop" class="fa fa-arrow-circle-up" style="display: none;"></a>
<div id="fb-root" class="fb_reset">
    <div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
        <div></div>
    </div>
    <div style="position: absolute; top: -10000px; height: 0px; width: 0px;">
        <div>
        </div>
    </div>
</div>
<div class="modal fade " id="modalLances" tabindex="-1" role="dialog" aria-labelledby="lblModalLances" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="content-lances">

        </div>
    </div>
</div>
<div id='sound' style='display: none'></div>

