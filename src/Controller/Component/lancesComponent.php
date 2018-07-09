<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\TableRegistry;
use Cake\I18n\FrozenTime;
use Cake\Mailer\Email;


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
        $query->contain(['Users',  'Animais']);
        $query->where(['animais_id' => $id_animal]);
        $query->orderdesc('lances__valor');
        $query->limit(1);

        foreach ($query as $key => $value) {
            return $value;
        }
        return $return;
    }

    /**
     * comunicarLance method
     *
     * @param objeto lance
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function comunicarLance($lance){
        $query = TableRegistry::get('lances')->find();
        $query->contain(['Users',  'Animais']);
        $query->where(['animais_id' => $lance->animais_id]);
        $query->group('Users.username');

        foreach ($query as $key => $value) {
            if($lance->users_id == $value->user->id){
                //debug($value->user->username);  
                $email = new Email('default');
                $email->from(['haras@harasluanda.com.br' => 'Haras Luanda - Site'])
                ->to($this->request->session()->read()['Auth']['User']['username'])
                ->replyTo('haras@harasluanda.com.br')
                ->emailFormat('html')
                ->subject('Lance - Haras Luanda')
                ->send(
                    
                    'Prezado(a), '.$this->request->session()->read()['Auth']['User']['username'].' <br /><br />'.

                    'Parabéns, <br /><br />'.

                    'Seu lance no lote '.$lance->animais_id.' foi computado com sucesso.<br /><br />'.

                    'Caso seu lance seja o vencedor nosso comercial@harasluanda.com.br entrara em contato.<br /><br />'.
                    
                    'Atenciosamente,<br />'. 
                    'Equipe Haras Luanda <br />'.
                    'haras@harasluanda.com.br<br />
                    Rodrigo Vilas Boas (Administrador): (71) 99958-6750<br />
                    Av. Alphaville, nº 522, Quadra F4 Lote 01, Ed. Alpha Business 3º Andar, Sala 302, Alphaville I Salvador - Bahia - Brasil CEP: 41701-015'
                );
  
                //seu lance foi computado
            }else{
                //debug($value->user->username);    
                $email = new Email('default');
                $email->from(['haras@harasluanda.com.br' => 'Haras Luanda - Site'])
                ->to($value->user->username)
                ->replyTo('haras@harasluanda.com.br')
                ->emailFormat('html')
                ->subject('Lance - Haras Luanda')
                ->send(
                    
                    'Prezado(a), '.$value->user->username.' <br /><br />'.

                    'Seu lance no lote '.$lance->animais_id.' foi superado.<br /><br />'.

                    'Não perca essa oportunidade.<br /><br />'.

                    '<a href="http://harasluanda.com.br/leilao/animais/leilao/'.$lance->animais_id.'"><h2>Clique aqui e retome o seu lance!</h2></a><br /><br />'.
                    
                    'Atenciosamente,<br />'. 
                    'Equipe Haras Luanda <br />'.
                    'haras@harasluanda.com.br<br />
                    Rodrigo Vilas Boas (Administrador): (71) 99958-6750<br />
                    Av. Alphaville, nº 522, Quadra F4 Lote 01, Ed. Alpha Business 3º Andar, Sala 302, Alphaville I Salvador - Bahia - Brasil CEP: 41701-015'
                );
            }
            //um novo lance foi dado para esse Lote ??
        }
        
    }
}

?>
