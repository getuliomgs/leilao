<?php
  echo $this->Html->scriptBlock(' 
  
    jQuery(function($){

      $("#date-referencia").mask("99/9999",{placeholder:"dd/yyyy"});
      $("#date-pagamento-previsto").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});

      $("#buttonAtualizar").click(
        function (){
          location.reload();
        }
      );


      $("#modalLanceButtonAdd10").click(
        function (){
          alterarLance(10);
        }
      );

      $("#modalLanceButtonAdd50").click(
        function (){
          alterarLance(50);
        }
      );

      $("#modalLanceButtonSub10").click(
        function (){
          alterarLance(-10);
        }
      );

      $("#modalLanceButtonSub50").click(
        function (){
          alterarLance(-50);
        }
      );

      $("a[id=\'linkLance\']").click(
        function() {
          var teste = $("div[id=\'divListarLances\']").html();
          $("div[id=\'divListarLancesModal\']").html(teste);
        }
      );
     
      function add10() {
        alert("function add10");
      }

      $("button[name=\'efetuarLance\']").click(
        function() {
          var lanceAtual = parseFloat($("#modalLanceButtonLanceAtual").val());
          var lanceAtualBD = parseFloat($("input[name=\'lanceAtual\']").val());
          var animai_id = parseInt($("button[name=\'animai_id\']").val());
          if(confirm("Pressione OK para confirmar seu lance!")){
            if(lanceAtual > lanceAtualBD){
              $.ajax({
                url: "../lance/"+animai_id+"?lanceAtual="+lanceAtual,
                type: "GET",
                
                beforeSend: function () {
                    //Aqui adicionas o loader
                    $("#modalLance").html("<div class=\"col-12\">Seu lance está sendo computado pelo nosso sistema aguarde!</div><br /><hr /> <div class=\"col-12\"><div class=\"progress\"><div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"30\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 30%\"></div></div></div> " );
                      setTimeout(function(){ 
                        $("#modalLance").html("<div class=\"col-12\">Seu lance está sendo computado pelo nosso sistema aguarde!</div><br /><hr /> <div class=\"col-12\"><div class=\"progress\"><div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"60\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 60%\"></div></div></div> " );
                      }, 3000);  
                      setTimeout(function(){ 
                        $("#modalLance").html("<div class=\"col-12\">Seu lance está sendo computado pelo nosso sistema aguarde!</div><br /><hr /> <div class=\"col-12\"><div class=\"progress\"><div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"90\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 90%\"></div></div></div> " );
                      }, 6000);  
                      setTimeout(function(){ 
                        $("#modalLance").html("<div class=\"col-12\">Seu lance está sendo computado pelo nosso sistema aguarde!</div><br /><hr /> <div class=\"col-12\"><div class=\"progress\"><div class=\"progress-bar progress-bar-striped progress-bar-animated\" role=\"progressbar\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 100%\"></div></div></div> " );
                      }, 10000);  


                },         
                success: function(data) {
                   console.log("sucesso");
                },
                error: function() {
                    console.log("erro");
                } ,  
                complete: function(){
                  
                }
              })  
              .done(function( html ) {
                setTimeout(function(){ 
                        $( "#modalLance" ).html(html);
                      }, 11000);
              });       
            }else{
              alert("Seu lance deve ser maior que atual");
            }
          }else{
            alert("Fique a vontade para apresentar seus lances");
          }
        }
      );
      
      function alterarLance(valor){
        var lanceAtual = parseFloat($("#modalLanceButtonLanceAtual").val());
        var lanceAtualBD = parseFloat($("input[name=\'lanceAtual\']").val());
        lanceAtual = lanceAtual + valor;
        if(lanceAtual > lanceAtualBD) {
          $("#modalLanceButtonLanceAtual").html("R$ "+lanceAtual+",00");
          $("#modalLanceButtonLanceAtual").val(lanceAtual);  
          $("span[name=\'lanceAtual\']").html("R$ "+lanceAtual);
        }else{
          alert("Seu lance deve ser maior que R$ "+lanceAtualBD);
        }     
      }

      $("#condominios-id").change(
        function() {
          if($(this).val() == 0) {
            alert("Você precisa informar um Condomínio!");
            $(this).focus();
          } else {
            $("#fornecedores-id").load("listarFornecedores/" + $(this).val());
            $("#plano-contas-id").load("listarPC/" + $(this).val());
            $("#extratos-id").load("listarExtratos/" + $(this).val());
          }
        }
      );

      var YY = '.$eventos->data_fim->year.';
    var MM = '.$eventos->data_fim->month.';
    var DD = '.$eventos->data_fim->day.';
    var HH = '.$eventos->data_fim->hour.';
    var MI = '.$eventos->data_fim->minute.';
    var SS = '.$eventos->data_fim->second.'; 
    var alertEncerramento = true;

    function atualizaContador() {


    var hoje = new Date();
    var futuro = new Date(YY,MM-1,DD,HH,MI,SS); 

    var ss = parseInt((futuro - hoje) / 1000);
    var mm = parseInt(ss / 60);
    var hh = parseInt(mm / 60);
    var dd = parseInt(hh / 24); 

    ss = ss - (mm * 60);
    mm = mm - (hh * 60);
    hh = hh - (dd * 24); 

    var faltam = "Faltam ";
    faltam += (dd && dd > 1) ? dd+" dias, " : (dd==1 ? "1 dia, " : "");
    faltam += (toString(hh).length) ? hh+"h : " : "";
    faltam += (toString(mm).length) ? mm+"m : " : "";
    faltam += ss+"s"; 
    faltam += " para o encerramento."; 

      if (dd+hh+mm+ss > 0) {
        document.getElementById("contador").innerHTML = faltam;
        setTimeout(atualizaContador,1000);
      } else {
        document.getElementById("contador").innerHTML = "ENCERRADO!!!!";
        setTimeout(atualizaContador,1000);
        if(alertEncerramento) {
          alert("Leilão ENCERRADO!");
          alertEncerramento = false;
        }
      }
    }
    atualizaContador();

    });
  ' ,  ['defer' => true])
