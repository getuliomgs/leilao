<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    private $optRole =  ['superUser' => 'Super Usuário', 'leiloeiro' => 'Leiloeiro'];


    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout', 'cadastro','index','login', 'add','edit', 'view']);
    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {


        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        //$this->testeAuth($this->request->session()->read()['Auth']['User']['role'],['leiloeiro']);

        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        //$this->testeAuth($this->request->session()->read()['Auth']['User']['role'],['leiloeiro']);

        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                if($this->request->data['avulso'] == 'true'){
                    $this->login();
                }else{  
                    return $this->redirect(['action' => 'index']);
                }
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $optRole = $this->optRole;
        $this->set(compact('user', 'optRole'));
        $this->set('_serialize', ['user', 'optRole']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
       // $this->testeAuth($this->request->session()->read()['Auth']['User']['role'],['leiloeiro']);

        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $optRole = $this->optRole;
        $this->set(compact('user', 'optRole'));
        $this->set('_serialize', ['user', 'optRole']);
    }

    /**
     * Edit User method
     *
     * @param 
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editUser()
    {
        
        //$this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['leiloeiro']);

        $user = $this->Users->get($this->request->session()->read()['Auth']['User']['id'], [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Salvo!'));
                return $this->redirect(['action' => 'editUser']);
            } else {
                $this->Flash->error(__('Tente novamente!'));
            }
        }
        $optRole = $this->optRole;
        $this->set(compact('user', 'optRole'));
        $this->set('_serialize', ['user', 'optRole']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        //$this->testeAuth($this->request->session()->read()['Auth']['User']['role'],['leiloeiro']);


        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function login()
    {
        if ($this->request->is('post')) {
           
           $user = $this->Auth->identify();
            //debug($user['role']);
           //debug($user)or die();
            if ($user) {
                $this->Auth->setUser($user);
                if($user['role'] != 'condomino'){
                    return $this->redirect($this->Auth->redirectUrl());
                }else{
                    if($user['created']->format("Y-m-d") == date("Y-m-d") ){
                         $this->Flash->success(__('Um email foi enviado para '.$user['username'].' com instruções de acesso.'));  
                    }
                    return $this->redirect(['controller' => 'relatorios', 'action'=>'']);
                }
            }
            
            if(isset($this->request->data['cadastro'])){
                //cadastra usuário e envia email para confirmar acesso
                $this->add();
            }else{
                $this->Flash->error(__('Invalido usuário ou senha, tente novamente'));
            }
        }
    }

    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

    public function acesso()
    {
        $m = 0;

        if(isset($_GET['m'])) {
            $m = $_GET['m'];
        }

        switch ($m) {
            case 1:
                $mens = "Verifique seu acesso!";
                break;
            
            default:
                $mens = "Usuário não tem credencial de acesso!";
                break;
        }
        $this->Flash->error(__($mens));
    }


    public function indexUser()
    {
        
        //$this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['leiloeiro']);

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

     public function cadastro()
    {
          
    }
}
