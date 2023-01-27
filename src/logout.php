<?=

'<form action="" method = "POST" >
<button name="logout" value= "logout">Log Out</button>
</form>'

?>
<?php

if(isset($_POST['logout'])){

   echo '<script type="text/javascript">

    var logout = function(user) {
        document.cookie = user + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;";
    };

    logout("user");
    location.reload();
   </script>
   ';
   $indexPath = APP_PATH . "\index.php";
   //header("Location:");
  // echo '<script type="text/javascript"> 
//';

//header('Location: '.$indexPath);
}

