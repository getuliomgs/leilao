<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CondominiosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CondominiosTable Test Case
 */
class CondominiosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CondominiosTable
     */
    public $Condominios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Condominios') ? [] : ['className' => 'App\Model\Table\CondominiosTable'];
        $this->Condominios = TableRegistry::get('Condominios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Condominios);

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
}
