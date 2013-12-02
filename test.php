

<?php
    //print_r($_SERVER);
    echo $_SERVER['REMOTE_ADDR'];
    echo "<br>";
    $myIP = substr($_SERVER['REMOTE_ADDR'],0,11);
    $myPersonalIP = $_SERVER['REMOTE_ADDR'];
    
    if($myIP == "192.168.204" OR $myPersonalIP = "192.168.204.94")
    {
        echo "You are allowed to view this page.";
    }
    else
    {
        echo "Access to this page is restricted";    
    }
?>    
