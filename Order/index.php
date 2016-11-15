<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../css/commonCss.css" />
        <style type="text/css">
            #form
            {
                font-weight: bold;
                margin-left:260px;;
            }
            
            #fName{
                color: #ff0033;
            }
            
        </style>
        <script type='text/javascript'>
            var filled = 0;
            var fNameFilled =0;
            var lNameFilled =0;
            var addressFilled =0;
            var pCodeFilled =0;
            var ccNumFilled =0;
            
            function notEmpty(userIn,id)
            {
                if(userIn==null || userIn=="" || userIn =="")
                {
                    var html= "<div style=\"background-color:rgba(181,181,181,0.9); border-radius:5px; padding: 0px 20px;\"><span style=\"color: #ff0015; font-size:20px;\" > Cannot be Empty!</span></div>";
                    document.getElementById(id).innerHTML = " " + html;
                }
                
                else
                {
                    document.getElementById(id).innerHTML = "";
                }
            }
            
        </script>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Order</title>
    </head>
    <body>
        <div class="header">
            <a href="../" id="logo"> Infinity Computers</a>
            <a href="../ContactUs/" class="pages">Contact Us</a>
            <a href="#" class="pages">Order</a>
            <a href="../Products/" class="pages">Products</a>
            <a href="../" class="pages">Home</a>
        </div>
        <div id="bodyOfPage">
        <div class="contentWrap">
        <div class="pageCont">
        <form name="forma" action="../Confirmation/index.php" method="post">
            <table id="form" style="margin-top:40px;">
                <tr><td>First Name  </td><td>: <input type="text" name="firstname"  onBlur="notEmpty(this.form.firstname.value,'fName');"/></td><td id="fName"></td></tr>
            <tr><td>Last Name   </td><td>: <input type="text" name="lastname" onBlur="notEmpty(this.form.lastname.value,'lName');" /></td><td id="lName"></td></tr>
            <tr><td>Model You Want To Buy</td><td>: <select name="model" style="width: 154px;margin-left:2px;">
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

                $result = mysql_query("SELECT * FROM laptops ORDER BY name ASC");
                $lastCo="";
                $num = mysql_num_rows($result);
                $num = $num -1;
                if(isset($_GET['model']))
                {
                    $numOfRes=0;
                    for($i=0; $i< $num;$i++)
                    {
                        if($i==0)
                        {
                            $row = mysql_fetch_array($result);
                        }
                        echo "<optgroup label=".$row['name'].">";
                        do
                        {
                            if($row['modelNum'] == $_GET['model'])
                            {
                                echo "<option selected value=".$row['modelNum'].">".$row['modelNum']."</option>";
                            }
                            else
                            {
                                echo "<option value=".$row['modelNum'].">".$row['modelNum']."</option>";
                            }
                            $lastCo=$row['name'];
                            $row = mysql_fetch_array($result);
                            
                            
                            $numOfRes++;
                        }while($row['name']== $lastCo && $numOfRes<$num);
                        echo "</optgroup>";
                    }
                }
                
                else
                {
                    $numOfRes=0;
                    for($i=0; $i< $num;$i++)
                    {
                        if($i==0)
                        {
                            $row = mysql_fetch_array($result);
                        }
                        echo "<optgroup label=".$row['name'].">";
                        do
                        {
                            
                            echo "<option value=".$row['modelNum'].">".$row['modelNum']."</option>";
                            $lastCo=$row['name'];
                            $row = mysql_fetch_array($result);
                            
                            $numOfRes++;
                        }while(($row['name']== $lastCo) && $numOfRes<$num);
                        echo "</optgroup>";
                    }
                }
                
                mysql_close($con);
           
            ?>
            </select></td></tr>
            <tr><td>Additional RAM</td><td>: <input type="radio" name="addRam" checked value="No Additional RAM"/> No Additional RAM</td></tr>
            <tr><td></td><td> &nbsp;&nbsp;<input type="radio" name="addRam" value="2 GB"/> 2 GB ($25)</td></tr>
            <tr><td></td><td> &nbsp;&nbsp;<input type="radio" name="addRam" value="4 GB"/> 4 GB ($34)</td></tr>
            <tr><td>Address</td><td>: <input type="text" name="address" onBlur="notEmpty(this.form.address.value,'address');" /></td><td id="address"></td></tr>
            <tr><td>Postal Code</td><td>: <input type="text" name="postalcode" onBlur="notEmpty(this.form.postalcode.value,'pCode');" /></td><td id="pCode"></td></tr>
            <tr><td>Credit Card Number</td><td>: <input type="text" maxlength="11" name="cardNum" onBlur="notEmpty(this.form.cardNum.value,'ccNum');" /></td><td id="ccNum"></td></tr>
            </table>
            <input style="position: relative; left: 340px;" type="image" width="200px" name="Submit" src="http://img191.imageshack.us/img191/4706/5438798.png">
        </form>
    </div>
    </div>
            <div id="errors">
    </div>
    </body>
</html>
