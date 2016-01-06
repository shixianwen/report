<!doctype html>
<head>

</head>
<body>
    <?php
    $from = $_POST['from'];
    $des = $_POST['des'];
    //echo '<h1>destination111 = ' . $des . '</h1>';
    $dom = new DOMDocument;
    $dom->load('xml/airlines.xml');
    $xpath = new DOMXPath($dom);
    echo'<table border="1">';
    echo'<tr>';
    echo'<td>company</td>';
    echo'<td>name</td>';
    echo'<td>price</td>';
    echo'<td>from</td>';
    echo'<td>des</td>';
    echo'<td>flydate</td>';
    echo'<td>flytime</td>';
    echo'</tr>';
    
    foreach ($xpath->query("/airlines/airline[des = '$des']") as $record) {
        echo'<tr>';
        echo'<td>' . $record->getElementsByTagName("company")->item(0)->nodeValue . '</td>';
        echo'<td>' . $record->getElementsByTagName("name")->item(0)->nodeValue . '</td>';
        echo'<td>' . $record->getElementsByTagName("price")->item(0)->nodeValue . '</td>';
        echo'<td>' . $record->getElementsByTagName("from")->item(0)->nodeValue . '</td>';
        echo'<td>' . $record->getElementsByTagName("des")->item(0)->nodeValue . '</td>';
        echo'<td>' . $record->getElementsByTagName("flydate")->item(0)->nodeValue. '</td>';
        echo'<td>' . $record->getElementsByTagName("flytime")->item(0)->nodeValue . '</td>';
        echo'</tr>';
    }
    echo'</table>';
    echo'<a href="index.php">go back to main page</a>'
    ?>
</body>