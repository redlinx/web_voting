<?php
    require_once("clsVoter.php");
    
    class Program extends Voter
    {
        public function getProgram()
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT prog_id, prog_name FROM program";
            
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $program[$ctr++] = array('progID'=>$row['prog_id'],
                                         'progName'=>$row['prog_name']);
            }
            
            if(!isset($program)){$program = null;}
            return $program;   
        }
        public function getStudentProgram($id)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT prog_name,prog_code FROM voter,program WHERE vot_id = '$id' AND voter.prog_id = program.prog_id";
            
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $program[$ctr++] = array('progName'=>$row['prog_name'],'progCode'=>$row['prog_code']);
            }
            
            if(!isset($program)){$program = null;}
            return $program;   
        }
    }

?>