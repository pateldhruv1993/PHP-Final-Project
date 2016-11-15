<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" type="text/css" href="../css/commonCss.css" />
         <style type="text/css">
            .pageCont
            {
                margin-left: auto;
                margin-right: auto;
                margin-top: 60px;
                width: 88%;
                border: 2px solid;
                border-color: #000000;
                border-radius: 5px;
                background-color:rgba(181,181,181,0.5);
            }
            
            #error
            {
                font-weight: bold;
                font-size: 30px;
            }
            
            .inner
            {
                margin-left: auto;
                margin-right: auto;
                min-height:300px;
            }
            
        </style>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Order Confirmation</title>
    </head>
    <body>
        <div class="header">
            <a href="../" id="logo">Infinity Computers</a>
            <a href="../ContactUs/" class="pages">Contact Us</a>
            <a href="../Order/" class="pages">Order</a>
            <a href="../Products/" class="pages">Products</a>
            <a href="../" class="pages">Home</a>
        </div>
        <div class="pageCont">
            <div class="inner">
            <?php
                $host = "localhost";
                $username = "padhruv";
                $pwd = "991269415";
                /*$host = "localhost";
                $username= "root";
                $pwd ="";*/
                
                $con = mysql_connect($host,$username,$pwd);
                
                $firstN="";
                $lastN="";
                $address="";
                $postalCode="";
                $creditCard="";
                $modelNum="";
                $addRAM="";
                $err = "<div align='center' width='auto' style='font-size: 30px; margin:10px; padding:5px;'>One Or More Fields Were Left Empty.<br/>To Fill Your Form Again, <a href='../Order/'>Click Here</a></div>";
                
                if (!$con)
                {
                    die('Could not connect: ' . mysql_error());
                }       
                if(isset($_POST['firstname'])  && $_POST['firstname'] != "")
                {
                    $firstN = $_POST['firstname'] ;
                }
                
                else
                {
                    echo $err;
                    return;
                }
                
                if(isset($_POST['lastname'])  && $_POST['lastname'] != "")
                {
                    $lastN = $_POST['lastname'] ;
                }
                
                else
                {
                    echo $err;
                    return;
                }
                
                
                if(isset($_POST['address'])  && $_POST['address'] != "")
                {
                    $address = $_POST['address'] ;
                }
                
                else
                {
                    echo $err;
                    return;
                }
                
                if(isset($_POST['postalcode'])  && $_POST['postalcode'] != "")
                {
                    $postalCode = $_POST['postalcode'] ;
                }
                
                else
                {
                    echo $err;
                    return;
                }
                
                if(isset($_POST['model'])  && $_POST['model'] != "")
                {
                    $modelNum = $_POST['model'] ;
                }
                
                else
                {
                    echo $err;
                    return;
                }
                
                if(isset($_POST['cardNum'])  && $_POST['cardNum'] != "")
                {
                    $creditCard = $_POST['cardNum'] ;
                }
                
                else
                {
                    echo $err;
                    return;
                }
                
                if($_POST['addRam'] ==  "No Additional RAM")
                {
                    $addRamPrice = 0;
                    $ram = "None";
                }
                if($_POST['addRam'] ==  "2 GB")
                {
                    $addRamPrice = 25;
                    $ram = "2 GB ($ 25)";
                }
                if($_POST['addRam'] ==  "4 GB")
                {
                    $addRamPrice = 34;
                    $ram = "4 GB ($ 34)";
                }
                
                $query = "INSERT INTO custorder (firstN,lastN,modelNum,addRAM,address,postalCode,creditCard) VALUES ('$firstN','$lastN','$modelNum','$addRAM','$address','$postalCode','$creditCard')";
                $addRAM = $_POST['addRam'] ;
                
                mysql_select_db("padhruv", $con);
                $result = mysql_query($query,$con);
                
                if(!$result)
                {
                    echo "<span id='error'>Something went wrong. Please Re-submit your form. <a href='../Order/'>Click Here</a></span>";
                }
                
                $query2 = "SELECT * FROM laptops WHERE modelNum = '$modelNum'";
                $result = mysql_query($query2,$con);
                
                $row = mysql_fetch_array($result);
                
                if($result)
                {
                    echo "<img src=\"".$row['image']."\" style=\"float:left; border: 2px solid; border-color:#4f535e ; border-radius:5px;\" />";
                    $model = $row['modelNum'];
                    $company = $row['name'];
                    $price = $row['price'] ;
                }
                
                
                
                //OUTPUT
                $query2 = "SELECT * FROM custorder WHERE creditCard = '$creditCard'";
                
                $result2 = mysql_query($query2,$con);
                
                if ($result) 
                {
                    $row = mysql_fetch_array($result2);
                    
                    $amount= $price + $addRamPrice;
                    echo "<div style=\"float:left; margin-left:20px;\"><span style=\"font-size:50px;font-weight:bold;\">".$company."</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-size:30px;\">".$model."</span>";
                    echo "<table align=\"center\" width=\"400px;\" style=\" font-size:30px; \">";
                    echo "<tr><td>Name </td><td>:  ".$row['firstN']." ".$row['lastN']."</td></tr>";
                    echo "<tr><td>Address </td><td>:  ".$row['address']." </td></tr>";
                    echo "<tr><td>Postal Code </td><td>:  ".$row['postalCode']." </td></tr>";
                    echo "<tr><td>Additional RAM </td><td>:  ".$ram."</td></tr>";
                    echo "<tr><td>Total Amount </td><td>:  $".$amount."</td></tr>";
                    echo "</table></div>";
                } 
                
                else
                {
                    $error = "<span id='error'>Sorry could not retrieve your order Confrmation</span>";  
                    echo $error;  
                    return;
                }
                
                mysql_close($con);
            ?>
            </div>
            </div>
    </body>
</html>
