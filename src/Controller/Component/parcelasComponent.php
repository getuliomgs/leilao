<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class parcelasComponent extends Component
{

	/**
     * selectAjax method
     *
     * @param int|null $id parcelas id.
     * @param int|null $condominios_id condominios id
     * @return combo select para resposta de ajax
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
	public function formSelectAjax($id = null, $condominios_id) {

		$query = TableRegistry::get('parcelas')->find()
            ->select([ 'id', 'nome',  'condominos.nome','condominos.cpf', 'condominos.cnpj'])
            ->leftJoin('condominos', ['parcelas.condominos_id = condominos.id']);
            $query->where(['condominios_id' => $condominios_id]);
            $query->order(['parcelas.nome' => 'ASC']);
        $formSelect = '
        	<div class="input select">
    			<label for="parcelas-id">Parcelas</label>
				<select name="parcelas_id" id="parcelas-id">
        			<option value="0">Selecione</option>';
			        foreach ($query as $parcela) {
			        	if($parcela->id == $id) {
			        		$selected = "selected";
			        	}else{
			        		$selected = "";
			        	}
			            $formSelect .= '<option value="'.$parcela->id.'"'.$selected.'>'.$parcela->nome.' - '.$parcela['condominos']['nome'].' - CPF/CNPJ: '.$parcela['condominos']['cpf'].$parcela['condominos']['cnpj'].'</option>';
			        }
        $formSelect .= 
        		'</select>
    		</div>';
    	return $formSelect;
	}

    /**
     * selectx method
     *
     * @param int|null $id parcelas id.
     * @param int|null $condominios_id condominios id
     * @return combo select para resposta de ajax
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function select($condominios_id) {

        $query = TableRegistry::get('parcelas')->find()
            ->select([ 'id', 'nome',  'condominos.nome','condominos.cpf', 'condominos.cnpj'])
            ->leftJoin('condominos', ['parcelas.condominos_id = condominos.id']);
            $query->where(['condominios_id' => $condominios_id]);
            $query->order(['parcelas.nome' => 'ASC']);      
            $parcelas = array();
            foreach ($query as $parcela) {
                $parcelas[$parcela->id] = $parcela->nome.' - '.$parcela['condominos']['nome'].' - CPF/CNPJ: '.$parcela['condominos']['cpf'].$parcela['condominos']['cnpj'];
            }
        return $parcelas;
    }

}