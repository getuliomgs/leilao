<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\ORM\Table;

class aPagarContasComponent extends Component
{

     public $components = array('fornecedores', 'condominios');

	public function extencaoNome($nome)  {

	    $arquivo =  $nome;
	 
		$arquivo = substr($arquivo, -4);
		 
		if($arquivo[0] == '.'){
		      $arquivo = substr($arquivo, -3);
		}
		 
		return $arquivo;
    }

    // selecionando as contas pagar do condomínio
    public function selectAPagarContasFornecedor($condominios_id = null) {

        //$fornecedores_ids = implode("," , $this->fornecedores->idFornecedores($condominios_id));

        $query = TableRegistry::get('a_pagar_contas')->find()
        	->select([
        		'a_pagar_contas.id',
        		'a_pagar_contas.descricao',
        		'a_pagar_contas.date_pagamento_real',
        		'a_pagar_contas.valor',
        		'fornecedores.nome'
        	])
        	->leftjoin('fornecedores' , ['a_pagar_contas.fornecedores_id = fornecedores.id'])
            ->where(['a_pagar_contas.date_pagamento_real is not null'])
            ->where
            ([
                "((a_pagar_contas.extratos_id is null OR a_pagar_contas.extratos_id = 0) and a_pagar_contas.condominios_id = ".$condominios_id.")" 
            ])->order(["a_pagar_contas.date_pagamento_real" => "ASC"])
        ;
        
        $a_pagar_contas = array();
        foreach ($query as $a_pagar_conta) {

            $a_pagar_contas[$a_pagar_conta->id] = $this->is_objectData($a_pagar_conta->date_pagamento_real)." - R$: ".number_format($a_pagar_conta->valor, 2, ",",".")." - ".$a_pagar_conta['fornecedores']['nome']." - ".$a_pagar_conta->descricao;
        }

        return $a_pagar_contas;
    }

    public function is_objectData($data, $formato = "d/m/Y") {

        if(is_object($data)){
            $data = $data->format($formato);
        }else{
            $data = date_format(date_create($data), $formato);
        }
        return $data;
    }


    public function a_pagar_contas_date_pagamento_real_menor($condominios_id) {


        //$fornecedores_ids = implode("," , $this->fornecedores->idFornecedores($condominios_id));

        $a_pagar_contas_date_pagamento_real_menor = null;
          
        $query = TableRegistry::get('a_pagar_contas')->find();
        $query->select([
            'a_pagar_contas.id',
            'a_pagar_contas.extratos_id',
            'date_pagamento_real' => $query->func()->MIN('date_pagamento_real'),
            'fornecedores.id'
            ])
            ->leftjoin('fornecedores', ['a_pagar_contas.fornecedores_id = fornecedores.id'])
            ->where
                ([
                    "a_pagar_contas.condominios_id" => $condominios_id
                ]);
       
        $a_pagar_contas = array();
        foreach ($query as $a_pagar_conta) {
           $a_pagar_contas_date_pagamento_real_menor = $a_pagar_conta->date_pagamento_real;
        }
        return $a_pagar_contas_date_pagamento_real_menor;
    }


    public function queryRelatorioCaixa($condominios_id) {

        //$fornecedores_ids = implode("," , $this->fornecedores->idFornecedores($condominios_id));

        $a_pagar_contas_date_pagamento_real_menor = null;
          
        $query = TableRegistry::get('a_pagar_contas')->find();
        $query->select([
            'a_pagar_contas.id',
            'a_pagar_contas.fornecedores_id',
            'a_pagar_contas.plano_contas_id',
            'a_pagar_contas.extratos_id',
            'a_pagar_contas.descricao',
            'a_pagar_contas.tipo',
            'a_pagar_contas.valor',
            'a_pagar_contas.date_referencia',
            'a_pagar_contas.date_pagamento_previsto',
            'a_pagar_contas.date_pagamento_real',
            'a_pagar_contas.doc_referencia',
            'fornecedores.id',
            'fornecedores.nome',
            'plano_contas.id',
            'plano_contas.cod_eap',
            'plano_contas.nome',

            ])
            ->leftjoin('fornecedores', ['a_pagar_contas.fornecedores_id = fornecedores.id'])
            ->leftJoin('plano_contas', 'a_pagar_contas.plano_contas_id = plano_contas.id ')
            ->where(["a_pagar_contas.condominios_id" => $condominios_id ])
            ->where(["a_pagar_contas.date_pagamento_real is not null"]);
  
        return $query;
    }


