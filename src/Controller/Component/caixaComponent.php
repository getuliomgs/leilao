<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class caixaComponent extends Component
{
	public $components = array( 'aReceberContas', 'aPagarContas', 'extratos', 'condominios', 'contas', 'fornecedores', 'caixaStatusMes');

    public function saldoAnterior($condominios_id, $date) {
    	
    	//$fornecedores_id = implode("," , $this->fornecedores->idFornecedores($condominios_id));

    	$contas_id = implode(",",$this->contas->contasCondominio($condominios_id,true));   	

    	$saldo = (float)0;

    	$saldo = (float)$this->extratos->saldoAnterior($date, $contas_id)->valor;

    	$saldo = (float)bcadd($saldo, (float)$this->aReceberContas->saldoAnterior($date, $condominios_id),2);

    	$saldo = (float)bcadd($saldo, (float)$this->aPagarContas->saldoAnterior($date, $condominios_id),2);

        return $saldo;
    } 

    public function extencaoNome($nome)  {

        $arquivo =  $nome;
     
        $arquivo = substr($arquivo, -4);
         
        if($arquivo[0] == '.'){
              $arquivo = substr($arquivo, -3);
        }
         
        return $arquivo;
    }


    /**
     * consulta se conta a receber esta em alguma movimentação do caixa
     *
     * @return 
     */
    public function buscarAReceberConta($id){
        $query = array();
        $query = TableRegistry::get('caixa')->find()
            ->select([
                'caixa.a_receber_contas_id'
            ]);
        $query->where(['caixa.a_receber_contas_id' => $id]);
        
        return $query->count();
    }  

    /**
     * consulta se conta a pagar esta em alguma movimentação do caixa
     *
     * @return 
    */
    public function buscarAPagarConta($id){
        $query = array();
        $query = TableRegistry::get('caixa')->find()
            ->select([
                'caixa.a_pagar_contas_id'
            ]);
        $query->where(['caixa.a_pagar_contas_id' => $id]);
        
        return $query->count();
    } 

    /**
     *
     *
     */
    public function condominio($caixa){
        $condominio = "";
        if(isset($caixa->a_receber_conta->plano_conta->condominio)){
            $condominio = $caixa->a_receber_conta->plano_conta->condominio;    
        }elseif(isset($caixa->a_pagar_conta->plano_conta->condominio)){
            $condominio = $caixa->a_pagar_conta->plano_conta->condominio;
        }
        return $condominio;
    }  

    /**
     *
     *
     */
    private function condominio_id($caixa){
        $condominio = "";
        if(isset($caixa->a_receber_conta->plano_conta->condominios_id)){
            $condominio = $caixa->a_receber_conta->plano_conta->condominios_id;    
        }elseif(isset($caixa->a_pagar_conta->plano_conta->condominios_id)){
            $condominio = $caixa->a_pagar_conta->plano_conta->condominios_id;
        }
        return $condominio;
    }  

    /**
     *
     *
     */
    public function planoConta($caixa){
        $planoConta = "";
        if(isset($caixa->a_receber_conta->plano_conta)){
            $planoConta = $caixa->a_receber_conta->plano_conta;    
        }elseif(isset($caixa->a_pagar_conta->plano_conta)){
            $planoConta = $caixa->a_pagar_conta->plano_conta;
        }
        return $planoConta;
    } 


    /**
     *
     *
     */
    public function fornecedor($caixa){
        $fornecedor = ''; 
        if(isset($caixa->a_pagar_conta->fornecedore)){
            $fornecedor = $caixa->a_pagar_conta->fornecedore;
        }
        return $fornecedor;
    } 

    /**
     *
     *
     */
    public function parcela($caixa){
        $parcela = "";
        if(isset($caixa->a_receber_conta->parcela)){
            $parcela = $caixa->a_receber_conta->parcela;    
        }
        return $parcela;
    }


    /**
     *
     *
     */
    public function date_pagamento_previsto($caixa){
        $date_pagamento_previsto = "";
        if(isset($caixa->a_receber_conta->date_pagamento_previsto)){
            $date_pagamento_previsto = $caixa->a_receber_conta->date_pagamento_previsto;    
        }elseif(isset($caixa->a_pagar_conta->date_pagamento_previsto)){
            $date_pagamento_previsto = $caixa->a_pagar_conta->date_pagamento_previsto;
        }
        return $date_pagamento_previsto;
    }  

    /**
     *
     *
     */
    public function valor_previsto($caixa){
        $valor_previsto = "";
        if(isset($caixa->a_receber_conta->valor)){
            $valor_previsto = $caixa->a_receber_conta->valor;    
        }elseif(isset($caixa->a_pagar_conta->valor)){
            $valor_previsto = $caixa->a_pagar_conta->valor * -1;
        }
        return $valor_previsto;
    } 

    /**
     * 
     * @return bool
    */
    public function verificarMes($caixa)
    {
        $queryCaixaStatusMe = TableRegistry::get('caixa_status_mes')->find();
        if(is_object($caixa['data_pagamento'])){
            $queryCaixaStatusMe->where([
                "caixa_status_mes.mes >=" => $caixa['data_pagamento']
            ]);            
            $queryCaixaStatusMe->where([
                'caixa_status_mes.condominios_id'=>$this->condominio_id($caixa)
            ]);
        }else{
            $queryCaixaStatusMe->where([
                'caixa_status_mes.condominios_id'=>$caixa['condominios_id']
            ]);
            $data = explode( "/",  $caixa['data_pagamento'] );
            $data =   ['year' => $data[2],'month' => $data[1],'day' => $data[0]];       
            $queryCaixaStatusMe->where([
                "caixa_status_mes.mes >=" => $data['year'].'-'.$data['month'].'-'.$data['day']
            ]);
        }
        return ($queryCaixaStatusMe->count()) ? false : true ;        
    }



    /**
     * retoran o valor do saldo da data anterior 
     * @return array caixa
    */
    public function consultaSaldoCaixa($caixa){
        if(empty($caixa->a_pagar_conta->plano_conta->condominios_id)){
            $condominios_id = $caixa->a_receber_conta->plano_conta->condominios_id;
        }else{
            $condominios_id = $caixa->a_pagar_conta->plano_conta->condominios_id;
        }
        
        $query = TableRegistry::get('caixa')->find()->select([
            'caixa.id',
            'caixa.saldo',
            'caixa.valor',
            'pc_apc.nome',
            'pc_arc.nome',
            'f.nome',
            'p.nome',
            'caixa.descricao',
            'apc.id',
            'arc.id',
            'apc.descricao',
            'arc.descricao',
            'apc.date_referencia',
            'arc.date_referencia',
            'c_pc_apc.id',
            'c_pc_apc.name',
            'caixa.a_receber_contas_id',
            
            
            'c_pc_arc.id',
            'c_pc_arc.name',
            'caixa.descricao',
            'caixa.valor',
            'caixa.saldo',
            'caixa.data_pagamento',
            'caixa.doc_referencia'
        ]);

        $query->join([
            'apc' => [
                'table' => 'a_pagar_contas',
                'type' => 'LEFT',
                'conditions' => 'caixa.a_pagar_contas_id = apc.id'
            ],
            'f' => [
                'table' => 'fornecedores',
                'type' => 'LEFT',
                'conditions' => 'apc.fornecedores_id = f.id'
            ],
            'pc_apc' => [
                'table' => 'plano_contas',
                'type' => 'LEFT',
                'conditions' => 'apc.plano_contas_id = pc_apc.id'
            ],
            'c_pc_apc' => [
                'table' => 'condominios',
                'type' => 'LEFT',
                'conditions' => 'pc_apc.condominios_id = c_pc_apc.id'
            ],
            'arc' => [
                'table' => 'a_receber_contas',
                'type' => 'LEFT',
                'conditions' => 'caixa.a_receber_contas_id = arc.id'
            ], 
            'p' => [
                'table' => 'parcelas',
                'type' => 'LEFT',
                'conditions' => 'arc.parcelas_id = p.id'
            ],
            'pc_arc' => [
                'table' => 'plano_contas',
                'type' => 'LEFT',
                'conditions' => 'arc.plano_contas_id = pc_arc.id'
            ],
            'c_pc_arc' => [
                'table' => 'condominios',
                'type' => 'LEFT',
                'conditions' => 'pc_arc.condominios_id = c_pc_arc.id'
            ]
        ]);
       
        $query->where([
             'OR' => ['c_pc_apc.id' => $condominios_id, 'c_pc_arc.id' => $condominios_id]
        ]);
                
        $query->order(['caixa.data_pagamento'=>'DESC', 'caixa.created'=>'DESC', 'caixa.id'=>'DESC']);
        $query->where([
            'caixa.data_pagamento <' => $caixa->data_pagamento
        ]);
        $query->limit(1);

        if(empty($query->count())){
            $caixa->caixa['saldo'] = (float) 0;
        }else{
            foreach ($query as $value) {
                return  $value;
            }
        }
        return $caixa;
    }

    /**
     * retoran o valor do saldo anterior a tupla inserirda ou excluida por data e id
     * @return objeto caixa
    */
    public function consulAtuaSaldo($caixaSaldo){
        $return_caixa = array();
        if(empty($caixaSaldo->apc['id'])){
            $condominios_id = $caixaSaldo->c_pc_arc['id'];
        }else{
            $condominios_id = $caixaSaldo->c_pc_apc['id'];
        }
        
        $query = TableRegistry::get('caixa')->find()->select([
            'caixa.id',
            'pc_apc.nome',
            'pc_arc.nome',
            'f.nome',
            'p.nome',
            'caixa.descricao',
            'apc.descricao',
            'arc.descricao',
            'apc.date_referencia',
            'arc.date_referencia',
            'c_pc_apc.id',
            'c_pc_apc.name',
            'caixa.a_receber_contas_id',
            
            
            'c_pc_arc.id',
            'c_pc_arc.name',
            'caixa.descricao',
            'caixa.valor',
            'caixa.saldo',
            'caixa.data_pagamento',
            'caixa.doc_referencia'
        ]);

        $query->join([
            'apc' => [
                'table' => 'a_pagar_contas',
                'type' => 'LEFT',
                'conditions' => 'caixa.a_pagar_contas_id = apc.id'
            ],
            'f' => [
                'table' => 'fornecedores',
                'type' => 'LEFT',
                'conditions' => 'apc.fornecedores_id = f.id'
            ],
            'pc_apc' => [
                'table' => 'plano_contas',
                'type' => 'LEFT',
                'conditions' => 'apc.plano_contas_id = pc_apc.id'
            ],
            'c_pc_apc' => [
                'table' => 'condominios',
                'type' => 'LEFT',
                'conditions' => 'pc_apc.condominios_id = c_pc_apc.id'
            ],
            'arc' => [
                'table' => 'a_receber_contas',
                'type' => 'LEFT',
                'conditions' => 'caixa.a_receber_contas_id = arc.id'
            ], 
            'p' => [
                'table' => 'parcelas',
                'type' => 'LEFT',
                'conditions' => 'arc.parcelas_id = p.id'
            ],
            'pc_arc' => [
                'table' => 'plano_contas',
                'type' => 'LEFT',
                'conditions' => 'arc.plano_contas_id = pc_arc.id'
            ],
            'c_pc_arc' => [
                'table' => 'condominios',
                'type' => 'LEFT',
                'conditions' => 'pc_arc.condominios_id = c_pc_arc.id'
            ]
        ]);
       
        $query->where([
             'OR' => ['c_pc_apc.id' => $condominios_id, 'c_pc_arc.id' => $condominios_id]
        ]);
               
        $query->where([
            'caixa.data_pagamento >' => $caixaSaldo->data_pagamento
        ]);
        
         $query->order([
            'caixa.data_pagamento'=>'ASC',
            'caixa.created'=>'ASC',
            'caixa.id'=>'ASC'
        ]);
       
        $saldo = $caixaSaldo->saldo;
        
        foreach ($query as $value) {        
            $saldo = $value->saldo = (float) bcadd($saldo, $value->valor, 2);
            array_push($return_caixa, $value);            
        }
        return $return_caixa;
    }

    public function old_consultaSaldoCaixa($caixa){

        if(empty($caixa->a_pagar_conta->plano_conta->condominios_id)){
            $condominios_id = $caixa->a_receber_conta->plano_conta->condominios_id;
        }else{
            $condominios_id = $caixa->a_pagar_conta->plano_conta->condominios_id;
        }

        $query = TableRegistry::get('caixa')->find();
        $query->select([
           'caixa.id',
           'caixa.valor',
           'caixa.saldo',
           'caixa.a_pagar_contas_id',
           'a_pagar_contas.id',
           'a_pagar_contas.plano_contas_id',
           "plano_contas_apc.id",
           'plano_contas_apc.condominios_id',
           'caixa.a_receber_contas_id',
           'a_receber_contas.id',
           'a_receber_contas.plano_contas_id',
           'plano_contas_arc.condominios_id',
           'caixa.data_pagamento'
        ]);
        $query->leftjoin('a_pagar_contas', [' caixa.a_pagar_contas_id = a_pagar_contas.id ']);
        $query->leftjoin(['plano_contas_apc' => 'plano_contas'], ['a_pagar_contas.plano_contas_id = plano_contas_apc.id']);
        $query->leftjoin('a_receber_contas', ['caixa.a_receber_contas_id = a_receber_contas.id']);
        $query->leftjoin(['plano_contas_arc'=> 'plano_contas'], ['a_receber_contas.plano_contas_id = plano_contas_arc.id']);
        $query->where(['plano_contas_apc.condominios_id' => $condominios_id])->orwhere(['plano_contas_arc.condominios_id' => $condominios_id]);
        $query->where([
            'caixa.data_pagamento <' => $caixa->data_pagamento
        ]);
        $query->order([
            'caixa.data_pagamento'=>'DESC',
            'caixa.created'=>'DESC',
            'caixa.id'=>'DESC'
        ]);
        $query->limit(1);
        
        foreach ($query as $value) {
            $caixa = $value;
            if($caixa->saldo == null){
                return $caixa;
            }else{
                return $caixa;    
            }
            
        }
        return $caixa;
    }

    public function saldo($condominios_id){
      
        $return_saldo = array();
        $query = TableRegistry::get('caixa')->find()->select([
            'caixa.id',
            'caixa.saldo',
            'caixa.valor',
            'pc_apc.nome',
            'pc_arc.nome',
            'f.nome',
            'p.nome',
            'caixa.descricao',
            'apc.id',
            'arc.id',
            'apc.descricao',
            'arc.descricao',
            'apc.date_referencia',
            'arc.date_referencia',
            'c_pc_apc.id',
            'c_pc_apc.name',
            'caixa.a_receber_contas_id',
            
            
            'c_pc_arc.id',
            'c_pc_arc.name',
            'caixa.descricao',
            'caixa.valor',
            'caixa.saldo',
            'caixa.data_pagamento',
            'caixa.doc_referencia'
        ]);

        $query->join([
            'apc' => [
                'table' => 'a_pagar_contas',
                'type' => 'LEFT',
                'conditions' => 'caixa.a_pagar_contas_id = apc.id'
            ],
            'f' => [
                'table' => 'fornecedores',
                'type' => 'LEFT',
                'conditions' => 'apc.fornecedores_id = f.id'
            ],
            'pc_apc' => [
                'table' => 'plano_contas',
                'type' => 'LEFT',
                'conditions' => 'apc.plano_contas_id = pc_apc.id'
            ],
            'c_pc_apc' => [
                'table' => 'condominios',
                'type' => 'LEFT',
                'conditions' => 'pc_apc.condominios_id = c_pc_apc.id'
            ],
            'arc' => [
                'table' => 'a_receber_contas',
                'type' => 'LEFT',
                'conditions' => 'caixa.a_receber_contas_id = arc.id'
            ], 
            'p' => [
                'table' => 'parcelas',
                'type' => 'LEFT',
                'conditions' => 'arc.parcelas_id = p.id'
            ],
            'pc_arc' => [
                'table' => 'plano_contas',
                'type' => 'LEFT',
                'conditions' => 'arc.plano_contas_id = pc_arc.id'
            ],
            'c_pc_arc' => [
                'table' => 'condominios',
                'type' => 'LEFT',
                'conditions' => 'pc_arc.condominios_id = c_pc_arc.id'
            ]
        ]);
       
        $query->where([
             'OR' => ['c_pc_apc.id' => $condominios_id, 'c_pc_arc.id' => $condominios_id]
        ]);

        $query->order([
            'caixa.data_pagamento'=>'DESC',
            'caixa.created'=>'DESC',
            'caixa.id'=>'DESC'
        ]);
        $query->limit(1);
        
        foreach ($query as $key => $value) {
            array_push($return_saldo, $value);
        }
        return $return_saldo;
    }
}   
?>
