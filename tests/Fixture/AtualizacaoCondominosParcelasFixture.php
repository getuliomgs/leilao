<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AtualizacaoCondominosParcelasFixture
 *
 */
class AtualizacaoCondominosParcelasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'parcelas_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'condominos_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'ac_data_codominio_parcela_FKIndex1' => ['type' => 'index', 'columns' => ['condominos_id'], 'length' => []],
            'ac_data_codomino_parcela_FKIndex2' => ['type' => 'index', 'columns' => ['parcelas_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'atualizacao_condominos_parcelas_ibfk_1' => ['type' => 'foreign', 'columns' => ['condominos_id'], 'references' => ['condominos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'atualizacao_condominos_parcelas_ibfk_2' => ['type' => 'foreign', 'columns' => ['parcelas_id'], 'references' => ['parcelas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'parcelas_id' => 1,
            'condominos_id' => 1,
            'created' => '2016-03-12 11:33:00',
            'modified' => '2016-03-12 11:33:00'
        ],
    ];
}
