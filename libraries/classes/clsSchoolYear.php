<?php
    require_once("clsMySQLdatabase.php");
    
    class SchoolYear extends MySQLdatabase
    {
        public $databaseName = DB_NAME;
        
        public function getCurrentSchoolYear()
        {
            /*This method return ID of the current school year*/
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = " SELECT sy_id,sy_desc 
                        FROM $database_name.school_year
                        WHERE sy_status = 1";
            $result = mysql_query($sQuery);
            if($result)
            {
                if(mysql_num_rows($result) == 1) { $schoolYear = mysql_fetch_assoc($result); }
                else { $schoolYear = null;}
            }
            else { $schoolYear = null;}
            return $schoolYear;
        }
    }

?>