<?php
    require_once("clsProgram.php");
    
    class Course extends Program
    {
        public function getVotersCourse($id)
        {
            $this->connectDatabase();
            $database_name = $this->databaseName;
            $sQuery = "SELECT course_name
                       FROM $database_name.voter,$database_name.course
                       WHERE vot_id = '$id' AND voter.course_id = course.course_id";
            $result = mysql_query($sQuery);
            $ctr = 0;
            while($row = mysql_fetch_array($result, MYSQL_ASSOC)){
                $course[$ctr++] = array('course'=>$row['course_name']);
            }
            
            if(!isset($course)){$course = null;}
            return $course;   
        }
    }
?>