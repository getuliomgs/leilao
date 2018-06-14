<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use App\Controller\Aplicacoes;

class extratosComponent extends Component {

	public $components = array('contas', 'aplicacoes','aPagarContas', 'aReceberContas');


    public function arrayExtratos2($condominios_id){

        $return = array();
        $contas_id = $this->contas->contasCondominio($condominios_id);

        $query = TableRegistry::get('extratos')->find()
        ->rightJoin('aplicacoes', ['extratos.id = aplicacoes.extratos_id'])
            ->where( ['extratos.contas_id' => $contas_id[0]->id ]);
      
        foreach ($query as $key => $value) {
            $return[$value->id] = $value->id;
        }

        return $return;
    }

	//seleciona extrato não conciliado
	public function selectExtratos($contas_id = false, $extratos_id = false, $condominios_id = false ){

		if($condominios_id){
			$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;	
		}


		$extratos[""] = "Selecione";

		if($extratos_id){

			$query = TableRegistry::get('extratos')->find()->where(['id = ' => $extratos_id]);

			foreach ($query as $extrato)
	        	$extratos[$extrato->id] = $extrato->date_movimentacao->format("d/m/Y")." - ".$extrato->historico." - R$: ".number_format($extrato->valor, 2, ",",".");
		}
	    
		$query = TableRegistry::get('extratos')->find()
	        ->leftJoin('a_pagar_contas', ['extratos.id = a_pagar_contas.extratos_id'])
	        ->leftJoin('a_receber_contas', ['extratos.id = a_receber_contas.extratos_id'])
	        ->where( ['a_pagar_contas.extratos_id IS NULL',  'a_receber_contas.extratos_id IS NULL'])  
	        ->where( ['contas_id' => $contas_id ,  
            "(
                extratos.conciliado = 0 AND a_pagar_contas.extratos_id is NULL AND a_receber_contas.extratos_id is NULL
            )"
    	]);        
	
	    
	    foreach ($query as $extrato)
	        $extratos[$extrato->id] = $extrato->date_movimentacao->format("d/m/Y")." - ".$extrato->historico." - R$: ".number_format($extrato->valor, 2, ",",".");

	    

