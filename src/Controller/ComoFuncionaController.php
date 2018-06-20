<?php
namespace App\Controller;

use App\Controller\AppController;

class ComoFuncionaController extends AppController
{
	public function initialize()
    {
        parent::initialize();
        // Add the 'add' action to the allowed actions list.
        $this->Auth->allow(['index']);
    }

    public function index()
    {

    }
}