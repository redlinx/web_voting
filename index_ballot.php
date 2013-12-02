<?php require_once("libraries/templates/header.php");?>
    <div id="ballotContainer">
          <?php
                if(isset($_SESSION["studentID"]) AND isset($_SESSION["programID"]))
                {
                      require_once("libraries/forms/ballotForm.php");      
                }
                else
                {
                      include_once("libraries/forms/loginForm.php");
                }
          ?>
    </div>
</div>
<?php require_once("libraries/templates/footer.php");?>