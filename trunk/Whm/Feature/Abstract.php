<?php
/**
 *
 * Abstract WHM Feature Object
 *
 * Feature of an Account / Package
 *
 * @abstract
 * @package whm-lib
 * @subpackage Feature 
 * @author Peter Kumaschow  (pkumaschowATgmail.com)
 * @copyright Peter Kumaschow 2011
 * @license GNU GPL v3
 *
 * This file is part of whm-lib.
 * 
 * whm-lib is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 *  whm-lib is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *  
 *  You should have received a copy of the GNU General Public License
 *  along with whm-lib.  If not, see <http://www.gnu.org/licenses/>.  
 *
 * $Id: Abstract.php 203 2011-11-06 12:35:05Z peterk $
 */
abstract class Whm_Feature_Abstract
{
    /**
     *
     * feature name
     * @var string
     */
    public $featureName;
    
    /**
     *
     * feature value
     * @var string
     */
    public $featureValue;
    
    /**
     *
     * array of valid feature names
     * @var array
     */
    protected $_validFeatures;
    
    /**
     *
     * constructor
     * @param string $featureName
     * @param string $featureValue
     */
    public function __construct ($featureName, $featureValue)
    {
        
    }//__construct
    
    /**
     *
     * Enter description here ...
     * @param string $featureName
     * @param string $featureValue
     * @throws Exception
     */
    protected function setValue($featureName,$featureValue)
    {
        if ($this->validFeature($featureName)) {
            $this->featureName = $featureName;
            $this->featureValue = $featureValue;
        } else {
            throw new Exception($featureName . ' is an invalid feature');
        }
    }//setValues
       
    /**
     *
     * test that the feature name is a valid one
     * @param string $featureName
     * @return boolean
     */
    private function validFeature($featureName)
    {
        if (in_array($featureName, $this->_validFeatures)) {
            return true;
        }
        return false;
    }//validFeature
    
}
