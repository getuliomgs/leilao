<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CondominosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CondominosTable Test Case
 */
class CondominosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CondominosTable
     */
    public $Condominos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.condominos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Condominos') ? [] : ['className' => 'App\Model\Table\CondominosTable'];
        $this->Condominos = TableRegistry::get('Condominos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Condominos);

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
