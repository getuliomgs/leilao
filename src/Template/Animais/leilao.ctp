<?php
  echo $this->Html->scriptBlock(' 
  
    jQuery(function($){
      $("#date-referencia").mask("99/9999",{placeholder:"dd/yyyy"});
      $("#date-pagamento-previsto").mask("99/99/9999",{placeholder:"dd/mm/yyyy"});


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
          alert("teste lance");
        }
      );
      
      function alterarLance(valor){
        var lanceAtual = parseFloat($("#modalLanceButtonLanceAtual").val());
        var lanceAtualBD = parseFloat($("input[name=\'lanceAtual\']").val());
        lanceAtual = lanceAtual + valor;
        if(lanceAtual > lanceAtualBD) {
          $("#modalLanceButtonLanceAtual").html("R$ "+lanceAtual);
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
    });
  ' ,  ['defer' => true])
?>
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
              <img class="third-slide" style="width: 100%; max-height:154px" src="../../uploads/animais/<?= h($animai->foto_4) ?>" alt="Third slide">
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
        <strong><?= h($animai->nome) ?></strong>
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
          <?php echo $this->Html->link('LANCE', '#lance', array('id'=>'linkLance', 'data-toggle' => 'modal', 'class' => 'btn btn-success btn-lg btn-block' )); ?>
        <?php endif; ?>
        <?php if($flagLeilao == "EMB"):  ?>
          <?php echo $this->Html->link('EM BREVE', '#emb', array('data-toggle' => 'modal', 'class' => 'btn btn-warning btn-lg btn-block' )); ?>
        <?php endif; ?>
        <div class="modal fade" id="emb" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" style="width: 80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                  <span aria-hidden="true">&times;</span>
                  <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Dê seu lance: Lote <strong><?= h($animai->id) ?> - <?= h($animai->nome) ?></strong></h4>
              </div>
              <div class="modal-body"> <button type="button" class="btn btn-success">LANCE</button></div>
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
            <strong>&#218;ltimo Lance:</strong><?= h($animai->parcelas) ?> x de <?= h($value->valor) ?>
          </p>
          <small style="float: right;margin-top: -32px;"><?= h($this->animais->diasPassados($value->created)) ?></small>
        </div>
      <?php } else { ?>
        <div style="border-radius: 10px; background:#f9f9f9; padding: 12px 10px 2px 20px; margin-top: 3px;">    
          <p>
            <i class="fa fa-gavel"></i>&nbsp;<strong>Lance:</strong> <?= h($animai->parcelas) ?> x de R$ <?= h($value->valor) ?>
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
            <i class="fa fa-gavel"></i>&nbsp;<strong>Lance:</strong><?= h($animai->parcelas) ?> x de R$ <?= h($animai->valor) ?>
          </p>
          <small style="float: right;margin-top: -32px;"><?= h($this->animais->diasPassados($animai->data_leilao_ini)) ?></small>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 hidden-sm hidden-xs" style="margin-top:20px">
      <div  style="border-radius: 10px; background: #ededed; padding:10px;" >
        <strong>Genealogia</strong>
        <div  class="genealogia" style=""><?= h($animai->geneologia) ?></div>
      </div>
  </div>
</div>


<!-- Modal lance -->
<div class="modal" id="lance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dar seu lance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>      
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12 col-sm-12  col-md-12  col-lg-7  col-xl-7" style="padding-bottom: 5px">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-3" style="padding-bottom: 5px">
                  <button id="modalLanceButtonAdd10" type="button" class="btn btn-outline-success"> + R$ 10</button>
                  <button id="modalLanceButtonAdd50" type="button" class="btn btn-outline-success"> + R$ 50</button>
                </div>
                <div class="col-12 col-sm-12 col-md-6" style="padding-bottom: 5px">
                  <button id="modalLanceButtonLanceAtual" value="<?= $lanceAtual ?>" type="button" style="height: 100%" class="btn btn-ln btn-block btn-outline-success"> R$ <?= $lanceAtual ?></button>
                  <input type="text" style="display: none;" name="lanceAtual" value="<?= $lanceAtual ?>">
                </div>
                <div class="col-12 col-sm-12 col-md-3" >
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
                  62x de R$ <span  name="lanceAtual" ><?= $lanceAtual ?></span>,00
                </div>
                <div class="col-12">
                  <hr>
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
