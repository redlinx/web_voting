<?php
    session_start();
    require_once("../libraries/classes/config.php");
    require_once("../libraries/classes/clsVoter.php");
    $user = new Voter();
    $userDtl = $user->checkUserId($_POST["user_id"],$_POST["password"]);
    //print_r($userDtl);

    if($userDtl == null)
    {
        echo "LOGIN FAILED";
        header("Refresh:1; url =  ../accounts/index_bei.php");
        
    }
    
    else
    {
        $_SESSION["uLev_id"] = $userDtl["uLev_id"];
        header("Location: ../accounts/index.php");
    }

?>