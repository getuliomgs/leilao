<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ExtratosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ExtratosTable Test Case
 */
class ExtratosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ExtratosTable
     */
    public $Extratos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.extratos',
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
        $config = TableRegistry::exists('Extratos') ? [] : ['className' => 'App\Model\Table\ExtratosTable'];
        $this->Extratos = TableRegistry::get('Extratos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Extratos);

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