    public function arrayAPagarContas($condominios_id = 1) {

        $APagarContas = $this->queryRelatorioCaixa($condominios_id);

        $movimentacoes = array();

        foreach ($APagarContas as $APagarConta) {
            

            $movimentacoes[] = array(

                'descricao' => $APagarConta->descricao." - ".$APagarConta['fornecedores']['nome'],
                'data_referencia' => $APagarConta->date_referencia,
                'data_pagamento_previsto' => $APagarConta->date_pagamento_previsto,
                'data_pagamento' => $APagarConta->date_pagamento_real,
                'valor_previsto' => 0,
                'valor_pagamento' => $APagarConta->valor,
                'plano_contas_cod_eap' => $APagarConta['plano_contas']['cod_eap'],
                'plano_contas_nome' => $APagarConta['plano_contas']['nome'],
                'doc_referencia' => $APagarConta->doc_referencia
            );
        }
        return  $movimentacoes;
    }

    /**
     * 
     **/
    public function saldoAnterior($date, $condominios_id) {

        //$fornecedores_id = implode("," , $this->fornecedores->idFornecedores($condominios_id));

        $return = (float)0;
        $query = TableRegistry::get('a_pagar_contas')->find();
        $query->select([
                'valor'  => $query->func()->sum('a_pagar_contas.valor')
            ])
        ->where
            ([
                "condominios_id" => $condominios_id,
                "date_pagamento_real < '".$date."'",
                "date_pagamento_real IS NOT NULL"
            ])           
        ;
        foreach ($query as $key => $value) {
            $return = $value->valor;
        }
        return $return;
    }

    /**
     * retorna o valor das contas a pagar do pacote de ids do plano de contas considerando periodo de data de pagamento
    **/
    public function valorCodEap($idFilhos, $periodo_ini, $periodo_fim) {
        $valorCodEap = (float)0;
        $idFilhos = implode(",",$idFilhos);

        $query = TableRegistry::get('a_pagar_contas')->find();
         $query->select
            ([
                'valor'  => $query->func()->sum('a_pagar_contas.valor')
            ])
        ->where
            ([
                "   a_pagar_contas.plano_contas_id IN(".$idFilhos.") 
                AND
                    a_pagar_contas.date_pagamento_real BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')
                "
            ])       
        ;

        foreach ($query as $key => $value) {
            $valorCodEap = (float)$value->valor;
        }

        return $valorCodEap;
    }

    /**
     * criar vetor de contas a receber de um periodo e condominios com data de pagamento
    **/
    public function relatorioBalanceteAnalitico($condominios_id, $periodo_ini, $periodo_fim){

        //$fornecedores_ids = implode("," , $this->fornecedores->idFornecedores($condominios_id));

        $relatorioBalanceteAnalitico = array(); 
        $relatorioBalanceteAnalitico['cod_eap'] = array();
        $relatorioBalanceteAnalitico['movimentacoes'] = array();

        $query = TableRegistry::get('a_pagar_contas')->find()
        ->select([
            'a_pagar_contas.id',
            'a_pagar_contas.fornecedores_id',
            'a_pagar_contas.plano_contas_id',
            'a_pagar_contas.descricao',
            'a_pagar_contas.valor',
            'a_pagar_contas.date_referencia',
            'a_pagar_contas.date_pagamento_real',
            'a_pagar_contas.doc_referencia',
            'plano_contas.id',
            'plano_contas.cod_eap',
            'plano_contas.nome',
            'fornecedores.id',
            'fornecedores.nome'
        ])
        ->leftJoin('plano_contas', 'a_pagar_contas.plano_contas_id = plano_contas.id')
        ->leftJoin('fornecedores', 'a_pagar_contas.fornecedores_id = fornecedores.id')
        ->where([
            'a_pagar_contas.condominios_id' => $condominios_id,
            "a_pagar_contas.date_pagamento_real BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')",
            'a_pagar_contas.date_pagamento_real IS NOT NULL'
        ]);
        foreach ($query as $key => $p) {
            $relatorioBalanceteAnalitico['cod_eap'][] = $p['plano_contas']['cod_eap'];
            $relatorioBalanceteAnalitico['movimentacoes'][] = array(
                'id' => $p->id,
                'credor' => $p['fornecedores']['nome'],
                'descricao' => $p->descricao,
                'data_referencia' => $p->date_referencia,
                'data_pagamento' => $p->date_pagamento_real->format("d/m/y"),
                'valor_pagamento' => $p->valor,
                'cod_eap' => $p['plano_contas']['cod_eap'],
                'nome_eap' => $p['plano_contas']['nome'],
                'doc_referencia' => $p->doc_referencia,
            );   
        }
        return $relatorioBalanceteAnalitico;   
    }

