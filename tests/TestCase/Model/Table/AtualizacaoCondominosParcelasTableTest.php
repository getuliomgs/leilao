<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AtualizacaoCondominosParcelasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AtualizacaoCondominosParcelasTable Test Case
 */
class AtualizacaoCondominosParcelasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AtualizacaoCondominosParcelasTable
     */
    public $AtualizacaoCondominosParcelas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.atualizacao_condominos_parcelas',
        'app.parcelas',
        'app.condominios',
        'app.condominos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AtualizacaoCondominosParcelas') ? [] : ['className' => 'App\Model\Table\AtualizacaoCondominosParcelasTable'];
        $this->AtualizacaoCondominosParcelas = TableRegistry::get('AtualizacaoCondominosParcelas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AtualizacaoCondominosParcelas);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
