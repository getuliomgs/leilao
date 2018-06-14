<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LancesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LancesTable Test Case
 */
class LancesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LancesTable
     */
    public $Lances;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lances',
        'app.users',
        'app.animais'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Lances') ? [] : ['className' => 'App\Model\Table\LancesTable'];
        $this->Lances = TableRegistry::get('Lances', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Lances);

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
