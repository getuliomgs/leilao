<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AReceberContasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AReceberContasTable Test Case
 */
class AReceberContasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AReceberContasTable
     */
    public $AReceberContas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.a_receber_contas',
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
        $config = TableRegistry::exists('AReceberContas') ? [] : ['className' => 'App\Model\Table\AReceberContasTable'];
        $this->AReceberContas = TableRegistry::get('AReceberContas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AReceberContas);

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
