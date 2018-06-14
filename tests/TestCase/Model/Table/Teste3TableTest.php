<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\Teste3Table;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\Teste3Table Test Case
 */
class Teste3TableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\Teste3Table
     */
    public $Teste3;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.teste3'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Teste3') ? [] : ['className' => 'App\Model\Table\Teste3Table'];
        $this->Teste3 = TableRegistry::get('Teste3', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Teste3);

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
