<?php

/**
 * WHM Package Functions
 *
 * Calls to Package functions of the WHM XML and JSON APIs
 *
 * @link http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/XmlApi
 * 
 * @package whm-lib
 * @subpackage Functions * @author Peter Kumaschow
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
 * $Id: Package.php 203 2011-11-06 12:35:05Z peterk $
 *
 */

class Whm_Functions_Package extends Whm_Functions_Abstract
{

    /**
     * http://etwiki.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/AddPackage
     *
     * This function adds a new hosting package.
     *
     * @param array $requiredParams
     * @param array $optionalParams
     * @return object
     */
     public function addpkg($requiredParams, $optionalParams = null)
     {
         $validRequiredParams = array(
            'name' => 'string'
         );
         $validOptionalParams = array(
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
         $this->checkParams(
             $requiredParams,
             $validRequiredParams,
             $optionalParams,
             $validOptionalParams
         );
         return $this->post('addpkg');
     }
     

     /**
      * http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/EditPackage
      *
      * This function edits all aspects of a specific hosting package.
      *
      * @param unknown_type $requiredParams
      * @param unknown_type $optionalParams
      */
     public function editpkg($requiredParams, $optionalParams = null)
     {
         $validRequiredParams = array(
            'name' => 'string'
             );
         $validOptionalParams = array(
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
         $this->checkParams(
             $requiredParams,
             $validRequiredParams,
             $optionalParams,
             $validOptionalParams
         );
         return $this->post('editpkg');
         
     }//editpkg
     
     /**
      *
      * This function deletes a specific hosting package.
      *
      * @param string $name
      * @return object
      */
     public function killpkg( $pkg )
     {
        $requiredParams = array(
            'pkg' => $pkg,
        );
        $validRequiredParams = array(
            'pkg' => 'string'
        );
        $this->checkParams($requiredParams, $validRequiredParams);
        return $this->post('killpkg');
     }//killpkg
    
    /**
     *
     * This function will retrieve a list of available features.
     *
     * @return object
     */
    public function getfeaturelist()
    {
        return $this->post('getfeaturelist');
    }
    
    /**
     *
     * This function lists all hosting packages available for use by the
     * WHM user who is currently logged in. If that user is a reseller,
     * he or she may not see some packages that exist, if those packages
     * are not currently available to be used for account creation.
     *
     * @return object
     */
    public function listpkgs ( )
    {
        return $this->post('listpkgs');
    }//listpkgs
    
}//class whmPackageModel