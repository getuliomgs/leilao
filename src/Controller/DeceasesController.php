<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Deceases Controller
 *
 * @property \App\Model\Table\DeceasesTable $Deceases
 */
class DeceasesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $deceases = $this->paginate($this->Deceases);

        $this->set(compact('deceases'));
        $this->set('_serialize', ['deceases']);
    }

 

    /**
     * View method
     *
     * @param string|null $id Decease id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $decease = $this->Deceases->get($id, [
            'contain' => []
        ]);

        $this->set('decease', $decease);
        $this->set('_serialize', ['decease']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $decease = $this->Deceases->newEntity();
        if ($this->request->is('post')) {
            $decease = $this->Deceases->patchEntity($decease, $this->request->data);
            if ($this->Deceases->save($decease)) {
                $this->Flash->success(__('The decease has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The decease could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('decease'));
        $this->set('_serialize', ['decease']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Decease id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $decease = $this->Deceases->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $decease = $this->Deceases->patchEntity($decease, $this->request->data);
            if ($this->Deceases->save($decease)) {
                $this->Flash->success(__('The decease has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The decease could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('decease'));
        $this->set('_serialize', ['decease']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Decease id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $decease = $this->Deceases->get($id);
        if ($this->Deceases->delete($decease)) {
            $this->Flash->success(__('The decease has been deleted.'));
        } else {
            $this->Flash->error(__('The decease could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }


    public function test($id = null){

        $decease = $this->Deceases->get($id, [
            'contain' => [
                ]
        ]);
        $this->set('decease', $decease);

        $this->viewBuilder()->options([
            'pdfConfig' => [
                'orientation' => 'portrait',
                'filename' => 'test'.$id
            ]           
        ]);     
    }
}
