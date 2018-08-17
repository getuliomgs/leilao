<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LeiloesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LeiloesTable Test Case
 */
class LeiloesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LeiloesTable
     */
    public $Leiloes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.leiloes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Leiloes') ? [] : ['className' => 'App\Model\Table\LeiloesTable'];
        $this->Leiloes = TableRegistry::get('Leiloes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Leiloes);

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
