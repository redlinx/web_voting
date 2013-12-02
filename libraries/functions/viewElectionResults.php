<?php
    require_once("../classes/clsCandidate.php");
    require_once("../classes/config.php");
    class ViewElectionResults extends Candidate
    {
        public function display_election_results()
        {
            $data = $this->getElectionResults();
            echo "<table border=1>";
            
            echo '<tr>';
            echo "<td>SSG Candidates</td>";
            echo "<td>Positions</td>";
            echo "<td>ITE Votes</td>";
            echo "<td>MLS Votes</td>";
            echo "<td>Pharm Chem Votes</td>";
            echo "<td>NDHRM Votes</td>";
            echo "<td>Music Votes</td>";
            echo "<td>ABA Votes</td>";
            echo "<td>LA Votes</td>";
            echo "<td>ENGR Votes</td>";
            echo "<td>EDUC Votes</td>";
            echo "<td>Nursing Votes</td>";
            echo "<td>Total Votes</td>";
            echo '</tr>';
            for($x=0;$x<count($data);$x++){
                echo '<tr>';
                //for($y=0;$y<count($data);$y++)
                //{
                    echo '<td>';
                    echo $data[$x]['vot_lname'].', ';
                    echo $data[$x]['vot_fname'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['pos_name'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['ite_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['mls_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['pharmchem_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['ndhrm_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['music_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['aba_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['la_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['engr_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['educ_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['nursing_votes'].'<br>';
                    echo '</td>';
                    echo '<td>';
                    echo $data[$x]['total_votes'].'<br>';
                    echo '</td>';
                //}
                echo '</tr>';
                
                //echo '<tr>';
                //echo '</tr>';
            }
            echo "</table>";
        }
    }
    
    /*
    echo '<tr>';
                    echo '<td colspan=3>'.$result[$ctr]["votLname"].", ".$result[$ctr]["votFname"]."</td>";
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Course</td>';
                    echo '<td colspan=2>'.$result[$ctr]["courseName"].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Program</td>';
                    echo '<td colspan=2>'.$result[$ctr]["progCode"].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Time Voted</td>';
                    echo '<td colspan=2>'.$result[$ctr]["voteLog"].'</td>';
                echo '</tr>';
                echo '<tr>';
                    echo '<td>Time Ballot Printed</td>';
                    echo '<td colspan=2>'.$result[$ctr]["ballotLog"].'</td>';
                echo '</tr>';
*/
    $a = new ViewElectionResults();
    $b = $a->display_election_results();
    echo $b;
?>