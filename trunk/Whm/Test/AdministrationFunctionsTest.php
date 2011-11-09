<?php
require_once 'Abstract.php';
/**
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */
class AdministrationFunctionsTest extends Whm_Test_Abstract
{
    /**
     * @var instance of Whm_Administration_Functions
     */
    private $administrationFunctions;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->administrationFunctions = Whm::getInstance('Administration', $this->config);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated administrationFunctionsTest::tearDown()
        $this->administrationFunctions = null;
        parent::tearDown();
    }
    /**
     * Constructs the test case.
     */
    public function __construct ()
    {
        // TODO Auto-generated constructor
    }
    /**
     * Tests administrationFunctions->addip()
     */
    public function testAddip ()
    {
        $response = $this->administrationFunctions->addip($this->config['testip'],$this->config['netmask']);
        $this->assertEquals(1, $response->addip[0]->status,$response->addip[0]->statusmsg);
    }
    /**
     * Tests administrationFunctions->delip()
     */
    public function testDelip ()
    {
        $response = $this->administrationFunctions->delip($this->whm['testip']);
        $this->assertEquals(1, $response->delip[0]->status,$response->delip[0]->statusmsg);
    }
    /**
     * Tests administrationFunctions->listips()
     */
    public function testListips ()
    {
        $response = $this->administrationFunctions->listips();
    }
    /**
     * Tests administrationFunctions->nvget()
     */
    public function testNvget ()
    {
        // TODO Auto-generated administrationFunctionsTest->testNvget()
        $this->markTestIncomplete("nvget test not implemented");
        $this->administrationFunctions->nvget(/* parameters */);
    }
    /**
     * Tests administrationFunctions->nvset()
     */
    public function testNvset ()
    {
        // TODO Auto-generated administrationFunctionsTest->testNvset()
        $this->markTestIncomplete("nvset test not implemented");
        $this->administrationFunctions->nvset(/* parameters */);
    }
    /**
     * Tests administrationFunctions->reboot()
     */
    public function testReboot ()
    {
        // TODO Auto-generated administrationFunctionsTest->testReboot()
        $this->markTestIncomplete("reboot test not implemented");
        $this->administrationFunctions->reboot(/* parameters */);
    }
    /**
     * Tests administrationFunctions->sethostname()
     */
    public function testSethostname ()
    {
        // TODO Auto-generated administrationFunctionsTest->testSethostname()
        $this->markTestIncomplete("sethostname test not implemented");
        $this->administrationFunctions->sethostname(/* parameters */);
    }
    /**
     * Tests administrationFunctions->setresolvers()
     */
    public function testSetresolvers ()
    {
        // TODO Auto-generated administrationFunctionsTest->testSetresolvers()
        $this->markTestIncomplete("setresolvers test not implemented");
        $this->administrationFunctions->setresolvers(/* parameters */);
    }
    /**
     * Tests administrationFunctions->showbw()
     */
    public function testShowbw ()
    {
        // TODO Auto-generated administrationFunctionsTest->testShowbw()
        $this->markTestIncomplete("showbw test not implemented");
        $this->administrationFunctions->showbw(/* parameters */);
    }
}

