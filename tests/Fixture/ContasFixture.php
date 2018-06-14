<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ContasFixture
 *
 */
class ContasFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'condominios_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'codigo_banco' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'nome' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'agencia' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'agencia_digito' => ['type' => 'string', 'fixed' => true, 'length' => 10, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'numero_conta' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'digito_conta' => ['type' => 'string', 'fixed' => true, 'length' => 10, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nome_contato' => ['type' => 'string', 'length' => 150, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'telefone' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'celular' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'ac_conta_FKIndex1' => ['type' => 'index', 'columns' => ['condominios_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'contas_ibfk_1' => ['type' => 'foreign', 'columns' => ['condominios_id'], 'references' => ['condominios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'condominios_id' => 1,
            'codigo_banco' => 'Lorem ipsum dolor ',
            'nome' => 'Lorem ipsum dolor sit amet',
            'agencia' => 'Lorem ipsum dolor ',
            'agencia_digito' => 'Lorem ip',
            'numero_conta' => 'Lorem ipsum dolor ',
            'digito_conta' => 'Lorem ip',
            'nome_contato' => 'Lorem ipsum dolor sit amet',
            'telefone' => 'Lorem ipsum dolor ',
            'celular' => 'Lorem ipsum dolor '
        ],
    ];
}
