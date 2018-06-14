<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AReceberContasFixture
 *
 */
class AReceberContasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'plano_contas_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'extratos_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'descricao' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'tipo' => ['type' => 'string', 'fixed' => true, 'length' => 5, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'valor' => ['type' => 'decimal', 'length' => 15, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'date_pagamento_previsto' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'date_pagamento_real' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'doc_referencia' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'ContasAReceber_FKIndex1' => ['type' => 'index', 'columns' => ['extratos_id'], 'length' => []],
            'contas_a_receber_FKIndex2' => ['type' => 'index', 'columns' => ['plano_contas_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'a_receber_contas_ibfk_1' => ['type' => 'foreign', 'columns' => ['extratos_id'], 'references' => ['extratos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'a_receber_contas_ibfk_2' => ['type' => 'foreign', 'columns' => ['plano_contas_id'], 'references' => ['plano_contas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'extratos_id' => 1,
            'descricao' => 'Lorem ipsum dolor sit amet',
            'tipo' => 'Lor',
            'valor' => 1.5,
            'date_pagamento_previsto' => '2016-03-16',
            'date_pagamento_real' => '2016-03-16',
            'doc_referencia' => 'Lorem ipsum dolor sit amet',
            'created' => '2016-03-16 20:15:11',
            'modified' => '2016-03-16 20:15:11'
        ],
    ];
}
