<?php
require_once 'Abstract.php';

/**
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */
class Whm_Test_Adhoc extends Whm_Test_Abstract
{
    /**
     * @var whmAccountModel
     */
    private $accountFunctions;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->account = new Whm_Account_Create($this->testUserName,$this->testDomainName);
        $this->accountFunctions = Whm::getInstance('Account', $this->config);
        $this->accountFunctions->createacct($this->account);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        parent::tearDown();
        $this->accountFunctions->removeacct($this->testUserName,false);
        $this->accountFunctions = null;
    }
    /**
     * Constructs the test case.
     */
    public function __construct ()
    {    // TODO Auto-generated constructor
    }
    /**
     * Tests whmAccountModel->domainuserdata()
     */
    public function testDomainuserdata ()
    {
        $response = $this->accountFunctions->domainuserdata($this->testDomainName);
        $this->assertObjectHasAttribute('userdata', $response);
        $this->assertObjectHasAttribute('result', $response);
        $this->assertEquals(1, $response->result[0]->status);
    }
}