?>
<div class="eventos row">
    <div class="col-  col-sm- col-md- col-lg- col-xl-4" >
      <?php echo $this->html->image('../uploads/eventos/'.$eventos->img2, ['width'=>"100%"]); ?> 
    </div>
    <div class="col-  col-sm- col-md- col-lg- col-xl-8"  >
      <?php
        $meses = array(1=>'janeiro',2=>'fevereiro', 3=>'março',4=>'abril',5=>'maio',6=>'junho',7=>'julho',8=>'agosto',9=>'setembro',10=>'outubro',11=>'novembro',12=>'dezembro' );
        echo "<h2>".'<strong>'.$eventos->nome.'</strong>';
        echo "<br /><strong>Início:</strong> ".$eventos->data_ini->day." de ".$meses[$eventos->data_ini->month];
        echo "<br /><strong>Encerramento: </strong> ".$eventos->data_fim->day." de ".$meses[$eventos->data_fim->month]." | ".$eventos->data_ini->hour."hs</h2>";
      ?>
      <h3>
        <strong>
          <span id="timerLeilao15" class="contador"></span>
              <span  style="color: red; " id="contador" class="contador border border-danger"></span>
            </strong>
          </h3>
    </div>        
    </div>
    <hr>
<div class="row" >
  <!-- Indicador de lances cobertos -->
  <div class="row" style=" background: linear-gradient(#ccc, #fff); border-radius: 5px; margin: 10px ">
    <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
      <div id="myCarousel" class="carousel slide" data-ride="carousel" >
        <ol class="carousel-indicators">
          <?php if(!empty($animai->foto_1)): ?>
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <?php endif; ?>
          <?php if(!empty($animai->foto_2)): ?>
            <li data-target="#myCarousel" data-slide-to="1"></li>
          <?php endif; ?>
          <?php if(!empty($animai->foto_3)): ?>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          <?php endif; ?>
          <?php if(!empty($animai->foto_4)): ?>
            <li data-target="#myCarousel" data-slide-to="3"></li>
          <?php endif; ?>
        </ol>
        <div class="carousel-inner">
          <?php if(!empty($animai->foto_1)): ?>
            <div class="carousel-item active">
              <img class="second-slide" style="width: 100%; height: auto;" src="../../uploads/animais/<?= h($animai->foto_1) ?>" alt="Second slide">
            </div>
          <?php endif; ?>
          <?php if(!empty($animai->foto_2)): ?>
            <div class="carousel-item">
              <img class="second-slide" style="width: 100%; height: auto;" src="../../uploads/animais/<?= h($animai->foto_2) ?>" alt="Second slide">
            </div>
          <?php endif; ?>
          <?php if(!empty($animai->foto_3)): ?>
            <div class="carousel-item">
              <img class="third-slide" style="width: 100%; height: auto;" src="../../uploads/animais/<?= h($animai->foto_3) ?>" alt="Third slide">
            </div>
          <?php endif; ?>
          <?php if(!empty($animai->foto_4)): ?>
            <div class="carousel-item">
              <img class="third-slide" style="width: 100%; height: auto;" src="../../uploads/animais/<?= h($animai->foto_4) ?>" alt="Third slide">
            </div>
          <?php endif; ?>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12" >
      <div style=" background: #CCC;  solid black; border-radius: 5px;">     
        <strong><?= h($animai->nome) ?></strong><br />
        <strong>Lote: <?= h($animai->id) ?></strong><br />

        <p style="font-size:small; line-height:1.5 "><?php echo nl2br($animai->descricao); ?>
        </p>
        <div id="videoYoutube"></div>
        <?php if($lances->count() <= 0): ?>
        <?php $lanceAtual = $animai->valor; ?>
        <p>Lance atual:</p>
        <p style="display: inline-block"><?= h($animai->parcelas) ?> x de </p>
        <strong style="display: inline-block" >R$ <?= h(number_format($animai->valor, 2, ",",".")); ?></strong>
        <?php endif; ?>
        <?php foreach ($lances as $key => $value): ?>
          <?php $lanceAtual = $value->valor; ?>  
          <p>Lance atual:</p>
          <p style="display: inline-block"><?= h($animai->parcelas) ?> x de </p>
          <strong style="display: inline-block" >R$ <?= h(number_format($value->valor, 2, ",",".")) ?></strong>
        <?php break; endforeach; ?>            
        <?php if($flagLeilao == "FEC"): ?>
          <?php  echo $this->Html->link('FECHADO', '#fec', array('data-toggle' => 'modal', 'class' => 'btn btn-dark btn-lg btn-block' )); ?>
          <div class="modal fade" id="fec" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">
                    <span  aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel">Lote Fechado</h4>
                </div>
                <div class="modal-body">
                  <?php echo $this->Html->link('OK', '', ['class'=>'close btn btn-info btn-block', 'data-dismiss'=>'modal']) ?>
                </div>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <?php if($flagLeilao == "ABE"): ?>
          <?php 
            if(isset($this->request->session()->read()['Auth']['User']['role'])){
              echo $this->Html->link('LANCE', '#lance', array('id'=>'linkLance', 'data-toggle' => 'modal', 'class' => 'btn btn-success btn-lg btn-block' ));
            }else{
              echo $this->Html->link('LANCE', '#login', array('id'=>'linkLance', 'data-toggle' => 'modal', 'class' => 'btn btn-success btn-lg btn-block' ));
            }
          ?>
        <?php endif; ?>
        <?php if($flagLeilao == "EMB"):  ?>
          <?php echo $this->Html->link('EM BREVE', '#emb', array('data-toggle' => 'modal', 'class' => 'btn btn-warning btn-lg btn-block' )); ?>
        <?php endif; ?>
        <?php echo $this->Html->link('REGULAMENTO', '#regulamento', array('data-toggle' => 'modal', 'class' => 'btn btn-warning btn-lg btn-block bd-example-modal-lg' )); ?>
        

        <!-- MODAL 
        <div class="modal fade bd-example-modal-lg" id="regulamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              ...
            </div>
          </div>
        </div>
