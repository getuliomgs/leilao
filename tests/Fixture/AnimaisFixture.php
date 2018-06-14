<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AnimaisFixture
 *
 */
class AnimaisFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nome' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'sexo' => ['type' => 'string', 'fixed' => true, 'length' => 3, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'data_nasc' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'raca' => ['type' => 'string', 'fixed' => true, 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'pelagem' => ['type' => 'string', 'fixed' => true, 'length' => 50, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'localizacao' => ['type' => 'string', 'fixed' => true, 'length' => 50, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'status_2' => ['type' => 'string', 'fixed' => true, 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'link_video' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'foto_1' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'foto_2' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'foto_3' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'foto_4' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'geneologia' => ['type' => 'string', 'length' => 250, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'valor' => ['type' => 'decimal', 'length' => 15, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'parcelas' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'data_leilao_ini' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'data_leilao_fim' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
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
            'nome' => 'Lorem ipsum dolor sit amet',
            'sexo' => 'L',
            'data_nasc' => '2018-05-24',
            'raca' => 'Lorem ipsum dolor sit amet',
            'pelagem' => 'Lorem ipsum dolor sit amet',
            'localizacao' => 'Lorem ipsum dolor sit amet',
            'status_2' => 'Lorem ipsum dolor sit amet',
            'link_video' => 'Lorem ipsum dolor sit amet',
            'foto_1' => 'Lorem ipsum dolor sit amet',
            'foto_2' => 'Lorem ipsum dolor sit amet',
            'foto_3' => 'Lorem ipsum dolor sit amet',
            'foto_4' => 'Lorem ipsum dolor sit amet',
            'geneologia' => 'Lorem ipsum dolor sit amet',
            'valor' => 1.5,
            'parcelas' => 1,
            'data_leilao_ini' => '2018-05-24 15:02:22',
            'data_leilao_fim' => '2018-05-24 15:02:22',
            'created' => '2018-05-24 15:02:22',
            'modified' => '2018-05-24 15:02:22'
        ],
    ];
}
