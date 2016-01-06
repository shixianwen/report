<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        // Process the registration form
        if (isset($_POST['submitregistration'])) {
            $firstname = $_POST["firstname"];
            $surname = $_POST["surname"];
            $username = $_POST["username"];
            $password = $_POST["password"];
            $flight = $_POST["flight"];




            //check if the username already exist in the file using xpath
            $doc = new DOMDocument;
            $doc->load('xml/books.xml');
            $xpath = new DOMXPath($doc);
            $finusername = $xpath->query("/Books/Profile[@username='$username']");

            //loop through to find values matching the username
            foreach ($finusername as $theusername) {

                print($theusername->nodeValue);
            }
            //if theusername return null
            if (isset($theusername)) {

                header("location:index.php?category=jjjjjjjj");
            } else {
                echo '<h1>firstname = ' . $firstname . '</h1>';

                //This will add a record into the register.xml file    
                $xml = simplexml_load_file('xml/books.xml');
                $item = $xml->addChild('Profile');
                $item->addAttribute('username', $username);
                $item->addChild('firstname', $firstname);
                $item->addChild('surname', $surname);
                $item->addChild('password', $password);
                $item->addChild('author_id', $username);
                $item->addChild('flight', $flight);
                file_put_contents('xml/books.xml', $xml->asXML());




                $docs = new DOMDocument;
                $docs->load('xml/books.xml');
                if (!$docs->schemaValidate('xml/books.xsd')) {

                    //delete the record if it does not conform to the xml schema
                    echo '<h1>fail to pass the schemaValidate</h1>';
                    $dom = new DOMDocument;
                    $dom->load('xml/books.xml');
                    $xpaths = new DOMXPath($dom);
                    $query = sprintf("/Books/Profile[@username='$username']");
                    foreach ($xpaths->query($query) as $record) {
                        $record->parentNode->removeChild($record);
                    }
                    $dom->save("xml/books.xml");
                    header("location:index.php?bad=jjjjjjjj");
                } else {
                echo '<h1>successful to pass the schemaValidate</h1>';
                    //add record to database
        require("dbConnection.php"); // connection to the database
        
        //insert into the Profile table
        $query="INSERT INTO books (username, firstname, surname, password, flight) " .
        "VALUES ('$username', '$firstname', '$surname', '$password', '$flight')";	
		echo $query;
		//$query="SELECT firstname FROM `books`";
        $result = mysql_query($query);
		
		 if(!$result){
			 echo "Failed!";
			 $message = 'Error: ' . mysql_error() . "\n";
			 echo $message;
			 die($message);
		 }else {echo "Success!";}
		 
        
          //insert into the Login table
        $query2="INSERT INTO login (username, password) ".
        "VALUES ('$username', '$password')";
		echo $query2;	
         $result2= mysql_query($query2);
		 if(!$result2){
			 echo "login Failed!";
			 $message = 'Error: ' . mysql_error() . "\n";
			 echo $message;
			 die($message);
		 }else {echo "login Success!";}
		 
         //$_SESSION['USERNAME'] = $username;
// open the inventory page page to allow user log on to the system
                   header("location:index.php?book=jjjjjjjj");
                }
            }
        }
        ?>
    </body>
</html>