-->
      <!-- Modal regulamento -->
    <div class="modal" id="regulamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Regulamento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>      
          <div  style="line-height: 1.5;" class="modal-body text-justify">
              <p  class="text-justify ">
              <h3>Leilão virtual HARAS LUANDA e convidados.</h3>
              <br />
              <br />
              <strong>1 - O Leilão</strong>
              <br />
              Os lances serão recebidos através do site: www.harasluanda.com.br/leilao  mediante cadastro aprovado via análise, conforme lei que regulamenta esta prática.
              <br />
              <br />
              <br />
              <strong>2 - CONDIÇÕES DE PAGAMENTO</strong>
              <br  />
              O valor total de cada lote será: O valor do lance final multiplicado por 36 (trinta e seis).
              <br />
              O comprador efetuará o pagamento em uma das seguintes modalidades: 
              <br />
              <br />
              <strong>2.1 –</strong> Pagamento à vista com 20% de desconto.
              <br />
              <br />
              <strong>2.2 –</strong> Pagamento em 36 (trinta e seis) parcelas fixa mensais no valor do lance.
              <br />
              <strong>2.3 -</strong> A primeira parcela vence no ato de assinatura do contrato.
              <br />
              <br />
              <br />
              <strong>3 - COMISSÕES</strong>
              <br />
              <br />
              Não terá comissão.
              <br />
              <br />
              <br />
              <strong>4 - CADASTROS ANTECIPADOS</strong>
              <br />
              <br />
              Por tratar-se de evento não presencial, é obrigatória a efetivação dos cadastros dos interessados senhores compradores através do site do leilão www.harasluanda.com.br,  sem os quais não estarão credenciados a acatar lances dos respectivos participantes.
              <br />
              <br />
              <strong>4.1 - LOCAL DE CADASTRAMENTO</strong>
              <br />
              Os cadastros deverão ser realizados através do site do leilão no endereço: www.harasluanda.com.br/leilao
              <br />
              <br />
              <br />
              <strong>5 - APROVAÇÃO DOS CADASTROS</strong>
              <br />
              <br />
              A critério dos vendedores, os senhores compradores que não apresentarem referências pessoais, bancárias ou documentos exigidos no item 4.1 não estarão aptos a participarem do leilão. Caso haja restrição financeira e comercial em instituições credenciadas para avaliação de crédito, o cadastro poderá ser reprovado pelo nosso sistema.
              <br />
              <br />
              <br />
              <strong>6 - AVALISTAS</strong>
              <br />
              <br />
              Assiste aos vendedores o direito de solicitar avalista de seu conhecimento desde que manifeste esta exigência antes que seja feita a liberação dos animais para entrega aos senhores compradores, ficando a aprovação do nome indicado a exclusivo critério do vendedor.
              <br />
              <br />
              <br />
              <strong>7 - DOCUMENTAÇÕES PARA CONFIRMAÇÃO DAS VENDAS</strong>
              <br />
              <br />
              Configurada a venda, conforme Cláusula 4,5 e 6 deste Regulamento, será encaminhando aos senhores compradores os Contratos de Compra e Venda e respectivas Notas Promissórias, com firma reconhecida, para o endereço constante do cadastro fornecido, documentação que deverá ser assinada e prontamente devolvida ao vendedor ( endereço fornecido por vendedor)
              <br />
              <br />
              <br />
              <strong>8 –</strong> Toda e qualquer incidência de Impostos será por conta do comprador.
              <br />
              <br />
              <br />
              <strong>9 - LIBERAÇÕES DOS ANIMAIS</strong>
              <br />
              <br />
              Os animais adquiridos somente serão liberados para retirada física e entrega aos senhores compradores, após a assinatura dos contratos e respectivas Notas Promissórias e recebimento destes documentos originais, com firma reconhecida, conforme cláusula 7 acima, bem como depois de confirmado os créditos, nas respectivas contas corrente indicadas pelo VENDEDOR, dos valores correspondentes a compra e das primeiras parcelas do sinal do negócio efetivado.
              <br />
              <br />
              <br />
              <strong>10 - DA RETIRADA DOS ANIMAIS</strong>
              <br />
              <br />
              Uma vez cumprido o acima descrito na Cláusula 9 deste Regulamento, os senhores compradores poderão retirar os animais adquiridos nos endereços dos Haras dos vendedores, sendo de responsabilidade dos respectivos senhores compradores os custo e risco do transporte dos mesmos desde a origem até seus destinos (lembramos o prazo de 30 trinta dias sem ônus, posteriormente o vendedor se resguarda a cobrar estadia dos mesmos – sugerimos contato para o acerto da retirada o mais breve).
              <br />
              <br />
              <br />
              <strong>11 - Óvulos:</strong> No caso de venda de óvulo da égua doadora, serão de responsabilidade do COMPRADOR os custo e serviços técnicos e profissionais na coleta do embrião e consequente transferência para receptora. A receptora deverá ser fornecida pelo COMPRADOR. O COMPRADOR terá o direito de escolher o garanhão a ser utilizado, devendo enviar o sémem ate a central de transferência do vendedor
              <br />
              <br />
              <strong>11.1 - Embrião:</strong> No caso de venda de embrião, os custos dos serviços  técnicos e profissionais na coleta do embrião e a consequente transferência para a receptora, será de responsabilidade do VENDEDOR. A receptora devera ser fornecida pelo VENDEDOR, devendo a mesma ficar a disposição apos a desmama do produto.
              <br />
              <br />
              <br />
              <strong>12 - IRREVOGABILIDADE DAS VENDAS -</strong> As vendas realizadas no presente remate são irrevogáveis e irretratáveis, não podendo o comprador recusar o animal ou solicitar redução de seu preço, conforme Legislação do Código Civil Brasileiro.
              <br />
              <br />
              <br />
              <strong>13 – RESPONSABILIDADE SOBRE OS ANIMAIS -</strong> Serão de responsabilidade do vendedor a guarda e cuidados com a mantença dos animais leiloados e vendidos, até 30 dias para a retirada, após estes 30 dias, será cobrada um ajuda de manejo de R$ 15,00 por dia no local de origem dos mesmos, cessando esta quando da entrega dos referidos animais de acordo com a Cláusula 10, deste Regulamento, não restando à nós nenhum ônus em caso de acidentes e danos que, eventualmente, venham a ocorrer com os animais.
              <br />
              A partir do embarque do animal a responsabilidade do animal passa a ser do comprador.
              <br />
              <br />
              <br />
              <strong>14 - GARANTIAS E RESPONSABILIDADES DO VENDEDOR</strong>
              <br />
              <br />
              <strong>14.1 - REPRODUTIVAS –</strong> Os vendedores são responsáveis e garantem a fertilidade dos animais ofertados, entregando-os em condições de aptidão reprodutiva verificada por veterinário antes da liberação dos mesmos.
              <br />
              <br />
              <strong>14.2 - SANITÁRIAS –</strong> Os vendedores comprometem-se a entregar os animais livres, acompanhados da documentação comprobatória, de qualquer doença infecto contagiosa nos termos da exigência da Legislação e Fiscalização Sanitárias dos respectivos Estados.
              <br />
              <br />
              <strong>14.3 - DE REGISTRO –</strong> Responsabilizam-se os vendedores pela garantia do cumprimento das exigências de documentação referente ao Registro Genealógico dos animais vendidos, exeto aqueles animais em quer não a possibilidade de emissão de documentos.
              <br />
              junto ao Serviço de Registro Genealógico da A Associação Brasileira dos Criadores do Cavalo Campolina qual este animal está inserido, no que tange aos aspectos de documentação exigida até quando da data de venda dos mesmos.
              <br />
              <br />
              <strong>14.4 - DE TRANSFERÊNCIA –</strong> Comprometem-se os vendedores a procederem às respectivas transferências dos animais aos seus novos proprietários, de acordo com os dados fornecidos pelos senhores compradores, ocorrendo isto após a quitação final dos pagamentos correspondentes de cada Nota Promissória emitida pelo vendedor e assinada. 
              <br />
              pelos senhores compradores, conforme constante do Contrato de Compra e Venda.
              <br />
              <br />
              <strong>14.5 - DAS INFORMAÇÕES FORNECIDAS –</strong> Todas as informações constantes no site são de responsabilidades do vendedor.
              <br />
              <br />
              <br />
              <strong>15 - REMATE -</strong> O remate proceder-se á publicamente e dar-se á pelo método do maior lance recebido cabendo, não aceitar lances aviltantes ou de pessoas que julgar irresponsáveis ou inaptas por qualquer razão, podendo o mesmo estabelecer os motivos para tal.
              <br />
              <br />
              <br />
              <strong>16 - PARTICIPANTE -</strong> Os participantes vendedores e senhores compradores, do leilão obrigam-se a acatar de forma definitiva e irrecorrível as disposições aqui consignadas, as quais são consideradas como conhecidas por todos, não podendo escusar-se de aceitá-las, alegando desconhecimento, conforme art. 30 da Lei de Introdução ao Código Civil Brasileiro.
              <br />
              <br />
              <br />
              <strong>17 – CONDIÇÕES –</strong> RESERVA DE DOMÍNIO - Por força de pacto de reserva de domínio, aqui expressamente instituído e aceito pelas partes, o VENDEDOR mantém-se na propriedade do animal negociado, até o efetivo e completo pagamento das parcelas negociadas acima.
              <br />
              <br />
              <strong>17.1 - O COMPRADOR</strong> não pode transferir ou sub-rogar o contrato, nem negociar, alienar, emprestar a terceiro, dar em penhor ou pagamento o animal antes de quitar integralmente as parcelas, uma vez que o proprietário até a quitação integral é o VENDEDOR.
              <br />
              <br />
              <strong>17.2 -</strong> Enquanto não tiver sido quitado integralmente o contrato, os produtos, prenhezes, aspirações, embriões, óvulos ou barrigas do animal, permanecerão em posse do comprador, que exercerá a função de fiel depositário, respondendo pelas condições iniciais em que recebeu o animal, uma vez que a venda aqui realizada é com reserva de domínio. 
              <br />
              <br />
              <strong>17.3 -</strong> Em consequência da constituição de pacto de reserva de domínio, caso o COMPRADOR falte ao pontual pagamento de qualquer das prestações, por mais de 30 (trinta) dias, será constituído imediata e automaticamente em mora, podendo o VENDEDOR exercer a cláusula de reserva de domínio.
              <br />
              <br />
              <strong>17.4 -</strong> Em caso de inadimplência de qualquer das parcelas incidirá, também, automaticamente multa de 2% (dois por cento) e correção de 1% (um por cento) ao mês pro rata die.
              <br />
              <br />
              <strong>17.5 –</strong> Em caso de inadimplência por mais de 30 (trinta) dias de qualquer das parcelas, consecutivas ou não, o VENDEDOR poderá, ao seu critério, exercer a cláusula de reserva de domínio, visando reaver o animal, via medida própria, ou seus créditos aqui pactuados, em caso de morte e/ou debilidade do animal.
              <br />
              <br />
              <strong>17.6 –</strong> Caso não haja devolução do animal, ou o valor integral não seja quitado, é facultado ao VENDEDOR protestar a nota promissória.
              <br />
              <br />
              <br />
              <strong>18 – OMISSÃO -</strong>  Todos os casos omissos no presente Regulamento serão resolvidos com base no Código Civil e demais legislação aplicável.
              <br />
              <br />
              <br />
              <h3>www.harasluanda.com.br</h3>
            </p>
          </div>
        </div>
      </div>
    </div>








        <div class="modal fade" id="emb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width: 80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">EM BREVE: Lote <strong><?= h($animai->id) ?> - <?= h($animai->nome) ?></strong></h4>
              </div>
              <div class="modal-body"> O lote <strong><?= h($animai->id) ?> - <?= h($animai->nome) ?></strong>, estará disponível a partir de <?= $animai->data_leilao_ini ?></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<br clear="all">
