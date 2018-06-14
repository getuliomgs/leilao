<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;

class relatoriosComponent extends Component
{

	public $components = array( 'aReceberContas', 'aPagarContas', 'extratos', 'condominios', 'relatorios' , 'caixa', 'contas', 'aplicacoes', 'planoContas');

	public function minDatePagamento($condominios_id) {


		$minDatePagamento = null;
		$minDatePagamentoExtrato = $this->extratos->minDataMovimentacao2($condominios_id);


		$minDatePagamentoPagar = $this->aPagarContas->a_pagar_contas_date_pagamento_real_menor($condominios_id);


		$minDatePagamentoReceber = $this->aReceberContas->a_receber_contas_date_pagamento_real_menor($condominios_id);

		$minDatePagamento = $this->menorData($minDatePagamentoExtrato, $minDatePagamentoPagar);
		
		$minDatePagamento = $this->menorData($minDatePagamento, $minDatePagamentoReceber);

		return $minDatePagamento;
	}

	public function menorData($data1 = null, $data2 = null) {

		if(is_null($data1)){
			if(is_null($data2)){
				debug("As datas são null")or die();
			}
		}else{
			if(is_null($data2)){
				return $data1;
			}else{
				if($data1->format("Y-m-d") >= $data2->format("Y-m-d")){
					return $data2;
				}else{
					return $data1;
				}
			}
		}
	}

    private function countRowSpan($query){

        $countRowSpan = array();
        $count = 1;
        $id_temp = 0;
        foreach ($query as $rba) {

            if(empty($countRowSpan)){
                $id_temp = $rba->id;
            }

            if($id_temp == $rba->id){
                $countRowSpan[$rba->id] = $count;
                $count++;
            }else{
                $count = 1;
                $countRowSpan[$rba->id] = $count;
                $id_temp = $rba->id;
                $count++;
            }
        }
        return $countRowSpan;
    }

	public function fillDrive($array, $minDatePagamento, $periodo_ini, $periodo_fim, $saldo, $caixa ) {

        $fillDrive = array();

        foreach ($array as $arrayExtrato) {

            if($arrayExtrato['data_pagamento']->format("Y-m-d") == $minDatePagamento->format("Y-m-d")){
                $fillDrive['data_ultima_apuracao'] = $arrayExtrato['data_pagamento'];
                $saldo = $saldo + $arrayExtrato['valor_pagamento'];
                 $fillDrive['saldo'] = $arrayExtrato['saldo'] = $saldo;

                //verificar se a data de pagamento esta no intervalo 
                if($arrayExtrato['data_pagamento']->format("Y-m-d") >= $periodo_ini and $arrayExtrato['data_pagamento']->format("Y-m-d") <= $periodo_fim){
                    $caixa[] = $arrayExtrato;
                }
                $fillDrive['caixa'] = $caixa;
            }
        }
        return $fillDrive;
    }

