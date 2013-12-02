<?php
    header("Location: ../accounts/index.php");
    session_start();
    require_once("../libraries/classes/config.php");
    require_once("../libraries/classes/clsCandidate.php");
    
    $candidate = new Candidate();
    $candidateList = $candidate->searchStudent($_POST["lname"], $_POST["program"]);
    
    $_SESSION["candidateList"] = $candidateList;
    
    
    //echo "<pre>";
    //print_r($_SESSION["candidateList"]);
    //echo "</pre>";
    
?>