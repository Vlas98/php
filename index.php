<html>
    <head>
        <title>
            Test
        </title>
    </head>

    <body>

         <form action="index.php" method="post">
            <p> Name: <textarea name="name"/></textarea></p>
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
