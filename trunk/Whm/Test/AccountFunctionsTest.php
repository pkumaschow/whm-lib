<?php
require_once 'Abstract.php';
/**
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */
class AccountFunctionsTest extends Whm_Test_Abstract
{
    /**
     * @var accountFunctions
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
     * Tests accountFunctions->accountsummary()
     */
    public function testAccountsummary ()
    {
        
        $response = $this->accountFunctions->accountsummary($this->testUserName);
        $this->assertObjectHasAttribute('acct', $response);
        $this->accountFunctions->removeacct($this->testUserName,false);
    }
    /**
     * Tests accountFunctions->changepackage()
     */
    public function testChangepackage ()
    {
        // TODO Auto-generated accountFunctionsTest->testChangepackage()
        $this->markTestIncomplete(
        "changepackage test not implemented");
        $this->accountFunctions->changepackage(/* parameters */);
    }
    /**
     * Tests accountFunctions->createacct()
     */
    public function testCreateacct ()
    {
        $account = new Whm_Account_Create('unittest2','unittest2.com.au');
        $response = $this->accountFunctions->createacct($account);
        $this->assertObjectHasAttribute('result', $response);
        $this->assertEquals(1, $response->result[0]->status);
    }
    /**
     * Tests accountFunctions->domainuserdata()
     */
    public function testDomainuserdata ()
    {
        $response = $this->accountFunctions->domainuserdata($this->testDomainName);
        $this->assertObjectHasAttribute('userdata', $response);
        $this->assertObjectHasAttribute('result', $response);
        $this->assertEquals(1, $response->result[0]->status);
    }
    /**
     * Tests accountFunctions->editquota()
     */
    public function testEditquota ()
    {
        // TODO Auto-generated accountFunctionsTest->testEditquota()
        $this->markTestIncomplete(
        "editquota test not implemented");
        $this->accountFunctions->editquota(/* parameters */);
    }
    /**
     * Tests accountFunctions->listaccts()
     */
    public function testListaccts ()
    {
        $response = $this->accountFunctions->listaccts();
        $this->log($response->acct);
        $this->assertObjectHasAttribute('acct', $response);;
        $this->assertEquals(1, $response->status);        
    }
    /**
     * Tests accountFunctions->listsuspended()
     */
    public function testListsuspended ()
    {
        // TODO Auto-generated accountFunctionsTest->testListsuspended()
        $this->markTestIncomplete(
        "listsuspended test not implemented");
        $this->accountFunctions->listsuspended(/* parameters */);
    }
    /**
     * Tests accountFunctions->modifyacct()
     */
    public function testModifyacct ()
    {
        $feature = new Whm_Feature_Account_Modify('maxftp', 7);
        $account2Modify = new Whm_Account_Modify($this->testUserName, $feature);
        $response = $this->accountFunctions->modifyacct($account2Modify);
        $this->assertObjectHasAttribute('newcfg', $response->result[0]);
    }
    /**
     * Tests accountFunctions->myprivs()
     */
    public function testMyprivs ()
    {
        // TODO Auto-generated accountFunctionsTest->testMyprivs()
        $this->markTestIncomplete(
        "myprivs test not implemented");
        $this->accountFunctions->myprivs(/* parameters */);
    }
    /**
     * Tests accountFunctions->passwd()
     */
    public function testPasswd ()
    {
        $response = $this->accountFunctions->passwd($this->testUserName, 'testpass');
        $this->assertObjectHasAttribute('passwd', $response);
        $this->assertEquals(1, $response->passwd[0]->status);
    }
    /**
     * Tests accountFunctions->removeacct()
     */
    public function testRemoveacct ()
    {
        $response = $this->accountFunctions->removeacct('unittest2',false);
        $this->assertObjectHasAttribute('result', $response);
        $this->assertEquals(1, $response->result[0]->status);
    }
    /**
     * Tests accountFunctions->restoreaccount()
     */
    public function testRestoreaccount ()
    {
        // TODO Auto-generated accountFunctionsTest->testRestoreaccount()
        $this->markTestIncomplete(
        "restoreaccount test not implemented");
        $this->accountFunctions->restoreaccount(/* parameters */);
    }
    /**
     * Tests accountFunctions->setsiteip()
     */
    public function testSetsiteip ()
    {
        // TODO Auto-generated accountFunctionsTest->testSetsiteip()
        $this->markTestIncomplete(
        "setsiteip test not implemented");
        $this->accountFunctions->setsiteip(/* parameters */);
    }
    /**
     * Tests accountFunctions->suspendacct()
     */
    public function testSuspendacct ()
    {
        // TODO Auto-generated accountFunctionsTest->testSuspendacct()
        $this->markTestIncomplete(
        "suspendacct test not implemented");
        $this->accountFunctions->suspendacct(/* parameters */);
    }
    /**
     * Tests accountFunctions->unsuspendacct()
     */
    public function testUnsuspendacct ()
    {
        // TODO Auto-generated accountFunctionsTest->testUnsuspendacct()
        $this->markTestIncomplete(
        "unsuspendacct test not implemented");
        $this->accountFunctions->unsuspendacct(/* parameters */);
    }
}

