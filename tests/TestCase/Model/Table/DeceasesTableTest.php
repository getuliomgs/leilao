<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DeceasesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DeceasesTable Test Case
 */
class DeceasesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DeceasesTable
     */
    public $Deceases;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.deceases'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Deceases') ? [] : ['className' => 'App\Model\Table\DeceasesTable'];
        $this->Deceases = TableRegistry::get('Deceases', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Deceases);

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
