<?php
namespace App\View\Helper;


use Cake\View\Helper;
use App\View\AppView;

class aplicacoesHelper extends Helper
{

	/**
	 * @param string|null $desc Aplicacoes descricao
     * @param string|null $e_hist Extatos historico
     * @return a descrição 
     * @throws \Cake\Network\Exception\NotFoundException When record not found
	 **/
	public function descricao( $desc = NULL, $e_hist = NULL) {

		$r = "";
		if(empty($desc)){
			if(isset($e_hist)) {
				$r = $e_hist;
			}
		}else{
			$r = $desc;
		}
		return $r;
	}

	/**
     * @param date|null $date Aplicacoes date
     * @param date|null $d_mo Extratos date_movimentcao
     * @return a data
     * @throws 
	 **/
	public function data( $date = NULL, $d_mo = NULL) {

		$r = "";
		if(empty($date)){
			if(isset($d_mo)) {
				$r = $d_mo;
			}
		}else{
			$r = $date;
		}
		$r = @AppView::data($r);
		return $r;
	}

	/**
     * @param decimal|null $valor Aplicacoes valor
     * @param decimal|null $e_valor Extratos valor
     * @return a valor
     * @throws 
	 **/
	public function valor( $valor = NULL, $e_valor = NULL) {

		$r = (float)0;
		if(empty($valor)){
			if(isset($e_valor)) {
				$r = bcmul(-1, $e_valor, 2);
			}
		}else{
			$r = $valor;
		}
		return $r;
	}

}