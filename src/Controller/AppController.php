<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
 use Cake\Database\Type;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->_validViewOptions[] = 'pdfConfig';

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
             // If unauthorized, return them to page they were just on
            'unauthorizedRedirect' => $this->referer()
        ]);

                
        //$this->viewBuilder()->theme('TwitterBootstrap');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }

    public function format_data($data){

        if($data != '') {
            $data = explode( "/", $data );
            if(count($data) == 3){
                $data =   ['year' => $data[2],'month' => $data[1],'day' => $data[0]];
                
            }elseif(count($data) == 2) {
                $data =   ['year' => $data[1],'month' => $data[0],'day' => '01'];
            }
        }else{
            $data = null;
        }
        return $data;
    }

    public function beforeFilter(Event $event) {

        //$this->Auth->allow("ALL");
    }

    //teste permissão rule
    public function testeAuth($rule, $rules = array(), $m = 0){
        
        //credecial admin tem acesso a tudo
        array_push($rules, "superUser");
        $permissao = false;
        foreach ($rules as $key => $value) {
            if($rule == $value){
                $permissao = true;
            }
        }

        //http://book.cakephp.org/3.0/en/controllers/components/authentication.htmls
        if(!$permissao){
            $this->redirect(['controller'=>'Users', 'action'=>'login', 'm'=>$m]);
        }
        //debug("testeAuth")or die();
    }

    public function extencaoNome($nome)  {

        $arquivo =  $nome;
     
        $arquivo = substr($arquivo, -4);
         
        if($arquivo[0] == '.'){
              $arquivo = substr($arquivo, -3);
        }
         
        return $arquivo;
    }
}
