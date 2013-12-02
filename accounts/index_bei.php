<?php
      session_start();
      require_once("../libraries/inc/checkClientComputer.php");
      $allowComputer = checkClientIP();
      //$allowComputer = 1;
      if($allowComputer == 0){ header('Location: http://www.uic.edu.ph'); };

      if(isset($_SESSION["studentID"]) AND isset($_SESSION["programID"]))
      {
            require_once("libraries/templates/header.php");
            echo '<div id="mainContainer">';
            require_once("../libraries/forms/search_voter_form.php");
            echo '</div>';
      }
      else
      {
            require_once("../libraries/templates/header_bei.php");
            echo '<div id="mainContainer">';
            include_once("../libraries/forms/loginForm_bei.php");
            echo "</div>";
      }
      require_once("../libraries/templates/footer.php");
?>