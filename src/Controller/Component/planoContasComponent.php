<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class planoContasComponent extends Component
{

	public $components = array( 'aReceberContas', 'aPagarContas', 'extratos');

    public function selectPlanoContas($condominios_id = null) {

    	        
        $query = TableRegistry::get('planoContas')->find()
 			->order(['cod_eap' => 'ASC']);
        ;

        if($condominios_id){
        	$query->where(["condominios_id" => $condominios_id]);
        }
        $planoContas = array();
        $planoContas[null] = "Selecione";
        foreach ($query as $planoConta)
            $planoContas[$planoConta->id] = $planoConta->cod_eap." - ".$planoConta->nome;

        return $planoContas;
    }

	public function idFilhos($id) {

		$query = TableRegistry::get('planoContas')->find()
		->where(['plano_contas_id' => $id ]);

		$filhos = array();

		$filhos[] = $id;

		foreach ($query as $key => $value) {
			

			$filhos[] = $value->id;

			foreach($this->idFilhos($value->id) as $v){
				$filhos[] = $v;

			}
		}
		return array_unique($filhos);
	}

	public function valorCodEap($idFilhos, $periodo_ini, $periodo_fim){

		$valorCodEapExtrato = $this->extratos->valorCodEap($idFilhos, $periodo_ini, $periodo_fim);
		$valorCodEapAPagarContas = $this->aPagarContas->valorCodEap($idFilhos, $periodo_ini, $periodo_fim);
		$valorCodEap = (float)bcadd($valorCodEapExtrato, $valorCodEapAPagarContas, 2);
		$valorCodEapAReceberContas = $this->aReceberContas->valorCodEap($idFilhos, $periodo_ini, $periodo_fim);
		$valorCodEap = (float)bcadd($valorCodEap, $valorCodEapAReceberContas, 2);

		return (float)$valorCodEap;
	}

	/**
     * selectAjax method
     *
     * @param int|null $id planoConts id.
     * @param int|null $condominios_id condominios id
     * @return combo select para resposta de ajax
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function formSelectAjax($id = null, $condominios_id) {

		$query = TableRegistry::get('planoContas')->find()
 		->order(['cod_eap' => 'ASC']);
        $query->where(['condominios_id' => $condominios_id]);
        $formSelect = '
        	<div class="input select">
    			<label for="plano-contas-id">Plano de Contas</label>
				<select name="plano_contas_id" id="plano-contas-id">
        			<option value="0">Selecione</option>';
			        foreach ($query as $planoConta) {
			        	if($planoConta->id == $id) {
			        		$selected = "selected";
			        	}else{
			        		$selected = "";
			        	}
			            $formSelect .= '<option data-tipo="'.$planoConta->tipo.'" value="'.$planoConta->id.'"'.$selected.'>'.$planoConta->cod_eap.' - '.$planoConta->nome.'</option>';
			        }
        $formSelect .= 
        		'</select>
    		</div>';
    	return $formSelect;
	}


    public function condominio_id($id){
        $query = TableRegistry::get('planoContas')->find();
        $query->where(['id'=>$id]);
        foreach($query as $planoConta){
            return $planoConta->condominios_id;
        }
    }

    public function buscarPlanoConta($plano_contas_id = null){
    	
    	$plano_conta = array();
    	$query = TableRegistry::get('planoContas')->find();

    	if($plano_contas_id){
    		$query->where(['id'=>$plano_contas_id]);
    	}
        
    	foreach ($query as $plano_conta) {
    		$plano_conta = $plano_conta;
    	}
    	return $plano_conta;
    }
}

?>