    /**
     * editar relacionamento
     * @return void
     **/
    public function editExtrato_id($id) {

        $modified = new FrozenTime();
        $aPagarContasTable = TableRegistry::get('aPagarContas');
        $query = $aPagarContasTable->find()->where(['extratos_id' => $id]);
        foreach ($query as $aPagarContaQuery) {         
            $aPagarConta = $aPagarContasTable->get($aPagarContaQuery->id);          
            $aPagarConta->modified = $modified;
            $aPagarConta->extratos_id = null;
            if ($aPagarContasTable->save($aPagarConta)) {
            } else {
                $this->Flash->error(__('Erro ao salvar relacionamento com contas a pagar!'));
            }
        }
    }

    public function formSelectAjax($id = null,$condominios_id = null, $plano_contas_id = null) {

        $query = array();
        //$fornecedores_ids = implode("," , $this->fornecedores->idFornecedores($condominios_id));
        if($id != 0 or $condominios_id != 0 or $plano_contas_id != 0){
            $query = TableRegistry::get('a_pagar_contas')->find()
                ->select([
                    'a_pagar_contas.id',
                    'a_pagar_contas.descricao',
                    'a_pagar_contas.plano_contas_id',
                    'a_pagar_contas.date_pagamento_previsto',
                    'a_pagar_contas.valor',
                    'fornecedores.nome',
                    'caixa.a_pagar_contas_id',
                ])
                ->leftjoin('fornecedores' , ['a_pagar_contas.fornecedores_id = fornecedores.id'])
                ->leftjoin('caixa', ['caixa.a_pagar_contas_id = a_pagar_contas.id'
                ]);
            $query->order(["a_pagar_contas.date_pagamento_previsto" => "DESC"]);

            if(!empty($plano_contas_id)){
                $query->where(['a_pagar_contas.plano_contas_id' => $plano_contas_id ]);
            }
            if(!empty($condominios_id)){
                $query->where([ 'a_pagar_contas.condominios_id' => $condominios_id]);
            }
            $query->where(['caixa.a_pagar_contas_id IS NULL']);
        }
        $a_pagar_conta = array();

        $formSelect = '
            <div class="input select">
                <label for="a-pagar-contas-id">A Pagar Contas</label>
                <select name="a_pagar_contas_id" id="a-pagar-contas-id">
                    <option value="0">Selecione</option>';
                    foreach ($query as $a_pagar_conta) {
                        if($a_pagar_conta->id == $id) {
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }

                        $valor = number_format($a_pagar_conta->valor, 2, ",",".");
                        $valor_data_v = $a_pagar_conta->valor;
                        $date_pagamento_previsto = $this->is_objectData($a_pagar_conta->date_pagamento_previsto);
                        $date_referencia = $this->is_objectData($a_pagar_conta->date_referencia, "m/Y"); 

                        $formSelect .= '<option data-pc"'.$a_pagar_conta->plano_contas_id.'"  data-dr="'.$date_referencia.'" data-v="'.$valor_data_v.'" data-d="'.$a_pagar_conta->descricao.'" value="'.$a_pagar_conta->id.'"'.$selected.'>'.$date_pagamento_previsto." - R$: ".$valor." - ".$a_pagar_conta['fornecedores']['nome']." - ".$a_pagar_conta->descricao.'</option>';
                    }
        $formSelect .= 
                '</select>
            </div>';
            
        return $formSelect;
    }

    /**
     *
     * retorna objeto do a pagar contas com condominio
    */
    public function buscar($a_pagar_contas_id = null){
        $a_pagar_conta = array();
        $query  = TableRegistry::get('a_pagar_contas')->find()
            ->select([
                'a_pagar_contas.id',
                'a_pagar_contas.plano_contas_id',
                'plano_contas.id',
                'plano_contas.nome',
                'condominios.id',
                'condominios.nome'
            ]);

        $query->leftjoin('plano_contas', ['a_pagar_contas.plano_contas_id = plano_contas.id']);
        $query->leftjoin('condominios', ['a_pagar_conta.condominios_id = condominios.id']);
        $query->where(['a_pagar_contas.id' => $a_pagar_contas_id]); 
        debug($query);
        exit;
        foreach ($query as $value) {
            $a_pagar_conta = $value;
        }
        return $a_pagar_conta;
    }

     /**
     *
     * retorna objeto do a pagar contas com condominio
    */
    public function entidade($id = null){
        
        $aPagarConta = TableRegistry::get('a_pagar_contas')->find()->where([ 'id' => $id]);

        foreach ($aPagarConta as $value) {
            return $value;
        }
        
        return $aPagarConta;
    }
}

?>
