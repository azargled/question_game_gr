<?php
session_start();
?>

<html>
<head>

<meta http-equiv="content-type" content="text-html; charset=utf-8"> 
	 
<title>Ερωτηματολόγιο Κατηγορίας</title>  				<!-- Epikefalida selidas -->

</head>

<body>

<?php

if (isset($_SESSION["username"]))	// TO if AFTO TELEIONEI STO TELOS TIS SELIDAS
{

$db = mysql_connect('localhost', 'root', ''); //Sundesi Sto Server

mysql_select_db("db1", $db) or die(mysql_error());
//Entoli Sundesis Metablitis Basis

mysql_query("SET NAMES 'utf8'");
//utf-8

$categ = $_POST["category"];

switch ($categ)
{
case 1:
  $sql = "SELECT * FROM Geografia order by rand()";
  break;  
case 2:
  $sql = "SELECT * FROM Entertainment order by rand()";
  break;
case 3:
  $sql = "SELECT * FROM History order by rand()";
  break;
case 4:
  $sql = "SELECT * FROM Art order by rand()";
  break;
case 5:
  $sql = "SELECT * FROM Science order by rand()";
  break;
case 6:
  $sql = "SELECT * FROM SporHobby order by rand()";
  break;
}

$myresult = mysql_query($sql);
$myrow = mysql_query($myresult);
//Epilegei ola ta pedia apo ton pinaka users kai ta
//egxorei stin metabliti myresult

//$myrow = mysql_fetch_row($myresult);
//Entoli Epilogis mias grammis apo to myresult kai
//apothikeusis tis sto myrow

$user_log = $_POST["user_log"];

print <<<HERE
	<H3 align="center">
			(Χρήστης $user_log)
	</H3>

HERE;

$categ = $_POST["category"];

print "<p>Καλωσόρισες <b>".$user_log."</b>!</p>";
print "Θέμα: ";
switch ($categ)
{
case 1:
  print "Γεωγραφία<br><br>";
  break;  
case 2:
  print "Διασκέδαση / Ψυχαγωγία<br><br>";
  break;
case 3:
  print "Ιστορία<br><br>";
  break;
case 4:
  print "Τέχνη & Λογοτεχνία<br><br>";
  break;
case 5:
  print "Επιστήμη & Φύση<br><br>";
  break;
case 6:
  print "Σπορ & Χόμπι<br><br>";
  break;
}

$myrow = mysql_fetch_row($myresult);

echo "<form name=\"Form1\" action=pdf_create.php method=\"POST\">";

for ($j = 1; $j <= 10; $j++)
{

	$ans1 = rand(2, 5);
	$ans2 = rand(2, 5);
	
	while ($ans2 == $ans1)
	{
		$ans2 = rand(2, 5);
	}
	
	$ans3 = rand(2, 5);
	
	while (($ans3 == $ans2) || ($ans3 == $ans1))
	{
		$ans3 = rand(2, 5);
	}
	
	$ans4 = rand(2, 5);
	
	while (($ans4 == $ans3) || ($ans4 == $ans2) || ($ans4 == $ans1))
	{
		$ans4 = rand(2, 5);
	}
	
	// PARAKATO VRISKOUME TI THESI (position) TIS SOSTIS APANTISIS, AFOU EXEI PROIGITHEI RANDOM
	// OSTE NA MPOROUME NA KANOUME ELEGXO META
	
	if ($ans1 == 2)
		$position = 1;
	elseif ($ans2 == 2)
		$position = 2;
	elseif ($ans3 == 2) 
		$position = 3;
	else
		$position = 4;
		
  	print "Ερώτηση $j : $myrow[1] <br> ";
	
	$posit[$j] = $position;
	
	$k = 1;
	
print <<<HERE

		     <table>
                	</tr>
               	    </tr>
                    <td>
					</td>
                   	<td> 
						   <input type="radio" name="q$j" value="1" onClick="getName()"> $myrow[$ans1]		
					</td>
               		</tr>
               		</tr>
                  	<td>
                  	</td>
                  	<td>
                           <input type="radio" name="q$j" value="2" onClick="getName()"> $myrow[$ans2]
                  	</td>
               		</tr>
               		</tr>
                  	<td>
                  	</td>
                  	<td>
                     	   <input type="radio" name="q$j" value="3" onClick="getName()"> $myrow[$ans3]
                  	</td>
               		</tr>
               		</tr>
                    <td>
                  	</td>
                  	<td>
                     	   <input type="radio" name="q$j" value="4" onClick="getName()"> $myrow[$ans4]
                  	</td>
               		</tr>
               		<tr>
		     </table>
			 
							<input type="hidden" name="true$j" value="$position">
							<input type="hidden" name="user_log" value="$user_log">
							<input type="hidden" name="categ" value="$categ">
			 <br>		 
HERE;

$myrow = mysql_fetch_row($myresult);
$k += 1;
} // end for j loop

print <<<HERE
<br> <input type = "submit" name = "end" value = "Υποβολή PDF">
</form>

<br>
	<center>
	<a href="logout.php">
		<H3><font color=LightBlue>Αποσύνδεση</font><H3>
	</a>
	</center>
HERE;
}
else
{
echo "<center>";

	for ($i = 0; $i < 6; $i++){	// Επαναληπτική διαδικασία
	print "<br>";				// Εμφάνιση κενών γραμμών
	} 							// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<h1>Δεν υπάρχει κάποιος συνδεδεμένος χρήστης αυτή τη στιγμή, πρέπει να συνδεθείτε από την αρχή.</h1><br>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:</b>
HERE;

			for ($i = 0; $i < 4; $i++){	// Επαναληπτική διαδικασία
  			print "<br>";			// Εμφάνιση κενών γραμμών
			} 				// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
		      <a href="intro.php" >    <!-- Υπερσύνδεση στη σελίδα intro.html -->
			  <img src="home.gif" alt="Επιστροφή στην αρχική σελίδα">
	          <br>						<!-- Άλλαξε μια γραμμή -->
			  <font color=LightBlue>			<!-- Χρωμάτισε με ελαφρό μπλέ το παρακάτω μήνυμα -->
        			Επιστροφή στην αρχική σελίδα		<!-- Εμφάνιση μηνύματος -->
			  </font>					<!-- Τέλος της ιδιότητας χρώματος -->
		      </a>						<!-- Τέλος της ιδιότητας επικοινωνίας -->
			  </center>
HERE;
			
}

?>	
	
</body>
</html>