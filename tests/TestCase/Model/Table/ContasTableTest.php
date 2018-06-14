<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContasTable Test Case
 */
class ContasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ContasTable
     */
    public $Contas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.contas',
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
        $config = TableRegistry::exists('Contas') ? [] : ['className' => 'App\Model\Table\ContasTable'];
        $this->Contas = TableRegistry::get('Contas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Contas);

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
