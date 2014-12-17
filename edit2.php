<?php




function random_string() {
    $key = '';
    $keys = array_merge(range(0, 9), range('a', 'z'),range('A', 'Z'));

    for ($i = 0; $i < 5; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
}
$rsent=false;



//initialize database information
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 
//$tbl_name="members"; // Table name
$to="";
$error="";
$error2="";
$con = mysqli_connect($host, $username, $password) or die("cannot connect"); 
mysqli_select_db($con , $db_name) or die("Cannot Enter DATABASE");

//This code runs if the form has been submitted
if (isset($_POST['remail']))
	{
 
	// check for valid email address
	$email = $_POST['remail'];
	$pattern = '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';
	if (!preg_match($pattern, trim($email))) {
  		$error = 'Please enter a valid email address';
	}
 
// checks if the username is in use
	$check = mysqli_query($con,"SELECT * FROM patient WHERE email = '$email'")or die(mysql_error());
	$check2 = mysqli_num_rows($check);
 
//if the name doesn't exist it gives an error
	if ($check2 == 0) {
		$error2 = "Sorry, we cannot find your account details please try another email address.";
	}
 
// if no errors then carry on
	if (($error == "") && ($error2 == "" )) {
 
		$query = mysqli_query($con,"SELECT * FROM patient WHERE email = '$email' ")or die (mysql_error());
 
//create a new random password
 
		$password = uniqid(random_string());
		//update database
		//$sql = mysqli_query($con,"UPDATE donator SET pass='$password' WHERE email = '$email'")or die (mysql_error());
		
 
//send email
		$to = $email;
		$subject = "Reset patient's form";
		$body = "Hi , \n\n The code is $password.\n\n Regards kidney.com";
		$additionalheaders = "From: <kidneydonation390@gmail.com>";
		mail($to, $subject, $body, $additionalheaders);
 		$rsent = true;

		
 
 
		}// close error
 
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
                <li><a href="doctor.php" >doctor</a></li>
                <li><a href="donator.php">donator</a></li>
                <li><a href="patient.php" class="active">patient</a></li>
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
					    <?php if ($rsent == true){
					           
					           echo"<a href=\"change2.php?email=$to\">Click Here To Edit Your Form</a>";

							 }
							else {?>
							<p>Please enter your e-mail address. You will receive a code via e-mail</p><br>
							<p>Email Address: <input type="text" name="remail" size="50" maxlength="255">
							<br><br>
						    <input type="submit" name="submit" value="Get a code to edit your form"></p><br>

							
						<?php }
						

						    //show any errors
							if (!empty($error))
							{
								echo "<div>".$error."</div>";
							
							}
							else if (!empty($error2))
							{
								echo "<div>".$error2."</div>";
								
							}						?>

					</form>
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