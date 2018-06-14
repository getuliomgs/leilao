<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FornecedoresCondominiosFixture
 *
 */
class FornecedoresCondominiosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fornecedores_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'condominios_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fornecedores_id' => ['type' => 'index', 'columns' => ['fornecedores_id'], 'length' => []],
            'condominios_id' => ['type' => 'index', 'columns' => ['condominios_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fornecedores_condominios_ibfk_1' => ['type' => 'foreign', 'columns' => ['condominios_id'], 'references' => ['condominios', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'fornecedores_condominios_ibfk_2' => ['type' => 'foreign', 'columns' => ['fornecedores_id'], 'references' => ['fornecedores', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'fornecedores_id' => 1,
            'condominios_id' => 1
        ],
    ];
}
