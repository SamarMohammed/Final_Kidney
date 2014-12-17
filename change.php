<?php

//initialize database information
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 
$to=$_GET['email'];

//set all variables to null
$msgs_name=$gender=$tnc=$tncv=$tnc7v=$tnc6v=$tnc5v=$tnc4v=$tnc3v=$tnc2v=$tnc1v=$msg_name=$msg2s_name=$msg2_name=$msg2s_pass2=$msg_pass2=$msgs_pass=$msg_pass=$msg2s_pass=$msgs_pass2=$msg2_pass=$msg2_pass2=$msg3s_pass2=$msg3_pass2=$msgs_email=$msg_email=$msg2s_email=$msg2_email=$msg2_agree=$msg_agree="";
$msgs_pass=$msg_pass=$msg2s_pass=$msg2_pass2=$msg3_pass2=$mgpass=$mgspass=$alrt=$msg2_pass=$msgs_pass2=$msg2s_pass2=$msg_pass2="";

$error2="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 
	$pass_subject = $_POST['pass2'];  // get the password
	$pass_pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/'; //regular expression for the password 
	//preg_match($pass_pattern, $pass_subject, $pass_matches);  //check if the password match the regular expression
	if(empty($_POST['pass2'])) //check if the password is empty
	{
		$msgs_pass="*"; 
		$msg_pass="You must supply your code"; 
	} 
	else 
	{
		if(!preg_match($pass_pattern, $pass_subject, $pass_matches)/*!$pass_matches[0]*/)
		{  
			$msg2s_pass="*";
			$msg2_pass = "The code must be greater than 5 char & contains both Capital & small letter & digit ";
		}
	}
	$name_subject = $_POST['user1']; //get user name  
    $name_pattern = '/(?=.*\d)(?=.*[a-z]).{10}/';  //regular expression for user
    if(empty($_POST['user1']))  
	{
		$msgs_name="*";
		$msg_name = "You must enter your tissue type";  
	} 
	else 
	{
		if(!preg_match($name_pattern, $name_subject, $name_matches)/*!$name_matches[0]*/) 
		{ 
			$msg2s_name="*"; 
			$msg2_name="Wrong format"; 
		}
	}
	$email_subject = $_POST['email'];  //get the email
	$email_pattern = '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/'; //regular expression for email  
	if(empty($_POST['email'])) //check if the email is empty
	{  
		$msg_email = "You must supply your email";  
	} 
	else 
	{
		if(!preg_match($email_pattern, $email_subject, $email_matches)/*!$email_matches[0]*/) 
		{
			$msg2_email="Wrong email formate";
		}
		if(($msg2_email!="")||($msg_email!=""))
		{
		    $msgs_email="*"; 
		}
	}
	if(isset($_POST['se']))
	{
		$tnc=$_POST['se'];
		if($tnc == 'E')
		{
			$msg_agree="*";
			$msg2_agree = "You must select";
		}
	}
	$email = $_POST["email"];
	$user = $_POST["user1"];
	$gender = $_POST["se"];
/*	
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
		if(!preg_match($pass2_pattern, $pass2_subject, $pass2_matches)/*!$pass2_matches[0]*//*) 
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
	*/if($msg2_agree == "" && $msg_agree=="" && $msgs_name=="" && $msg_name=="" && $msg2s_name=="" && $msg2_name=="" && $msgs_email=="" && $msg_email=="" && $msg2_email=="")
	{
		$con = mysqli_connect($host, $username, $password) or die("cannot connect");
		mysqli_select_db($con , $db_name) or die("Cannot Enter DATABASE");
/*		if (mysqli_errno($con)) 
		{
			die("Failed to connect to MySQL: " . mysqli_error());
		}
		mysqli_select_db($con , $db_name) or die ("Cannot select database");*/
	
		$check = mysqli_query($con,"SELECT * FROM donator WHERE email = '$to'")or die(mysql_error());
	    $check2 = mysqli_num_rows($check);
 
        //if the name doesn't exist it gives an error
	    if ($check2 == 0) {
		$error2 = "Sorry, we cannot find your form details please try another email address.";
		
		}
                

 
		// if no errors then carry on
		if ( ($error2=="") && ($msgs_pass=="")&&($msg_pass=="")&&($msg2s_pass=="")&&($msg2_pass2=="")&&($msg3_pass2=="" )) {
 
		
		
		$sql = mysqli_query($con,"UPDATE donator SET email='$email', blood='$gender', tissue='$user' WHERE email = '$to'")or die (mysql_error());
		$sql = mysqli_query($con,"SELECT * FROM donator WHERE email = '$email'");
	    $check3 = mysqli_num_rows($sql);


	        //if the password updated carry on else show error
	        if ($check3) 
	        {       $alrt=true; 
	        	    $message = "Your Form Has Been Changed";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                        //header("Location:home.php");
	      	        
	        }
	        else 
	        {
	    	$alrt=false;
	    	$message = "You have entered a wrong code";
            echo "<script type='text/javascript'>alert('$message');</script>";
	        
	        
	    } 
   
	 }  
	mysqli_close($con);
	}
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
    <link rel="stylesheet" type="text/css" href="css1/star.css">
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
				<a href="doctor.php" >doctor</a></li>
                <li><a href="donator.php" class="active">donator</a></li>
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
		                     <th colspan="2" style="color:white">Edit Form<br><br></th>
             	            </tr>	                 			    
	                    <tr>
		                     <td>Enter the code:</td>
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
	   	                 <td>Email:</td>
		                     <td><input name="email" type="email" placeholder="user@domain.com" value="" required>
		                     <?php echo "<span class='r'>".$msgs_email."</span>";?></td>
                                     
	                     </tr>
	                     <tr>
	                          <td><?php echo "<p class='r'>".$msg_email."</p>";?>
                                     <?php echo "<p class='r'>".$msg2_email."</p>";?></td>
	                     </tr>
	                            <tr>
		                     <td>Choose your blood type:</td>
		                     <td>
		                     	<select name="se" id="sel" onchange="">  
                       			<option value="E">-----</option>
                       			<option value="AP">A+</option>
                       			<option value="AM">A-</option>
                       			<option value="BP">B+</option>
                       			<option value="BM">B-</option>
                       			<option value="ABP">AB+</option>
                       			<option value="ABM">AB-</option>
								<option value="OP">O+</option>
								<option value="OM">O-</option>
                      			</select>
			          		  </td>
			          	  <td><?php echo "<p class='r'>".$msg_agree."</p>";?></td>
	                     </tr>
	                     <tr>
	                    	 <td>  
                        	   <?php echo "<p class='r'>".$msg2_agree."</p>";?>
                        	 </td>
                         </tr> 
	                     
						<tr>
		                     <td>Tissue type:</td>
		                     <td><input name="user1" type="text" placeholder="Tissue type" value="" required></td>
		                     <td style="float=left;"><?php echo "<p class='r'>".$msgs_name."</p>";?>
                                     <?php echo "<p class='r'>".$msg2s_name."</p>";?></td>
                             </tr>
                             <tr>
                                 <td><?php echo "<p class='r'>".$msg_name."</p>";?>
                                     <?php echo "<p class='r'>".$msg2_name."</p>";?>

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
