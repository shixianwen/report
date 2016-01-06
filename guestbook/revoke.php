
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        if (isset($_POST['submitLogin'])) {
            //create a connection to the database
            require("dbConnection.php");

            $sql = "SELECT * FROM login WHERE username = '" . $_POST['username'] .
                    "' AND password = '" . $_POST['password'] . "';";
            $result = mysql_query($sql);
            $numrows = mysql_num_rows($result);
            $username2 = $_POST['username'];

            if ($numrows == null) {
                header("location:index.php?login=jjjjjjjj");
            } else {
                
                $_SESSION['USERNAME'] = $username2;
// open the inventory page page to allow user onto the system
                $sql = "DELETE FROM books WHERE username = '" . $_POST['username'] .
                       "' AND password = '" . $_POST['password'] . "' AND flight = '" . $_POST['flight'] . "';";
                //echo '**********'.$sql;
                $result = mysql_query($sql);
               // echo '**********'.$result;
                header("location:index.php?revoke=jjjjjjjj");
            }
        }
        ?>
    </body>
</html>
