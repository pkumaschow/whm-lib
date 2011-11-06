<?php

/**
 * WHM Server Functions
 *
 * Calls to Server functions of the WHM XML and JSON APIs
 *
 * @link http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/XmlApi
 *
 * @package whm-lib
 * @subpackage Functions
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
 * $Id: Server.php 203 2011-11-06 12:35:05Z peterk $
 *
 */
class Whm_Functions_Server extends Whm_Functions_Abstract
{
    /**
     *
     * Returns the host name of the server
     * @return string
     */
    public function gethostname()
    {
        return $this->post('gethostname');
    }//gethostname
    
    /**
     * Returns a list of the languages available on the server
     * @return array
     */
    public function getlanglist()
    {
        return $this->post('getlanglist');
    }//getlanglist
    
    /**
     * Returns the server's load average
     * @return object
     */
    public function loadavg()
    {
        return $this->post('loadavg');
    }//loadavg
    
    /**
     *
     * This function displays your server's load average.
     * @return object
     */
    public function systemloadavg()
    {
        return $this->post('systemloadavg');
    }
    
    /**
     * Returns the version of cPanel/WHM running on the server.
     * @return string
     */
    public function version()
    {
        return $this->post('version');
    }//version
}