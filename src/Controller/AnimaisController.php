<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Animais Controller
 *
 * @property \App\Model\Table\AnimaisTable $Animais
 */
class AnimaisController extends AppController
{

  public $components = array('animais', 'lances');

  public $uploads =  '../uploads/animais/'; 
  public $uploads2 =  'uploads/animais/'; 
  private $sexo = ['m' => 'Macho','f' => 'Fêmea'];
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser']);
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
      $sexo = $this->sexo;
      $pelagem = $this->pelagem;
      $status_2 = $this->status_2;

      $animai = $this->Animais->newEntity();
      if ($this->request->is('post')) {
          $this->request->data['data_nasc'] = $this->format_data($this->request->data['data_nasc']);
          $animai = $this->Animais->patchEntity($animai, $this->request->data);         
          
          if ($this->Animais->save($animai)) {

              foreach ($_FILES as $key => $value) {

                  if (move_uploaded_file($value['tmp_name'], $this->uploads2.$this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']))) {

                      $animai = $this->Animais->get($this->Animais->save($animai)->id);

                      $animai->{$key} =  $this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']);

                      if($this->Animais->save($animai)) {
                          $this->Flash->success(__('Sucesso '.$key));
                      }else{
                          $this->Flash->error(__('Erro '.$key));
                      }
                  }else{
                      if($value['name'] != "") {
                          $this->Flash->error(__('Erro ao salvar imagem '.$value['name']));
                      }
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
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
          unset($this->request->data['geneologia_img']);
          $this->request->data['data_nasc'] = $this->format_data($this->request->data['data_nasc']);
          $animai = $this->Animais->patchEntity($animai, $this->request->data);
          
          if ($this->Animais->save($animai)) {

              //debug(getcwd());
              
              foreach ($_FILES as $key => $value) {
                  if (move_uploaded_file($value['tmp_name'], $this->uploads2.$this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']))) {

                      $animai = $this->Animais->get($this->Animais->save($animai)->id);

                      $animai->{$key} =  $this->Animais->save($animai)->id."-".$key.".".$this->extencaoNome($value['name']);

                      if($this->Animais->save($animai)) {
                          $this->Flash->success(__('Sucesso'.$key));
                      }else{
                          $this->Flash->error(__('Erro'.$key));
                      }
                  }else{
                      if($value['name'] != "") {
                          $this->Flash->error(__('Erro ao salvar imagem '.$value['name']));
                      }
                  }
              }

              $this->Flash->success(__('Salvo.'));
              return $this->redirect(['action' => 'indexUser']);
          } else {
              $this->Flash->error(__('Erro ao Salvar.'));
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

      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
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
      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
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

      $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro']);
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

       $eventos = "";
        foreach (TableRegistry::get('eventos')->find()->limit(1)->order(['data_ini' => "DESC"]) as $key => $value) {
            
            $eventos = $value;
            
        }

      //debug($time->subSecond(3600));
      
      //debug($time);
      //debug(get_class_methods($time));
     
      
      
     
      $flagLeilao = $this->animais->flagLeilao($animai->data_leilao_ini, $animai->data_leilao_fim, $time);
      $lances = $this->lances->lances($id);
      $animai->status_2 = $status_2[$animai->status_2];
      $this->set(compact('animai', 'flagLeilao', 'lances', 'eventos', 'time'));
      $this->set('_serialize', [$animai, $flagLeilao, $lances, $time]);
  }

  /**
   * listarExtratos method
   *
   * @param int|null $id Condominios id.
   * @return retorna form select extratos
   * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
   */
  public function lance($id)
  { 
      
    $this->testeAuth($this->request->session()->read()['Auth']['User']['role'], ['superUser', 'leiloeiro', 'arrematante']);

    $animai = $this->Animais->get($id, [
          'contain' => []
      ]);
    $this->autoRender = false;
    $this->viewBuilder()->layout('ajax');

    $lances = TableRegistry::get('Lances');
    $lance = $lances->newEntity();
    $lance->animais_id = $id;
    $lance->users_id = $this->request->session()->read()['Auth']['User']['id'];
    $lance->valor = $this->request->query['lanceAtual'];
    
    //verificar se ainda a tempo para lance
    //verifciar se a lance é maior
    //verificar se o animal esta ativo
    if( ($animai->status_2 == 'A')  AND ($animai->data_leilao_ini < Time::now() AND $animai->data_leilao_fim > Time::now()) AND (empty($this->lances->lanceMaior($id)) OR $this->lances->lanceMaior($id)->valor < (float) $lance->valor )){
      if ($lances->save($lance)) {
        echo  "
              <div class='col-12'><h2>Parabéns</h2></div>
              <div class='col-12'><h4>Você é o atual arrematante desse Lote!</h4></div>
              <div class='col-12'><a href='javascript:history.back() ' ><button id=\"buttonAtualizar\" type=\"button\" class=\"btn btn-success btn-primary btn-lg btn-block\">ATUALIZAR</button></a></div>
            ";
        $this->lances->comunicarLance($lance);
      }else{
        echo  "
              <div class='col-12'><h2>Erro no processamento do Lance.</h2></div>
              <div class='col-12'><h4>Contate administrador Rodrigo Vilas Boas (71) 99958-6750</h4></div>
            ";
      }
    }else{
       echo  "
              <div class='col-12'><h2>Opa, não foi possível computar seu lance!</h2></div>
              <div class='col-12'><h4>Verifique se existe um lance maior ou igual ao seu ou se o período para lances esgotou.</h4></div>
              <div class='col-12'><h4>Atualize e tente novamente.</h4></div>
              <div class='col-12'><a href='javascript:history.back() ' ><button id=\"buttonAtualizar\" type=\"button\" class=\"btn btn-success btn-primary btn-lg btn-block\">ATUALIZAR</button></a></div>
            ";
    }
      
  }
}
