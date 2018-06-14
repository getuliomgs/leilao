<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CaixaTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CaixaTable Test Case
 */
class CaixaTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CaixaTable
     */
    public $Caixa;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.caixa',
        'app.plano_contas',
        'app.condominios',
        'app.a_pagar_contas',
        'app.extratos',
        'app.contas',
        'app.fornecedores',
        'app.a_receber_contas',
        'app.parcelas',
        'app.condominos',
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
        $config = TableRegistry::exists('Caixa') ? [] : ['className' => 'App\Model\Table\CaixaTable'];
        $this->Caixa = TableRegistry::get('Caixa', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Caixa);

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
