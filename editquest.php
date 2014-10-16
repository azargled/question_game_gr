<?php
session_start();
?>
<html>
<head>
	 <meta http-equiv="content-type" content="text-html; charset=utf-8"> 
	 <title>Επεξεργασία ερωτήσεων</title>  				<!-- Epikefalida selidas -->
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

if (isset($_POST["catedit"]))
{
	$categ = substr($_POST["catedit"], 0, 1);
	$categ_word = substr($_POST["catedit"], 3);
}
else
{
	switch ($_GET["catget"])
	{
		case 1: 
		$categ = 1;
		$categ_word = "Γεωγραφία";
		$cg = 1;
		$keyfield = "Geo_id";	$table = "Geografia";	// keyfield: onoma pediou pou periexei to id. table: pinakas me erotiseis
		$quest = "Geo_question"; $right = "Geo_answer1"; $wrong1 = "Geo_answer2";
		$wrong2 = "Geo_answer3"; $wrong3 = "Geo_answer4";
		break;
		case 2:
		$categ = 2;
		$categ_word = "Διασκέδαση / Ψυχαγωγία";
		$cg = 2;
		$keyfield = "Enter_id"; $table = "Entertainment";		// esy prepei na to exeis diaforetika
		$quest = "Enter_question"; $right = "Enter_answer1"; $wrong1 = "Enter_answer2";
		$wrong2 = "Enter_answer3"; $wrong3 = "Enter_answer4";
		break;
		case 3: 
		$categ = 3;
		$categ_word = "Ιστορία";
		$cg = 3;
		$keyfield = "History_id"; $table = "History";
		$quest = "History_question"; $right = "History_answer1"; $wrong1 = "History_answer2";
		$wrong2 = "History_answer3"; $wrong3 = "History_answer4";
		break;
		case 4: 
		$categ = 4;
		$categ_word = "Τέχνη και Λογοτεχνία";
		$cg = 4;
		$keyfield = "Art_id"; $table = "Art";
		$quest = "Art_question"; $right = "Art_answer1"; $wrong1 = "Art_answer2";
		$wrong2 = "Art_answer3"; $wrong3 = "Art_answer4";		
		break;
		case 5: 
		$categ = 5;
		$categ_word = "Επιστήμη και Φύση";
		$cg = 5;
		$keyfield = "Science_id"; $table = "Science";
		$quest = "Science_question"; $right = "Science_answer1"; $wrong1 = "Science_answer2";
		$wrong2 = "Science_answer3"; $wrong3 = "Science_answer4";
		break;
		case 6:
		$categ = 6;
		$categ_word = "Σπορ και Χόμπι";
		$cg = 6;
		$keyfield = "SporHobby_id"; $table = "SporHobby";
		$quest = "SporHobby_question"; $right = "SporHobby_answer1"; $wrong1 = "SporHobby_answer2";
		$wrong2 = "SporHobby_answer3"; $wrong3 = "SporHobby_answer4";
		break;
	}
}	
	
$question = $_POST["question"];
$rightans = $_POST["rightans"];
$wrongans1 = $_POST["wrongans1"];
$wrongans2 = $_POST["wrongans2"];
$wrongans3 = $_POST["wrongans3"];

switch ($categ)
{
case 1:
  $cg = 1;
  $categ_word = "Γεωγραφία";
  $keyfield = "Geo_id";	$table = "Geografia";	// keyfield: onoma pediou pou periexei to id. table: pinakas me erotiseis
  $quest = "Geo_question"; $right = "Geo_answer1"; $wrong1 = "Geo_answer2";
  $wrong2 = "Geo_answer3"; $wrong3 = "Geo_answer4";
  break;  
case 2:
  $cg = 2;
  $categ_word = "Διασκέδαση / Ψυχαγωγία";
  $keyfield = "Enter_id"; $table = "Entertainment";		// esy prepei na to exeis diaforetika
  $quest = "Enter_question"; $right = "Enter_answer1"; $wrong1 = "Enter_answer2";
  $wrong2 = "Enter_answer3"; $wrong3 = "Enter_answer4";
  break;
case 3:
  $cg = 3;
  $categ_word = "Ιστορία";
  $keyfield = "History_id"; $table = "History";
  $quest = "History_question"; $right = "History_answer1"; $wrong1 = "History_answer2";
  $wrong2 = "History_answer3"; $wrong3 = "History_answer4";
  break;
case 4:
  $cg = 4;
  $categ_word = "Τέχνη και Λογοτεχνία";
  $keyfield = "Art_id"; $table = "Art";
  $quest = "Art_question"; $right = "Art_answer1"; $wrong1 = "Art_answer2";
  $wrong2 = "Art_answer3"; $wrong3 = "Art_answer4";
  break;
case 5:
  $cg = 5;
  $categ_word = "Επιστήμη και Φύση";
  $keyfield = "Science_id"; $table = "Science";
  $quest = "Science_question"; $right = "Science_answer1"; $wrong1 = "Science_answer2";
  $wrong2 = "Science_answer3"; $wrong3 = "Science_answer4";
  break;
case 6:
  $cg = 6;
  $categ_word = "Σπορ και Χόμπι";
  $keyfield = "SporHobby_id"; $table = "SporHobby";
  $quest = "SporHobby_question"; $right = "SporHobby_answer1"; $wrong1 = "SporHobby_answer2";
  $wrong2 = "SporHobby_answer3"; $wrong3 = "SporHobby_answer4";
  break;
}

