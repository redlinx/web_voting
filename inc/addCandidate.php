<?php
    require_once("../libraries/classes/config.php");
    require_once('../libraries/classes/clsCandidate.php');
    $candidate = new Candidate;
    
    
    if(!empty($_GET["id"])AND !empty($_POST["position"])){
            $candidate->addCandidate($_GET["id"],
                                     $_POST["position"]);
    }
    
    echo "<br>";
    echo "Record Added";
?>