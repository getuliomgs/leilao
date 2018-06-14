<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class aReceberContasComponent extends Component
{

    public $components = array('contas');

    private function query($id = null, $condominios_id = null, $date_pagamento_real = null, $plano_contas_id = null, $caixa_a_receber_contas_id = null){
        
        $query = array();
            if($id != 0 or $condominios_id != 0 or $date_pagamento_real != 0 or $plano_contas_id != 0 or $caixa_a_receber_contas_id != 0) {
            $query = TableRegistry::get('a_receber_contas')->find()
                ->select([
                    'a_receber_contas.id',
                    'a_receber_contas.parcelas_id',
                    'a_receber_contas.plano_contas_id',
                    'a_receber_contas.extratos_id',
                    'a_receber_contas.descricao',
                    'a_receber_contas.tipo',
                    'a_receber_contas.valor',
                    'a_receber_contas.date_referencia',
                    'a_receber_contas.date_pagamento_previsto',
                    'a_receber_contas.doc_referencia',
                    'plano_contas.id',
                    'plano_contas.cod_eap',
                    'plano_contas.nome',
                    'plano_contas.condominios_id',
                    'condominios.id',
                    'condominios.name',
                    'parcelas.id',
                    'parcelas.nome',
                    'condominos.id',
                    'condominos.nome'
                ])
                ->leftJoin('plano_contas', ['a_receber_contas.plano_contas_id = plano_contas.id'])
                ->leftJoin('condominios', ['plano_contas.condominios_id = condominios.id'])
                ->leftJoin('parcelas', ['a_receber_contas.parcelas_id = parcelas.id'])
                ->leftJoin('condominos', ['parcelas.condominos_id = condominos.id'])
            ;

            if(!empty($id)) {
                $query->where(['a_receber_contas.id' => $id]);
            }

            if ($caixa_a_receber_contas_id == "IsNull"){
                $query->select(['caixa.a_receber_contas_id']);
                $query->leftJoin('caixa',['a_receber_contas.id = caixa.a_receber_contas_id']);
                $query->where(['caixa.a_receber_contas_id IS NULL']);
            }

            
            if($date_pagamento_real == "IsNull") {
                $query->where(['a_receber_contas.date_pagamento_real IS  NULL']);
            }

            if(!empty($plano_contas_id)) {
                $query->where(['a_receber_contas.plano_contas_id' => $plano_contas_id]);
            }
        }
        return $query;
    }

	public function extencaoNome($nome) {

	    $arquivo =  $nome;
	 
		$arquivo = substr($arquivo, -4);
		 
		if($arquivo[0] == '.'){
		      $arquivo = substr($arquivo, -3);
		}
		 
		return $arquivo;
    }

    public function selectParcelasCondominios($id) {
        
        $query = TableRegistry::get('parcelas')->find()
            ->select([ 'id', 'nome',  'condominos.nome','condominos.cpf', 'condominos.cnpj'])
            ->leftJoin('condominos', ['parcelas.condominos_id = condominos.id']);
            $query->where(['condominios_id' => $id]);
        $parcelas = array();
        $parcelas[] = "Selecione";
        foreach ($query as $parcela) {
            $parcelas[$parcela->id] = $parcela->nome." - ".$parcela['condominos']['nome']." - CPF/CNPJ: ".$parcela['condominos']['cpf'].$parcela['condominos']['cnpj'];
        }
        return $parcelas;
    } 

    public function selectAReceberContas($condominios_id){
            
            $query = TableRegistry::get('a_receber_contas')->find()
                ->select([
                    'a_receber_contas.id',
                    'a_receber_contas.descricao',
                    'a_receber_contas.date_referencia',
                    'a_receber_contas.date_pagamento_real',
                    'a_receber_contas.date_pagamento_previsto',
                    'a_receber_contas.valor',
                    'parcelas.nome',
                    'condominos.nome'
                ])
                ->leftJoin('parcelas', ['a_receber_contas.parcelas_id = parcelas.id'])
                ->leftJoin('condominos', ['parcelas.condominos_id = condominos.id'])
             ->where(['a_receber_contas.extratos_id is null'])
             ->where(['a_receber_contas.condominios_id' => $condominios_id ])
             ->order(['a_receber_contas__date_pagamento_real' => 'ASC']);
            $a_receber_contas = array();
            foreach ($query as $a_receber_conta) {
                $a_receber_contas[$a_receber_conta->id] = $this->is_objectData($a_receber_conta->date_pagamento_real)." REF.".$a_receber_conta->date_referencia->format("m/Y")." - R$: ".number_format($a_receber_conta->valor, 2, ",",".")." - ".$a_receber_conta['parcelas']['nome']." - ".$a_receber_conta['condominos']['nome']." - ".$a_receber_conta->descricao;
            }
            
            return $a_receber_contas;
    }

    public function is_objectData($data, $format = null){

        if(empty($format)){
            $format = "d/m/Y";
        }

        if(is_object($data)){

            $data = $data->format($format);
        }else{
            if($data == null){

            }else{
                $data = date_format(date_create($data), $format);
            }
        }
        return $data;
    }
    
    public function a_receber_contas_date_pagamento_real_menor($condominios_id){

        $a_receber_contas_date_pagamento_real_menor = null;
          
        $query = TableRegistry::get('a_receber_contas')->find();
        $query->select([
            'a_receber_contas.id',
            'a_receber_contas.extratos_id',
            'date_pagamento_real' => $query->func()->MIN('date_pagamento_real'),
            ])
            ->where
                ([
                    "(a_receber_contas.extratos_id is not null OR a_receber_contas.extratos_id = 0)",
                    "a_receber_contas.condominios_id = " => $condominios_id
                ]);
  
        $a_receber_contas = array();
        foreach ($query as $a_receber_conta) {
           $a_receber_contas_date_pagamento_real_menor = $a_receber_conta->date_pagamento_real;
        }
        return $a_receber_contas_date_pagamento_real_menor;
    }

    public function queryRelatorioCaixa($condominios_id){

        $query = TableRegistry::get('a_receber_contas')->find()
            ->select([
                'a_receber_contas.id',
                'a_receber_contas.condominios_id',
                'a_receber_contas.parcelas_id',
                'a_receber_contas.plano_contas_id',
                'a_receber_contas.extratos_id',
                'a_receber_contas.descricao',
                'a_receber_contas.tipo',
                'a_receber_contas.valor',
                'a_receber_contas.date_referencia',
                'a_receber_contas.date_pagamento_previsto',
                'a_receber_contas.date_pagamento_real',
                'a_receber_contas.doc_referencia',
                'plano_contas.id',
                'plano_contas.cod_eap',
                'plano_contas.nome',
                'condominios.id',
                'condominios.name',
                'parcelas.id',
                'parcelas.nome',
                'condominos.id',
                'condominos.nome'
            ])
            ->leftJoin('plano_contas', ['a_receber_contas.plano_contas_id = plano_contas.id'])
            ->leftJoin('condominios', ['a_receber_contas.condominios_id = condominios.id'])
            ->leftJoin('parcelas', ['a_receber_contas.parcelas_id = parcelas.id'])
            ->leftJoin('condominos', ['parcelas.condominos_id = condominos.id'])
            ->where(['a_receber_contas.condominios_id' => $condominios_id])
            ->where(['a_receber_contas.date_pagamento_real IS NOT NULL']);

        return $query;
    }

    public function is_null_date($date){

        $return = $date;

        if(is_null($date)){

        }else{
             $return = $date->format("d/m/Y");
        }
        return $return;
    }

    public function arrayReceberContas($condominios_id = 1){

        $AReceberContas = $this->queryRelatorioCaixa($condominios_id);

        $movimentacoes = array();

        foreach ($AReceberContas as $AReceberConta) {
            $movimentacoes[] = array(

                'descricao' => $AReceberConta->descricao." - ".$AReceberConta['condominios']['name']." - ".$AReceberConta['parcelas']['nome']." - ".$AReceberConta['condominos']['nome'],
                'data_referencia' => $AReceberConta->date_referencia,
                'data_pagamento_previsto' => $AReceberConta->date_pagamento_previsto,
                'data_pagamento' => $AReceberConta->date_pagamento_real,
                'valor_previsto' => $AReceberConta->valor,
                'valor_pagamento' => $AReceberConta->valor,
                'plano_contas_cod_eap' => $AReceberConta['plano_contas']['cod_eap'],
                'plano_contas_nome' => $AReceberConta['plano_contas']['nome'],
                'doc_referencia' => $AReceberConta->doc_referencia
            );
        }
        return  $movimentacoes;
    }

    /**
     * retorno soma das contas a receber pagar ainda não conciliadas
     **/
    public function saldoAnterior($date, $condominios_id) {

        $return = (float)0;
        $query = TableRegistry::get('a_receber_contas')->find();
        $query->select([
                'valor'  => $query->func()->sum('a_receber_contas.valor')
            ])
        ->where
            ([
                "condominios_id IN(".$condominios_id.")",
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
     * retorna o valor das contas a receber do pacote de ids do plano de contas considerando periodo de data de pagamento
     **/
    public function valorCodEap($idFilhos, $periodo_ini, $periodo_fim) {
        $valorCodEap = (float)0;
        $idFilhos = implode(",",$idFilhos);

        $query = TableRegistry::get('a_receber_contas')->find();
         $query->select
            ([
                'valor'  => $query->func()->sum('a_receber_contas.valor')
            ])
        ->where
            ([
                "   a_receber_contas.plano_contas_id IN(".$idFilhos.") 
                AND
                    a_receber_contas.date_pagamento_real BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')
                AND 
                    a_receber_contas.date_pagamento_real IS NOT NULL
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
        
        $relatorioBalanceteAnalitico = array();
        $relatorioBalanceteAnalitico['cod_eap'] = array();
        $relatorioBalanceteAnalitico['movimentacoes'] = array();

        $query = TableRegistry::get('a_receber_contas')->find()
        ->select([
            'a_receber_contas.id',
            'a_receber_contas.condominios_id',
            'a_receber_contas.parcelas_id',
            'a_receber_contas.plano_contas_id',
            'a_receber_contas.descricao',
            'a_receber_contas.valor',
            'a_receber_contas.date_referencia',
            'a_receber_contas.date_pagamento_real',
            'a_receber_contas.doc_referencia',
            'plano_contas.id',
            'plano_contas.cod_eap',
            'plano_contas.nome',
            'parcelas.id',
            'parcelas.condominos_id',
            'parcelas.nome',
            'condominos.id',
            'condominos.nome'
        ])
        ->leftJoin('plano_contas', 'a_receber_contas.plano_contas_id = plano_contas.id')
        ->leftJoin('parcelas', 'a_receber_contas.parcelas_id = parcelas.id')
        ->leftJoin('condominos', 'parcelas.condominos_id = condominos.id')
        ->where([
            'a_receber_contas.condominios_id' => $condominios_id,
            "a_receber_contas.date_pagamento_real BETWEEN ('".$periodo_ini."') AND ('".$periodo_fim."')",
            'a_receber_contas.date_pagamento_real IS NOT NULL'
        ]);
        foreach ($query as $key => $r) {
            $relatorioBalanceteAnalitico['cod_eap'][] = $r['plano_contas']['cod_eap'];
            $relatorioBalanceteAnalitico['movimentacoes'][] = array(
                'id' => $r->id,
                'credor' => $r['condominos']['nome']." - ".$r['parcelas']['nome'],
                'descricao' => $r->descricao,
                'data_referencia' => $r->date_referencia,
                'data_pagamento' => $r->date_pagamento_real->format("d/m/y"),
                'valor_pagamento' => $r->valor,
                'cod_eap' => $r['plano_contas']['cod_eap'],
                'nome_eap' => $r['plano_contas']['nome'],
                'doc_referencia' => $r->doc_referencia,
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
        $aReceberContasTable = TableRegistry::get('aReceberContas');
        $query = $aReceberContasTable->find()->where(['extratos_id' => $id]);
        foreach ($query as $aReceberContaQuery) {         
            $aReceberConta = $aReceberContasTable->get($aReceberContaQuery->id);          
            $aReceberConta->modified = $modified;
            $aReceberConta->extratos_id = null;
            if ($aReceberContasTable->save($aReceberConta)) {
            } else {
                $this->Flash->error(__('Erro ao salvar relacionamento com contas a pagar!'));
            }
        }
    }

    public function formSelectAjax($id = null, $condominios_id = null, $plano_contas_id = null, $date_pagamento_real = null, $caixa_a_receber_contas_id = null) {
        
        $query = $this->query($id, $condominios_id, $date_pagamento_real, $plano_contas_id, $caixa_a_receber_contas_id);        
        $a_receber_conta = array();
        $formSelect = '
            <div class="input select">
                <label for="a-receber-contas-id">A Receber Contas</label>
                <select name="a_receber_contas_id" id="a-receber-contas-id">
                    <option value="0">Selecione</option>';
                    foreach ($query as $a_receber_conta) {
                        if($a_receber_conta->id == $id) {
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        
                        $valor = number_format($a_receber_conta->valor, 2 , ",",".");
                        $valor_data_v = $a_receber_conta->valor; 
                        $dias_atrazo = intval(date_diff($a_receber_conta->date_pagamento_previsto, date_create("2017-11-29"))->format('%R%a'));

                        /*
                        if($dias_atrazo > 0){
                            $valor_data_d = " TXC com ".$dias_atrazo." dias de atrazo";

                            //multa
                            $valor_data_v = $valor * 1.02;
                            //juros 
                            $valor_data_v = ($valor_data_v * 0.01 / 30 * $dias_atrazo) + $valor_data_v;

                            //$valor_data_v = number_format($valor_data_v, 2, ".",",");

                        }else{
                            $valor_data_d = " TXC";

                            $valor_data_v = $valor;
                        }
                        */



                        $date_pagamento_previsto = $this->is_objectData($a_receber_conta->date_pagamento_previsto);
                        $date_referencia = $this->is_objectData($a_receber_conta->date_referencia, "m/Y"); 

                        $formSelect .= '<option data-dr="'.$date_referencia.'" data-v="'.$valor_data_v.'" data-d="'.$valor_data_d.'" value="'.$a_receber_conta->id.'"'.$selected.'>'.$date_pagamento_previsto." | R$: ".$valor." | ".$a_receber_conta['parcelas']['nome']." Ref. ".$date_referencia." | ".$a_receber_conta->descricao.$valor_data_d.'</option>';
                    }
        $formSelect .= 
                '</select>
            </div>';
        return $formSelect;
    }
    /**
     * 
     *
     * @return objeto recond set a_receber_contas
     **/
    public function buscar($id = null){

        $aReceberConta = array();
        $query = $this->query($id);
        
        foreach ($query as $value) {
            $aReceberConta = $value;
        }
        return $aReceberConta;
    }

    /**
     * 
     *
     * @return objeto recond set a_receber_contas
     **/
    public function inadimplencia($condominios_id){

        $query = TableRegistry::get('a_receber_contas')->find('all', 
            ['contain' =>
                ['Parcelas'=>
                    ['Condominos'],
                'PlanoContas' =>
                    ['Condominios' => 
                        function ($q) use ($condominios_id) {
                            return $q->where(['Condominios.id'=>$condominios_id]);
                        }
                    ]
                ]
            ]
        );
        $query->select(['inadimplencia' => $query->func()->sum('a_receber_contas.valor')]);
         
        $query->leftjoin( 'caixa', 'caixa.a_receber_contas_id = a_receber_contas.id');
        if(isset($this->request->data['parcelas_id']) and !empty(($this->request->data['parcelas_id']))){
            $query->where('parcelas_id = '.$this->request->data['parcelas_id']);
        }
        $query->where('caixa.a_receber_contas_id IS NULL');
        $this->log($query, 'debug');
        foreach ($query as $key => $value) {
            return $value['inadimplencia'];
        }
        return 0;
    }
}

?>
