<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;

class fornecedoresCondominiosComponent extends Component
{
    public function selectedCheckBox($fornecedores_id) {
        $selectedCheckBox = array();
        $query = TableRegistry::get('fornecedoresCondominios')->find()->where(['fornecedores_id' => $fornecedores_id]);
        foreach($query as $fc) {
            array_push($selectedCheckBox, $fc->condominios_id);
        }

        return $selectedCheckBox;
    }

    public function delete($fornecedores_id) {

    	$query = TableRegistry::get('FornecedoresCondominios')->find()->delete()->where(['fornecedores_id' => $fornecedores_id]);
        if($query->execute()){
        } else {
            $this->Flash->error(__('Ocorrel algum erro, Tente Novamente.'));
        }
    }

}   