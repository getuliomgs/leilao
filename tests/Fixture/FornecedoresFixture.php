<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * FornecedoresFixture
 *
 */
class FornecedoresFixture extends TestFixture
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
        'nome' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cnpj' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'cpf' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'endereco' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'numero_endereco' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'complemento_endereco' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cidade' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'estado' => ['type' => 'string', 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'cep' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nome_contato' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'telefone' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'celular' => ['type' => 'string', 'fixed' => true, 'length' => 20, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'email' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        '_indexes' => [
            'Fornecedores_FKIndex1' => ['type' => 'index', 'columns' => ['condominios_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fornecedores_ibfk_1' => ['type' => 'foreign', 'columns' => ['condominios_id'], 'references' => ['condominios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'nome' => 'Lorem ipsum dolor sit amet',
            'cnpj' => 'Lorem ipsum dolor ',
            'cpf' => 'Lorem ipsum dolor ',
            'endereco' => 'Lorem ipsum dolor sit amet',
            'numero_endereco' => 'Lorem ipsum dolor ',
            'complemento_endereco' => 'Lorem ipsum dolor sit amet',
            'cidade' => 'Lorem ipsum dolor sit amet',
            'estado' => 'Lorem ipsum dolor ',
            'cep' => 'Lorem ipsum dolor ',
            'nome_contato' => 'Lorem ipsum dolor sit amet',
            'telefone' => 'Lorem ipsum dolor ',
            'celular' => 'Lorem ipsum dolor ',
            'email' => 'Lorem ipsum dolor sit amet'
        ],
    ];
}
