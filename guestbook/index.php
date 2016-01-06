<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="add/style.css">
    <script type="text/javascript" src="add/validate.min.js"></script> <!-- JS form validation -->
    
</head>

<body id="index_body" background = "backgroundbird.gif">
    <?php
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    $page = $_GET['page'];
    $xmlsrc = "xml/comments.xml";
    $xml = simplexml_load_file($xmlsrc);
    $counted = count($xml);
    function getFeed($url){
        $x = simplexml_load_file($url);
        echo"<u1>";
        foreach ($x->channel->item as $entry){
           echo "<li><a href = '$entry->link' title = '$entry->title'>".$entry->title."</a></li>"; 
        }
        echo"</u1>";
    }
    function getComments() {
        global $page;
        global $xmlsrc;
        global $xml;
        $pagination = 3; // Number of posts on page
        $i = 0; // comments index   
        foreach ($xml->comment as $comment) {
            ++$i;
            if ((($page - 1) * $pagination) < $i && $i <= ($page * $pagination)) { // match page number to comments we want to show
                $gravatar_img = 'http://www.gravatar.com/avatar/?gravatar_id=' . md5(strtolower($comment->email)) . '&amp;default=monsterid&amp;size=75'; // get gravatar img for each email   
                echo '
          <div class="commentwrap">
                  <img class="gravatar" alt="Gravatar - " src="' . $gravatar_img . '" />
                  <div class="author"><h3>';
                if ($comment->email != "") {
                    echo '<a href="mailto:' . htmlspecialchars($comment->email) . '">' . htmlspecialchars($comment->name) . '</a>';
                } // check if author supplied email - if so, show mailto: link
                else {
                    echo htmlspecialchars($comment->name);
                }; // else show only name 
                echo '</h3></div>
                  <div class="comment">' . nl2br(htmlspecialchars($comment->message)) . '</div>' // strip HTML - but preserve line breaks 
                . '</div>';
            } else {
                if ($i > ($page * $pagination)) { // add next page link (if more comments exist)
                    echo "<a class=\"pageplus\" href=\"?page=";
                    echo $page + 1;
                    echo "#comments\">Newer comments &raquo;</a>";
                    break;
                } // end next page link
            }
        }  // end foreach 
        if ($page > 1) {
            echo "<a class=\"pageminus\" href=\"?page=";
            echo $page - 1;
            echo "#comments\">&laquo; Older comments</a>";
        } // add link to previous pages (if not on page 1)
    }

// end getComments
    ?>

    <div id="header">  
        <h1><a href="index.php">Flightbook</a></h1>
        <ul>
            <li>Welcome to our Flightbook Website</li>
            <li>You can enjoy booking,revoking flight tickets and commenting bad airline companies in our page</li>
        </ul> 
    </div>  

    <div align="center" id="flysearch">
        <h2>flight Search:</h2>
        <form action ="flyinfo.php" method="post">
            From:<input type="text" name = "from"/>
            Destination:<input type="text" name = "des"/>
            <input type = "submit" value="search"/>
        </form>
    </div>


    <div id="register" align="right">
        <div id="innerregister"> 
            <div id="innerregdivbanner"><h2>book your tickets:</h2></div>
            <form name="myForm" action="book.php"   method="post">

                <!--registeration form div-->
                <table style=" border-spacing:13px;">
                    <tr>
                        <td id="td">Firstname: </td> <td id="td"><input id="input" type="text" name="firstname" > </td>

                    </tr>
                    <tr>
                        <td id="td">Surname: </td> <td id="td"><input id="input" type="text" name="surname"> </td>

                    </tr>


                    <tr>
                        <td>Username: </td> <td><input id="input" type="text" name="username" /> </td>

                    </tr>

                    <tr>
                        <td >Password: </td> <td><input id="input" type="password" name="password" /> </td>

                    </tr>
                    <tr>
                        <td >Flight: </td> <td><input id="input" type="text" name="flight" /> </td>

                    </tr>
                </table>

                <input  name="submitregistration" id="submit" type="submit" value="book!" /> 
                <a style="color:red; font-size:15px;  " href="index.php">Cancel</a>

            </form><br>
        </div>               
    </div>  

    <div  id="revoke" align="left">
        <h2>revoke your tickets:</h2>
        <form name="myForm" action="revoke.php"   method="post">

            <table style="padding-top:20px;  border-spacing:13px;"> 
                <tr><td>Username:</td><td> <input type="text" name="username"></td> </tr>  
                <tr><td>Password : </td><td><input type="password" name="password"></td> </tr> 
                <tr><td>flight : </td><td><input type="text" name="flight"></td> </tr> 
            </table><br> 
            <input id="submit" type="submit" name="submitLogin" value="revoke" >
        </form>
    </div>  <!--end div for login--> 
    
    <div id ="news" align="center"><font color = "#FF00FF"> <?php echo getFeed("http://rss.cnn.com/rss/edition.rss");?></font></div>
    <div id="wrap">  
        <h2>Add comment:</h2>
        <form name="addcomment" action="submit.php" method="post"> 
            <label for="fname">Name:</label> <input type="text" id="fname" name="name" /> 
            <label for="email">Email:</label> <input type="text" id="email" name="email" />
            <label for="fmessage">Message:</label> <textarea rows="4" cols="15" id="fmessage" name="message"></textarea>
            <input id="submit" type="submit" value="Send" />
            <script type="text/javascript">
                var fname = new LiveValidation('fname'); // validate email 
                fname.add(Validate.Presence);
                var fmessage = new LiveValidation('fmessage'); // validate message
                fmessage.add(Validate.Presence);
            </script> 
        </form>

        <hr /><a name="comments"></a>

        <h2><?php echo $counted; ?> Comments</h2>
        <?php
        getComments();
        ?>
        <?php
        if (isset($_GET["category"])) {
            ?>
            <script>
                alert("Sorry your username Already exist");
            </script>
            <?php
        }
        if (isset($_GET["bad"])) {
            ?>

            <script>
                alert("xml validation error! Your details does not conform to our xml scehma");
            </script>
            <?php
        }
        if (isset($_GET["login"])) {
            ?>
            <script>
                alert("Sorry Login details Miss-match");
            </script>
            <?php
        }
        if (isset($_GET["revoke"])) {
            ?>
            <script>
                alert("your ticket is succesfully revoked");
            </script>
            <?php
        }
        if (isset($_GET["book"])) {
            ?>
            <script>
                alert("your ticket is succesfully booked");
            </script>
            <?php }
            ?>

    </div>


    <div id="footer">
        Footer
    </div>

</body>
</html>