<?php
require_once 'Abstract.php';
/**
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */
class AbstractFunctionsTest extends Whm_Test_Abstract
{
    /**
     * @var abstractFunctions
     */
    private $abstractFunctions;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->abstractFunctions = Whm::getInstance('Package', $this->config);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->abstractFunctions = null;
        parent::tearDown();
    }
    /**
     * Constructs the test case.
     */
    public function __construct ()
    {    // TODO Auto-generated constructor
    }

    /**
     * Tests abstractFunctions->setMethod()
     */
    public function testSetMethod ()
    {
        $this->abstractFunctions->setMethod('testMethod');
        $this->assertEquals('testMethod',$this->abstractFunctions->getMethod());
    }
    /**
     * Tests abstractFunctions->getMethod()
     */
    public function testGetMethod ()
    {
        $this->abstractFunctions->setMethod('testMethod');
        $this->assertEquals('testMethod',$this->abstractFunctions->getMethod());
    }
    /**
     * Tests abstractFunctions->setApi()
     */
    public function testSetApi ()
    {
        $this->abstractFunctions->setApi('json');
        
    }
    /**
     * Tests abstractFunctions->getApi()
     */
    public function testGetApi ()
    {
        $this->assertEquals('json',$this->abstractFunctions->getApi());
    }
    /**
     * Tests abstractFunctions->setParams()
     */
    public function testSetParams ()
    {
        $this->abstractFunctions->setParams(array('x'=>1));
        $params = $this->abstractFunctions->getParams();
        $this->assertEquals(array('x'=>1),$params);
    }
    /**
     * Tests abstractFunctions->getParams()
     */
    public function testGetParams ()
    {
        $this->abstractFunctions->setParams(array('x'=>2));
        $params = $this->abstractFunctions->getParams();
        $this->assertEquals(array('x'=>2),$params);
    }
    /**
     * Tests abstractFunctions->post()
     */
    public function testPost ()
    {
        // TODO Auto-generated abstractFunctionsTest->testPost()
        $this->markTestIncomplete(
        "post test not implemented");
        $this->abstractFunctions->post(/* parameters */);
    }
    /**
     * Tests abstractFunctions->decode()
     */
    public function testDecode ()
    {
        // TODO Auto-generated abstractFunctionsTest->testDecode()
        $this->markTestIncomplete(
        "decode test not implemented");
        $this->abstractFunctions->decode(/* parameters */);
    }
    /**
     * Tests abstractFunctions->buildQueryString()
     */
    public function testBuildQueryString ()
    {
        // TODO Auto-generated abstractFunctionsTest->testBuildQueryString()
        $this->markTestIncomplete(
        "buildQueryString test not implemented");
        $this->abstractFunctions->buildQueryString(/* parameters */);
    }
    /**
     * Tests abstractFunctions->checkParams()
     */
    public function testCheckParams ()
    {
        // TODO Auto-generated abstractFunctionsTest->testCheckParams()
        $this->markTestIncomplete(
        "checkParams test not implemented");
        $this->abstractFunctions->checkParams(/* parameters */);
    }
    /**
     * Tests abstractFunctions->validateParams()
     */
    public function testValidateParams ()
    {
        // TODO Auto-generated abstractFunctionsTest->testValidateParams()
        $this->markTestIncomplete(
        "validateParams test not implemented");
        $this->abstractFunctions->validateParams(/* parameters */);
    }
}

