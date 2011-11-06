<?php
/**
 * 
 * List of features that can be modified during account modification
 * 
 * @package whm-lib
 * @subpackage Feature 
 * @author Peter Kumaschow
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
 *
 *
 */
class Whm_Feature_Account_Modify extends Whm_Feature_Abstract
{
    function __construct ($featureName, $featureValue)
    {
        $this->_validFeatures = array(
            'cptheme',
            'hascgi',
            'lang',
            'locale',
            'maxaddon',
            'maxftp',
            'maxlst',
            'maxpark',
            'maxpop',
            'maxsql',
            'maxsub',
            'newuser',
            'owner',
            'shell'
        );
        $this->setValue($featureName, $featureValue);
    }
}