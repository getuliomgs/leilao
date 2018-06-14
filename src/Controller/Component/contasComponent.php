<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class contasComponent extends Component
{

	public $components = array('condominios');


	public function contasCondominio($condominios_id, $caseId = false){

		$return = array();
		$query = TableRegistry::get('contas')->find()
			->where(['condominios_id' => $condominios_id])
		;
		if($caseId){
			foreach ($query as $conta) {
				$return[] = $conta->id;
			}	
		}else{
			foreach ($query as $conta) {
				$return[] = $conta;
			}	
		}
		
			return $return;
	}

	public function conta($contas_id = null){

		$r = "";
		
		$query = TableRegistry::get('contas')->find()
			->where(['id' => $contas_id])
		;

		foreach ($query as $conta) {
			$r = $conta;
		}
		return $r;
	}

	/**
     * formSelectAjax method
     *
     * @param int|null $id contas id.
     * @param int|null $condominios_id condominios id
     * @return combo select para resposta de ajax
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function formSelectAjax($id = null, $condominios_id) {

		$query = TableRegistry::get('contas')->find()
			->select(['contas.id','contas.nome','contas.condominios_id','condominios.id','condominios.name'])
			->leftjoin('condominios', ['contas.condominios_id'=>'condominios.id'])
			->where(['contas.condominios_id' => $condominios_id]);
        $formSelect = '
        	<div class="input select">
    			<label for="contas-id">Contas</label>
				<select name="contas_id" id="contas-id">
        			<option value="0">Selecione</option>';
			        foreach ($query as $conta) {
			        	if($conta->id == $id) {
			        		$selected = "selected";
			        	}else{
			        		$selected = "";
			        	}
			            $formSelect .= '<option value="'.$conta->id.'"'.$selected.'>'.$conta->nome.' - '.$conta['condominios']['name'].'</option>';
			        }
        $formSelect .= 
        		'</select>
    		</div>';
    	return $formSelect;
	}

}