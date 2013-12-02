<?php
    require_once("../libraries/classes/config.php");
    require_once("../libraries/classes/clsProgram.php");
    $program = new Program();
    $programDtl = $program->getProgram();
?>
<div id="addcand_form>">
<form action="../inc/searchCandidate.php" method="post">
    <input type="text" name="lname" placeholder="Last Name">
    <select name="program">
        <option value="">Select Program</option>
        <?php
            for($ctr=0; $ctr<count($programDtl); $ctr++)
            {
                echo '<option value="'.$programDtl[$ctr]["progID"].'">'.$programDtl[$ctr]["progName"]."</option>";
            }
        ?>
    </select>
    <input type="submit" value="Search Record">
</form>
</div>