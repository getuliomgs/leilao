<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersCondominos Controller
 *
 * @property \App\Model\Table\UsersCondominosTable $UsersCondominos
 */
class UsersCondominosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->testeAuth($_SESSION['Auth']['User']['role'], ['sindAdm']);

        $this->paginate = [
            'contain' => ['Users', 'Condominos']
        ];
        $usersCondominos = $this->paginate($this->UsersCondominos);

        $this->set(compact('usersCondominos'));
        $this->set('_serialize', ['usersCondominos']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Condomino id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->testeAuth($_SESSION['Auth']['User']['role'], ['sindAdm']);

        $usersCondomino = $this->UsersCondominos->get($id, [
            'contain' => ['Users', 'Condominos']
        ]);

        $this->set('usersCondomino', $usersCondomino);
        $this->set('_serialize', ['usersCondomino']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->testeAuth($_SESSION['Auth']['User']['role'], ['sindAdm']);

        $usersCondomino = $this->UsersCondominos->newEntity();
        if ($this->request->is('post')) {
            $usersCondomino = $this->UsersCondominos->patchEntity($usersCondomino, $this->request->data);
            if ($this->UsersCondominos->save($usersCondomino)) {
                $this->Flash->success(__('The users condomino has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users condomino could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersCondominos->Users->find('list', ['limit' => 200]);
        $condominos = $this->UsersCondominos->Condominos->find('list', ['limit' => 200]);
        $this->set(compact('usersCondomino', 'users', 'condominos'));
        $this->set('_serialize', ['usersCondomino']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Condomino id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->testeAuth($_SESSION['Auth']['User']['role'], ['sindAdm']);

        $usersCondomino = $this->UsersCondominos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersCondomino = $this->UsersCondominos->patchEntity($usersCondomino, $this->request->data);
            if ($this->UsersCondominos->save($usersCondomino)) {
                $this->Flash->success(__('The users condomino has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The users condomino could not be saved. Please, try again.'));
            }
        }
        $users = $this->UsersCondominos->Users->find('list', ['limit' => 200]);
        $condominos = $this->UsersCondominos->Condominos->find('list', ['limit' => 200]);
        $this->set(compact('usersCondomino', 'users', 'condominos'));
        $this->set('_serialize', ['usersCondomino']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Condomino id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->testeAuth($_SESSION['Auth']['User']['role'], ['sindAdm']);

        $this->request->allowMethod(['post', 'delete']);
        $usersCondomino = $this->UsersCondominos->get($id);
        if ($this->UsersCondominos->delete($usersCondomino)) {
            $this->Flash->success(__('The users condomino has been deleted.'));
        } else {
            $this->Flash->error(__('The users condomino could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
