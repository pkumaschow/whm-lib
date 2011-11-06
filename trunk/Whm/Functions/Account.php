<?php

/**
 * WHM API Account Functions
 *
 * Calls to Account functions of the WHM XML and JSON APIs
 *
 * @link http://docs.cpanel.net/twiki/bin/view/SoftwareDevelopmentKit/XmlApi
 * 
 * @package whm-lib
 * @subpackage Functions
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
 * $Id: Account.php 203 2011-11-06 12:35:05Z peterk $
 *
 */

class Whm_Functions_Account extends Whm_Functions_Abstract
{

    /**
     * Retrieve pertinent information about a specific account
     *
     * @param string $username
     * @return object
     */
    public function accountsummary( $user )
    {
        $this->setQueryString(array('user'=>$user));
        return $this->post('accountsummary');
    }//accountsummary
    
    /**
     * upgrade or downgrade a user's package
     *
     * @param string $user
     * @param string $pkg
     * @return object
     */
    public function changepackage($user, $pkg)
    {
        $this->setQueryString(array('user'=>$user,'pkg'=>urlencode($pkg)));
        return $this->post('changepackage');
    }//changepackage
    
    /**
     * create a new account using just the basic parameters
     *
     * @param whmAccount $account
     * @return object
     *
     */
    public function createacct(Whm_Account_Create $account)
    {
        $params = $account->getAccountParams();
        if (isset($params)) {
            $this->setQueryString($params);
        }
        //$this->setQueryString($account);
        return $this->post('createacct');
    }//createacct
    
    /**
     * Retrieve user data for a specific domain.
     *
     * @param string $domain
     * @return object
     */
    public function domainuserdata ($domain )
    {
        $this->setQueryString(array('domain' => urlencode($domain)));
        return $this->post('domainuserdata');
    }//domainuserdata
    
    /**
     * Alter the disk quota for a user
     *
     * @param string $username
     * @param integer $quota
     * @return object
     */
    public function editquota ($user, $quota)
    {
        $requiredParams = array(
            'user'  => $user,
            'quota' => intval($quota)
        );
        $validRequiredParams = array(
            'user'  => 'string',
            'quota' => 'int'
        );
        $this->checkParams($requiredParams, $validRequiredParams);
        return $this->post('editquota');
    }//editquota
    
    /**
     * Limit Bandwidth Usage (Transfer) — limitbw
     *
     * This function modifies the bandwidth usage (transfer) limit
     * for a specific account.
     *
     * @param string $username
     * @param string $bwlimit
     * @return object
     */
    public function limitbw ( $user, $bwlimit )
    {
        $this->setQueryString(array('user'=>$user,'bwlimit'=>$bwlimit));
        return $this->post('limitbw');
    }//limitbw

    /**
     * retrieves a list of all accounts
     *
     * @return array of objects
     */
    public function listaccts()
    {
        if ($this->_rest->isRaw())
        {
            return $this->post('listaccts');
        }
    }//listaccts
    
    /**
     * returns a list of suspended accounts
     *
     * @return object
     */
    public function listsuspended()
    {
        return $this->post('listsuspended');
    }//listsuspended
    
    /**
     * modify a user account
     *
     * @param whmAccount $account
     * @return object
     */
    public function modifyacct(Whm_Account_Modify $account)
    {
        $params = $account->getAccountParams();
        if (isset($params)) {
            $this->setQueryString($params);
        }        
        return $this->post('modifyacct');
    }//modifyacct
    
    
    /**
     * Generate a list of features you are allowed to use in WHM.
     * Each feature will display either a 1 or 0.
     * You are only able to use features with a corresponding 1
     *
     * privs->all (boolean) — Provides all access privileges to the user.
     * Warning: If this feature is set to 1, the user has root access.
     *
     * @return object
     */
    public function myprivs()
    {
        return $this->post('myprivs');
    }//myprivs

    /**
     * change a user's password
     *
     * @param string $username
     * @param string $password
     * @return object
     */
    public function passwd ( $user, $pass )
    {
        $this->setQueryString(array('user'=>$user,'pass'=>$pass));
        return $this->post('passwd');
    }
    
    /**
     * Terminate an account
     *
     * @param string $username
     * @param integer $keepdns  1 = yes, 2 = no (default)
     * @return object
     */
    public function removeacct( $user, $keepdns = 2 )
    {
        $this->setQueryString(array('user'=>$user,'keepdns'=>$keepdns));
        return $this->post('removeacct');
    }//removeacct
    
    /**
     * Restore a user’s account from a backup file. You may restore a monthly,
     * weekly or daily backup.
     *
     * This function is only available in version 11.27/11.28+.
     *
     * To use this function, you must specify at least one of the
     * following parameters: mail, subs, all, mysql.
     *
     *
     * TODO: restoreaccount
     *
     * @param string $username
     * @param string $type
     * @param boolean $all
     * @param boolean $ip
     * @param boolean $mail
     * @param boolean $mysql
     * @param boolean $subs
     * @return object
     */
    public function restoreaccount( $username,
                                    $type,
                                    $all   = true,
                                    $ip    = true,
                                    $mail  = true,
                                    $mysql = true,
                                    $subs  = true )
    {
        $requiredParams = array(
            'api.version'   => 1,          //must be set to 1 actually
            'user'          => $username,  //user name
            'type'          => $type,      //monthly,weekly,daily
            'all'           => $all,
            'ip'            => $ip,        // only used if $all is true
            'mail'			=> $mail,
            'mysql'         => $mysql,
            'subs'          => $subs
        );
        
        $validRequiredParams = array(
            'api.version'   => 'integer', //must be set to 1 actually
            'user'          => 'string',  //user name
            'type'          => 'string',  //monthly,weekly,daily
            'all'           => 'boolean',
            'ip'            => 'boolean',
            'mail'			=> 'boolean',
            'mysql'         => 'boolean',
            'subs'          => 'boolean'
        );
        
        //checkParams also sets the Query String
        $this->checkParams($requiredParams, $validRequiredParams);
        return $this->decode($this->_rest->query('restoreaccount'));
        
    }//restoreaccount
    
    /**
     * Change a Site's (or User's) IP Address — setsiteip
     *
     * change the IP address of a website, or a user account,
     * hosted on your server
     *
     *
     * @param string $user
     * @param string $ip
     * @return object
     */
    public function setsiteip($user, $ip)
    {
       $this->setQueryString(array('user'=>$user, 'ip'=>$ip));
       return  $this->post('setsiteip');
    }//setsiteip
    
    /**
     * Suspend a useraccount
     *
     * @param string $username
     * @param string $reason - optional but recommended
     * @return object
     */
    public function suspendacct ( $user, $reason = '' )
    {
        $this->setQueryString(array('user'=>$user,'reason'=>$reason));
        return $this->post('suspendacct');
    }//suspendacct
    
    /**
     * Unsuspend a user account
     *
     * @param string $username
     */
    public function unsuspendacct ($user )
    {
        $this->setQueryString(array('user'=>$user));
        return $this->post('unsuspendacct');
    }//unsuspendacct

}//whmModel