	    return $extratos;
	}

    public function extratosPlanoContasAPagarContasAReceberContas($condominios_id) {

    	$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;
    	//$date_movimentacao = $this->minDataMovimentacao();
    
	    // seleciona extratos
	    $query = TableRegistry::get('extratos')->find()
	        ->select([
	            'extratos.id',
	            'extratos.contas_id',
	             'extratos.historico',
	             'extratos.descricao',
	             'plano_contas.cod_eap',
	             'plano_contas.nome',
	             'extratos.date_movimentacao',
	             'extratos.valor'
	        ])
	        ->leftJoin('plano_contas', 'extratos.plano_contas_id = plano_contas.id ')
	        ->leftJoin('a_pagar_contas', 'extratos.id = a_pagar_contas.extratos_id ')
	        ->leftJoin('a_receber_contas', 'extratos.id = a_receber_contas.extratos_id ')
	        ->where(['a_pagar_contas.extratos_id is null'])
	        ->where( ['extratos.contas_id' => $contas_id ])
	        ->andwhere([' a_receber_contas.extratos_id is null'])
	        ->andwhere([' extratos.conciliado = 0'])
	     //  ->andwhere( ['extratos.date_movimentacao' => $date_movimentacao->format("Y/m/d")])
	    ;
	    
	    $extratos = array();
	    foreach ($query as $extrato) {
	        $extratosConciliacao[$extrato->id] = $extrato->date_movimentacao->format("d/m/Y")." - R$: ".number_format($extrato->valor, 2, ",",".")." - ".$extrato->historico;
	    }

	    return @$extratosConciliacao;
    }

    //menor data do extrato que não foi conciliada
    public function minDataMovimentacao($condominios_id){

    	$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;

    	$date_movimentacao = "";

    	$query = TableRegistry::get('extratos')->find();
        $query->select
            ([
                'date_movimentacao'  => $query->func()->min('extratos.date_movimentacao')
            ])
        ->leftJoin('a_pagar_contas', ['extratos.id = a_pagar_contas.extratos_id'])
        ->leftJoin('a_receber_contas', ['extratos.id = a_receber_contas.extratos_id'])
        ->where( ['a_pagar_contas.extratos_id IS NULL',  'a_receber_contas.extratos_id IS NULL']) 

        // -------------------------------------------------------------------------------------------------- 
        
        ->where( ['contas_id' => $contas_id ]);        
        foreach ($query as $value)
            $date_movimentacao = $value->date_movimentacao;

        return $date_movimentacao;
    }

    public function minDataMovimentacao2($condominios_id){

    	$contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;

    	$date_movimentacao = "";

    	$query = TableRegistry::get('extratos')->find();
        $query->select
        ([
        	'date_movimentacao'  => $query->func()->min('extratos.date_movimentacao')
        ])
        ->where( ['contas_id' => $contas_id]);        
        foreach ($query as $value)
            $date_movimentacao = $value->date_movimentacao;

        return $date_movimentacao;
    }

    public function descricao( $extrato){

    	if(empty($extrato->descricao)){
    		if(empty($extrato['a_receber_contas']['descricao'])){
				$descricao = $extrato['a_pagar_contas']['descricao'];
    		}else{
    			$descricao = $extrato['a_receber_contas']['descricao'];
    		}
    	}else{
    		$descricao = $extrato->descricao;
    	}

    	return $descricao;
    }
	
	public function date_referencia($extrato){

		if(empty($extrato['a_receber_contas']['date_referencia'])){
			if(empty($extrato['a_pagar_contas']['date_referencia'])){
				$date_referencia = $this->formatarData($extrato->date_movimentacao);
			}else{
				$date_referencia = $this->formatarData($extrato['a_pagar_contas']['date_referencia']);
			}
		}else{
			$date_referencia = $this->formatarData($extrato['a_receber_contas']['date_referencia']);
		}

		return $date_referencia;
	}

	public function date_pagamento_previsto($extrato){

		if(empty($extrato['a_receber_contas']['date_pagamento_previsto'])){
			if(empty($extrato['a_pagar_contas']['date_pagamento_previsto'])){
				$date_pagamento_previsto = "---";
			}else {
				$date_pagamento_previsto = $this->formatarData($extrato['a_pagar_contas']['date_pagamento_previsto']);
			}
		}else{
			$date_pagamento_previsto = $this->formatarData($extrato['a_receber_contas']['date_pagamento_previsto']);
		}
		return $date_pagamento_previsto;
	}

	public function date_pagamento($extrato){

		if(empty($extrato['a_receber_contas']['date_pagamento_real'])){
			if(empty($extrato['a_pagar_contas']['date_pagamento_real'])){
				$date_pagamento = $this->formatarData($extrato->date_movimentacao);
			}else{
				$date_pagamento = $this->formatarData($extrato['a_pagar_contas']['date_pagamento_real']);
			}
		}else{
			$date_pagamento = $this->formatarData($extrato['a_receber_contas']['date_pagamento_real']);
		}
		return $date_pagamento;
	}

	public function valor_previsto($extrato){

		if(empty($extrato['a_receber_contas']['valor'])){
			if(empty($extrato['a_pagar_contas']['valor'])){
				$valor_previsto = (float)0;
			}else{
				$valor_previsto = $extrato['a_pagar_contas']['valor'];
			}
		}else{
			$valor_previsto = $extrato['a_receber_contas']['valor'];
		}
		return $valor_previsto;
	}

	public function valor_pagamento($extrato = null){
        
		if(is_null($extrato['a_receber_contas']['valor'])){
			if(is_null($extrato['a_pagar_contas']['valor'])){
				$valor_pagamento = $extrato->valor;
			}else{
				$valor_pagamento = $extrato['a_pagar_contas']['valor'];
			}
		}else{
			$valor_pagamento = $extrato['a_receber_contas']['valor'];
		}
		return (float)$valor_pagamento;
	}

	public function plano_contas_cod_eap($extrato){

		if(empty($extrato['a_r_c_plano_contas']['cod_eap'])){
			if(empty($extrato['a_p_c_plano_contas']['cod_eap'])){
				$plano_contas_cod_eap = $extrato['plano_contas']['cod_eap'];
			}else{
				$plano_contas_cod_eap = $extrato['a_p_c_plano_contas']['cod_eap'];
			}
		}else{
			$plano_contas_cod_eap = $extrato['a_r_c_plano_contas']['cod_eap'];
		}
		return $plano_contas_cod_eap;
	}

	public function plano_contas_nome($extrato){

		if(empty($extrato['a_r_c_plano_contas']['nome'])){
			if(empty($extrato['a_p_c_plano_contas']['nome'])){
				$plano_contas_nome = $extrato['plano_contas']['nome'];
			}else{
				$plano_contas_nome = $extrato['a_p_c_plano_contas']['nome'];
			}
		}else{
			$plano_contas_nome = $extrato['a_r_c_plano_contas']['nome'];
		}
		return $plano_contas_nome;
	}

	public function doc_referencia($extrato){

		if(empty($extrato['a_receber_contas']['doc_referencia'])){
			$doc_referencia = $extrato['a_pagar_contas']['doc_referencia'];
		}else{
			$doc_referencia = $extrato['a_receber_contas']['doc_referencia'];
		}
		return $doc_referencia;
	}

	public function formatarData($data){

		if(is_object($data)){
          
       	}else{
            $data = new FrozenTime($data);
       	}
       	return $data;
	}

	public function queryRelatorioCaixa($condominios_id){

		$contas = $this->contas->contasCondominio($condominios_id);

    	$extratos = TableRegistry::get('extratos')->find()
          ->select([
                'extratos.id',
                'extratos.contas_id',
                'a_pagar_contas.extratos_id',
                'a_receber_contas.extratos_id',
                'extratos.descricao',
                'a_receber_contas.descricao',
                'a_pagar_contas.descricao',
                'a_receber_contas.date_referencia',
                'a_pagar_contas.date_referencia',
                'a_receber_contas.date_pagamento_previsto',
                'a_pagar_contas.date_pagamento_previsto',
                'extratos.date_movimentacao',
                'a_receber_contas.date_pagamento_real',
                'a_pagar_contas.date_pagamento_real',
                'extratos.valor',
                'a_receber_contas.valor',
                'a_pagar_contas.valor',
                'extratos.saldo',
                'extratos.plano_contas_id',
                'a_receber_contas.plano_contas_id',
                'a_pagar_contas.plano_contas_id',
                'extratos.plano_contas_id',
                'plano_contas.cod_eap',
                'plano_contas.nome',
                'a_r_c_plano_contas.cod_eap',
                'a_r_c_plano_contas.nome',
                'a_p_c_plano_contas.cod_eap',
                'a_p_c_plano_contas.nome',
                'a_receber_contas.doc_referencia',
                'a_pagar_contas.doc_referencia'
            ])
            ->leftJoin('a_receber_contas', 'extratos.id = a_receber_contas.extratos_id ')
            ->leftJoin('a_pagar_contas', 'extratos.id = a_pagar_contas.extratos_id ')
            ->leftJoin('plano_contas', 'extratos.plano_contas_id = plano_contas.id ')
            ->leftJoin( ['a_r_c_plano_contas' => 'plano_contas'] , 'a_receber_contas.plano_contas_id = a_r_c_plano_contas.id ')
            ->leftJoin( ['a_p_c_plano_contas' => 'plano_contas'] , 'a_pagar_contas.plano_contas_id = a_p_c_plano_contas.id ')
            ->where(["extratos.contas_id" => $contas[0]->id])
            ->where
                ([
                    "(a_pagar_contas.extratos_id is null AND a_receber_contas.extratos_id is null ) 
                    AND
                    (
                        ( extratos.conciliado <> 0 AND extratos.plano_contas_id IS NOT NULL )
                        OR
                          ( extratos.id = a_pagar_contas.extratos_id)
                        OR
                          ( extratos.id = a_receber_contas.extratos_id)
                    )"
                ])
            ->order(['extratos.date_movimentacao' => 'ASC', 'a_receber_contas.extratos_id' => 'ASC', 'a_pagar_contas.extratos_id' => 'ASC']);
        ;
        return $extratos;
    }

	public function arrayExtratos($condominio = 1){

 		$extratos = $this->queryArrayExtratos($condominio);
        
        $movimentacoes = array();

        foreach ($extratos as $extrato) {

            $movimentacoes[] = array(

                'descricao' => $extrato->descricao,
                'data_referencia' => $extrato->date_movimentacao,
                'data_pagamento_previsto' => $extrato->date_movimentacao,
                'data_pagamento' => $extrato->date_movimentacao,
                'valor_previsto' => $extrato->valor,
                'valor_pagamento' => $extrato->valor,
                'plano_contas_cod_eap' => $extrato->plano_contas['cod_eap'],
                'plano_contas_nome' => $extrato->plano_contas['nome']
            );
        }
        return  $movimentacoes;
    }

    public function queryArrayExtratos($condominio = 1){

        $contas = $this->contas->contasCondominio($condominio);

        $extratos = TableRegistry::get('extratos')->find()
          ->select([
                'extratos.id',
                'extratos.contas_id',
                'extratos.descricao',
                'extratos.date_movimentacao',
                'extratos.valor',
                'extratos.saldo',
                'extratos.plano_contas_id',
                'plano_contas.cod_eap',
                'plano_contas.nome'
            ])
            ->leftJoin('plano_contas', 'extratos.plano_contas_id = plano_contas.id ')
            ->where(["extratos.contas_id" => $contas[0]->id])
            ->where
                ([
                    "
                    (
                        ( extratos.conciliado <> 0 AND extratos.plano_contas_id IS NOT NULL )
                    )"
                ])
        ;
        return $extratos;   
    }

    /**
     * queryRelatorioBalanceteAnalitico method
     *
     * @return query
     */
    public function relatorioBalanceteAnalitico($condominios_id, $periodo_ini, $periodo_fim){

        $relatorioBalanceteAnalitico = array();        
        $contas = $this->contas->contasCondominio($condominios_id);

        $query = TableRegistry::get('extratos')->find()
        ->select([
            'extratos.id',
            'extratos.contas_id',
            'extratos.descricao',
            'extratos.date_movimentacao',
            'extratos.valor',
            'extratos.saldo',
            'extratos.plano_contas_id',
            'plano_contas.id',
            'plano_contas.cod_eap',
            'plano_contas.nome'
        ])
        ->leftJoin('plano_contas', 'extratos.plano_contas_id = plano_contas.id')
        ->where([
            'contas_id' => $contas[0]->id,
            "extratos.date_movimentacao BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')",
            'conciliado' => 1
        ]);
        foreach ($query as $key => $e) {
            $relatorioBalanceteAnalitico['cod_eap'][] = $e['plano_contas']['cod_eap'];
            $relatorioBalanceteAnalitico['movimentacoes'][] = array(
                'id' => $e->id,
                'credor' => "",
                'descricao' => $e->descricao,
                'data_referencia' => $e->date_movimentacao,
                'data_pagamento' => $e->date_movimentacao->format("d/m/y"),
                'valor_pagamento' => $e->valor,
                'cod_eap' => $e['plano_contas']['cod_eap'],
                'nome_eap' => $e['plano_contas']['nome'],
                'doc_referencia' => "",
            );   
        }
        return $relatorioBalanceteAnalitico;   
    }

    /**
     * queryRelatorioBalanceteAnalitico method
     *
     * @return query
     */
    public function queryRelatorioConciliacao($condominios_id, $periodo_ini, $periodo_fim){

        $contas_id = $this->contas->contasCondominio($condominios_id, true)[0];

        $queryRelatorioConciliacao = TableRegistry::get('extratos')->find()
        ->select([
            'extratos.id',
            'extratos.contas_id',
            'a_pagar_contas.extratos_id',
            'a_receber_contas.extratos_id',
            'extratos.descricao',
            'extratos.historico',
            'extratos.nr_doc',
            'a_receber_contas.descricao',
            'a_pagar_contas.descricao',
            'a_receber_contas.date_referencia',
            'a_pagar_contas.date_referencia',
            'a_receber_contas.date_pagamento_previsto',
            'a_pagar_contas.date_pagamento_previsto',
            'extratos.date_movimentacao',
            'a_receber_contas.date_pagamento_real',
            'a_pagar_contas.date_pagamento_real',
            'extratos.valor',
            'a_receber_contas.valor',
            'a_pagar_contas.valor',
            'extratos.saldo',
            'extratos.plano_contas_id',
            'a_receber_contas.plano_contas_id',
            'a_pagar_contas.plano_contas_id',
            'plano_contas.cod_eap',
            'plano_contas.nome',
            'a_r_c_plano_contas.cod_eap',
            'a_r_c_plano_contas.nome',
            'a_p_c_plano_contas.cod_eap',
            'a_p_c_plano_contas.nome',
            'a_receber_contas.doc_referencia',
            'a_pagar_contas.doc_referencia',
            'parcelas.id',
            'parcelas.nome',
            'condominos.id',
            'condominos.nome',
            'fornecedores.id',
            'fornecedores.nome'
        ])
        ->leftJoin('a_receber_contas', 'extratos.id = a_receber_contas.extratos_id ')
        ->leftJoin('parcelas', 'a_receber_contas.parcelas_id = parcelas.id ')
        ->leftJoin('condominos', 'parcelas.condominos_id = condominos.id ')
        ->leftJoin('a_pagar_contas', 'extratos.id = a_pagar_contas.extratos_id ')
        ->leftJoin('fornecedores', 'a_pagar_contas.fornecedores_id = fornecedores.id')
        ->leftJoin('plano_contas', 'extratos.plano_contas_id = plano_contas.id ')
        ->leftJoin( ['a_r_c_plano_contas' => 'plano_contas'] , 'a_receber_contas.plano_contas_id = a_r_c_plano_contas.id ')
        ->leftJoin( ['a_p_c_plano_contas' => 'plano_contas'] , 'a_pagar_contas.plano_contas_id = a_p_c_plano_contas.id ')
        ->where
            ([
                " (extratos.contas_id = ".$contas_id." AND extratos.date_movimentacao BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')
                    AND
                      (
                        ( extratos.plano_contas_id IS NOT NULL AND extratos.conciliado = 1)
                        OR
                        (
                            ( extratos.id = a_pagar_contas.extratos_id)
                          OR
                            ( extratos.id = a_receber_contas.extratos_id)
                        )
                      ))"
            ])           
        ;

        return $queryRelatorioConciliacao;   
    }

    /**
     *  method
     * somatório das movimentações conciliadas (para caixa) e com plano de contas, exceto as que tem date_pagamento (a_pagar_contas e a_receber_contas)
     * @return 1 objeto extrato
     */
    public function saldoAnterior($date, $contas_id) {

        $return = TableRegistry::get('extratos')->newEntity(['valor'=>0]);
        $query = TableRegistry::get('extratos')->find();
        $query->select
            ([
                'valor' => $query->func()->sum('valor')
            ])
        ->where
            ([
                "extratos.conciliado = 1",
                "extratos.plano_contas_id IS NOT NULL",
                "extratos.date_movimentacao < '".$date."'"
            ])       
        ;
        $query->where(['extratos.contas_id' => $contas_id]);
        foreach ($query as $value) {
            $return = $value;
        }
        return $return;
    }

    /**
     *
     *retorna valor das movimentações do extrato que estão entre periodo e estão enviadas para caixa com os campos (plano_contas_id, descrição e conciliacao) preenchidos
     **/
    public function valorCodEap($idFilhos, $periodo_ini, $periodo_fim){

        $valorCodEapExtrato = (float)0;
        $idFilhos = implode(",",$idFilhos);

        $query = TableRegistry::get('extratos')->find();
         $query->select
            ([
                'valor'  => $query->func()->sum('extratos.valor')
            ])
        ->where
            ([
                "   plano_contas_id IN(".$idFilhos.") 
                AND
                    extratos.date_movimentacao BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')
                AND
                    extratos.conciliado = 1
                "
            ])       
        ;
        foreach ($query as $key => $value) {
            $valorCodEapExtrato = (float)$value->valor;
        }

        return $valorCodEapExtrato;
    }


    /**
     *
     * editar aplicacão com $id do extrato que vai ser excluido
     * @param int|  $contas_id Extratos contas_id
     * @return void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editRelacionamentos($id, $contas_id, $date_movimentacao) {
        
        //excluir todas aplicacoes posteriores da data de movimentação do extrato.
        $aplicacoes = $this->aplicacoes->editExtrato_id($contas_id, $date_movimentacao);
        //tira relacionametno de contas a receber
        $aReceberContas = $this->aReceberContas->editExtrato_id($id);
        //tira relacionamento de contas a pargar
        $aPagarContas = $this->aPagarContas->editExtrato_id($id);
    }

    /**
     * retonar ultima movimenação da conta no extrato
     * @param $contas_id extratos contas_id
     * @return objeto extrato
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     **/
    public function ultimaMovimentacao($contas_id) {

        $return = null;
        $query = TableRegistry::get('extratos')->find();
        $query->where([
            "extratos.contas_id" => $contas_id
        ]);
        $query->order(["extratos.id" => "DESC"]);
        $query->LIMIT(1);
        foreach ($query as $extrato) {
            $return = $extrato;
        }
        return $return;
    }

    /**
     * selectAjax method
     *
     * @param int|null $id extratos id.
     * @param int|null $condominios_id condominios id
     * @return combo select para resposta de ajax
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function formSelectAjax($id = null, $condominios_id, $extratos_id = null) {

        if($condominios_id){
            $contas_id = $this->contas->contasCondominio($condominios_id)[0]->id;   
        }


        $formSelect = '
            <div class="input select">
                <label for="extratos-id">Extratos</label>
                <select name="extratos_id" id="extratos-id">
                    <option value=null >Selecione</option>';

        if($extratos_id){

            $query = TableRegistry::get('extratos')->find()->where(['id = ' => $extratos_id]);

            foreach ($query as $extrato)
                $formSelect .= '<option value="'.$extrato->id.'" selected>'.$extrato->date_movimentacao->format("d/m/Y")." - ".$extrato->historico." - R$: ".number_format($extrato->valor, 2, ",",".").'</option>';
        }
        
        $query = TableRegistry::get('extratos')->find()
            ->leftJoin('a_pagar_contas', ['extratos.id = a_pagar_contas.extratos_id'])
            ->leftJoin('a_receber_contas', ['extratos.id = a_receber_contas.extratos_id'])
            ->where( ['a_pagar_contas.extratos_id IS NULL',  'a_receber_contas.extratos_id IS NULL'])  
            ->where( ['contas_id' => $contas_id ,  
            "(
                extratos.conciliado = 0   AND a_pagar_contas.extratos_id is NULL AND a_receber_contas.extratos_id is NULL
            )"
        ]);        
        foreach ($query as $extrato) {
           $formSelect .= '<option value="'.$extrato->id.'">'.$extrato->date_movimentacao->format("d/m/Y")." - ".$extrato->historico." - R$: ".number_format($extrato->valor, 2, ",",".").'</option>';
        }

        $formSelect .= 
                '</select>
            </div>';

        return $formSelect;
    }
}

?>
