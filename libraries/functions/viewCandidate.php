<?php
    class ViewCandidate
    {
        public function displayStudentCandidateList($studentList)
        {
            echo "<table border=1>";
            for($ctr=0; $ctr<count($studentList); $ctr++)
            {
                echo '<tr><td><a href="index.php?option=2&id='.$studentList[$ctr]["vot_id"].'">'
                                                     .$studentList[$ctr]["vot_lname"].", "
                                                     .$studentList[$ctr]["vot_fname"]."</a></td></tr>";
            }
            echo "</table>";
        }
    }
?>