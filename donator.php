<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 

$i=0;

$msgs_bday=$msg_bday=$msgs_name=$gender=$tnc=$tncv=$tnc7v=$tnc6v=$tnc5v=$tnc4v=$tnc3v=$tnc2v=$tnc1v=$msg_name=$msg2s_name=$msg2_name=$msg2s_pass2=$msg_pass2=$msgs_pass=$msg_pass=$msg2s_pass=$msgs_pass2=$msg2_pass=$msg2_pass2=$msg3s_pass2=$msg3_pass2=$msgs_email=$msg_email=$msg2s_email=$msg2_email=$msg2_agree=$msg_agree="";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name_subject = $_POST['user1']; //get user name  
    $name_pattern = '/(?=.*\d)(?=.*[a-z]).{10}/';  //regular expression for user
    if(empty($_POST['bday']))  
	{
		$msgs_bday="*";
		$msg_bday="You must enter your date of birth.";
	}
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
	$bday= $_POST["bday"];
	if($msg2_agree == "" && $msg_agree=="" && $msgs_name=="" && $msg_name=="" && $msg2s_name=="" && $msg2_name=="" && $msgs_email=="" && $msg_email=="" && $msg2_email=="")
	{
	
			$con=mysqli_connect($host, $username, $password) or die("cannot connect"); 
			mysqli_select_db($con,$db_name) or die("cannot select DB!!");
			$te="SELECT * FROM `donator` WHERE email='$email'";
			$re=mysqli_query($con, $te);
			$n = mysqli_num_rows($re); 
			if($n)
			{
				$msgs_email="*";			
				$msg_email="EMAIL ALREADY EXISTS";
			}
			else
			{				
				header("location:matchd.php?user=".$user."&gender=".$gender."&email=".$email."&bday=".$bday);	
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
                <li><a href="doctor.php" >doctor</a></li>
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
              <div class="col-md-6 col-md-offset-3">
                <br><br><br><br><br><br><br><br><br>

        <br>
                  <br>
                     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="on" >
                     <table>
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
	                     <td>Date of birth:</td>
		                     <td><input name="bday" type="date" max="2006-01-01" required>
		                     <?php echo "<span class='r'>".$msgs_bday."</span>";?></td>
                                     
	                     </tr>
	                     <tr>
	                          <td><?php echo "<p class='r'>".$msg_bday."</p>";?></td>
	                     </tr>
	                     
	            	     <tr>
		                     <td colspan="2" class="center"><br><br>
		                         <input name="submit1" type="submit" value="Register">
		                         <input name="reset1" type="reset" value="Reset"><br>
		                     </td>
	                     </tr>

                    </table>
                    </form><br><br>
					<a href="edit.php" style="color:red">EDIT YOUR FORM</a>
     
      </div></div></div>
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