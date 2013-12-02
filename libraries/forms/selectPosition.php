<?php
    require_once("../libraries/classes/config.php");
    require_once("../libraries/classes/clsPosition.php");
    require_once("../libraries/classes/clsVoter.php");
    $position = new Position();
    $positionDtl = $position->getPosition(2);
    $voter = new Voter();
    $name = $voter->searchVoter($_GET["id"]);
?>

<form action="../inc/addCandidate.php" method="post">
    
    <?php echo $name[0]['vot_lname'].', '.$name[0]['vot_fname']; ?>
    <select name="position">
        <option value="">Select position</option>
        <?php
            for($ctr=0; $ctr<count($positionDtl); $ctr++)
            {
                echo '<option value="'.$positionDtl[$ctr]["posID"].'">'.$positionDtl[$ctr]["posName"]."</option>";
            }
        ?>
    </select>
    <input type="submit" value="Add Program Candidate">     
</form>