<?php
    if(isset($_SESSION["candidateList"])) { $x = 1;}
    elseif(isset($_SESSION["voter"])) { $x = 2;}
    else { $x = 0;}


    //display search results
    switch($x)
    {
        case 1:
            require_once("../libraries/forms/addCandidateForm.php");
            $candidateApplicant = new ViewCandidate();
            $candidateApplicant->displayStudentCandidateList($_SESSION["candidateList"]);
            unset($_SESSION["candidateList"]);
            break;
        case 2:
            require_once("../libraries/forms/search_voter_form.php");
            $voter = new ViewVoter();
            $voter->display_voter_dtl($_SESSION["voter"]);
            unset($_SESSION["voter"]);
            break;
    }

    if(isset($_GET["searchresult"]))
    {
        if($_GET["searchresult"] == 1 AND isset($_GET["vid"])) { $y = 1;}
    }
    else { $y = 0; }
    
    //display search details
    switch($y)
    {
        case 1:
            echo "Student Profile";
            break;
    }
?>