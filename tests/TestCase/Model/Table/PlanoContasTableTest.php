<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanoContasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanoContasTable Test Case
 */
class PlanoContasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanoContasTable
     */
    public $PlanoContas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.plano_contas',
        'app.condominios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PlanoContas') ? [] : ['className' => 'App\Model\Table\PlanoContasTable'];
        $this->PlanoContas = TableRegistry::get('PlanoContas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlanoContas);

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