$myrec = $_POST["myrec"];

if ($rightans)
{
	mysql_query("UPDATE " . $table . " SET " . $quest . " = '" . $question . "' WHERE " . $keyfield . " = " . $myrec);
	mysql_query("UPDATE " . $table . " SET " . $right . " = '" . $rightans . "' WHERE " . $keyfield . " = " . $myrec);
	mysql_query("UPDATE " . $table . " SET " . $wrong1 . " = '" . $wrongans1 . "' WHERE " . $keyfield . " = " . $myrec);
	mysql_query("UPDATE " . $table . " SET " . $wrong2 . " = '" . $wrongans2 . "' WHERE " . $keyfield . " = " . $myrec);
	mysql_query("UPDATE " . $table . " SET " . $wrong3 . " = '" . $wrongans3 . "' WHERE " . $keyfield . " = " . $myrec);
}

$rec = $_GET["rec"];
$sql = "SELECT * FROM " . $table . " ORDER BY " . $keyfield;

$myresult = mysql_query($sql);

for ($j = 1; $j <= $rec; $j++)
	$myrow = mysql_fetch_row($myresult);

$cat = $_GET["catget"];

print <<<HERE
			<b>Επεξεργασία ερώτησης κατηγορίας: $categ_word</b>
			<form action="editquest.php?rec=$rec" name="form1" method="POST">
			<br> <br>
			Ερώτηση:
			<br>
			<input type="text" name="question" value="$myrow[1]" size=150>
			<br> <br>
			Σωστή απάντηση:
			<br>
			<input type="text" name="rightans" value="$myrow[2]" size=40>
			<br> <br>
			Λανθασμένη απάντηση 1:
			<br>
			<input type="text" name="wrongans1" value="$myrow[3]" size=40>
			<br> <br>
			Λανθασμένη απάντηση 2:
			<br>
			<input type="text" name="wrongans2" value="$myrow[4]" size=40>
			<br> <br>
			Λανθασμένη απάντηση 3:
			<br>
			<input type="text" name="wrongans3" value="$myrow[5]" size=40>
			<br> <br>
			<input type="hidden" name="catedit" value="$cat">
			<input type="hidden" name="myrec" value="$rec">
			<input type="submit" name="store" value="Καταχώρηση">
			<br>
HERE;

$questid = 0;
do
{
	$questid += 1;
	$testid = mysql_query("SELECT " . $keyfield . " FROM " . $table . " WHERE " . $keyfield . " = " . $questid);
}
while (mysql_num_rows($testid));

if ($rec == 1)
{	
	$prev = $questid - 1;
	$next = 2;
}
elseif ($rec == $questid - 1)
{
	$prev = $questid - 2;
	$next = 1;
}
else 
{
	$prev = $rec - 1;
	$next = $rec + 1;
}

print <<<HERE
		<br> <br>
		<H3><font color=LightBlue>
			<a href="editquest.php?rec=$prev&catget=$cg">Προηγούμενη ερώτηση
			<br>	
			<a href="editquest.php?rec=$next&catget=$cg">Επόμενη ερώτηση
		</font><H3>
		<br><br>
		<center>
			<a href="logout.php">
				<H3><font color=LightBlue>Αποσύνδεση</font><H3>
			</a>
		</center>

		</form>
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