<?php
session_start();
?>

<html>
<head>
	 <meta http-equiv="content-type" content="text-html; charset=utf-8"> 
	 <title>Επεξεργασία χρηστών</title>  				<!-- Epikefalida selidas -->
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

$username = $_POST["username"];
$password = $_POST["password"];
$email = $_POST["email"];
$surname = $_POST["surname"];
$firstname = $_POST["firstname"];

$userid = 1;
do
{
	$userid += 1;
	$testid = mysql_query("SELECT user_id FROM users WHERE user_id = " . $userid . " ORDER BY user_id");
}
while (mysql_num_rows($testid));

$rec = $_GET["rec"];

if ($username)
{
echo $myrec;
	mysql_query("UPDATE users SET username = '" . $username . "' WHERE user_id = " . $rec);
	mysql_query("UPDATE users SET password = '" . $password . "' WHERE user_id = " . $rec);
	mysql_query("UPDATE users SET email = '" . $email . "' WHERE user_id = " . $rec);
	mysql_query("UPDATE users SET surname = '" . $surname . "' WHERE user_id = " . $rec);
	mysql_query("UPDATE users SET firstname = '" . $firstname . "' WHERE user_id = " . $rec);
}

$sql = "SELECT * FROM users WHERE user_id > 0 ORDER BY user_id";

$myresult = mysql_query($sql);

for ($j = 1; $j <= $rec; $j++)
	$myrow = mysql_fetch_row($myresult);

print <<<HERE
		<b>Επεξεργασία χρήστη</b>


		<form action="edituser.php?rec=$rec" name="form1" method="POST">
		<br> <br>
		Όνομα χρήστη: 
		<br>
		<input type="text" name="username" value="$myrow[1]" size=32>
		<br> <br>
		Συνθηματικό:
		<br>
		<input type="text" name="password" value="$myrow[2]" size=32>
		<br> <br>
		Email:
		<br>
		<input type="text" name="email" value="$myrow[3]" size=30>
		<br> <br>
		Επώνυμο:
		<br>
		<input type="text" name="surname" value="$myrow[4]" size=30>
		<br> <br>
		Όνομα:
		<br>
		<input type="text" name="firstname" value="$myrow[5]" size=30>
		<br> <br>
		<input type="submit" name="store" value="Καταχώρηση">
		</form>

HERE;
		
if ($rec == 1)
{	
	$prev = $userid - 1;
	$next = 2;
}
elseif ($rec == $userid - 1)
{
	$prev = $userid - 2;
	$next = 1;
}
else 
{
	$prev = $rec - 1;
	$next = $rec + 1;
}

print <<<HERE
		<br>
		<H3><font color=LightBlue>
			<a href="edituser.php?rec=$prev">Προηγούμενος χρήστης
			<br>
			<a href="edituser.php?rec=$next">Επόμενος χρήστης
		</font><H3>
		</form>

		<br><br>
		<center>
			<a href="logout.php">
				<H3><font color=LightBlue>Αποσύνδεση</font><H3>
			</a>
		</center>

HERE;

}
else
{
	for ($i = 0; $i < 6; $i++){	// Επαναληπτική διαδικασία
	print "<br>";				// Εμφάνιση κενών γραμμών
	} 							// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<center>
	<h1>Δεν υπάρχει κάποιος συνδεδεμένος χρήστης αυτή τη στιγμή,</h1>
	<h1>πρέπει να συνδεθείτε από την αρχή.</h1><br>
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