<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FornecedoresCondominiosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FornecedoresCondominiosTable Test Case
 */
class FornecedoresCondominiosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FornecedoresCondominiosTable
     */
    public $FornecedoresCondominios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.fornecedores_condominios',
        'app.fornecedores',
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
        $config = TableRegistry::exists('FornecedoresCondominios') ? [] : ['className' => 'App\Model\Table\FornecedoresCondominiosTable'];
        $this->FornecedoresCondominios = TableRegistry::get('FornecedoresCondominios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FornecedoresCondominios);

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
