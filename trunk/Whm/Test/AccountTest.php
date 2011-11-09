<?php
require_once 'Abstract.php';

/**
 * @category whm-lib
 * @package whm-lib
 * @subpackage Test 
 * @author peterk
 */
class AccountTest extends Whm_Test_Abstract
{
    /**
     * @var Whm_Account_Create
     */
    private $account;
    /**
     * @var Whm_Account_Modify
     */
    private $accountModify;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->account = new Whm_Account_Create($this->testUserName, $this->testDomainName);
        $feature2Modify = new Whm_Feature_Account_Modify('maxftp', 11);
        $this->accountModify = new Whm_Account_Modify($this->testUserName, $feature2Modify);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->account = null;
        $this->accountModify = null;
        parent::tearDown();
    }
    
    
    /**
     * Tests whmAccount->__construct()
     */
    public function test__construct ()
    {
        $newFeature = new Whm_Feature_Account_Add('maxftp', 5);
        $this->account = new Whm_Account_Create($this->testUserName, $this->testDomainName, $newFeature);
        $this->assertInstanceOf('Whm_Account_Create', $this->account);
    }
    
    public function testGetDomain()
    {
        $this->assertEquals($this->testDomainName, $this->account->getDomain());
    }
    
    public function testSetDomain()
    {
        $this->account->setDomain('test2');
        $this->assertEquals('test2', $this->account->getDomain());
    }
    
    public function testGetUserName()
    {
        $this->assertEquals($this->testUserName,$this->account->getUsername());
    }
    
    public function testSetUserName()
    {
        $this->account->setUsername('test2');
        $this->assertEquals('test2',$this->account->getUsername());
    }
    
    public function testAddFeature()
    {
        $newFeature = new Whm_Feature_Account_Add('maxftp', 5);
        $this->account->addFeature( $newFeature );
        $features = $this->account->getFeatures();
        $featurePresent = false;
        foreach($features as $feature)
        {
            if ($feature->featureName == $newFeature->featureName)
            {
                $featurePresent = true;
            }
        }
        $this->assertTrue($featurePresent);
    }
    
    public function testAddFeatureArray()
    {
        $newfeature1 = new Whm_Feature_Account_Add('maxftp', 5);
        $newfeature2 = new Whm_Feature_Account_Add('maxsql', 5);
        $newfeatures[] = $newfeature1;
        $newfeatures[] = $newfeature2;
        $this->account = new Whm_Account_Create($this->testUserName, $this->testDomainName, $newfeatures);
        $features = $this->account->getFeatures();
        $featurePresent = false;
        foreach($features as $feature) {
            if ($feature->featureName == $newfeatures[0]->featureName ||
                $feature->featureName == $newfeatures[1]->featureName){
                    $featurePresent = true;
                }
        }
        $this->assertTrue($featurePresent);
    }
    
    public function testBadFeatureAdded()
    {
        $this->setExpectedException('Exception');
        $this->account = new Whm_Account_Create($this->testUserName, $this->testDomainName, true);
    }

    public function testBadFeatureArrayAdded()
    {
        $this->setExpectedException('Exception');
        $this->account = new Whm_Account_Create($this->testUserName, $this->testDomainName, array(1,2,3));
    }
    
    
    public function testAddModificationFeature()
    {
        $newFeature = new Whm_Feature_Account_Modify('maxpark', '2');
        $this->accountModify = new Whm_Account_Modify($this->testUserName, $newFeature);
        $newFeature = new Whm_Feature_Account_Modify('cptheme', 'x3');
        $this->accountModify->addFeature($newFeature);
        $features = $this->accountModify->getFeatures();
        $featurePresent = false;
        foreach($features as $feature)
        {
            if ($feature->featureName == $newFeature->featureName)
            {
                $featurePresent = true;
            }
        }
        $this->assertTrue($featurePresent);
    }
    
    public function testRemoveFeature()
    {
        $newFeature1 = new Whm_Feature_Account_Add('maxftp', 5);
        $this->account->addFeature($newFeature1);
        $newFeature2 = new Whm_Feature_Account_Add('maxsql', 5);
        $this->account->addFeature($newFeature2);
        
        $this->account->removeFeature('maxftp');
        $features = $this->account->getFeatures();
        $featurePresent = false;
        if (isset($features) && !is_null($features))
        {
        foreach($features as $feature)
        {
            if ($feature->featureName == $newFeature1->featureName)
            {
                $featurePresent = true;
            }
        }
        }
        $this->assertFalse($featurePresent);
    }
}//whmAccountTest

