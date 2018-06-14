<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class fornecedoresComponent extends Component
{


    public function selectFornecedores($condominios_id = null) {
        
        if($condominios_id){
            $query = TableRegistry::get('fornecedores')->find()
           ->order(['nome' => 'ASC']);
            $query->rightjoin('fornecedores_condominios', ['fornecedores.id = fornecedores_condominios.fornecedores_id' ] );
            if(!empty($condominios_id)){
                $query->where(['fornecedores_condominios.condominios_id' => $condominios_id]);
            }
        }else{
            $query = TableRegistry::get('fornecedores')->find()
            ->order(['nome' => 'ASC']);
        }
        
        $fornecedores = array();
        foreach ($query as $fornecedor)
            $fornecedores[$fornecedor->id] = $fornecedor->nome;

        return $fornecedores;
    }

    /**
     *
     *Retorna array com id dos fornecedores 
     * ideal para IN em query usanodo implode
     **/
    public function idFornecedores($condominios_id = null){

        if($condominios_id){
            $query = TableRegistry::get('fornecedores')->find()
            ->where(['fornecedores.condominios_id' => $condominios_id ]);
        }else{
            $query = TableRegistry::get('fornecedores')->find();
        }
        
        ;
        $fornecedores = array();
        foreach ($query as $fornecedor)
            array_push($fornecedores, $fornecedor->id);

        return $fornecedores;
    }

    public function selectFornecedor($fornecedores_id = null){

        if($fornecedores_id){
            $query = TableRegistry::get('fornecedores')->find()
            ->where(['id' => $fornecedores_id ]);
        }else{
            return $fornecedores_id;
        }
        
        ;
        $fornecedores = null;
        foreach ($query as $fornecedor)
            $fornecedores = $fornecedor;

        return $fornecedores;

    }

    /**
     * selectAjax method
     *
     * @param int|null $id fornecedores id.
     * @param int|null $condominios_id condominios id
     * @return combo select para resposta de ajax
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function formSelectAjax($id = null, $condominios_id) {
        
        $query = TableRegistry::get('fornecedores')->find()
        ->order(['nome' => 'ASC']);
        $query->rightjoin('fornecedores_condominios', ['fornecedores.id = fornecedores_condominios.fornecedores_id' ] );
        $query->where(['fornecedores_condominios.condominios_id' => $condominios_id]);
        $formSelect = '
            <div class="input select">
                <label for="fornecedores-id">Fornecedores</label>
                <select name="fornecedores_id" id="fornecedores-id">
                    <option value="0">Selecione</option>';
                    foreach ($query as $fornecedor) {
                        if($fornecedor->id == $id) {
                            $selected = "selected";
                        }else{
                            $selected = "";
                        }
                        $formSelect .= '<option value="'.$fornecedor->id.'"'.$selected.'>'.$fornecedor->nome.' - CNPJ/CPF:'.$fornecedor->cnpj.$fornecedor->cpf.'</option>';
                    }
        $formSelect .= 
                '</select>
            </div>';
        return $formSelect;
    }
}

?>