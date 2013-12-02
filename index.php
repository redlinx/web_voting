<?php session_start();?>
<?php
      require_once("libraries/inc/checkClientComputer.php");
      
      $allowComputer = checkClientIP();    
      if($allowComputer == 0){ header('Location: http://www.uic.edu.ph'); }
      
      if(isset($_SESSION["studentID"]) AND isset($_SESSION["programID"]))
      {
            require_once("libraries/templates/header.php");
            echo '<div id="mainContainer">';
            require_once("libraries/forms/ballotForm.php");
            echo '</div>';
      }
      else
      {
            require_once("libraries/templates/headerlogin.php");
            echo '<div id="mainContainer">';
            include_once("libraries/forms/loginForm.php");
            echo "</div>";
      }
      require_once("libraries/templates/footer.php");
?>