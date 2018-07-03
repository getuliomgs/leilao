<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Dados Controller
 *
 * @property \App\Model\Table\DadosTable $Dados
 */
class DadosController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $dados = $this->paginate($this->Dados);

        $this->set(compact('dados'));
        $this->set('_serialize', ['dados']);
    }

    /**
     * View method
     *
     * @param string|null $id Dado id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dado = $this->Dados->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('dado', $dado);
        $this->set('_serialize', ['dado']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dado = $this->Dados->newEntity();
        if ($this->request->is('post')) {
            $dado = $this->Dados->patchEntity($dado, $this->request->data);
            if ($this->Dados->save($dado)) {
                $this->Flash->success(__('The dado has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dado could not be saved. Please, try again.'));
            }
        }
        $users = $this->Dados->Users->find('list', ['limit' => 200]);
        $this->set(compact('dado', 'users'));
        $this->set('_serialize', ['dado']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Dado id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dado = $this->Dados->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dado = $this->Dados->patchEntity($dado, $this->request->data);
            if ($this->Dados->save($dado)) {
                $this->Flash->success(__('The dado has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The dado could not be saved. Please, try again.'));
            }
        }
        $users = $this->Dados->Users->find('list', ['limit' => 200]);
        $this->set(compact('dado', 'users'));
        $this->set('_serialize', ['dado']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dado id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dado = $this->Dados->get($id);
        if ($this->Dados->delete($dado)) {
            $this->Flash->success(__('The dado has been deleted.'));
        } else {
            $this->Flash->error(__('The dado could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * IndexUser method
     *
     * @return \Cake\Network\Response|null
     */
    public function IndexUser()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $dados = $this->paginate($this->Dados);

        $this->set(compact('dados'));
        $this->set('_serialize', ['dados']);
    }

    /**
     * ViewUser method
     *
     * @param string|null $id Dado id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewUser($id = null)
    {
        $dado = $this->Dados->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('dado', $dado);
        $this->set('_serialize', ['dado']);
    }
}
