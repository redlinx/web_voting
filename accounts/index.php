<?php
    require_once("../libraries/templates/header_.php");
    require_once("../libraries/inc/checkClientComputer.php");
    $allowComputer = checkClientIP();
    //$allowComputer = 1;
    if($allowComputer == 0){ header('Location: http://www.uic.edu.ph'); };
?>
    
<?php
    session_start();
    require_once("../libraries/functions/viewCandidate.php");
    require_once("../libraries/functions/viewVoter.php");
?>

<div id="search">
    <?php
        if(!isset($_GET["option"])){ $_GET["option"] = 2;}
    
        //display search forms
        switch($_GET["option"])
        {
            case 1:
                //header("Location: index_bei.php");
                break;
            case 2:
                require_once("../libraries/forms/search_voter_form.php");
                break;
            case 3:
                echo "case 3";
                break;
        }
    ?>
    <div class="search_result">
    <?php require_once("../libraries/functions/viewSearchResult.php");?>
    </div>

</div>

<?php    
    if(!isset($_GET["option"])){ $_GET["option"] = 2;}

    //display search forms
    switch($_GET["option"])
    {
        case 1:
            require_once("../libraries/forms/addCandidateForm.php");
            break;
        case 2:
            require_once("../libraries/forms/search_voter_form.php");
            break;
        case 3:
            require_once("../libraries/forms/viewElectionResult.php");
            break;
    }

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

    </div>
<?php
    require_once("../libraries/templates/footer_.php");
?>