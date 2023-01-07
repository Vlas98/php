<html>
    <head>
        <title>
            Test
        </title>
    </head>

    <body>

         <form action="index.php" method="post">
            <p> Name: <input type="text" name="name"/></p>
            <p><input type="submit"/> </p>
         </form>
        
        <?php
        echo htmlspecialchars($_POST['name']);
        ?>
    </body>
</html>