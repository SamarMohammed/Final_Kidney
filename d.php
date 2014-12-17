<?php
session_start();
if(!isset($_SESSION["email"])){
    header("location:index.html");
}
?>
<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 
$m="";



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
                
                <li><a href="doctor.php" class="active">doctor</a></li>
                <li><a href="logout.php">log out</a></li>
                
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
                <br><br><br><br><br>
                
                
                <?php
	               	$con=mysqli_connect($host, $username, $password) or die("cannot connect");  //connect to the database
			        mysqli_select_db($con,$db_name) or die("cannot select DB!!");
					$query="SELECT * FROM `match`";  //query to select the rows where the id = 1
					$r=mysqli_query($con, $query);
					
					if($r)
					{
					?>
					<table class="t" border="1" cellspacing="1" align="center" style="color:black; background-color:white;">
                   <tr >
                   	<td align="center" style="height: 90px; width: 200px; "><b> PATIENT </b></td>
                   	<td align="center"style="height: 90px; width:200px"><b> DONATOR </b></td>
                   	<td align="center" style="height: 90px; width:200px"><b>   BLOOD   </b> </td>
                   	<td align="center" style="height: 90px; width:200px"><b> PATIENT'S TISSUE </b> </td>
					<td align="center" style="height: 90px; width:200px"><b> DONATOR'S TISSUE </b> </td>
                   	<td align="center" width="100" style="height: 90px"><b> CHOOSE </b></td>
                   </tr><?php	
					while($row = mysqli_fetch_array($r))
					{	  
					?>       	       
                   <tr>
                    <td align="center" style="height: 90px"> <?php echo $row['emailp'] ?> </td>
                    <td align="center" style="height: 90px"> <?php echo $row['emaild'] ?> </td>
                    <td align="center" style="height: 90px"> <?php echo $row['blood'] ?> </td>
                    <td align="center" style="height: 90px"> <?php echo $row['tissuep'] ?> </td>
                    <td align="center" style="height: 90px"> <?php echo $row['tissued'] ?> </td>
                    <td width="100" align="center" style="height: 90px"> 
                    <?php
                    			$subject = "kidney match";
								$body = "Hi , \n\n CONGRATULATION YOU HAVE A MATCH, PLLEASE VISIT THE HOSPITAL.\n\n Regards KIDNEY.com";
								$additionalheaders = "From: <kidneydonation390@gmail.com>";
								$m=$row['emailp'];  //get email 
								$email2=$row['emaild'];
								mail($m, $subject, $body, $additionalheaders);
								mail($email2, $subject, $body, $additionalheaders);
                                echo "<a class=\"h\" href=\"delete.php?email=$m\">CHOOSE</a>";
                     ?>                    
                   </td>
                  </tr>
                  <?php }?>
               </table>
               <?php }?>
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