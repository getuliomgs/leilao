<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;

/**
 * Animais Controller
 *
 * @property \App\Model\Table\AnimaisTable $Animais
 */
class AnimaisController extends AppController
{

    public $components = array('animais', 'lances');

    public $uploads =  '../uploads/animais/'; 
    public $uploads2 =  'webroot/uploads/animais/'; 
    private $sexo = ['m' => 'Macho','f' => 'Fêmia'];
    private $status_2 =  [ 'A'=>'Ativo', 'I'=>'Inativo'];
    private $pelagem =
        [
            '1'=>'Alazã',
            '2'=>'Alazã amarilha',
            '3'=>'Alazã Amarilia Clara',
            '4'=>'Alazã sobre baia tendendo a alazã',
            '5'=>'Alazã tostada',
            '6'=>'Alazão sobre baio',
            '7'=>'Amarilho',
            '8'=>'Baia',
            '9'=>'Baia palha',
            '10'=>'Baia Pampa',
            '11'=>'Baia tendendo a tordilha',
            '12'=>'Castanha pampa',
            '13'=>'Castanha tendendo a preta pampa',
            '14'=>'Castanho',
            '15'=>'Lobuno',
            '16'=>'Não informado',
            '17'=>'Pampa de baio',
            '18'=>'Pampa de Lobuna',
            '19'=>'Pampa de preto',
            '20'=>'Pelo de rato arruanado',
            '21'=>'Preta pampa',
            '22'=>'Preto',
            '23'=>'Tordilha'
        ];
    
public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['leilao']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $animais = $this->paginate($this->Animais);

