<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChequesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChequesTable Test Case
 */
class ChequesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChequesTable
     */
    public $Cheques;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cheques',
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
        $config = TableRegistry::exists('Cheques') ? [] : ['className' => 'App\Model\Table\ChequesTable'];
        $this->Cheques = TableRegistry::get('Cheques', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cheques);

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
