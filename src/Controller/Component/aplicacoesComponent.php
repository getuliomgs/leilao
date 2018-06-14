<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class aplicacoesComponent extends Component
{

	public $components = array('extratos', 'contas');


	public function findAplicacoes($condominios_id) {

        $extratos_id = $this->extratos->arrayExtratos2($condominios_id);

		return $extratos_id;
	}

	private function querySaldoAplicacoes($contas_id, $ultimo=true) {
		$query = TableRegistry::get('aplicacoes')->find()
			->select([
				'aplicacoes.id',
				'aplicacoes.contas_id',
				'aplicacoes.extratos_id',
				'aplicacoes.saldo',
				'aplicacoes.created',
				'aplicacoes.modified',
				'extratos.id',
				'extratos.contas_id',
				'extratos.plano_contas_id',
				'extratos.date_movimentacao',
				'extratos.nr_doc',
				'extratos.historico',
				'extratos.valor',
				'extratos.saldo',
				'extratos.deb_cred',
				'extratos.descricao',
				'extratos.created',
				'extratos.modified',
				'extratos.conciliado'
			])
	        ->leftJoin('extratos', ['aplicacoes.extratos_id = extratos.id'])
	        ->where( ["extratos.contas_id = ".$contas_id."
	        		OR
	        			aplicacoes.contas_id = ".$contas_id]);
	        

	        if($ultimo){
	        	$query->order(['aplicacoes.id' => 'DESC']);
				$query->LIMIT(1); 
	        }else {
	       		$query->order(['aplicacoes.id DESC LIMIT 1,1']);
	        }
	    return $query;
	}
	
	public function saldoAplicacoes($condominios_id, $ultimo=true) {

		$return = (float)0;
		$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;
		$query = $this->querySaldoAplicacoes($contas_id,$ultimo);
		foreach ($query as $key => $value) {
			$return = $value->saldo;
		}
		
		return $return;
	}

	public function ultimaMovimentacao($condominios_id) {

		$return = (float)0;
		$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;
		$query = $query = TableRegistry::get('aplicacoes')->find()
	        ->leftJoin('extratos', ['aplicacoes.extratos_id = extratos.id'])
	        ->where( ["extratos.contas_id = ".$contas_id."
	        		OR
	        			aplicacoes.contas_id = ".$contas_id]);
		foreach ($query as $key => $value) {
			$return = $value;
		}
		
		return $return;
	}

	private function querySumPeriodo($contas_id, $periodo_ini, $periodo_fim) {
		
		$query = TableRegistry::get('aplicacoes')->find();
		$query->select([
            'valor' =>  $query->func()->sum('if(e.valor < 0, -1*e.valor, 0)')
        ])
        ->from(['aplicacoes' => 'aplicacoes'] )
        ->leftjoin('contas', 'aplicacoes.contas_id = contas.id')
        ->leftjoin('condominios', 'contas.condominios_id = condominios.id')
        ->leftjoin(['e' => 'extratos'], 'aplicacoes.extratos_id = e.id')
        ->leftjoin(['contas2' => 'contas'], 'e.contas_id = contas2.id')
        ->leftjoin(['condominios2' => 'condominios'], 'contas2.id = condominios2.id')
        ->leftjoin('plano_contas', 'aplicacoes.plano_contas_id = plano_contas.id')
        ->leftjoin(['plano_contas2' => 'plano_contas'], 'e.plano_contas_id = plano_contas2.id')
        ->where( ['e.contas_id' => $contas_id, 
	        	"e.date_movimentacao BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')
	        	OR 
	        	aplicacoes.date BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')
	        "]);
	    return $query;
	}

	private function querySaldoPeriodo($contas_id, $periodo_fim) {

		$query = TableRegistry::get('aplicacoes')->find();
        $query->select([
                'valor' => 'aplicacoes.saldo'
            ])
	        ->leftJoin('extratos', ['aplicacoes.extratos_id = extratos.id'])
	        ->where( ["(extratos.contas_id = ".$contas_id."
	        	OR aplicacoes.contas_id = ".$contas_id.")", 
	        	"(extratos.date_movimentacao  < '".$periodo_fim."'
	        	OR
	        	aplicacoes.date  < '".$periodo_fim."')
	        	"
	        ])
	        ->order( ['aplicacoes.id' => 'DESC'])
	        ->LIMIT(1)
    	;	
	    return $query;
	}

	public function rendimentoAplicadoPeriodo($condominios_id, $periodo_ini, $periodo_fim) {

		$return = (float)0;
		$query = null;
		$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;
		$query = TableRegistry::get('aplicacoes')->find();
		$query->select([
            'valor' =>  $query->func()->sum('aplicacoes.valor')
        ])
        ->from(['aplicacoes' => 'aplicacoes'] )
        ->where( ['aplicacoes.contas_id' => $contas_id, 
	        	"aplicacoes.date BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')
	        "]);
        foreach ($query as $key => $value) {
			$return = $value->valor; 
		}
	    return $return;
	}

	/**
	 * @Return soma do valor de um periodo
	 **/
	public function aplicadoPeriodo($condominios_id, $periodo_ini = null, $periodo_fim = null) {

		$return = (float)0;
		$query = null;
		$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;

		if(empty($periodo_ini) AND isset($periodo_fim)) {
			$query = $this->querySaldoPeriodo($contas_id, $periodo_fim);	
		}

		if(isset($periodo_ini) AND isset($periodo_fim)){
			$query = $this->querySumPeriodo($contas_id, $periodo_ini, $periodo_fim);	
		}
		foreach ($query as $key => $value) {
			$return = $value->valor; 
		}
		return $return;
	}

	/**
	 *	seleciona todas aplicações de uma conta com data de movimentação maior ou igual $date_movimentação
	 * @param int| $contas_id
	 * @param Cake\I18n\FrozenTime $date_movimentacao
	 *  @return query
	 **/
	private function query2($contas_id, $date_movimentacao) {


		$query = TableRegistry::get('aplicacoes')->find()
			->select([
				'aplicacoes.id',
				'aplicacoes.contas_id',
				'extratos.contas_id',
				'aplicacoes.date',
				'extratos.date_movimentacao'
			])
	        ->leftJoin('extratos', ['aplicacoes.extratos_id = extratos.id'])
	        ->where( ['(extratos.contas_id = '.$contas_id."
	        	OR aplicacoes.contas_id = ".$contas_id.')', 
	        	"(extratos.date_movimentacao  >= '".$date_movimentacao->format("Y-m-d")."'
	        	OR
	        	aplicacoes.date  >= '".$date_movimentacao->format("Y-m-d")."')
	        	"
	        ])
    	;	
	    return $query;
	}

	/**
     * editExtrato_id method
     * retira id do extrao
     * @param contas_id|null $contas_id Contas id.
     * @param date_movimentacao | Cake\I18n\FrozenTime $date_movimentacao aplicacoes date_movimentacoes.
     * @return void
     * @throws 
     */
	public function editExtrato_id($contas_id, $date_movimentacao) {

		$aplicacoesTable = TableRegistry::get('aplicacoes');
		$query = $this->query2($contas_id, $date_movimentacao);
		$arrayid = array();
		foreach ($query as $aplicaco) {
			if ($aplicacoesTable->delete($aplicaco)) {
	        } else {
	            $this->Flash->error(__('Erro na exlusão de algumas aplicacões!'));
	        }
		}
	}

	/**
     * contas_id method
     * resgata id da aplicacao
     * @param aplicacoes_id|null $aplicacoes_id Contas id.
     * @return conta_id
     * @throws 
     */
	public function contas_id($id) {

		$aplicacoesTable = TableRegistry::get('aplicacoes');
		/*
		SELECT
		  aplicacoes.id,
		  extratos.id,
		  aplicacoes.contas_id,
		  extratos.contas_id,
		  if(aplicacoes.contas_id IS NULL , extratos.contas_id , aplicacoes.contas_id)
		FROM
		  `aplicacoes`
		LEFT JOIN
		  extratos ON aplicacoes.extratos_id = extratos.id
		WHERE
		  aplicacoes.id = 22
		  */
		$query =  TableRegistry::get('aplicacoes')->find();
		$query->select([
			'aplicacoes.id',
			'contas_id' => 'if(aplicacoes.contas_id IS NULL , extratos.contas_id , aplicacoes.contas_id)'
			]);
		$query->from(["aplicacoes" => "aplicacoes"]);
		$query->leftjoin("extratos", "aplicacoes.extratos_id = extratos.id");
		$query->where(["aplicacoes.id" => $id]);
		foreach ($query as $aplicaco) {
			$result = $aplicaco->contas_id;
		}
		return $result;
	}
}// fim class

?>