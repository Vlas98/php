<html>
    <head>
        <title>
            Test
        </title>
    </head>

    <body>
        <?php
         print 'hello';
         print $_SERVER['HTTP_USER_AGENT'];
         ?>

         <form action="index.php" method="post">
            <p> Name: <input type="text" name="name"/></p>
            <p><input type="submit"/> </p>
         </form>
        
        <?php
        

            if(empty($_POST['name']))
            {
                        echo 'Имя!';

            } 
            else
            {
                echo htmlspecialchars($_POST['name']);
            }
        ?>
    </body>
</html>