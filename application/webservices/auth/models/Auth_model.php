<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->username_arr = ['manager', 'admin'];
    }
    
    public function checkUserPassword($username, $password)
    {
        if(in_array($username, $this->username_arr) && $password == '123456')
        {
            return true;
        }
        
        return false;
    }
}