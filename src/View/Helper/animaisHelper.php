<?php
namespace App\View\Helper;


use Cake\View\Helper;
use App\View\AppView;
use Cake\I18n\Time;


class animaisHelper extends Helper
{

	/**
	 * @param string|null $desc Aplicacoes descricao
     * @param string|null $e_hist Extatos historico
     * @return a descrição 
     * @throws \Cake\Network\Exception\NotFoundException When record not found
	 **/
	public function diasPassados($data){

		$time = Time::now();

		if($time > $data) {
			$diferenca = date_diff($time, $data);
		
    		return $diferenca->format('%a d');
    	}else{
    		return "";
    	}
	}

}