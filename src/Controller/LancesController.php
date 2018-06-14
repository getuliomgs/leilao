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

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
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
        $this->request->allowMethod(['post', 'delete']);
        $lance = $this->Lances->get($id);
        if ($this->Lances->delete($lance)) {
            $this->Flash->success(__('The lance has been deleted.'));
        } else {
            $this->Flash->error(__('The lance could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
