<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;

/**
 * Leiloes Controller
 *
 * @property \App\Model\Table\AnimaisTable $Leiloes
 */
class LeiloesController extends AppController
{

    public $components = array('animais','leiloes', 'lances');


    public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['indexUser']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        
        
    }

    /**
     * Index User method
     *
     * @return \Cake\Network\Response|null
     */
    public function indexUser()
    {
               
        $flagLeilao = array();
        $time = Time::now();
        $listarAnimais = $this->animais->listarAnimais();
        foreach ($listarAnimais as $key => $value) {
            $flagLeilao[$key] = $this->animais->flagLeilao($value->data_leilao_ini, $value->data_leilao_fim, $time);
            $lances[$value->id] = $this->lances->lanceMaior($value->id);
        }
        $eventos = "";
        foreach (TableRegistry::get('eventos')->find()->limit(1)->order(['data_ini' => "DESC"]) as $key => $value) {
            
            $eventos = $value;
            
        }
        
        $this->set(compact('listarAnimais','flagLeilao', 'lances', 'eventos'));
        $this->set('_serialize', [$listarAnimais, $flagLeilao, $lances]);
    }

    

}
