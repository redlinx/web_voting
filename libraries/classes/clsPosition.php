<?php
    require_once("clsCandidate.php");
    
    class Position extends Candidate
    {
        public function getPosition($positionID) /*1 SSG, 2 Program*/
        {
            /*This method returns a position ID and pasition name*/
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT position.pos_id,position.pos_name
                       FROM $database_name.position, $database_name.division
                       WHERE position.div_id = division.div_id
                       AND position.div_id = $positionID
                       ORDER BY position.order_no ASC";
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $position[$ctr++] = array('posID'=>$row['pos_id'],
                                          'posName'=>$row['pos_name']);
            }
            
            if(!isset($position)){$position = null;}
            return $position;
        }
        
        public function positionIsVacant($posID, $progID)
        {
            /*This method checks is a position in SSG and Program divisions is vacant*/
        }
    }
?>