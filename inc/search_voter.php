<?php
    header("Location: ../accounts/index.php");
    session_start();
    require_once("../libraries/classes/config.php");
    require_once("../libraries/classes/clsVoter.php");
    
    if(isset($_POST['vot_id']))
    {
        $voter = new Voter();
        $_SESSION["voter"] = $voter->searchVoter($_POST['vot_id']);   
    }
?>