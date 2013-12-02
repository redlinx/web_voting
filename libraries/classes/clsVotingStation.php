<?php
    require_once("clsMySQLdatabase.php");

    class votingStation extends MySQLdatabase
    {
        public $databaseName = DB_NAME;
        
        public function checkMACAddress($address)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT * FROM voting_station WHERE status = 1 AND mac_address = '$address'";

            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $station[$ctr++] = array('station_id'=>$row['vot_station_id']);
            }
            if(!isset($station)){$station = 0;}
            return $station;   
        }
    }
?>