<div class="row">
  <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" >
    <div  style="border-radius: 10px; background: linear-gradient(#ccc, #fff); padding: 10px;" class="box-mh" data-mh="box-mh">
      <table class="table table-striped" style="margin-bottom:0">
      <tbody>
      <tr>
        <td><strong>Raça:</strong></td>
        <td><?= h($animai->raca) ?></td>
      </tr>
      <tr>
        <td><strong>Sexo do Animal:</strong></td>
        <td><?= h($animai->sexo) ?></td>
      </tr>
      <tr>
        <td><strong>Nascimento:</strong></td>
        <td><?= h($animai->data_nasc) ?></td>
      </tr>
      <tr>
        <td><strong>Pelagem:</strong></td>
        <td><?= h($animai->pelagem) ?></td>
      </tr>
      <tr>
        <td><strong>Localização:</strong></td>
        <td><?= h($animai->localizacao) ?></td>
      </tr>
  </tbody>
  </table>
  </div>
  </div>

  <div id="divListarLances" class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
    <div  style="border-radius: 10px; background: linear-gradient(#ccc, #fff); padding: 10px;" class="box-mh" data-mh="box-mh">
      <?php if($lances->count() <= 0): ?>
        <div style="border-radius: 10px; background:#f9f9f9; padding: 12px 10px 2px 20px; margin-top: 3px;">    
          <p>
            <i class="fa fa-gavel"></i>&nbsp;<strong>Lance:</strong> <?= h($animai->parcelas) ?> x de R$ <?= h(number_format($animai->valor, 2, ",",".")) ?>
          </p>
          <small style="float: right;margin-top: -32px;"><?= h($this->animais->diasPassados($animai->data_leilao_ini)) ?></small>
        </div>

      <?php endif; ?>
      <?php
        $c = true;
        $qtd = 0;
        foreach ($lances as $key => $value):
        
        if($c) {
          $c = false;
      ?>
        <div style="border-radius: 10px; background:rgba(95, 185, 90, 0.18); padding: 12px 10px 2px 20px; margin-top: 3px;">
          <p>
            <i class="fa fa-gavel"></i>&nbsp;
            <strong>&#218;ltimo Lance:</strong><?= h($animai->parcelas) ?> x de <?= h(number_format($value->valor,2,',','.')) ?>
          </p>
          <small style="float: right;margin-top: -32px;"><?= h($this->animais->diasPassados($value->created)) ?></small>
        </div>
      <?php } else { ?>
        <div style="border-radius: 10px; background:#f9f9f9; padding: 12px 10px 2px 20px; margin-top: 3px;">    
          <p>
            <i class="fa fa-gavel"></i>&nbsp;<strong>Lance:</strong> <?= h($animai->parcelas) ?> x de R$ <?= h(number_format($value->valor,2,',','.')) ?>
          </p>
          <small style="float: right;margin-top: -32px;"><?= h($this->animais->diasPassados($value->created)) ?></small>
        </div>
      <?php
        }
        if($qtd > 5){
          break;
        }
        $qtd++;
       ?>
      <?php endforeach; ?>
      <?php if($qtd < 5 and  $lances->count() > 0): ?>
        <div style="border-radius: 10px; background:#f9f9f9; padding: 12px 10px 2px 20px; margin-top: 3px;">    
          <p>
            <i class="fa fa-gavel"></i>&nbsp;<strong>Lance:</strong><?= h($animai->parcelas) ?> x de R$ <?= h(number_format($animai->valor,2,',','.')) ?>
          </p>
          <small style="float: right;margin-top: -32px;"><?= h($this->animais->diasPassados($animai->data_leilao_ini)) ?></small>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs" style="margin-top:20px">
      <div  style="border-radius: 10px; background: #ededed; padding:10px;" >
        <strong>Genealogia</strong>
        <div  class="genealogia" style=""><?= h($animai->geneologia) ?>
        <?php if(!empty($animai->geneologia_img)): ?>
            
              <img  style="width: 100%; height: auto;" src="../../uploads/animais/<?= h($animai->geneologia_img) ?>" >

          <?php endif; ?>
          
        </div>
      </div>
  </div>
