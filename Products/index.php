<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="../css/commonCss.css" />
        <title>Products :: Infinity Computers</title>
    </head>
    <body>
        <div class="header">
            <a href="../" id="logo">Infinity Computers</a>
            <a href="../ContactUs/" class="pages">Contact Us</a>
            <a href="../Order/" class="pages">Order</a>
            <a href="../Products/" class="pages">Products</a>
            <a href="../" class="pages">Home</a>
        </div>
        <div id="bodyOfPage"">
        <div class="contentWrap2">
            <span style="font-size:40px; margin-left: 14px; margin-bottom: 7px;position: relative; top:10px; ">All Products</span><br/>
            <?php
                $host = "localhost";
                $username = "padhruv";
                $pwd = "991269415";
                /*$host = "localhost";
                $username= "root";
                $pwd ="";*/
                $con = mysql_connect($host,$username,$pwd);
                if (!$con)
                {
                    die('Could not connect: ' . mysql_error());
                }

                mysql_select_db("padhruv", $con);

                $result = mysql_query("SELECT * FROM laptops");
            
                while($row = mysql_fetch_array($result))
                {
                    echo "<div class='contentOut'><img class='contentImg' src='" . $row['image'] ."' /> <div class='contentDat'><span class='prodName'>".$row['name'] ."</span><br /><span class='prodPrice'>$ ".$row['price']."</span><a href='../Order/index.php?model=".$row['modelNum']."'><img src='http://img152.imageshack.us/img152/8265/buyp.gif' class='buy'/></a></div></div>";
                
                }
            
                mysql_close($con);
            ?>
        </div>    
    </div>
    </body>
</html>
