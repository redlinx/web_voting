<?php
    require_once("config.php");
    
    class MySQLdatabase
    {   
        protected function connectDatabase()
        {
            $link = mysql_connect(DB_HOST, DB_USERNAME, DB_PASS);
            $db_selected = mysql_select_db(DB_NAME, $link);
        }
    }

?>