    public function relatorioBalanceteAnalitico($condominios_id,$mesAno) {

        $relatorioBalanceteAnalitico = array();

        $mes = substr($mesAno, 0,2);
        $ano = substr($mesAno, 3,7);
        $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));
        $periodo_ini = $ano."-".$mes."-01";
        $periodo_fim = $ano."-".$mes."-".$ultimo_dia;

        $relatorioBalanceteAnalitico = $this->fillBalanceteAnalitico($condominios_id, $periodo_ini, $periodo_fim);

        return $relatorioBalanceteAnalitico;
    }

    private function pc($cod_eap, $fillBalanceteAnalitico ){

        $pc['valor'] = (float)0;
        foreach ($fillBalanceteAnalitico as $key => $fba) {
            if($cod_eap == $fba['cod_eap']) {
                $pc['valor'] = bcadd($pc['valor'], $fba['valor_pagamento'],2);    
                $pc['nome'] = $fba['nome_eap'];
            }
        }
        return $pc;
    }

    /**
     * compara tupla do array
     */
    private function compara_credor($a, $b){
        return $a['credor'] > $b['credor'];
    }
    /**
     * compara tupla do array
     */
    private function compara_cod_eap($a, $b){
        return $a['cod_eap'] > $b['cod_eap'];
    }

    private function fillBalanceteAnalitico($condominios_id, $periodo_ini, $periodo_fim) {

        $fillBalanceteAnalitico = array();
        $fill['movimentacoes'] =  $fill['eap'] = $fill = array();
        $extrato = $this->extratos->relatorioBalanceteAnalitico($condominios_id, $periodo_ini, $periodo_fim);

        if(empty($extrato)){
            return $fill;
        }else{
            $fillBalanceteAnalitico = $extrato['movimentacoes'];
        }

        $aReceberContas = $this->aReceberContas->relatorioBalanceteAnalitico($condominios_id, $periodo_ini, $periodo_fim);

        $fillBalanceteAnalitico = array_merge($fillBalanceteAnalitico, $aReceberContas['movimentacoes']);

        $aPagarContas = $this->aPagarContas->relatorioBalanceteAnalitico($condominios_id, $periodo_ini, $periodo_fim);

        $fillBalanceteAnalitico = array_merge($fillBalanceteAnalitico, $aPagarContas['movimentacoes'] );

        //faz ordenação
        usort($fillBalanceteAnalitico, array($this, "compara_credor"));

        //debug($fillBalanceteAnalitico)or die();
        $extrato['cod_eap'] = array_unique($extrato['cod_eap']);
        $aReceberContas['cod_eap'] = array_unique($aReceberContas['cod_eap']);
        $aPagarContas['cod_eap'] = array_unique($aPagarContas['cod_eap']);
        $cod_eap = array_merge($extrato['cod_eap'], $aReceberContas['cod_eap'], $aPagarContas['cod_eap']);
        $cod_eap = array_unique($cod_eap);
        sort($cod_eap);              
        $saldo_pc = array();
        foreach ($cod_eap as $key => $value) {
            $fill['eap'][$value] = $this->pc($value, $fillBalanceteAnalitico);
            foreach ($fillBalanceteAnalitico as $key => $fba) {
                if($fba['cod_eap'] == $value){
                    $fill['movimentacoes'][$value][] = $fba;
                    //usort($fill['movimentacoes'][$value], array($this, "compara_credor"));
                }
            }
            
        }
        return $fill;
    }

    public function relatorioConciliacao($condominios_id,$mesAno) {

        $relatorioConciliacao = array();

        $mes = substr($mesAno, 0,2);
        $ano = substr($mesAno, 3,7);
        $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));
        $periodo_ini = $ano."-".$mes."-01";
        $periodo_fim = $ano."-".$mes."-".$ultimo_dia;
        $relatorioConciliacao = $this->fillConciliacao($condominios_id, $periodo_ini, $periodo_fim);

        return $relatorioConciliacao;
    }

    private function fillConciliacao($condominios_id, $periodo_ini, $periodo_fim) {

        $fillConciliacao = array();
        $queryRelatorioConciliacao = $this->extratos->queryRelatorioConciliacao($condominios_id, $periodo_ini, $periodo_fim);
        $countRowSpan = $this->countRowSpan($queryRelatorioConciliacao);

        foreach($queryRelatorioConciliacao as $rba) {
            
            $fillConciliacao[] = array(

                'id' => $rba->id,
                'historico' => $rba->historico,
                'nr_doc' => $rba->nr_doc,
                'date_movimentacao' => $rba->date_movimentacao,
                'valor' => $rba->valor,
                'descricao' => $rba->fornecedores['nome']." ".$rba->condominos['nome']." ".$rba->parcelas['nome']." ".$this->extratos->descricao($rba),
                'data_pagamento' => $this->extratos->date_pagamento($rba),
                'valor_pagamento' => $this->extratos->valor_pagamento($rba),
                'saldo' => $rba->saldo,
                'plano_contas' => $this->extratos->plano_contas_cod_eap($rba)." - ".$this->extratos->plano_contas_nome($rba),
                'doc_referencia' => $this->extratos->doc_referencia($rba),
                'rowSpan' => $countRowSpan[$rba->id]
            );
        }

        return $fillConciliacao;
    }

    public function relatorioBalanceteSintetico($condominios_id,$mesAno) {

        $relatorioBalanceteSintetico = array();

        $mes = substr($mesAno, 0,2);
        $ano = substr($mesAno, 3,7);
        $ultimo_dia = date("t", mktime(0,0,0,$mes,'01',$ano));
        $periodo_ini = $ano."-".$mes."-01";
        $periodo_fim = $ano."-".$mes."-".$ultimo_dia;

        $relatorioBalanceteSintetico = $this->fillBalanceteSintetico($condominios_id, $periodo_ini, $periodo_fim);

        return $relatorioBalanceteSintetico;
    }

    private function fillBalanceteSintetico($condominios_id, $periodo_ini, $periodo_fim) {

        $fillBalanceteSintetico = array();

        $saldoAnterior = $this->caixa->saldoAnterior($condominios_id, $periodo_ini);
        $t = new FrozenTime($periodo_fim);
        $t = $t->modify("+1 day");
    
        $saldoCaixa = $this->caixa->saldoAnterior($condominios_id, $t->format("Y-m-d"));

        $aplicadoMes = $this->aplicacoes->aplicadoPeriodo($condominios_id, $periodo_ini, $periodo_fim);

        $dataSaldoAplicacaoMesAnterior = new FrozenTime($periodo_ini);

        $saldoAplicacaoMesAnterior = $this->aplicacoes->aplicadoPeriodo($condominios_id, null, $dataSaldoAplicacaoMesAnterior->format("Y-m-d")); 

        $rendimentoAplicacaoMes = $this->aplicacoes->rendimentoAplicadoPeriodo($condominios_id, $periodo_ini, $periodo_fim);

        $saldoAplicacoes = $this->aplicacoes->aplicadoPeriodo($condominios_id, null, "2016-08-30"); 

        $saldoExtratoAplicacoes = bcadd($saldoCaixa, $saldoAplicacoes, 2);

        $fillBalanceteSintetico['saldoAnterior'] = $saldoAnterior;
        $fillBalanceteSintetico['saldoCaixa'] = $saldoCaixa;
        $fillBalanceteSintetico['saldoAplicacaoMesAnterior'] = $saldoAplicacaoMesAnterior;
        $fillBalanceteSintetico['aplicadoMes'] = $aplicadoMes;
        $fillBalanceteSintetico['rendimentoAplicacaoMes'] = $rendimentoAplicacaoMes;
        $fillBalanceteSintetico['saldoAplicacoes'] = $saldoAplicacoes;
        $fillBalanceteSintetico['saldoExtratoAplicacoes'] = $saldoExtratoAplicacoes;

        $queryEapPC = TableRegistry::get('planoContas')->find()->where(['condominios_id' => $condominios_id])->order(['cod_eap' => 'ASC']);

        foreach ($queryEapPC as $key => $value) {
            
            $valor = $this->planoContas->valorCodEap($this->planoContas->idFilhos($value->id),  $periodo_ini, $periodo_fim);
            $fillBalanceteSintetico['pc'][] = array('cod_eap' => $value->cod_eap, 'nome' => $value->nome, 'valor'=>$valor);
        }
       
        return $fillBalanceteSintetico;
    }

}

?>