        $this->set(compact('animais'));
        $this->set('_serialize', ['animais']);
    }

    /**
     * View method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $animai = $this->Animais->get($id, [
            'contain' => []
        ]);

        $this->set('animai', $animai);
        $this->set('_serialize', ['animai']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $animai = $this->Animais->newEntity();
        if ($this->request->is('post')) {
            $animai = $this->Animais->patchEntity($animai, $this->request->data);
            if ($this->Animais->save($animai)) {
                $this->Flash->success(__('The animai has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The animai could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('animai'));
        $this->set('_serialize', ['animai']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $animai = $this->Animais->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $animai = $this->Animais->patchEntity($animai, $this->request->data);
            if ($this->Animais->save($animai)) {
                $this->Flash->success(__('The animai has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The animai could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('animai'));
        $this->set('_serialize', ['animai']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $animai = $this->Animais->get($id);
        if ($this->Animais->delete($animai)) {
            $this->Flash->success(__('The animai has been deleted.'));
        } else {
            $this->Flash->error(__('The animai could not be deleted. Please, try again.'));
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
        $animais = $this->paginate($this->Animais);

        $this->set(compact('animais'));
        $this->set('_serialize', ['animais']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addUser()
    {
        $sexo = $this->sexo;
        $pelagem = $this->pelagem;
        $status_2 = $this->status_2;

        $animai = $this->Animais->newEntity();
        if ($this->request->is('post')) {
            $this->request->data['data_nasc'] = $this->format_data($this->request->data['data_nasc']);
            $animai = $this->Animais->patchEntity($animai, $this->request->data);         
            
            if ($this->Animais->save($animai)) {

                foreach ($_FILES as $key => $value) {
                    debug($_FILES);
                    debug($_POST);
                    if (move_uploaded_file($value['tmp_name'], $this->uploads2.$this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']))) {

                        $animai = $this->Animais->get($this->Animais->save($animai)->id);

                        $animai->{$key} =  $this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']);

                        if($this->Animais->save($animai)) {
                            $this->Flash->success(__('Sucesso'.$key));
                        }else{
                            $this->Flash->error(__('Erro'.$key));
                        }
                    }else{
                        $this->Flash->error(__('Erro ao salvar imagem'.$value['name']));
                    }
                }

                $this->Flash->success(__('Salvo com sucesso!'));
                return $this->redirect(['action' => 'indexUser']);
            } else {
                $this->Flash->error(__('Não foi possivel salvar. Tente novamente.'));
            }
        }

        $this->set(compact('animai', 'sexo', 'pelagem','status_2' ));
        $this->set('_serialize', ['animai', 'sexo', 'pelagem', 'status_2']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function editUser($id = null)
    {
        $sexo = $this->sexo;
        $pelagem = $this->pelagem;
        $status_2 = $this->status_2;

        $animai = $this->Animais->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {

            unset($this->request->data['foto_1']);
            unset($this->request->data['foto_2']);
            unset($this->request->data['foto_3']);
            unset($this->request->data['foto_4']);
            $this->request->data['data_nasc'] = $this->format_data($this->request->data['data_nasc']);
            $animai = $this->Animais->patchEntity($animai, $this->request->data);
            
            if ($this->Animais->save($animai)) {

                debug(getcwd());
                
                foreach ($_FILES as $key => $value) {
                    if (move_uploaded_file($value['tmp_name'], $this->uploads2.$this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']))) {

                        $animai = $this->Animais->get($this->Animais->save($animai)->id);

                        $animai->{$key} =  $this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']);

                        if($this->Animais->save($animai)) {
                            $this->Flash->success(__('Sucesso'.$key));
                        }else{
                            $this->Flash->error(__('Erro'.$key));
                        }
                    }
                }

                $this->Flash->success(__('The animai has been saved.'));
                return $this->redirect(['action' => 'indexUser']);
            } else {
                $this->Flash->error(__('The animai could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('animai', 'sexo','pelagem','status_2'));
        $this->set('_serialize', ['animai', 'sexo', 'pelagem', 'status_2']);
    }

    /**
     * View method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewUser($id = null)
    {

        $sexo = $this->sexo;
        $pelagem = $this->pelagem;
        $status_2 = $this->status_2;

        $animai = $this->Animais->get($id, [
            'contain' => []
        ]);
        $animai->sexo = $sexo[$animai->sexo];
        if(empty($animai->pelagem)){
            $animai->pelagem = '';  
        }else{
            $animai->pelagem = $pelagem[$animai->pelagem];
        }
        $animai->status_2 = $status_2[$animai->status_2];
        $this->set('animai', $animai);
        $this->set('_serialize', [$animai]);
    }


     /**
     * Delete method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function deleteUser($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $animai = $this->Animais->get($id);
        if ($this->Animais->delete($animai)) {
            $this->Flash->success(__('Animal deletado com sucesso.'));
        } else {
            $this->Flash->error(__('Não foi possivel deletar. Tente novamente.'));
        }
        return $this->redirect(['action' => 'index_user']);
    }

     /**
     * View method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function viewAnimais()
    {

        $sexo = $this->sexo;
        $pelagem = $this->pelagem;
        $status_2 = $this->status_2;

        
        $this->set('sexo', $sexo);
        $this->set('_serialize', [$sexo]);
    }

     /**
     * View method
     *
     * @param string|null $id Animai id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function leilao($id = null)
    {

        $lances = array();
        $sexo = $this->sexo;
        $pelagem = $this->pelagem;
        $status_2 = $this->status_2;
        $time = Time::now();
        $animai = $this->Animais->get($id, [
            'contain' => []
        ]);

        $animai->sexo = $sexo[$animai->sexo];
        if(empty($animai->pelagem)){
            $animai->pelagem = '';  
        }else{
            $animai->pelagem = $pelagem[$animai->pelagem];
        }

        //debug($this->request->session()->read()['Auth']['User']['role']);

        $flagLeilao = $this->animais->flagLeilao($animai->data_leilao_ini, $animai->data_leilao_fim, $time);
        $lances = $this->lances->lances($id);
        $animai->status_2 = $status_2[$animai->status_2];
        $this->set(compact('animai', 'flagLeilao', 'lances'));
        $this->set('_serialize', [$animai, $flagLeilao, $lances]);
    }

}
