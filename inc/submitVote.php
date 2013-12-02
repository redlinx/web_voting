<?php
    header('refresh: 3; url = ../index.php');
    //header('Location: ../index.php');
    session_start();
    require_once("../libraries/classes/config.php");
    require_once("../libraries/classes/clsSchoolYear.php");
    require_once("../libraries/classes/clsCandidate.php");
    require_once("../libraries/classes/clsPosition.php");
    require_once("../libraries/classes/clsVoter.php");
    
    $studentID = $_SESSION["studentID"];
    $programID = $_SESSION["programID"];
    
    $voter = new Voter();
    
    $schoolYear = new SchoolYear();
    $currentSY = $schoolYear->getCurrentSchoolYear();
    
    $candidate = new Candidate();
    $ssgCandidate = $candidate->getSSGCandidates();
    $programCandidate = $candidate->getProgramCandidates($programID);
    
    $position = new Position();
    $ssgPosition = $position->getPosition(1);
    $programPosition = $position->getPosition(2);
    $ctr = 0;
    
    /*This line displays list of voted candidates from the SSG executive positions*/
    //echo "-----------------------------------------------SSG Executive-----------------------------------------------<br>";
    for($pos_y=0;$pos_y<count($position->getPosition(1));$pos_y++)
    {
        if(isset($_POST[$ssgPosition[$pos_y]["posID"]]))
        {
            for($cand_x=0;$cand_x<count($candidate->getSSGCandidates());$cand_x++)
            {
                if($_POST[$ssgPosition[$pos_y]["posID"]] == $ssgCandidate[$cand_x]["candID"])
                {
                    /*
                    echo $ssgPosition[$pos_y]["posName"].": ";
                    echo $ssgCandidate[$cand_x]["lname"].", ".$ssgCandidate[$cand_x]["fname"];
                    echo " Candidate ID: ".$ssgCandidate[$cand_x]["candID"];
                    echo " Position ID: ".$ssgPosition[$pos_y]["posID"];
                    echo "<br>";
                    */
                    //$voter->insertVote($studentID,$ssgCandidate[$cand_x]["candID"],$ssgPosition[$pos_y]["posID"],$currentSY["sy_id"]);
                    $candidateID[$ctr] = $ssgCandidate[$cand_x]["candID"];
                    $positionID[$ctr] = $ssgPosition[$pos_y]["posID"];
                    $ctr++;
                }
            }
        }
    }
    /*This line displays list of voted candidates under the program level positions*/
    //echo "-----------------------------------------------Program Officers-----------------------------------------------<br>";
    for($pos_y=0;$pos_y<count($position->getPosition(2));$pos_y++)
    {  
        if(isset($_POST[$programPosition[$pos_y]["posID"]]))
        {
            for($cand_x=0;$cand_x<count($candidate->getProgramCandidates($programID));$cand_x++)
            {   
                if($_POST[$programPosition[$pos_y]["posID"]] == $programCandidate[$cand_x]["candID"])
                {
                    /*
                    echo $programPosition[$pos_y]["posName"].": ";
                    echo $programCandidate[$cand_x]["lname"].", ".$programCandidate[$cand_x]["fname"];
                    echo " Candidate ID: ".$programCandidate[$cand_x]["candID"];
                    echo " Position ID: ".$programPosition[$pos_y]["posID"];
                    echo "<br>";
                    */
                    //$voter->insertVote($studentID,$programCandidate[$cand_x]["candID"],$programPosition[$pos_y]["posID"],$currentSY["sy_id"]);
                    $candidateID[$ctr] = $programCandidate[$cand_x]["candID"];
                    $positionID[$ctr] = $programPosition[$pos_y]["posID"];
                    $ctr++;
                }
                
            }
        }
    }
    
    //echo "-----------------------------------------------Legislative Officers-----------------------------------------------<br>";
    
    
    for($pos_y=0;$pos_y<count($position->getPosition(2));$pos_y++)
    {
        if($programPosition[$pos_y]["posID"] == 10)
        {
            for($cand_x=0;$cand_x<count($candidate->getProgramCandidates($programID));$cand_x++)
            {
                $candidateName = $programCandidate[$cand_x]["lname"].", ".$programCandidate[$cand_x]["fname"];
                $candidateName = str_replace(" ","",
                                 str_replace(".","",
                                 str_replace(",","",$candidateName)));
        
                if(isset($_POST[$candidateName]))
                {
                    if($_POST[$candidateName] == $programCandidate[$cand_x]["candID"])
                    {
                        /*
                        echo $programPosition[$pos_y]["posName"].": ";
                        echo $programCandidate[$cand_x]["lname"].", ".$programCandidate[$cand_x]["fname"];
                        echo " Candidate ID: ".$programCandidate[$cand_x]["candID"];
                        echo " Position ID: ".$programPosition[$pos_y]["posID"];
                        echo "<br>";
                        */
                        $candidateID[$ctr] = $programCandidate[$cand_x]["candID"];
                        $positionID[$ctr] = $programPosition[$pos_y]["posID"];
                        $ctr++;
                    }
                }
            }
        }
    }
    
    if(count($candidateID) != 0)
    {
        $voter->insertVote($studentID, $candidateID, $positionID ,$currentSY["sy_id"]);
        echo "<h1>Thank you for voting. Please proceed at the Ballot printing area.</h1>";
    }
        
    unset($_SESSION["studentID"]);
    unset($_SESSION["programID"]);
    /*
    echo "<pre>";
    print_r($candidateID);
    echo "</pre>";
    
    echo "<pre>";
    print_r($positionID);
    echo "</pre>";
    */
?>
