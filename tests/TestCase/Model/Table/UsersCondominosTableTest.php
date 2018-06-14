<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersCondominosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersCondominosTable Test Case
 */
class UsersCondominosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersCondominosTable
     */
    public $UsersCondominos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_condominos',
        'app.users',
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
        $config = TableRegistry::exists('UsersCondominos') ? [] : ['className' => 'App\Model\Table\UsersCondominosTable'];
        $this->UsersCondominos = TableRegistry::get('UsersCondominos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersCondominos);

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
