<?php
    require_once("clsVoter.php");
    
    class Candidate extends Voter
    {
        public function addCandidate($vot_id, $pos_id)
        {
            $sy_id = $this->getCurrentSchoolYear();
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "INSERT INTO candidate(vot_id,sy_id,pos_id)
                       VALUES('$vot_id','$sy_id','$pos_id')";
            $result = mysql_query($sQueryInsert);
        }
        
        public function getProgramCandidates($progID)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT candidate.cand_id,
                                position.pos_id,
                                position.pos_name,
                                voter.vot_lname,
                                voter.vot_fname,
                                program.prog_name
                        FROM $database_name.candidate,
                                $database_name.position,
                                $database_name.division,
                                $database_name.voter,
                                $database_name.program,
                                $database_name.school_year
                        WHERE candidate.pos_id = position.pos_id
                        AND candidate.sy_id = school_year.sy_id 
                        AND position.div_id = division.div_id
                        AND candidate.vot_id = voter.vot_id
                        AND voter.prog_id = program.prog_id
                        AND division.div_id = 2
                        AND program.prog_id = $progID
                        AND school_year.sy_status = 1
                        ORDER BY position.order_no,voter.vot_lname ASC;";
            
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $candidate[$ctr++] = array('candID'=>$row['cand_id'],
                                           'posID'=>$row['pos_id'],
                                           'posName'=>$row['pos_name'],
                                           'lname'=>$row['vot_lname'],
                                           'fname'=>$row['vot_fname'],
                                           'progName'=>$row['prog_name']);
            }
            
            if(!isset($candidate)){$candidate = null;}
            return $candidate;
        }
        
        public function getSSGCandidates()
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT 	candidate.cand_id, 
                                position.pos_id,
                                position.pos_name,
                                voter.vot_lname,
                                voter.vot_fname
                        FROM 	$database_name.candidate,
                                $database_name.position,
                                $database_name.division,
                                $database_name.voter,
                                $database_name.school_year
                        WHERE candidate.pos_id = position.pos_id
                        AND position.div_id = division.div_id
                        AND candidate.vot_id = voter.vot_id
                        AND candidate.sy_id = school_year.sy_id
                        AND division.div_id = 1
                        AND school_year.sy_status = 1";

            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $candidate[$ctr++] = array('candID'=>$row['cand_id'],
                                           'posID'=>$row['pos_id'],
                                           'posName'=>$row['pos_name'],
                                           'lname'=>$row['vot_lname'],
                                           'fname'=>$row['vot_fname']);
            }
            
            if(!isset($candidate)){$candidate = null;}
            return $candidate;
        }
        
        public function getRecordVoted($id,$vot_id)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT candidate_voter.vot_id,
                              candidate_voter.pos_id,
                              position.pos_name,
                              division.div_name,
                              voter.vot_lname,
                              voter.vot_fname 
                       FROM $database_name.candidate_voter,
                            $database_name.candidate,
                            $database_name.program,
                            $database_name.voter,position,
                            $database_name.division
                       WHERE candidate_voter.cand_id = candidate.cand_id
                       AND voter.vot_id = candidate.vot_id
                       AND position.div_id = division.div_id
                       AND voter.prog_id = program.prog_id
                       AND candidate.pos_id = position.pos_id
                       AND division.div_id = '$id'
                       AND candidate_voter.vot_id = '$vot_id'
                       ORDER BY position.order_no ASC";
                       
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $candidate_rec[$ctr++] = array('lname'=>$row['vot_lname'],
                                               'fname'=>$row['vot_fname'],
                                               'id'=>$row['pos_id']);
            }
            
            if(!isset($candidate_rec)){$candidate_rec = null;}
            return $candidate_rec;
            
        }
        
        public function searchStudent($lname, $programID)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT vot_id,vot_fname,vot_lname
                       FROM voter
                       WHERE vot_lname = '$lname'
                       AND prog_id = '$programID'";
            
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $student[$ctr++] = array('vot_id'=>$row['vot_id'],
                                         'vot_fname'=>$row['vot_fname'],
                                         'vot_lname'=>$row['vot_lname']);
            }
            
            if(!isset($student)){$student = null;}
            return $student;
        }
        
        public function getElectionResults()
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT 	voter.vot_id,
                       voter.vot_lname,
                       voter.vot_fname,
                       position.pos_name,
                       program.prog_name,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 1 AND candidate_voter.status = 1) AS ITE_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 2 AND candidate_voter.status = 1) AS MLS_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 3 AND candidate_voter.status = 1) AS PharmChem_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 4 AND candidate_voter.status = 1) AS NDHRM_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 5 AND candidate_voter.status = 1) AS Music_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 6 AND candidate_voter.status = 1) AS ABA_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 7 AND candidate_voter.status = 1) AS LA_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 8 AND candidate_voter.status = 1) AS ENGR_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 9 AND candidate_voter.status = 1) AS EDUC_votes,
                       (SELECT count(*) FROM candidate_voter,voter WHERE candidate_voter.cand_id = candidate.cand_id AND voter.vot_id = candidate_voter.vot_id AND voter.prog_id = 10 AND candidate_voter.status = 1) AS Nursing_votes,
                       (SELECT count(*) FROM candidate_voter WHERE candidate_voter.cand_id = candidate.cand_id AND candidate_voter.status = 1) AS total_votes
                       FROM $database_name.candidate,
                            $database_name.position,
                            $database_name.division,
                            $database_name.voter,
                            $database_name.program
                       WHERE candidate.pos_id = position.pos_id 
                       AND position.div_id = division.div_id
                       AND candidate.vot_id = voter.vot_id
                       AND voter.prog_id = program.prog_id
                       AND division.div_id = 1
                        
                        ORDER BY position.order_no ASC";
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $election[$ctr++] = array('vot_id'=>$row['vot_id'],
                                         'vot_fname'=>$row['vot_fname'],
                                         'vot_lname'=>$row['vot_lname'],
                                         'pos_name'=>$row['pos_name'],
                                         'prog_name'=>$row['prog_name'],
                                         'ite_votes'=>$row['ITE_votes'],
                                         'mls_votes'=>$row['MLS_votes'],
                                         'pharmchem_votes'=>$row['PharmChem_votes'],
                                         'ndhrm_votes'=>$row['NDHRM_votes'],
                                         'music_votes'=>$row['Music_votes'],
                                         'aba_votes'=>$row['ABA_votes'],
                                         'la_votes'=>$row['LA_votes'],
                                         'engr_votes'=>$row['ENGR_votes'],
                                         'educ_votes'=>$row['EDUC_votes'],
                                         'nursing_votes'=>$row['Nursing_votes'],
                                         'total_votes'=>$row['total_votes']);
            }
            
            if(!isset($election)){$election = null;}
            return $election;
        }
    }
?>