</div>


<!-- Modal lance -->
<div class="modal" id="lance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dar seu lance no lote: <button class="btn btn-warning btn-sm" name="animai_id" value="<?= $animai->id ?>" ><?= $animai->id ?></button></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row" id="modalLance">
            <div class="col-12 col-sm-12  col-md-12  col-lg-7  col-xl-7" style="padding-bottom: 5px">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-3" style="padding-bottom: 5px">
                  <span style="font-size: 10">Adicionar<br /></span>
                  <button id="modalLanceButtonAdd10" type="button" class="btn btn-outline-success"> + R$ 10</button>
                  <button id="modalLanceButtonAdd50" type="button" class="btn btn-outline-success"> + R$ 50</button>
                </div>
                <div class="col-12 col-sm-12 col-md-6" style="padding-bottom: 5px">
                  <span style="font-size: 10">SEU Lance<br /></span>
                  <button id="modalLanceButtonLanceAtual" value="<?= $lanceAtual ?>" type="button" style="height: 100px; font-size: 28" class="btn btn-ln btn-block btn-outline-success"> R$ <?= $lanceAtual ?>,00</button>
                  <input type="text" style="display: none;" name="lanceAtual" value="<?= $lanceAtual ?>">
                </div>
                <div class="col-12 col-sm-12 col-md-3" >
                  <span style="font-size: 10">Subtrair<br /></span>
                  <button id="modalLanceButtonSub10" type="button" class="btn btn-outline-secondary"> - R$ 10</button>
                  <button id="modalLanceButtonSub50" type="button" class="btn btn-outline-secondary"> - R$ 50</button>
                </div>
                <div class="col-12">
                  <hr>
                </div>
                <div class="col-6 col-sm-6  col-md-6  col-lg-6  col-xl-6">
                  Fração do seu lance:
                </div>
                <div class="col-6 col-sm-6  col-md-6  col-lg-6  col-xl-6">
                  <?= $animai->parcelas ?>x de R$ <span  name="lanceAtual" ><?= $lanceAtual ?></span>,00
                </div>
                <div class="col-12">
                  <button name="efetuarLance" type="button" class="btn btn-success btn-lg btn-block">Efeturar Lance</button>
                </div>             
              </div>
            </div>
            <div id="divListarLancesModal" class="col-12 col-sm-12  col-md-12  col-lg-5  col-xl-5">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal login -->
