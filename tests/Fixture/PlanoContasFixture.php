<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlanoContasFixture
 *
 */
class PlanoContasFixture extends TestFixture
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
        'condominios_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nome' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cod_eap' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'tipo' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'PlanoContas_FKIndex1' => ['type' => 'index', 'columns' => ['condominios_id'], 'length' => []],
            'plano_contas_FKIndex2' => ['type' => 'index', 'columns' => ['plano_contas_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'plano_contas_ibfk_1' => ['type' => 'foreign', 'columns' => ['condominios_id'], 'references' => ['condominios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'condominios_id' => 1,
            'nome' => 'Lorem ipsum dolor sit amet',
            'cod_eap' => 'Lorem ipsum dolor ',
            'tipo' => 'Lorem ipsum dolor '
        ],
    ];
}
