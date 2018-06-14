<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


class lancesComponent extends Component {

    /**
     *
     * flag de aberto e fechado dependendo da data de ínicio e fim 
     * 
    */
    public function lances($id_animal){

    	$return = array();
        
        $query = TableRegistry::get('lances')->find();
        $query->where(['animais_id' => $id_animal]);
        $query->orderdesc('valor');
        $query->limit(5);

        $return = $query;

        return $return;
	}

    public function lanceMaior($id_animal){

        $return = array();
        
        $query = TableRegistry::get('lances')->find();
        $query->where(['animais_id' => $id_animal]);
        $query->orderdesc('valor');
        $query->limit(1);

        foreach ($query as $key => $value) {
            return $value;
        }
        return $return;
    }
}

?>
