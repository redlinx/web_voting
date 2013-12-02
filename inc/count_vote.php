<?php
    require_once('../libraries/classes/config.php');
    require_once('../libraries/classes/clsVoter.php');

    $votID1 = $_GET['vid'];

    $voter = new Voter();
    $count_votes = $voter->countVote($votID1);
    if($count_votes == 1)
    {
        echo "Votes Counted";
        header('refresh: 1; url = ../accounts');
    }
    
?>