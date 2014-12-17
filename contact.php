<?php
session_start();
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
    <link rel="stylesheet" href="css1/star.css">
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
                <li><a href="index.html">home</a></li>
                <li><a href="doctor.php">doctor</a></li>
                <li><a href="donator.php">donator</a></li>
                <li><a href="patient.php">patient</a></li>
                <li><a href="contact.php" class="active">contact</a></li>
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
                <br><br>
<?php

$msgsz_email="";
$msg2z_email =" ";
$msg_select =" ";
$msg2sz_pass=$msg2z_pass=$msgsz_email=$msg2sz_email=$msgsz_area=$msgz_email=" ";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 $email_subject = $_POST['email1'];  //get the email
 $email_pattern = '/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/';  //regular expression for the email
 preg_match($email_pattern, $email_subject,$email_matches); // check if the email match the regular expression
 if(empty($_POST['email1'])) // checking if the email is empty
 {  
  $msgz_email = "Enter email";  
 }

  else if (!$email_matches[0])   
 {
  $msg2z_email = "Email address is not in a valid format\n";
 }
// if(($msg2z_email!="")||($msgz_email!=""))
 //{
   // $msgsz_email="*"; 
 //}
 if(empty($_POST['description']))  //check if the textarea is empty
 {
  $msg_select = "please enter your comments";
  $msgsz_area="*";
 }
 $msg= $_POST['description']; //get text area message
 $email=$_POST['email1'];  //get email 
 mail("kidneydonation390@gmail.com",$msg,"From : ".$email); //send email

}
?>

         <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="on" >         
       <br><br><br><br>Email: <input name="email1" type="email" value="" required="required">
       <?php echo "<span class='r'>".($msgsz_email)."</span>";?>
       
	<?php echo "<p class='r'>".$msgz_email."</p>";?>
	<?php echo "<p class='r'>".$msg2z_email."</p>";?>
         <br><br>    
         	Enter Your Comments:<?php echo "<span class='r'>".$msgsz_area."</span>";?> <br><br>
         <textarea id="msg" cols="60" rows="15" name="description" required="required"></textarea>
              
		 <?php echo "<p class='r'>".$msg_select."</p>";?>

         <br><br>
         <input name="submitb" type="submit" value="Submit">
         <input name="reset" type="reset" value="reset"><br>
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/unslider.min.js"></script>
  </body>
</html>