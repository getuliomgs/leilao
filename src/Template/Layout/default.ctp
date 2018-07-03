<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;
/*
if (!Configure::read('debug')):
    throw new NotFoundException('Please replace Pages/home.ctp with your own version.');
endif;
*/
$cakeDescription = 'Haras Luanda - Leilões';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    
    <?php $this->Html->meta('icon') ?>

    <?= $this->Html->css('bootstrap.min.css'); ?>
    
    <?php
      /*
        $this->Html->css('base.css')
        $this->Html->css('cake.css');
    
        $this->Html->css('menuHorizontal.css');
      */
    ?>
    <?= $this->Html->css('cake.css'); ?>
    <?= $this->Html->css('base.css'); ?>
    <?= $this->Html->css('css.css'); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
    <?= $this->Html->script('jquery-3.3.1'); ?>
    <?php

    
    echo $this->Html->script('jquery.maskedinput')
    
    ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <section class="top-bar-section">
                <div id="navbar">
                    <ul>
<?php

    if(isset($this->request->session()->read()['Auth']['User']['role']) and $this->request->session()->read()['Auth']['User']['role'] == 'superUser' ) {
?>
                        <li class="first"><?= $this->Html->link(__('Usuários'), ['controller' => 'users', 'action' => '']) ?></li>
                        <li class="first"><?= $this->Html->link(__('Animais'), ['controller' => 'animais', 'action' => '']) ?></li>
                        <li><?= $this->Html->link(__('Lances'), ['controller' => 'lances', 'action' => '']) ?></li>
                        <li class="last"><?= $this->Html->link(__('Logout'), ['controller' => 'users', 'action' => 'logout']) ?></li>

<?php
    }
?>  
                   </ul>
                </div>     
        </section>
    </nav>
                       

    <?= $this->Flash->render() ?>


  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <?= $this->html->image('logomarca-haras-luanda.jpg') ?> 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= $this->html->link('Sobre', ['controller'=>'sobre/'], ['class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Leilões', ['controller'=>'leiloes', 'action'=>'indexUser'], ['class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Como funciona', ['controller'=>'como-funciona'], ['class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Politicas', ['controller'=>'politicas'], ['class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Contato', ['controller'=>'contato'], ['class'=>'nav-link']) ?>
      </li>
    </ul>

    <?php
        if(empty($this->request->session()->read()['Auth']['User']['role'])){
          echo  $this->html->link('Logar', ['controller'=>'users', 'action'=>'login'], ['class'=>'nav-link']);
          echo  $this->html->link('Cadastre-se', ['controller'=>'users', 'action'=>'cadastro'], ['class'=>'nav-link']);
        }else{
    ?>
    <!-- Small button groups (default and split) -->
    <div class="btn-group form-inline my-2 my-lg-0 nav-link">
      
        <?= $this->html->link($this->request->session()->read()['Auth']['User']['username'], '', [ 'class'=>"form-inline my-2 my-lg-0 btn btn-secondary btn-sm dropdown-toggle", 'type'=>"button", 'data-toggle'=>"dropdown", 'aria-haspopup'=>"true", 'aria-expanded'=>"false"]); ?>

      <div class="dropdown-menu">
        <?= $this->html->link('Senha', ['controller'=>'users', 'action'=>'editUserOne'], ['class'=>'dropdown-item']) ?>
        <?php
          if($this->request->session()->read()['Auth']['User']['role'] == 'superUser' OR $this->request->session()->read()['Auth']['User']['role'] == 'leiloeiro'){
            echo $this->html->link('Animais', ['controller'=>'animais', 'action'=>'indexUser'], ['class'=>'dropdown-item']);
            echo $this->html->link('Lances', ['controller'=>'lances', 'action'=>'indexUser'], ['class'=>'dropdown-item']);
            echo $this->html->link('Usuários', ['controller'=>'users', 'action'=>'indexUser'], ['class'=>'dropdown-item']);
            echo $this->html->link('Dados', ['controller'=>'dados', 'action'=>'indexUser'], ['class'=>'dropdown-item']);
            echo $this->html->link('Sair', ['controller'=>'users', 'action'=>'logout'],['class'=>'dropdown-item']);
          }
          if($this->request->session()->read()['Auth']['User']['role'] == 'arrematante'){
            echo $this->html->link('Lances', ['controller'=>'lances', 'action'=>'indexUserOne'], ['class'=>'dropdown-item']);
            echo $this->html->link('Sair', ['controller'=>'users', 'action'=>'logout'],['class'=>'dropdown-item']);
          }

        ?>
        
        
        
        
      </div>
    </div>
    <?php } ?>
  </div>


</nav>

    <section >
        <?= $this->fetch('content') ?>
    </section>
    <footer>
      
    </footer>
    <hr>
    <div class="rodape" style="color: #FFF; margin-top: 10px; ">
      <div style="padding-top: 20px; padding-bottom: 40px" class="row">
        <div class="col-md-4">
          <h3 style="color: #FFF">Contatos</h3>
          <p>
          Rodrigo Vilas Boas (Administrador): (71) 99958-6750<br /><br />

          E-mail: haras@harasluanda.com.br<br /><br />

          Av. Alphaville, nº 522, Quadra F4 Lote 01,<br /> Ed. Alpha Business 3º Andar, Sala 302,<br /> Alphaville I Salvador - Bahia - Brasil<br /> CEP: 41701-015
          </p>
        </div>
        <div class="col-md-4">
          <h3 style="color: #FFF"> Links</h3>
          <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <?= $this->html->link('Sobre', ['controller'=>'sobre/'], [ 'style'=>"color:#FFFFFF", 'class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Leilões', ['controller'=>'leiloes', 'action'=>'indexUser'], [ 'style'=>"color:#FFFFFF",'class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Como funciona', ['controller'=>'como-funciona'], [ 'style'=>"color:#FFFFFF",'class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Politicas', ['controller'=>'politicas'], [ 'style'=>"color:#FFFFFF",'class'=>'nav-link']) ?>
      </li>
      <li class="nav-item">
        <?= $this->html->link('Contato', ['controller'=>'contato'], [ 'style'=>"color:#FFFFFF",'class'=>'nav-link']) ?>
      </li>
    </ul>
        </div>
        <div class="col-md-4">
          <h3 style="color: #FFF">Redes sociais</h3>
          <!--  -->

          <a href="https://www.facebook.com/haras.luanda.94?ref=br_rs" target="_blank" ><img src="img/facebook.jpg" style="margin: 10px" ></a>
          <a href="https://www.youtube.com/user/harasluanda" target="_blank" ><img src="img/youtube.jpg" style="margin: 10px" > </a>
        </div>
      </div>
    </div>

    <?= $this->Html->script('bootstrap-4.1.0/dist/js/bootstrap.min'); ?>
        
</body>
</html>
