<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class condominiosComponent extends Component
{

	public function selectCondominios() {
        
        $query = TableRegistry::get('condominios')->find();
        $condominios = array();
        $condominios[''] = "Selecione";
        if($this->request->session()->read()['Auth']['User']['role'] != 'superUser'){
            $query->select([
                'condominios.id',
                'condominios.name',
                'parcelas.id',
                'parcelas.condominios_id',
                'parcelas.condominos_id',
                'condominos.id',
                'condominos.nome',
                'condominos.email'
            ]); 
            $query->rightjoin('parcelas', 'parcelas.condominios_id = condominios.id');
            $query->rightjoin('condominos', 'condominos.id = parcelas.condominos_id');
            $query->WHERE(['condominos.email' => $this->request->session()->read()['Auth']['User']['username']]);
            $query->GROUP('condominios.id');    
        }
        foreach ($query as $condominio) {
            $condominios[$condominio->id] = $condominio->name;
        }

        return $condominios;
    } 

    public function condominios_id() {
        
        $query = TableRegistry::get('condominios')->find();
        $condominios = array();
        if($this->request->session()->read()['Auth']['User']['role'] != 'superUser'){
            $query->select([
                'condominios.id',
                'condominios.name',
                'parcelas.id',
                'parcelas.condominios_id',
                'parcelas.condominos_id',
                'condominos.id',
                'condominos.nome',
                'condominos.email'
            ]); 
            $query->rightjoin('parcelas', 'parcelas.condominios_id = condominios.id');
            $query->rightjoin('condominos', 'condominos.id = parcelas.condominos_id');
            $query->WHERE(['condominos.email' => $this->request->session()->read()['Auth']['User']['username']]);
            $query->GROUP('condominios.id');    
        }
        foreach ($query as $key => $value) {
            array_push($condominios, $value->id);
        }
        return $condominios;
    } 

    public function selectCondominios2(){
        $query = Tableregistry::get('condominios')->find();
        $condominios = array(['' => "Selecione"]);
        foreach($query as $condominio){
            $condominios[$condominio->id] = $condominio->name;
        }
        return $condominios;
    }

    //$condominios_id = array(1 => 'ONE', 2=>'TWO',3=> 'THREE');
    public function checkbox() {
        
        $query = TableRegistry::get('condominios')->find();
        $condominios = array();
        foreach ($query as $condominio) {
        	$condominios[$condominio->id] = $condominio->name;
        }
        return $condominios;
    } 


     //$condominios_id = array(1 => 'ONE', 2=>'TWO',3=> 'THREE');
    public function checkboxUser() {
        
        $query = TableRegistry::get('condominios')->find();
        $query->leftjoin('parcelas', ['condominios.id = parcelas.condominios_id']);
        $query->leftjoin('condominos', ['parcelas.condominos_id = condominos.id ']);
        $query->where(['condominos.email' => $this->request->session()->read()['Auth']['User']['username']]);
        $condominios = array();
        foreach ($query as $condominio) {
            $condominios[$condominio->id] = $condominio->name;
        }
        return $condominios;
    } 

    public function buscarCondominio($plano_contas_id = null){

        $condominio = array();
        $query = TableRegistry::get('condominios')->find();
        if($plano_contas_id){
            $query->where(['plano_contas_id'=>$plano_contas_id]);    
        }

        foreach ($query as $value) {
            $condominio = $value;
        }
        return $condominio;
    }

}

?>