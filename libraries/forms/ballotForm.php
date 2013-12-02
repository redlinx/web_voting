<div id="ballot">
<?php
    require_once("libraries/classes/config.php");
    require_once("libraries/classes/clsCandidate.php");
    require_once("libraries/classes/clsPosition.php");
    require_once("libraries/classes/clsProgram.php");
    
    $programID = $_SESSION["programID"];
    
    $candidate = new Candidate();
    $ssgCandidate = $candidate->getSSGCandidates();
    $programCandidate = $candidate->getProgramCandidates($programID);
    $program = new Program();
    $programName = $program->getStudentProgram($_SESSION["studentID"]); 
    
    $position = new Position();
    $ssgPosition = $position->getPosition(1);
    $programPosition = $position->getPosition(2);
    
    
?>

<SCRIPT LANGUAGE="javascript">
    function KeepCount()
    {
        var NewCount = 0;
        <?php
            for($cand_x=0;$cand_x<count($candidate->getProgramCandidates($programID));$cand_x++)
            {
                if($programCandidate[$cand_x]["posID"] == 10) /*This line checks if the position is equivalent to Legislator*/
                {
                    $candidateName = $programCandidate[$cand_x]["lname"].", ".$programCandidate[$cand_x]["fname"];
        ?>
        
        if (document.Candidates.<?php echo str_replace(" ","",str_replace(",","",str_replace(".","",$candidateName))); ?>.checked)
        {NewCount = NewCount + 1}
        <?php
                }
            }
        ?>
        if (NewCount == 4)
        {
            alert('Just choose three candidates for legislative position.');
            document.Candidates;return false;
        }
    }
</SCRIPT>

<form name="Candidates" method="post" action="inc/submitVote.php">
<h3>Supreme Student Goverment</h3>
<?php
    /*This line displays list of candidates for SSG Executive positions*/
    for($pos_y=0;$pos_y<count($position->getPosition(1));$pos_y++)
    {
        echo '<div id="ssg_pos"><div class="line">'.$ssgPosition[$pos_y]["posName"]."<br>".'</div></div>';
        for($cand_x=0;$cand_x<count($candidate->getSSGCandidates());$cand_x++)
        {
            if($ssgPosition[$pos_y]["posID"] == $ssgCandidate[$cand_x]["posID"])
            {
                echo '<input type="radio" name="'.$ssgPosition[$pos_y]["posID"].'" value="'.$ssgCandidate[$cand_x]["candID"].'">';
                echo ' '.$ssgCandidate[$cand_x]["lname"].", ".$ssgCandidate[$cand_x]["fname"];
                echo "</input><br>";   
            }
        }
    }
    
    
    /*This line displays list of candidates for under the Program level prositions*/
    echo '<div class="prog_line"><br><h3>'.$programName[0]['progName'].'</h3>';
    for($pos_y=0;$pos_y<count($position->getPosition(2));$pos_y++)
    {
        echo '<div id="progpos">' . $programPosition[$pos_y]["posName"]."<br>". '</div>';
        for($cand_x=0;$cand_x<count($candidate->getProgramCandidates($programID));$cand_x++)
        {
            if($programPosition[$pos_y]["posID"] == $programCandidate[$cand_x]["posID"])
            {
                if($programPosition[$pos_y]["posID"] == 10) /*This line checks if the position is equivalent to Legislator*/
                {
                    $candidateName = $programCandidate[$cand_x]["lname"].", ".$programCandidate[$cand_x]["fname"];
                    echo '<input type="checkbox" value="'.$programCandidate[$cand_x]["candID"].'"
                                                 name="'.str_replace(" ","",
                                                         str_replace(".","",
                                                         str_replace(",","",$candidateName))).'" onClick="return KeepCount()">';
                    echo ' '.$candidateName;
                    echo "</input><br>";
                }
                else
                {
                    echo '<input type="radio" name="'.$programPosition[$pos_y]["posID"].'" value="'.$programCandidate[$cand_x]["candID"].'">';
                    echo ' '.$programCandidate[$cand_x]["lname"].", ".$programCandidate[$cand_x]["fname"];
                    echo "</input><br>";   
                }
            }
        }
    }
?>
    <div id="ballot_but">
    <input class="vote_but" type="submit" value="Vote">
    <input class="vote_but" type="submit" value="Cancel">
    </form>
    </div>
</div>
