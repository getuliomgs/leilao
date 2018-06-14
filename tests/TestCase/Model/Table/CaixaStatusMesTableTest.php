<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CaixaStatusMesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CaixaStatusMesTable Test Case
 */
class CaixaStatusMesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CaixaStatusMesTable
     */
    public $CaixaStatusMes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.caixa_status_mes',
        'app.users',
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
        $config = TableRegistry::exists('CaixaStatusMes') ? [] : ['className' => 'App\Model\Table\CaixaStatusMesTable'];
        $this->CaixaStatusMes = TableRegistry::get('CaixaStatusMes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CaixaStatusMes);

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
