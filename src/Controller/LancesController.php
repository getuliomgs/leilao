<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Lances Controller
 *
 * @property \App\Model\Table\LancesTable $Lances
 */
class LancesController extends AppController
{

     public $components = array('lances');

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $this->paginate = [
            'contain' => ['Users', 'Animais']
        ];
        $lances = $this->paginate($this->Lances);

        $this->set(compact('lances'));
        $this->set('_serialize', ['lances']);
    }

    /**
     * View method
     *
     * @param string|null $id Lance id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $lance = $this->Lances->get($id, [
            'contain' => ['Users', 'Animais']
        ]);

        $this->set('lance', $lance);
        $this->set('_serialize', ['lance']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $lance = $this->Lances->newEntity();
        if ($this->request->is('post')) {
            $lance = $this->Lances->patchEntity($lance, $this->request->data);
            if ($this->Lances->save($lance)) {
                $this->Flash->success(__('The lance has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lance could not be saved. Please, try again.'));
            }
        }
        $users = $this->Lances->Users->find('list', ['limit' => 200]);
        $animais = $this->Lances->Animais->find('list', ['limit' => 200]);
        $this->set(compact('lance', 'users', 'animais'));
        $this->set('_serialize', ['lance']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Lance id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $lance = $this->Lances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lance = $this->Lances->patchEntity($lance, $this->request->data);
            if ($this->Lances->save($lance)) {
                $this->Flash->success(__('The lance has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The lance could not be saved. Please, try again.'));
            }
        }
        $users = $this->Lances->Users->find('list', ['limit' => 200]);
        $animais = $this->Lances->Animais->find('list', ['limit' => 200]);
        $this->set(compact('lance', 'users', 'animais'));
        $this->set('_serialize', ['lance']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Lance id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $this->request->allowMethod(['post', 'delete']);
        $lance = $this->Lances->get($id);
        if ($this->Lances->delete($lance)) {
            $this->Flash->success(__('The lance has been deleted.'));
        } else {
            $this->Flash->error(__('The lance could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * Index user method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexUser()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser','leiloeiro']);
        $this->paginate = [
            'contain' => ['Users', 'Animais']
        ];
        $lances = $this->paginate($this->Lances);

        $this->set(compact('lances'));
        $this->set('_serialize', ['lances']);
    }

    /**
     * View User method
     *
     * @param string|null $id Lance id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewUser($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $lance = $this->Lances->get($id, [
            'contain' => ['Users', 'Animais']
        ]);

        $this->set('lance', $lance);
        $this->set('_serialize', ['lance']);
    }

    /**
     * EditUser method
     *
     * @param string|null $id Lance id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editUser($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $lance = $this->Lances->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lance = $this->Lances->patchEntity($lance, $this->request->data);
            if ($this->Lances->save($lance)) {
                $this->Flash->success(__('Salvo.'));
                return $this->redirect(['action' => 'indexUser']);
            } else {
                $this->Flash->error(__('Falha no Salvar, tente novamente!.'));
            }
        }
        $users = $this->Lances->Users->find('list', ['limit' => 200]);
        $animais = $this->Lances->Animais->find('list', ['limit' => 200]);
        $this->set(compact('lance', 'users', 'animais'));
        $this->set('_serialize', ['lance']);
    }

    /**
     * DeleteUser method
     *
     * @param string|null $id Lance id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteUser($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $this->request->allowMethod(['post', 'delete']);
        $lance = $this->Lances->get($id);
        if ($this->Lances->delete($lance)) {
            $this->Flash->success(__('Excluido com sucesso.'));
        } else {
            $this->Flash->error(__('Falha na exclusão, tente novamente!.'));
        }
        return $this->redirect(['action' => 'indexUser']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addUser()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $lance = $this->Lances->newEntity();
        if ($this->request->is('post')) {
            $lance = $this->Lances->patchEntity($lance, $this->request->data);
            $lanceMaior = $this->lances->lanceMaior($lance->animais_id);
            if (($lance->valor > $lanceMaior->animai->valor AND $lance->valor > $lanceMaior->valor ) AND $this->Lances->save($lance)) {
                $this->Flash->success(__('Salvo.'));
                return $this->redirect(['action' => 'indexUser']);
            } else {
                $this->Flash->error(__('Falha, tente novamente.'));
            }
        }
        $users = $this->Lances->Users->find('list', ['limit' => 200]);
        $animais = $this->Lances->Animais->find('list', ['limit' => 200]);
        $this->set(compact('lance', 'users', 'animais'));
        $this->set('_serialize', ['lance']);
    }

    /**
     * Index user method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexUserOne()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro', 'arrematante']);
        $this->paginate = [
            'contain' => ['Users', 'Animais']
        ];
        $query = $this->Lances->find()->where(['users_id'=>$this->request->session()->read()['Auth']['User']['id']]);
        $lances = $this->paginate($query);

        $this->set(compact('lances'));
        $this->set('_serialize', ['lances']);
    }


    
}
