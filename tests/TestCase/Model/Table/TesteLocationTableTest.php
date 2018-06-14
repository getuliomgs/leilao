<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TesteLocationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TesteLocationTable Test Case
 */
class TesteLocationTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TesteLocationTable
     */
    public $TesteLocation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teste_location'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TesteLocation') ? [] : ['className' => 'App\Model\Table\TesteLocationTable'];
        $this->TesteLocation = TableRegistry::get('TesteLocation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TesteLocation);

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
