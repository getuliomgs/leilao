<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Eventos Controller
 *
 * @property \App\Model\Table\EventosTable $Eventos
 */
class EventosController extends AppController
{

    public $uploads =  '../uploads/eventos/'; 
    public $uploads2 =  'uploads/eventos/'; 
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $eventos = $this->paginate($this->Eventos);

        $this->set(compact('eventos'));
        $this->set('_serialize', ['eventos']);
    }

    /**
     * View method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $evento = $this->Eventos->get($id, [
            'contain' => []
        ]);

        $this->set('evento', $evento);
        $this->set('_serialize', ['evento']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $evento = $this->Eventos->newEntity();
        if ($this->request->is('post')) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->data);
            if ($this->Eventos->save($evento)) {
                $this->Flash->success(__('The evento has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evento could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('evento'));
        $this->set('_serialize', ['evento']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $evento = $this->Eventos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->data);
            if ($this->Eventos->save($evento)) {
                $this->Flash->success(__('The evento has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The evento could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('evento'));
        $this->set('_serialize', ['evento']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
        $this->request->allowMethod(['post', 'delete']);
        $evento = $this->Eventos->get($id);
        if ($this->Eventos->delete($evento)) {
            $this->Flash->success(__('The evento has been deleted.'));
        } else {
            $this->Flash->error(__('The evento could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }

    /**
     * IndexUser method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexUser()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $eventos = $this->paginate($this->Eventos);

        $this->set(compact('eventos'));
        $this->set('_serialize', ['eventos']);
    }


    /**
     * AddUser method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addUser()
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $evento = $this->Eventos->newEntity();
        if ($this->request->is('post')) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->data);
            
            if ($this->Eventos->save($evento)) {

                foreach ($_FILES as $key => $value) {
                    if (move_uploaded_file($value['tmp_name'], $this->uploads2.$this->Eventos->save($evento)->id."-".$key.".".$this->extencaoNome($value['name']))) {

                        $evento = $this->Eventos->get($this->Eventos->save($evento)->id);

                        $evento->{$key} =  $this->Eventos->save($evento)->id."-".$key.".".$this->extencaoNome($value['name']);

                          if($this->Eventos->save($evento)) {
                              $this->Flash->success(__('Sucesso'.$key));
                          }else{
                              $this->Flash->error(__('Erro'.$key));
                          }
                    }else{
                        if($value['name'] != "") {
                            $this->Flash->error(__('Erro ao salvar imagem'.$value['name']));
                        }
                    }
                }

                $this->Flash->success(__('Salvo.'));
                return $this->redirect(['action' => 'indexUser']);
            } else {
                $this->Flash->error(__('Erro ao Salvar.'));
            }
        }
        $this->set(compact('evento'));
        $this->set('_serialize', ['evento']);
    }

    /**
     * EditUser method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editUser($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $evento = $this->Eventos->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            unset($this->request->data['img']);
            unset($this->request->data['img2']);
            $evento = $this->Eventos->patchEntity($evento, $this->request->data);
            if ($this->Eventos->save($evento)) {

                foreach ($_FILES as $key => $value) {
                    if (move_uploaded_file($value['tmp_name'], $this->uploads2.$this->Eventos->save($evento)->id."-".$key.".".$this->extencaoNome($value['name']))) {

                        $evento = $this->Eventos->get($this->Eventos->save($evento)->id);

                        $evento->{$key} =  $this->Eventos->save($evento)->id."-".$key.".".$this->extencaoNome($value['name']);

                          if($this->Eventos->save($evento)) {
                              $this->Flash->success(__('Sucesso'.$key));
                          }else{
                              $this->Flash->error(__('Erro'.$key));
                          }
                    }else{
                        if($value['name'] != "") {
                            $this->Flash->error(__('Erro ao salvar imagem'.$value['name']));
                        }
                    }
                }

                $this->Flash->success(__('Salvo.'));
                return $this->redirect(['action' => 'indexUser']);
            } else {
                $this->Flash->error(__('Erro ao Salvar.'));
            }
        }
        $this->set(compact('evento'));
        $this->set('_serialize', ['evento']);
    }

    /**
     * ViewUser method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewUser($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $evento = $this->Eventos->get($id, [
            'contain' => []
        ]);

        $this->set('evento', $evento);
        $this->set('_serialize', ['evento']);
    }

    /**
     * DeleteUser method
     *
     * @param string|null $id Evento id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteUser($id = null)
    {
        $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
        $this->request->allowMethod(['post', 'delete']);
        $evento = $this->Eventos->get($id);
        if ($this->Eventos->delete($evento)) {
            $this->Flash->success(__('Excluido.'));
        } else {
            $this->Flash->error(__('Não foi possível excluir.'));
        }
        return $this->redirect(['action' => 'indexUser']);
    }

}
