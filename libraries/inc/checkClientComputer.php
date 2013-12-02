<?php

    function checkClientIP()
    {
        $myIP = substr($_SERVER['REMOTE_ADDR'],0,11);
        
        $myPersonalIP = $_SERVER['REMOTE_ADDR'];
        
	
        if($myIP == "192.168.204" OR $myIP == "192.168.106" OR $myIP == "192.168.206")
        {
            $allowComputer = 1;
        }
        else
        {
            $allowComputer = 0;
        }
		
        return $allowComputer;
    }
?>