<?php
session_start();
?>
<html>
<head>
	 <meta http-equiv="content-type" content="text-html; charset=utf-8"> 
	 <title>Προσθήκη ερωτήσεων</title>  				<!-- Epikefalida selidas -->
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

$categ = $_POST["catedit"];
$question = $_POST["question"];
$rightans = $_POST["rightans"];
$wrongans1 = $_POST["wrongans1"];
$wrongans2 = $_POST["wrongans2"];
$wrongans3 = $_POST["wrongans3"];

if ($categ)		// AN YPARXEI (exei perastei os parametros)
{
switch ($categ)
{
case "Γεωγραφία":
  $keyfield = "Geo_id";		// keyfield: onoma pediou pou periexei to id
  $table = "Geografia";		// table: pinakas me erotiseis
  break;  
case "Διασκέδαση / Ψυχαγωγία":
  $keyfield = "Enter_id";
  $table = "Entertainment";		// esy prepei na to exeis diaforetika
  break;
case "Ιστορία":
  $keyfield = "History_id";
  $table = "History";
  break;
case "Τέχνη και Λογοτεχνία":
  $keyfield = "Art_id";
  $table = "Art";
  break;
case "Επιστήμη και Φύση":
  $keyfield = "Science_id";
  $table = "Science";
  break;
case "Σπορ και Χόμπι":
  $keyfield = "SporHobby_id";
  $table = "SporHobby";
  break;
}

$questid = 0;
do
{
	$questid += 1;
	$testid = mysql_query("SELECT " . $keyfield . " FROM " . $table . " WHERE " . $keyfield . " = " . $questid);
}
while (mysql_num_rows($testid));

$insquery = "INSERT INTO " . $table . " VALUES(" . $questid . ", '" . $question . "', '" . $rightans . "', '" . $wrongans1 . "', '" . $wrongans2 . "', '" . $wrongans3 ."')";
mysql_query($insquery, $db);
}

print <<<HERE
		<b>Εισαγωγή ερώτησης</b>
		<form action="addquest.php" name="form1" method="POST">
		<br> <br>
		Ερώτηση: 
		<br>
		<input type="text" name="question" size=150>
		<br> <br>
		Σωστή απάντηση:
		<br>
		<input type="text" name="rightans" size=40>
		<br> <br>
		Λανθασμένη απάντηση 1:
		<br>
		<input type="text" name="wrongans1" size=40>
		<br> <br>
		Λανθασμένη απάντηση 2:
		<br>
		<input type="text" name="wrongans2" size=40>
		<br> <br>
		Λανθασμένη απάντηση 3:
		<br>
		<input type="text" name="wrongans3" size=40>
		<br> <br>
		Κατηγορία ερώτησης:
		<br>
		<select name="catedit">
			<option selected>Γεωγραφία
			<option>Διασκέδαση / Ψυχαγωγία
			<option>Ιστορία
			<option>Τέχνη και Λογοτεχνία
			<option>Επιστήμη και Φύση
			<option>Σπορ και Χόμπι
		</select>
		<br> <br>
		<input type="submit" name="button1" value="Καταχώρηση">
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