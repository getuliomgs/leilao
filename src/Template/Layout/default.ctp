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

if (!Configure::read('debug')):
    throw new NotFoundException('Please replace Pages/home.ctp with your own version.');
endif;

$cakeDescription = 'CakePHP: the rapid development php framework';
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
    
    <?= $this->Html->meta('icon') ?>

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
    <?= $this->Html->script('jquery-3.3.1.slim.min'); ?>
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

<?php

    if(isset($this->request->session()->read()['Auth']['User']['role']) and ($this->request->session()->read()['Auth']['User']['role'] == 'leiloeiro' OR $this->request->session()->read()['Auth']['User']['role'] == 'superUser')) {
?>
                        <li class="first"><?= $this->Html->link(__('Usuários'), ['controller' => 'users', 'action' => 'indexUser']) ?></li>
                        <li class="first"><?= $this->Html->link(__('Animais'), ['controller' => 'animais', 'action' => 'indexUser']) ?></li>
                        <li><?= $this->Html->link(__('Lances'), ['controller' => 'lances', 'action' => 'indexUser']) ?></li>
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
           echo  $this->html->link('Logar', ['controller'=>'users'], ['class'=>'nav-link']);
        }else{
           echo $this->html->link($this->request->session()->read()['Auth']['User']['username'], ['controller'=>'users', 'action'=>'index-user'], ['class'=>'nav-link']);
        }
    ?>
    
    
  </div>
</nav>

    <section >
        <?= $this->fetch('content') ?>
    </section>
    <footer>
     
    </footer>

    <?= $this->Html->script('bootstrap.min'); ?>
        
</body>
</html>
