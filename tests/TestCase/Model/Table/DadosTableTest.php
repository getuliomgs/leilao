<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DadosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DadosTable Test Case
 */
class DadosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DadosTable
     */
    public $Dados;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dados',
        'app.users'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dados') ? [] : ['className' => 'App\Model\Table\DadosTable'];
        $this->Dados = TableRegistry::get('Dados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dados);

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
