<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;


class animaisComponent extends Component {

	//public $components = array('lances');


    public function listarAnimais(){

        $return = array();
        

        $query = TableRegistry::get('animais')->find();
        $query->where(['status_2' => 'A']);
        $return = $query;

        return $return;
    }

    /**
     *
     * flag de aberto e fechado dependendo da data de ínicio e fim 
     * 
    */
    public function flagLeilao($inicio, $fim, $time){
    	$flagLeilao = "";
		if($time > $inicio){
	        if($time < $fim){
	            $flagLeilao = "ABE";
	        }else{
	            $flagLeilao = "FEC";
	        }
	    }elseif($time > $fim){
	        $flagLeilao = "FEC";
	    }else{
	        $flagLeilao = "EMB";
	    }
	    return $flagLeilao;
	}
}

?>
