<?php
/**
 * 
 * List of features that can be added during package creation
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
 */
class Whm_Feature_Package_Add extends Whm_Feature_Abstract
{
    function __construct ($featureName, $featureValue)
    {
        $this->_validFeatures = array(
            'featurelist'   => 'string',
            'quota'         => 'integer',
            'ip'            => 'boolean',
            'cgi'           => 'boolean',
            'frontpage'     => 'boolean',
            'cpmod'         => 'string',
            'language'      => 'string',
            'maxftp'        => 'integer',
            'maxsql'        => 'integer',
            'maxpop'        => 'integer',
            'maxlists'      => 'integer',
            'maxsub'        => 'integer',
            'maxpark'       => 'integer',
            'maxaddon'      => 'integer',
            'hasshell'      => 'boolean',
            'bwlimit'       => 'bwlimit',
        );
        $this->setValue($featureName, $featureValue);
    }
}