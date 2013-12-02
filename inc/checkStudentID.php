<?php
    session_start();
    require_once("../libraries/classes/config.php");
    require_once("../libraries/classes/clsVoter.php");
    $student = new Voter();
    $studentDtl = $student->checkStudentLogin($_POST["student_Id"]);
    
    if($studentDtl!=null)
    {
        $_SESSION["studentID"] = $studentDtl["vot_id"];
        $_SESSION["programID"] = $studentDtl["prog_id"];
    }
    header("Location: ../index.php");
?>