<div class="modal" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Área Restrita </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-4 col-md-2 col-sm-2 col- users form">
            </div>
            <div class="col-lg-4 col-md-8 col-sm-8 col- users form">
              <?= $this->Flash->render('auth') ?>
              <?= $this->Form->create(null,  ['url' => ['controller' => 'users', 'action' => 'login'] ]) ?>
                  <fieldset>
                      <legend><?= __('Área Restrita') ?></legend>
                      <?= $this->Form->input('username' , ['label'=>'Usuário', 'required'=>'true' ]) ?>
                      <?= $this->Form->input('password', ['label'=>'Senha', 'required'=>'true']) ?>
                      <?= $this->Form->hidden('role', ['default'=> 'condomino' ]) ?>
                      <?= $this->Form->hidden('avulso', ['default'=> 'true' ]) ?>
                  </fieldset>
              <?= $this->Form->button(__('Logar')); ?>
              <?php
                echo  $this->Html->link('Cadastro', ['action' => '../users/cadastro']);
              ?>
              <?= $this->Form->end() ?>
              </div>
              <div class="col-lg-4 col-md-2 col-sm-2 col- users form">
                
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script async src="https://www.youtube.com/iframe_api"></script>
  <script>
    var player;
    var isOver = false;

    // Listen for the ready event

    function onYouTubeIframeAPIReady() {
      player = new YT.Player('videoYoutube', {
        videoId: '<?php
        preg_match('~(?:https?://)?(?:www.)?(?:youtube.com|youtu.be)/(?:watch\?v=)?([^\&]+)~', $animai->link_video, $match);
        print_r($match[1]); ?>', // YouTube Video ID
        width: "100%", // Player width (in px)
        height: "auto", // Player height (in px)
        playerVars: {
          autoplay: 1,
          controls: 2,
          showinfo: 0,
          modestbranding: 1,
          rel: 0,
          loop: 1,
          fs: 1,
          cc_load_policy: 0, // Hide closed captions
          iv_load_policy: 3, // Hide the Video Annotations
          autohide: 0 // Hide video controls when playing
        },
        events: {
          onStateChange:
          function(e){
            if (e.data === YT.PlayerState.ENDED) {
              player.playVideo();
            }
          },
          onReady: function (e) {
            e.target.setVolume(25);

            e.target.mute();
            $("#videoYoutube").on('mouseover',
              function(e) {

                player.unMute();

                if ($(this).css("position") != "fixed") {

                  $(this).css("position", "fixed");
                  $(this).css("z-index", "99999");

                  //$(this).css("right", e.clientX);
                  $(this).css("left", Math.min(e.clientX - 320, window.innerWidth - 680));

                  $(this).css("top", Math.max(0, e.clientY - 180));
                  // $(this).css("bottom", e.clientY + 10);

                  $(this).css("width", 640);
                  $(this).css("height", 360);

                  isOver = true;
                  AtualizaSpacer();
                }
              }
            );
            $("#videoYoutube").on('mouseout',
              function() {
                if (isOver) {
                  player.mute();
                  $(this).css("position", "relative");
                  $(this).css("left", "auto");
                  $(this).css("top", "auto");
                  $(this).css("width", "100%");
                  $(this).css("height", "auto");
                  $(this).css("z-index", "1");
                  AtualizaSpacer();
                  isOver = false;
                }
                /*
                $(this).css("position", "relative");
                $(this).removeClass("pop-out");
                $(this).css("width", "100%");

                $("#videoClone").remove();
                */
              }
            );
          }
        }
      });
    }
  
    function AtualizaSpacer() {
      $("#spacer").height(1);
      var relTop = $("#spacer").offset().top - $(".box_inner.brcinza").offset().top;
      $("#spacer").height($(".box_inner.brcinza").height() - relTop - $(".thumbnail").height());
    }
    $(function() {
      $.fn.matchHeight._afterUpdate = AtualizaSpacer;
      $('.item').matchHeight();
      $('.mhLote').matchHeight();
      $('.box-mh').matchHeight();
      $(window).on('resize',
        function () {
          $('.item').height("auto");
          $('.mhLote').height("auto");
          $('.box-mh').height("auto");
          $.fn.matchHeight._update();
          AtualizaSpacer();
       }
      );
    });
</script>
 