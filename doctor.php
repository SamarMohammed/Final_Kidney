<?php
session_start();
?>
<?php

//function to check if the email and password for this user in the database 
//function check()
if ($_SERVER["REQUEST_METHOD"] == "POST")
{

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 
//$tbl_name="members"; // Table name 

// Connect to server and select databse.
$con=mysqli_connect($host, $username, $password) or die("cannot connect"); 
mysqli_select_db($con,$db_name) or die("cannot select DB");

// email and password sent from form 
$email=$_POST['email']; 
$pass=$_POST['pass']; 

// To protect MySQL injection (more detail about MySQL injection)
//$pass = stripslashes($pass);

$sql="SELECT email, pass FROM doc WHERE email='$email' AND pass='$pass'"; 

$result=mysqli_query($con,$sql);

if ($result)
{

 $count=mysqli_num_rows($result); 
 if ($count==1)
 {
 
    echo"You are a validated user.";
    $_SESSION["email"] = $email;
    header("Location:d.php");
  }  
    
 else{
    
    $msg="Sorry, your credentials are not valid, Please try again.";
    echo "<script type='text/javascript'>alert('$msg');</script>";
   // displayForm();
    }
}
else 
    $msg="there is no result";
    echo "<script type='text/javascript'>alert('$msg');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">  
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/queries.css">
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
                <li><a href="doctor.php" class="active" >doctor</a></li>
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
              <div class="col-md-6 col-md-offset-3">
                <br><br><br><br><br><br><br><br><br>

<?php
displayform();
//function to display login form
function displayForm() {
?>
<html>
<body>
    <!--<form name="form1" method="post" onclick="check()">-->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="on" >
                     
    <table class="l">	
     <tr>
        <td>Email:</td>
        <td><input name="email" type="text" placeholder="Email" value="" required></td>
    </tr>
    <tr><td><br><br></td></tr>
    <tr>
        <td>Password:</td>
        <td><input name="pass" type="password" placeholder="Password" value="" required></td>
    </tr>
    <tr><td><br><br></td></tr>
    <tr>
       <td colspan="2" class="center">
       <input class="hero-btn"name="submit" type="submit" value="login">
       </td>
    </tr>
     <tr><td><br><br></td></tr>
    <tr>
       <td colspan="2" class="center"><a href="forget.php" class="hero-btn">forgot your password?</a><!--<a href="forget.php">forgot your password?</a>--></td>
    </tr>  
     <tr><td><br><br></td></tr>
    <tr>
       <td colspan="2" class="center">first time? <a href="Doc.php" class="hero-btn">Sign up</a><!--<a href="register.php">signup</a>--></td> 
    </tr>
    </table>
    </form>
   
</body>
</html>
 <?php
    }
    ?>
              </div>
            </div>
          </div>
        </li>
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
