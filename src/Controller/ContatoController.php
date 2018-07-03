<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;

class ContatoController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['index']);
    }

	public function index()
    {
	   	if($this->request->is('post')) {
	    	$email = new Email('default');
			$email->from(['haras@harasluanda.com.br' => 'Haras Luanda - Site Formulário de Contato'])
	    		->to('haras@harasluanda.com.br')
	    		->bcc('getulio.sena.junior@gmail.com')
	    		->replyTo($this->request->data['email'])
	    		 ->emailFormat('html')
	    		->subject('Contato do Site Haras Luanda')
	    		->send(
	    			'<h2> Contato do Site Haras Luanda</h2><br />'.'Nome: '.$this->request->data['nome'].'<br />'.'Email: '.$this->request->data['email'].'<br />'.'Telefone: '.$this->request->data['telefone'].'<br />'.'Mensagem: '.$this->request->data['mensagem'].'<br />'
	    		);
	    		 $this->Flash->success(__('Contato enviado com sucesso!'));
	    }

    }
}