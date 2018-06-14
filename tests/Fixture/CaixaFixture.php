<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CaixaFixture
 *
 */
class CaixaFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'caixa';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'plano_contas_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'a_pagar_contas_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'a_receber_contas_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fornecedores_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'descricao' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'valor' => ['type' => 'decimal', 'length' => 15, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'saldo' => ['type' => 'decimal', 'length' => 15, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'data_referencia' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'data_pagamento' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'doc_referencia' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'users_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'a_pagar_contas_id' => ['type' => 'index', 'columns' => ['a_pagar_contas_id'], 'length' => []],
            'a_receber_contas_id' => ['type' => 'index', 'columns' => ['a_receber_contas_id'], 'length' => []],
            'users_id' => ['type' => 'index', 'columns' => ['users_id'], 'length' => []],
            'plano_contas_id' => ['type' => 'index', 'columns' => ['plano_contas_id'], 'length' => []],
            'fornecedores_id' => ['type' => 'index', 'columns' => ['fornecedores_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'plano_contas_id' => 1,
            'a_pagar_contas_id' => 1,
            'a_receber_contas_id' => 1,
            'fornecedores_id' => 1,
            'descricao' => 'Lorem ipsum dolor sit amet',
            'valor' => 1.5,
            'saldo' => 1.5,
            'data_referencia' => '2017-08-02',
            'data_pagamento' => '2017-08-02',
            'doc_referencia' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-08-02 02:55:58',
            'users_id' => 1,
            'modified' => '2017-08-02 02:55:58'
        ],
    ];
}
