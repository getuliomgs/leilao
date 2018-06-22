<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\Entity;
use Cake\I18n\FrozenTime;
use App\Controller\DadosController;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{

    private $optRole =  ['superUser' => 'Super Usuário', 'leiloeiro' => 'Leiloeiro'];
    private $status = ['A'=>'Ativo', 'I'=>'Inativo', 'P'=>"Pendente"];

    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['logout', 'cadastro','login', 'view', 'confirmar']);
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
    public function editUser($id = null)
    {    
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['leiloeiro', 'superUser']);
        $user = $this->Users->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data, ['validate' => false]);
            if(empty($this->request->data['password'])){
                unset($user->password);
            }
            if ($this->Users->save($user)) {
                $user = $this->Users->get($id);
                if($this->request->data['status'] == 'A'){
                    $email = new Email('default');
                    $email->from(['getulio.sena.junior@gmail.com' => 'Haras Luanda'])
                        ->to($user->username)
                        ->cc('getulio.sena.junior@gmail.com')
                        ->replyTo('harasluanda@gmail.com')
                        ->emailFormat('html')
                        ->subject('USUÁRIO ATIVO - Haras Luanda')
                        ->send(
                            
                            '<h2>Parabéns,</h2>'.
                            'Seu usuário ( '.$user->username.' ) está apto para dar lances.<br /><br />'.

                            'Para completar seu cadastro, clique no link abaixo e crie a sua senha. <br />'.
                            '<a href="http://harasluanda.com.br/users/confirmar/'.$id.'?data='.$user->created.'&key='.$user->password.'">Acesse este Link  para criar sua senha</a><br /><br />'.
                            
                            'Atenciosamente,<br />'. 
                            'Sistema leilao Haras Luanda <br />'.
                            'harasluanda@gmail.com'
                        );
                        $this->Flash->success(__('Um email comunicando status avito foi enviado'));
                }

                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index_user']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $optRole = $this->optRole;
        $status = $this->status;
        $this->set(compact('user', 'optRole', 'status'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit User method
     *
     * @param 
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editUserOne()
    {
        //$this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['leiloeiro']);
        $user = $this->Users->get($this->request->session()->read()['Auth']['User']['id'], [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if(empty($this->request->data['password'])){
                unset($user->password);
            }
            if ($this->Users->save($user)) {
                $this->Flash->success(__('Salvo!'));
                return $this->redirect(['action' => 'editUser']);
            } else {
                $this->Flash->error(__('Tente novamente!'));
            }
        }
        $optRole = $this->optRole;
        $status = $this->status;
        $this->set(compact('user', 'optRole', 'status'));
        $this->set('_serialize', ['user']);
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
        if ($this->request->is('post')) {
            $this->request->data['data_nasc'] = $this->format_data($this->request->data['data_nasc']);
          
            $user = $this->Users->newEntity();
            

            $dadosTable = TableRegistry::get('Dados');
            $dados = $dadosTable->newEntity();
            $dados = $dadosTable->patchEntity($dados, $this->request->data);

            $user->username = $this->request->data['email'];
            $user->password = "mudar123";
            $user->status = "P";
            $user->role = "arrematante";
          
            if ($this->Users->save($user)) {
                $dados->users_id = $this->Users->save($user)->id;
                if($dadosTable->save($dados)) {
                   
                    $this->Flash->success(__('Usuário salvo com sucesso.'));
                    $email = new Email('default');
                    $email->from(['getulio.sena.junior@gmail.com' => 'Haras Luanda'])
                    ->to($this->request->data['email'])
                    ->replyTo('harasluanda@gmail.com')
                    ->emailFormat('html')
                    ->subject('Pré-cadastro - Haras Luanda')
                    ->send(
                        
                        '<h2>Olá, '.$dados->nome_razao.'</h2>'.
                        'O seu pré-cadastro foi realizado com sucesso.<br /><br />'.

                        'Seu  usuário encontra-se pendende de aprovação com prazo medio de 24hs para liberação.<br /><br >'.
                        
                        'Atenciosamente,<br />'. 
                        'Equipe Haras Luanda <br />'.
                        'harasluanda@gmail.com'
                    );

                    $email->from(['getulio.sena.junior@gmail.com' => 'Haras Luanda'])
                    ->to('harasluanda@gmail.com')
                    ->cc('getulio.sena.junior@gmail.com')
                    ->replyTo('harasluanda@gmail.com')
                    ->emailFormat('html')
                    ->subject('NOVO USUÁRIO - Haras Luanda')
                    ->send(
                        
                        '<h2>Olá,</h2>'.
                        'O usuário ( '.$user->username.' ) acabou de ser cadastrar no site e estar aguardando aprovação.<br /><br />'.

                        'Data cadastro: '.$this->Users->save($user)->created.'<br /><br >'.
                        
                        'Atenciosamente,<br />'. 
                        'Sistema leilao Haras Luanda <br />'.
                        'getulio.sena.junior@gmail.com'
                    );
                    $this->Flash->success(__('Um e-mail de pré-cadastro foi enviado para '.$user->username.', favor acessar!'));
                    //reset form
                }else{
                    $this->Flash->error(__('Erro contate administrador Rodrigo Vilas Boas (71) 99958-6750'));
                }
            }else{
                $this->Flash->error(__('Erro ao cadastrar, verifique em seu email se ele já esta cadastrado. Ou contate administrador Rodrigo Vilas Boas (71) 99958-6750'));
            }
        }
    }

    public function confirmar($id = null)
    {
        $this->Auth->logout();
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            if (($user->created == $this->request->query['data']) and ($user->password == $this->request->query['key'])){
                $user = $this->Users->patchEntity($user, $this->request->data);
            if($this->Users->save($user)) {
                 $this->Flash->success(__('Senha Alterada com sucesso. Faça login!'));

                return $this->redirect(['action' => 'index_user']);
            } else {
                $this->Flash->error(__('Erro ao salvar!'));
            }
        }else{
            $this->Flash->error(__('Erro contate administrador Rodrigo Vilas Boas (71) 99958-6750'));
        }
        $optRole = $this->optRole;
        $this->set(compact('user', 'optRole'));
        $this->set('_serialize', ['user', 'optRole']);
        }
    }
}
