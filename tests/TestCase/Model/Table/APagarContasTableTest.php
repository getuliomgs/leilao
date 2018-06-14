<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\APagarContasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\APagarContasTable Test Case
 */
class APagarContasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\APagarContasTable
     */
    public $APagarContas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.a_pagar_contas',
        'app.plano_contas',
        'app.condominios',
        'app.extratos',
        'app.contas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('APagarContas') ? [] : ['className' => 'App\Model\Table\APagarContasTable'];
        $this->APagarContas = TableRegistry::get('APagarContas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->APagarContas);

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
