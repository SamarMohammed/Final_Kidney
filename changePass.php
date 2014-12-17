<?php

//initialize database information
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 
$to=$_GET['email'];

//set all variables to null
$msgs_pass=$msg_pass=$msg2s_pass=$msg2_pass2=$msg3_pass2=$mgpass=$mgspass=$alrt=$msg2_pass=$msgs_pass2=$msg2s_pass2=$msg_pass2="";

$error2="";
if (isset($_POST['pass1'])&&isset($_POST['pass2'])&&isset($_POST['pass3'])) 
{  
	$pass_subject = $_POST['pass2'];  // get the password
	$pass_pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/'; //regular expression for the password 
	//preg_match($pass_pattern, $pass_subject, $pass_matches);  //check if the password match the regular expression
	if(empty($_POST['pass2'])) //check if the password is empty
	{
		$msgs_pass="*"; 
		$msg_pass="You must supply your password"; 
	} 
	else 
	{
		if(!preg_match($pass_pattern, $pass_subject, $pass_matches)/*!$pass_matches[0]*/)
		{  
			$msg2s_pass="*";
			$msg2_pass = "Password must be greater than 5 char & contains both Capital & small letter & digit ";
		}
	}
	$pass2_subject = $_POST['pass3'];  //get the confirm password 
	$pass2_pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/';  //regular expression for the password
	//preg_match($pass2_pattern, $pass2_subject, $pass2_matches); //check if the password match the regular expression
	if(empty($_POST['pass3'])) //check if the confirm password is empty
	{
		$msgs_pass2="*";  
		$msg_pass2="You must supply your password";  
	}  
	else 
	{
		if(!preg_match($pass2_pattern, $pass2_subject, $pass2_matches)/*!$pass2_matches[0]*/) 
		{
			$msg2s_pass2="*"; 
			$msg2_pass2="Password must be greater than 5 char & contains both Capital & small letter & digit ";
		}
	}
	//check if the two password is equal
	if ($pass_subject!=$pass2_subject)
	{
		
		$msg3_pass2="Passwords doesn't match";
	}
	
	
	       

		$pass1 = $_POST["pass1"];//get old password
		$pass2 = $_POST["pass2"];//get confirm password
	
		$con = mysqli_connect($host, $username, $password) or die("cannot connect");
		mysqli_select_db($con , $db_name) or die("Cannot Enter DATABASE");
/*		if (mysqli_errno($con)) 
		{
			die("Failed to connect to MySQL: " . mysqli_error());
		}
		mysqli_select_db($con , $db_name) or die ("Cannot select database");*/
	
		$check = mysqli_query($con,"SELECT * FROM doc WHERE email = '$to'")or die(mysql_error());
	    $check2 = mysqli_num_rows($check);
 
        //if the name doesn't exist it gives an error
	    if ($check2 == 0) {
		$error2 = "Sorry, we cannot find your account details please try another email address.";
		
		}
                

 
		// if no errors then carry on
		if ( ($error2=="") && ($msgs_pass=="")&&($msg_pass=="")&&($msg2s_pass=="")&&($msg2_pass2=="")&&($msg3_pass2=="" )) {
 
		
		
		$sql = mysqli_query($con,"UPDATE doc SET pass='$pass2' WHERE email = '$to' AND pass='$pass1'")or die (mysql_error());
		$sql = mysqli_query($con,"SELECT * FROM doc WHERE email = '$to' AND pass='$pass2'");
	    $check3 = mysqli_num_rows($sql);


	        //if the password updated carry on else show error
	        if ($check3) 
	        {       $alrt=true; 
	        	    $message = "Password Has Been Changed";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                        //header("Location:home.php");
	      	        
	        }
	        else 
	        {
	    	$alrt=false;
	    	$message = "You have entered a wrong old password";
            echo "<script type='text/javascript'>alert('$message');</script>";
	        
	        
	    } 
   
	   
	}
	 mysqli_close($con);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    <title>KIDNEY</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/queries.css">
    <link href="font-awesome.css" rel="stylesheet">
	  <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="html5shiv.js"></script>
      <script src="respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<header class="clearfix">
		    <div class="logo col-md-3"><h2 class="logo-text">KIDNEY</h2></div>
		    <nav class="clearfix">
            <ul class="clearfix">
                <li><a href="index.html" >home</a></li>
                <li>
				<a href="doctor.php" class="active">doctor</a></li>
                <li><a href="donator.php">donator</a></li>
                <li><a href="patient.php">patient</a></li>
                <li><a href="contact.php">contact</a></li>
            </ul>
        </nav>
        <div class="pullcontainer">
        <a href="#" id="pull"><i class="fa fa-bars fa-2x"></i></a>
        </div>     
		</header>
		
		
    <div class="banner">
    <ul>
        <li style="background-image: url('img/11.jpg');">
         <div class="container">
            <div class="row">
              <div class="col-md-6 col-md-offset-3"><br><br><br><br><br>
<form action="<?php $_SERVER['PHP_SELF']?>" method="post" autocomplete="on">
					 <?php if ($alrt == true){
					           
					           echo"<a href=\"index.html\">Return To Home Page</a>";

					}else{
	
					
						echo"You have been sent an email with your account details to ".$to."<br>" ?>
						<br><br><br>
                     <table>
	                    <tr>
		                     <th colspan="2" style="color:white">Change Password<br><br></th>
             	            </tr>
             	            <tr>
		                     <td>Old Password:</td>
		                     <td><input name="pass1" type="password" placeholder="Password" required value=""><br><br></td>
		                     
		             </tr>
	                 			    
	                    <tr>
		                     <td>New Password:</td>
		                     <td><input name="pass2" type="password" placeholder="Password" required value=""></td>
		                     <td><?php echo "<p class='r'>".$msgs_pass."</p>";?>
                                     <?php echo "<p class='r'>".$msg2s_pass."</p>";?>
		                     </td>
	                     </tr>
	                     <tr>
	                     	<td></td>
	                         <td><?php echo "<p class='r'>".$msg_pass."</p>";?>
                                     <?php echo "<p class='r'>".$msg2_pass."</p>";?>
		                </td>
                                 </tr>
	   	                 <tr>
		                     <td>Confirm Password:</td>
		                     <td><input name="pass3" type="password" placeholder="Password" value="" required></td>
		                     <td><?php echo "<p class='r'>".$msgs_pass2."</p>";?>
                                     <?php echo "<p class='r'>".$msg2s_pass2."</p>";?>
                                     
		                     </td>
	                     </tr>
	                     <tr>
	                     	<td></td>
	                        <td><?php echo "<p class='r'>".$msg_pass2."</p>";?>
                                     <?php echo "<p class='r'>".$msg2_pass2."</p>";?>
                                     <?php echo "<p class='r'>".$msg3_pass2."</p>";?>
		                     </td>
		             	</tr>

	            	     <tr>
		                     <td colspan="2" class="center">
		                         <button name="submit1" type="submit">Change</button>
		                         <button name="reset1" type="reset">Reset</button><br>
		                     </td>
	                     </tr>

                    </table>
	
					<?php } ?></form>
</div>
            </div>
          </div>
        </li>
    </ul>
</div>
 <div class="container">
    <div class="arrow"></div>
    </div>
     <script src="jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
  </body>
</html>
