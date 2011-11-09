<?php
require_once 'Abstract.php';
/**
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */
class DnsFunctionsTest extends Whm_Test_Abstract
{
    /**
     * @var accountFunctions
     */
    private $accountFunctions;
    /**
     * @var dnsFunctions
     */
    private $dnsFunctions;    

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->account = new Whm_Account_Create($this->testUserName,$this->testDomainName);
        $this->accountFunctions = Whm::getInstance('Account', $this->config);
        $this->accountFunctions->createacct($this->account);
        $this->dnsFunctions = Whm::getInstance('Dns', $this->config);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        parent::tearDown();
        $this->accountFunctions->removeacct($this->testUserName,false);
        $this->accountFunctions = null;
        $this->dnsFunctions = null;
    }
    /**
     * Constructs the test case.
     */
    public function __construct ()
    {    // TODO Auto-generated constructor
    }
    /**
     *
     * test for a dns zone you know exists
     */
    public function testDumpzoneSuccess()
    {
      $response = $this->dnsFunctions->dumpzone($this->testDomainName);
      $this->assertObjectHasAttribute('result',$response);
      $this->assertEquals(1, $response->result[0]->status);
    }
    
    /**
     *
     * Tests dumpzone for a zone that doesn't exist
     */
    public function testDumpzoneFailure()
    {
      $response = $this->dnsFunctions->dumpzone('xdfd.com');
      $this->assertObjectHasAttribute('result',$response);;
      $this->assertEquals(0, $response->result[0]->status);
    }
    
    /**
     * Tests dnsFunctions->getzonerecord()
     */
    public function testGetzonerecord ()
    {
        $response = $this->dnsFunctions->getzonerecord($this->testDomainName,'11');
        $this->assertEquals(
            1,
            intval($response->result[0]->status),
            $response->result[0]->statusmsg
        );
    }
    /**
     * Tests dnsFunctions->listzones()
     */
    public function testListzones ()
    {
        $response = $this->dnsFunctions->listzones(/* parameters */);
        $this->assertObjectHasAttribute('zone',$response);
    }
    
    public function testLookupnsip()
    {
        $response = $this->dnsFunctions->lookupnsip("ns1.webselect.com.au");
        $this->assertObjectHasAttribute('ip',$response);
    }
}

