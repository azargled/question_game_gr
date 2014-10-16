<?php
require('fpdf.php');
require('font/makefont/makefont.php');

$db = mysql_connect('localhost', 'root', ''); 		//Sundesi Sto Server
mysql_select_db("db1", $db) or die(mysql_error());

//mysql_set_charset('greek1',$db); 
mysql_query("SET NAMES 'utf8'");

$correct = 0;

for ($j = 1; $j < 11; $j++)
{
	if ($_POST["q$j"] == $_POST["true$j"]) 
		$correct++;
}

$user_log = $_POST["user_log"];
$categ = $_POST["categ"];

$myresult = mysql_query("SELECT * FROM users WHERE username = '" . $user_log . "'");
$myrow = mysql_fetch_row($myresult);

if (mysql_num_rows($myresult) > 0)
	mysql_query("DELETE FROM score WHERE user_id = $myrow[0]");

mysql_query("INSERT INTO score VALUES($myrow[0], $categ, $correct)");

// EDO KATHORIZETAI AN THA FTIAXTEI TO PDF (efoson diladi o xristis perase)
if ($correct >= 5)
{
	$pdf=new FPDF();
	$pdf->AddPage();
	//Makefont('arial.ttf', 'arial.afm', 'cp1253');
	$pdf->AddFont('Arial1', 'B', 'arial.php');
	$pdf->SetFont('Arial1', 'B', 24);
	$title = 'ΠΙΣΤΟΠΟΙΗΤΙΚΟ ΕΠΙΤΥΧΙΑΣ';
	$pdf->Image("teiath.jpg", 85, 7, 35, 35);
	$pdf->Ln(43);
	$pdf->Cell(0, 20, $title, 0, 1, 'C');
	$pdf->Ln(12);
	$pdf->SetFont('Arial1', 'B', 14);

	switch ($categ)
	{
	case 1:
		$category = "Γεωγραφία";
		break; 
	case 2:
		$category = "Διασκέδαση / Ψυχαγωγία";
		break;
	case 3:
		$category = "Ιστορία";
		break;
	case 4:
		$category = "Τέχνη & Λογοτεχνία";
		break;
	case 5:
		$category = "Επιστήμη & Φύση";
		break;
	case 6:
		$category = "Σπορ & Χόμπι";
		break;
	}
	
	$lname = iconv('utf-8' ,'cp1253', $myrow[4]);		// metatropi apo utf-8
	$fname = iconv('utf-8' ,'cp1253', $myrow[5]);		// se cp1253 (greek)
	
	$pdf->Cell(60, 12, "Επώνυμο: $lname", 0, 1, '');
	$pdf->Cell(60, 12, "Όνομα: $fname", 0, 1, '');
	$pdf->Cell(60, 12, "Όνομα χρήστη: $user_log", 0, 1, '');
	$pdf->Cell(60, 12, "Κατηγορία: $category", 0, 1, '');
	$pdf->Cell(60, 12, "Πόντοι: $correct/10", 0, 1, '');
	$pdf->Cell(60, 12, "Ημερομηνία: " . date("d/m/y"), 0, 1, '');
	
	if ($correct != 10)
	{
		$pdf->Ln(18);
		$pdf->Cell(60, 12, "Λανθασμένες απαντήσεις:", 0, 1, '');	
		$pdf->Ln(12);

		for ($j = 1; $j < 11; $j++)
		{
			if ($_POST["q$j"] != $_POST["true$j"]) 
			{
				$wrongans = "Ερ. $j: σωστή απάντηση είναι η ";
			
				switch ($_POST["true$j"])
				{
				case 1:
					$wrongans = $wrongans . "(α).";
					break; 
				case 2:
					$wrongans = $wrongans . "(β).";
					break;
				case 3:
					$wrongans = $wrongans . "(γ).";
					break;
				case 4:
					$wrongans = $wrongans . "(δ).";
					break;
				}

				$wrongans = $wrongans . " Εσείς απαντήσατε την ";
			
				switch ($_POST["q$j"])
				{
				case 1:
					$wrongans = $wrongans . "(α).";
					break; 
				case 2:
					$wrongans = $wrongans . "(β).";
					break;
				case 3:
					$wrongans = $wrongans . "(γ).";
					break;
				case 4:
					$wrongans = $wrongans . "(δ).";
					break;
				}
			
				$pdf->Cell(60, 12, $wrongans, 0, 1, '');	
			}
		}	
	}
	$pdf->Output();
}		// end if (an tha ftiaxtei to pdf)
else
{
echo "<center>";
for ($i = 0; $i < 6; $i++) {		// Επαναληπτική διαδικασία
		print "<br>";				// εμφάνιση κενών γραμμών
		} 							// Τέλος επαναληπτικής διαδικασίας
		
print <<<HERE
	<h1>Λυπάμαι αλλά απαντήσετε σωστά σε λιγότερες από τις μισές ερωτήσεις.</h1>
	<h1>Δεν έχετε περάσει επιτυχώς το ερωτηματολόγιο.</h1>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>
HERE;

for ($i = 0; $i < 3; $i++) {		// Επαναληπτική διαδικασία
  		print "<br>";				// εμφάνιση κενών γραμμών
		} 							// Τέλος επαναληπτικής διαδικασίας

echo "
<html>
<head>
	<meta http-equiv=\"content-type\" content=\"text-html; charset=windows-1253\"> 
	<title>Δεν έχετε περάσει το test</title>
</head>
<body bgcolor=Green>
<a href=\"intro.html\">    							<!-- Υπερσύνδεση στη σελίδα intro.html -->
	<img src=\"home.gif\" alt=\"Επιστροφή στην αρχική σελίδα\">
	<br>											<!-- Άλλαξε μια γραμμή -->
	   <font color=LightBlue>						<!-- Χρωμάτισε με ελαφρό μπλέ το παρακάτω μήνυμα -->
        	Επιστροφή στην αρχική σελίδα			<!-- Εμφάνιση μηνύματος -->
	   </font>										<!-- Τέλος της ιδιότητας χρώματος -->
</a>	
</center>
</body>
";
}