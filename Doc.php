<?php
//initialize database information
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 
$tbl_name="members"; // Table name


$msgs_name=$msg_name=$msg2s_name=$msg2_name=$msg2s_pass2=$msg_pass2=$msgs_pass=$msg_pass=$msg2s_pass=$msgs_pass2=$msg2_pass=$msg2_pass2=$msg3s_pass2=$msg3_pass2=$msgs_email=$msg_email=$msg2s_email=$msg2_email=$msg2_agree=$msg_agree="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{  

        $name_subject = $_POST['user1']; //get user name  
        $name_pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,10}/';  //regular expression for user
	//checking if user name is empty
	if(empty($_POST['user1']))  
	{
		$msgs_name="*";
		$msg_name = "You must enter your card number";  
	} 
	else 
	{
		if(!preg_match($name_pattern, $name_subject, $name_matches)/*!$name_matches[0]*/) 
		{ 
			$msg2s_name="*"; 
			$msg2_name="Wrong number"; 
		}
	}
	// Connect to server and select databse.
	$con=mysqli_connect($host, $username, $password) or die("cannot connect"); 
	mysqli_select_db($con,$db_name) or die("cannot select DB!!");
	$sql="SELECT id FROM `doctors` WHERE id='$name_subject'"; 
	$result=mysqli_query($con,$sql);
	if ($result)
	{
		 $count=mysqli_num_rows($result);
	 
		 if ($count!=1)
		 {
    		$msg_name = "You are not validated doctor.";
    	}
	}
	else 
	    echo "there is no result";

	
	$pass_subject = $_POST['pass1'];  // get the password
	$pass_pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/'; //regular expression for the password 
	if(empty($_POST['pass1'])) //check if the password is empty
	{
		$msgs_pass="*"; 
		$msg_pass="You must supply your password"; 
	} 
	else 
	{
		if(!preg_match($pass_pattern, $pass_subject, $pass_matches)/*!$pass_matches[0]*/)
		{  
			$msg2s_pass="*";
			$msg2_pass = "Wrong password";
		}
	}
	$pass2_subject = $_POST['pass2'];  //get the confirm password 
	$pass2_pattern = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{5,}/';  //regular expression for the password
	if(empty($_POST['pass2'])) //check if the confirm password is empty
	{
		$msgs_pass2="*";  
		$msg_pass2="You must supply your password";  
	}  
	else 
	{
		if(!preg_match($pass2_pattern, $pass2_subject, $pass2_matches)/*!$pass2_matches[0]*/) 
		{
			$msg2s_pass2="*"; 
			$msg2_pass2="Wrong password";
		}
	}
	//check if the two password is equal
	if ($pass_subject!=$pass2_subject)
	{
		$msg3s_pass2="*";
		$msg3_pass2="Password doesn't match";
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
	
	
	$email = $_POST["email"];
	$user = $_POST["user1"];
	$pass = $_POST["pass1"];
	if($msgs_name=="" && $msg_name=="" && $msg2s_name=="" && $msg2_name=="" && $msgs_pass=="" && $msg_pass=="" && $msg2s_pass=="" && $msg2_pass2=="" && $msg3s_pass2=="" && $msg3_pass2=="" && $msgs_email=="" && $msg_email=="" && $msg2_email=="")
	{
	   $con=mysqli_connect($host, $username, $password) or die("cannot connect"); 
	   mysqli_select_db($con,$db_name) or die("cannot select DB!!");
		$q="SELECT * FROM `doc` WHERE email=`$email`";
		$result=mysqli_query($con, $q);
		$count=mysqli_num_rows($result);
		if($result)
		{
			echo "<h1>USER OR EMAIL ALREADY EXISTS </h1>";
			header("location:Doc.php");
		}
		else 
		{
		    $query = "INSERT INTO `doc`(`email`, `pass`,`card`) VALUES ('$email','$pass','$user')";
		    if (mysqli_query($con,$query)) 
		    {        
		       echo "<h1>Data has been inserted into database</h1> ";
		       header("Location:index.html");
		    }
		    else 
		    {
		        echo "Error: " . mysqli_error($con);
		    }    
		    mysqli_close($con);
		}
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
        
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	  <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Sintony:400,700' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<header class="clearfix">
		    <div class="logo col-md-3"><h2 class="logo-text">KIDNEY</h2></div>
		    <nav class="clearfix">
            <ul class="clearfix">
                <li><a href="index.html" >home</a></li>
                <li><a href="doctor.php" class="active">doctor</a></li>
                <li><a href="donator.php">donator</a></li>
                <li><a href="patient.php">patient</a></li>
                
            <li><a href="#"></a></li>
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
              <div class="col-md-6 col-md-offset-3">
                <br><br><br><br><br><br><br><br><br>

        <br>
                  <br>
                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="on" >
                     <table>
	               	         <tr>
		                     <td>Card number:</td>
		                     <td><input name="user1" type="text" placeholder="Card number" value="" required></td>
		                     <td style="float=left;"><?php echo "<p class='r'>".$msgs_name."</p>";?>
                                     <?php echo "<p class='r'>".$msg2s_name."</p>";?></td>
                             </tr>
                             <tr>
                                 <td><?php echo "<p class='r'>".$msg_name."</p>";?>
                                     <?php echo "<p class='r'>".$msg2_name."</p>";?>

		                     </td>
                         </tr>
	                     <!--<tr>-->

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
		                     <td>Password:</td>
		                     <td><input name="pass1" type="password" placeholder="Password" required value=""></td>
		                     <td><?php echo "<p class='r'>".$msgs_pass."</p>";?>
                                     <?php echo "<p class='r'>".$msg2s_pass."</p>";?>
		                     </td>
	                     </tr>
	                     <tr>
	                         <td><?php echo "<p class='r'>".$msg_pass."</p>";?>
                                     <?php echo "<p class='r'>".$msg2_pass."</p>";?>
		                     </td>
                         </tr>
	   	                 <tr>
		                     <td>Confirm Password:</td>
		                     <td><input name="pass2" type="password" placeholder="Password" value="" required></td>
		                     <td><?php echo "<p class='r'>".$msgs_pass2."</p>";?>
                                     <?php echo "<p class='r'>".$msg2s_pass2."</p>";?>
                                     <?php echo "<p class='r'>".$msg3s_pass2."</p>";?>
		                     </td>
	                     </tr>
	                     <tr>
	                        <td><?php echo "<p class='r'>".$msg_pass2."</p>";?>
                                     <?php echo "<p class='r'>".$msg2_pass2."</p>";?>
                                     <?php echo "<p class='r'>".$msg3_pass2."</p>";?>
		                     </td>
		             </tr>
          

	            	     <tr>
		                     <td colspan="2" class="center">
		                         <input name="submit1" type="submit" value="Register">
		                         <input name="reset1" type="reset" value="Reset"><br>
		                     </td>
	                     </tr>

                    </table>
                    </form>

      </div></div></div>
</ul>
</div>
 <div class="container">
    <div class="arrow"></div>
    </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
</body>
</html>