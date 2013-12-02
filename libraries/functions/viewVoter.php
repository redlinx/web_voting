<?php
    class ViewVoter
    {
        public function display_voter_dtl($voter)
        {
                echo "<div class='table_style'>";
            echo "<table border=1>";
            for($ctr=0; $ctr<count($voter); $ctr++)
            {
                echo '<tr>';
                    echo '<td colspan=3>'.$voter[$ctr]["votLname"].", ".$voter[$ctr]["votFname"]."</td>";
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Course</td>';
                    echo '<td colspan=2>'.$voter[$ctr]["courseName"].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Program</td>';
                    echo '<td colspan=2>'.$voter[$ctr]["progCode"].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Time Voted</td>';
                    echo '<td colspan=2>'.$voter[$ctr]["voteLog"].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Time Vote Counted</td>';
                    echo '<td colspan=2>'.$voter[$ctr]["ballotLog"].'</td>';
                echo '</tr>';
                if($voter[$ctr]["votStatus"] == 0 AND isset($voter[$ctr]["voteLog"]))
                {
                    echo '<tr>';
                    echo '<td>Option</td>';
                    echo '<td><a href="../inc/display_ballot.php?vid='.$voter[$ctr]["votID"].'" target="_blank">Preview Ballot</a></td>';
                    echo '<td><a href="../inc/count_vote.php?vid='.$voter[$ctr]["votID"].'">Count</a></td>';
                    echo '</tr>';
                }
            }
            echo "</table>";
            echo "</div>";
            
           // echo "<pre>";
            //print_r($voter);
            //echo "</pre>";
        }
    }

?>