 <?php
 //getPageData("mike");
///function connectToDB(){
    $servername = "localhost";
    $_username = "root";
    $_password = "";
    //$conn = new mysqli($servername,$_username,$_password);
	$conn = mysql_connect($servername,$_username,$_password);
	mysql_select_db("xmldb", $conn);
    /*
    if($conn ->connect_error){
        echo "failed";
        pritnf("Failed: %s\n",  mysql_connect_error());
        exit();
    }else{ 
    echo 'connected';}
    #$mysqliLink = new mysqli('localhost','test1','test1','database');
    //$con = mysql_connect('localhost','root','root','database');
    //if(!$con) {echo "failedddddd".mysql_error(); echo "fails";} else {echo "connected";}
    /*
    if($mysqliLink->connect_errno){
        echo "failed";
        pritnf("Failed: %s\n",  mysql_connect_error());
        exit();
    } else {echo 'connected';}
    return $mysqliLink;*/
//}
/*function getPageData($pageName){
    $mysqliLink = connectToDB();
    $query = $mysqliLink->query("SELECT * FROM books WHERE username ='$pageName'");
    $firstname = "";
    $flight = "";
    #echo"lalala";
    if($row = $query->fetch_object()){
        echo 'inside if';
        $firstname = $row->firstname;
        $flight = $row->flight;
    } else {echo 'outside if';}
    $html = '<h1>'.$firstname.'fuck</h1>';
    $html .= '<h2>'.$firstname.'</h2>';
    echo $html;
    }*/
?>
