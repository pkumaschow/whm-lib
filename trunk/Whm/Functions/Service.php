<?php
/**
 * WHM Service Functions
 *
 * Calls to Service functions of the WHM XML and JSON APIs
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
 *  $Id: Service.php 203 2011-11-06 12:35:05Z peterk $
 *
 */

class Whm_Functions_Service extends Whm_Functions_Abstract
{
    /**
     * Allows you to enable or disable a service, and enable or disable
     * monitoring of that service
     *
     * @param string $service
     * @param boolean $enabled
     * @param boolean $monitored
     * @return object
     */
    public function configureservice($service, $enabled=true, $monitored=true)
    {
        if ( !$this->isacceptable($service) ) {
            throw new Exception($service . ' service not whitelisted');
        }
        $params = array(
            'service'   => $service,
            'enabled'   => $enabled,
            'monitored' => $monitored
        );
        $this->setQueryString($params);
        return $this->post('configureservice');
        
    }//configureservice

    /**
     * Restart a service, or daemon, on the server.
     *
     * @param string $service
     * @return object
     */
    public function restartservice($service)
    {
        if ( !$this->isacceptable($service) ) {
            throw new Exception($service . ' service not whitelisted');
        }
        $this->setQueryString(array('service'=>$service));
        return $this->post('restartservice');
    }//restartservice
    
    /**
     * Tells you which services (daemons) are enabled, installed, and monitored
     *
     * @param $service
     * @return object
     */
    public function servicestatus($service)
    {
        if (!$this->isacceptable($service)) {
            throw new Exception($service . ' service not whitelisted');
        }
        $this->setQueryString(array('service'=>$service));
        return $this->post('servicestatus');
    }//servicestatus
        
    /**
     * determines if service is an acceptable value
     *
     * @param string $service
     * @return boolean
     */
    public function isacceptable($service)
    {
        $services = array(
            'named',
            'interchange',
            'ftpd',
            'httpd',
            'imap',
            'cppop',
            'exim',
            'mysql',
            'postgresql',
            'sshd',
            'tomcat'
        );
        if (array_search($service, $services)) {
            return true;
        } else {
            return false;
        }
    }//isacceptable
    
}//whmServiceModel