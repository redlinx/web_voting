<?php
    require_once("clsSchoolYear.php");
    
    class Voter extends SchoolYear
    {   
        public function checkStudentLogin($studentID)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery =  "SELECT 	voter.vot_id,
                                voter.prog_id,
                                voter.vot_lname,
                                voter.vot_fname,
                                voter.vot_mname,
                                program.prog_name 
                        FROM $database_name.voter,$database_name.program
                        WHERE voter.prog_id = program.prog_id 
                        AND voter.vot_id = '$studentID' 
                        AND status = 0;";
            
            $result = mysql_query($sQuery);
            if($result)
            {
                if(mysql_num_rows($result) == 1) { $student = mysql_fetch_assoc($result); }
                else { $student = null;}
            }
            else { $student = null;}
            return $student;
        }
        
        public function insertVote($voterID, $candidateID, $positionID, $syID)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $voteStatus = $this->voteIsExisting($voterID, $syID);
          
            $sQueryDelete = "DELETE FROM $database_name.candidate_voter
                             WHERE vot_id = '$voterID'
                             AND sy_id = '$syID'";
            
            $sQueryUpdate = "UPDATE $database_name.voter
                             SET time_voted = NOW()
                             WHERE vot_id = $voterID";
    
            if($voteStatus == 1){ mysql_query($sQueryDelete); }
            
            for($cand_x=0; $cand_x<count($candidateID); $cand_x++)
            {
                $sQueryInsert = "INSERT INTO $database_name.candidate_voter(cand_id, vot_id, pos_id, sy_id, status)
                                 VALUES ('$candidateID[$cand_x]','$voterID','$positionID[$cand_x]','$syID', 0)";
                mysql_query($sQueryInsert);
            }
            mysql_query($sQueryUpdate);
        }
        
        public function voteIsExisting($voterID, $syID)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = " SELECT *
                        FROM $database_name.candidate_voter
                        WHERE vot_id = '$voterID'
                        AND sy_id = '$syID'";            
            $result = mysql_query($sQuery);
            if($result)
            {
                if(mysql_num_rows($result) >= 1) { $candidateVote = 1; }
                else { $candidateVote = 0;}
            }
            else { $candidateVote = 0;}
            return $candidateVote;            
        }
        
        public function searchVoter($id)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT  vot_id,
                               vot_lname,
                               vot_fname,
                               vot_mname,
                               status,
                               voter.course_id,
                               voter.prog_id,
                               prog_code,
                               prog_name,
                               course_name,
                               time_voted,
                               time_vote_printed
                        FROM $database_name.voter,
                             $database_name.course,
                             $database_name.program 
                        WHERE vot_id = '$id'
                        AND voter.prog_id = program.prog_id
                        AND voter.course_id = course.course_id";
            
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $voter[$ctr++] = array('votID'=>$row['vot_id'],
                                       'votFname'=>$row['vot_fname'],
                                       'votLname'=>$row['vot_lname'],
                                       'votMname'=>$row['vot_mname'],
                                       'votStatus'=>$row['status'],
                                       'courseID'=>$row['course_id'],
                                       'progID'=>$row['prog_id'],
                                       'progCode'=>$row['prog_code'],
                                       'progName'=>$row['prog_name'],
                                       'courseName'=>$row['course_name'],
                                       'voteLog'=>$row['time_voted'],
                                       'ballotLog'=>$row['time_vote_printed']);
            }
            
            if(!isset($voter)){$voter = null;}
            return $voter;
        }
        
        public function countVote($id){
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "UPDATE $database_name.candidate_voter,$database_name.voter 
                       SET voter.status = 1,
                           voter.time_vote_printed = NOW(),
                           candidate_voter.status = 1 
                       WHERE voter.vot_id = '$id'
                       AND candidate_voter.vot_id = '$id'
                       AND candidate_voter.sy_id = 1";
            $result = mysql_query($sQuery);
            if($result)
            {
                $count = 1;
            }
            else { $count = 0; }
            return $count;       
        }
        public function checkUserId($userID,$password)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery =  "SELECT uLev_id,vot_id FROM $database_name.account WHERE vot_id = '$userID' AND acct_password = md5('$password')";
            
            $result = mysql_query($sQuery);
            if($result)
            {
                if(mysql_num_rows($result) == 1) { $user = mysql_fetch_assoc($result); }
                else { $user = null;}
                //echo mysql_num_rows($result);
            }
            else { $user = null;}
            return $user;
        }
        
        public function updateBallotTimePrinted($voterID)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQueryUpdate = "UPDATE $database_name.voter
                             SET time_vote_printed = NOW()
                             WHERE vot_id = '$voterID'";
            mysql_query($sQueryUpdate);
        }
    }
?>