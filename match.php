<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="mysql"; // Database name 

$email=$_GET['email'];
$user=$_GET['user'];
$gender=$_GET['gender'];
$bday=$_GET['bday'];

$con=mysqli_connect($host, $username, $password) or die("cannot connect"); 
mysqli_select_db($con,$db_name) or die("cannot select DB!!");


$t="SELECT * FROM `donator` WHERE blood='$gender'";
$r=mysqli_query($con, $t);
$c1=0;
if($r)
{
	$row = mysqli_fetch_array($r);
	$w = mysqli_num_rows($r);
	$b=$row["tissue"];
	$b1 = str_split($b);
 	$bsize = count($b1); 
	$a= str_split($user);
	$asize = count($a);
	$c1=0;
	while($w > 0)
	{
		if($asize <= $bsize)
			$csize=$asize;
		else
			$csize=$bsize;	
		for ($x = 0; $x < $asize; $x++) 
		{
			for ($y = 0; $y < $bsize; $y++) 
			{
				if($a[$x] == $b1[$y])
				{
					$c1++;				  
				}
			} 
		}
		if($c1 >= 8)
		{  
			$m= $row["email"];
			$query = "INSERT INTO `match`(`emailp`, `emaild`,`blood`,`tissuep`,`tissued`) VALUES ('$m','$email','$gender','$b','$user')";
	  	    if (mysqli_query($con,$query)) 
	  		{        
    		   echo "<h1>Data has been inserted into database</h1> ";
    		   //delet from patient
				$f=" DELETE FROM  `donator` WHERE email = '$m'";
				$rr=mysqli_query($con, $f);
				if($rr)
				{
					echo "<h1> DATA HAVE BEEN DELETED </h1>";
					header("location:dpage.html");
				}
				else
					echo "<h1>THERE IS A PROBLEM.</h1>";	
	    	}
	    	else 
    		    echo "Error: " . mysqli_error($con);
				break;
		}
		else
		{
			//echo "<h1>3</h1>";
			$c1=0;
			for ($x = 0; $x < $csize; $x++) 
			{
				if($a[$x] == $b1[$x])
					$c1++;				  
			} 
			if($c1 >= 5)
			{
				$m= $row["email"];
				$query = "INSERT INTO `match`(`emailp`, `emaild`,`blood`,`tissuep`,`tissued`) VALUES ('$m','$email','$gender','$b','$user')";
	  	    	if (mysqli_query($con,$query)) 
	  			{        
	    		   echo "<h1>Data has been inserted into database</h1> ";
	    		   //delet from patient
					$f=" DELETE FROM  `donator` WHERE email = '$m'";
					$rr=mysqli_query($con, $f);
					if($rr)
					{
						echo "<h1> DATA HAVE BEEN DELETED </h1>";
						header("location:dpage.html");
					}
					else
						echo "<h1>THERE IS A PROBLEM.</h1>";	
	    		}
	    		else 
	    		    echo "Error: " . mysqli_error($con);
				break;
			}
			else
			{
				$c1=0;
				for ($x = 0; $x < $asize - 2; $x++) 
				{
					for ($y = 0; $y < $bsize-2; $y++) 
					{
						if($a[$x] == $b1[$y] && $a[$x+1] == $b1[$y+1] && $a[$x+2] == $b1[$y+2])
						{
							$m= $row["email"];
							$c1=1;
							$query = "INSERT INTO `match`(`emailp`, `emaild`,`blood`,`tissuep`,`tissued`) VALUES ('$m','$email','$gender','$b','$user')";
	  	    				if (mysqli_query($con,$query)) 
	  						{        
	    		   				echo "<h1>Data has been inserted into database</h1> ";
	    		   				//delet from patient
								$f=" DELETE FROM  `donator` WHERE email = '$m'";
								$rr=mysqli_query($con, $f);
								if($rr)
								{
									echo "<h1> DATA HAVE BEEN DELETED </h1>";
									header("location:dpage.html");
								}
								else
									echo "<h1>THERE IS A PROBLEM.</h1>";	
	    					}
	    					else 
    						    echo "Error: " . mysqli_error($con);
							break;
					  	} 
				  	}
				 }
			}
		}
		$w--;
	}
	if($c1==0)
	{
		$query = "INSERT INTO `patient`(`email`,`tissue`,`blood`,`birth`) VALUES ('$email','$user','$gender','$bday')";
	    if (mysqli_query($con,$query)) 
	    {        
	  	   echo "<h1>Data has been inserted into database</h1> ";
	  	   header("Location:pnpage.html");
	    }
	    else 
	    {
  		    echo "Error: " . mysqli_error($con);
	    }
	}
}
?>