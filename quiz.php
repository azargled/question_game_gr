<?php 
session_start();
?>
<html>
<head>
	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<title>Επιλογή Ομάδας Γνώσης</title>		<!-- Εμφάνισή Επικεφαλίδας -->

</head>

    <body>		<!-- Ορισμός του φόντου σελίδας --> 

	<?php

		   $_SESSION["username"] = $_POST["username"];
		   $_SESSION["password"] = $_POST["pass"];

		   $user_log = $_SESSION["username"];

 		   $myconn = mysql_connect("localhost:8080", "root", "");
		   mysql_select_db("quest", $myconn);
		   //$encpass = md5($pass_log);

		   $sql = "SELECT * FROM users WHERE username = '" . $_SESSION["username"] . "' AND password = '" . $_SESSION["password"] . "'";
		   $myresult = mysql_query($sql, $myconn) or die(mysql_error());
		   
		   $myrow = mysql_fetch_row($myresult);
		   $num_rows = mysql_num_rows($myresult);


if (!$num_rows)
{

	for ($i = 0; $i < SPACE1; $i++){	// Επαναληπτική διαδικασία
	print "<br>";				// Εμφάνιση κενών γραμμών
	} 							// Τέλος επαναληπτικής διαδικασίας

?>
	
	<h1>Δεν βρέθηκε αυτός ο συνδυασμός χρήστη και password.</h1><br>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:</b>

<?php

			for ($i = 0; $i < SPACE2; $i++){	// Επαναληπτική διαδικασία
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
HERE;
}
else if ($myrow[0] == 0) // ADMIN
{
print <<<HERE
			<H3 align="center">
				Διαχείριση εφαρμογής (administration)
			</H3>

			<br><br><br><br><br><br>
			<blockquote>
				<h1>Παρακαλώ επιλέξτε το είδος διαχείρισης που επιθυμείτε</h1>
				<table>
						<form action="addquest.php" method="POST">
					<tr>
					   <td align=middle>
					   		<input type = "submit" name = "addquest" value = "Προσθήκη ερωτήσεων">	  
					   </td>
					</tr>
						</form>
						<form action="editquest.php?rec=1" method="POST">
					<tr>
					   <td align=middle>
					   		<input type = "submit" name = "editquest" value = "Επεξεργασία ερωτήσεων">	  
					   </td>
					</tr>
					<td align=middle>
					Κατηγορία ερωτήσεων:
					<select name="catedit">
						<option selected>1. Γεωγραφία
						<option>2. Διασκέδαση / Ψυχαγωγία
						<option>3. Ιστορία
						<option>4. Τέχνη και Λογοτεχνία
						<option>5. Επιστήμη και Φύση
						<option>6. Σπορ και Χόμπι
						</select>
					</td>
					</tr>
					   </form>
					<tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
					<tr>
					   <td align=middle>
					      <form action="edituser.php?rec=1" method="POST">
								<input type = "submit" name = "edituser" value = "Επεξεργασία χρηστών">
						  </form>
					   </td>
					</tr>
			<br><br>
			</table>
			</blockquote>

			<br><br>
			<a href="logout.php">
						<H3><font color=LightBlue>Αποσύνδεση</font><H3>
			</a>
HERE;
}
else if ($num_rows > 0) // USER
{
print <<<HERE

			<H3 align="center">
				 (Χρήστης $user_log)
			</H3>

			<br><br>	<!-- Κυλιόμενο μήνυμα Εμφάνισης -->
			   <marquee border=0  Align="Middle"  Width=1200 Height=50>
			   	<H1><font color=lightblue> Καλωσήρθατε, έχετε συνδεθεί στο παχνίδι!!!</font></H1>
			</marquee>                 

			<br><br><br><br>
			<blockquote>
				<h1>Παρακαλώ επιλέξτε μία από τις επιλογές</h1>

				<table>
					<tr>
					   <td align=middle>
					      <form action="questions.php" method="POST">
								<input type = "hidden" name = "category" value = 1>
						        <input type = "hidden" name = "user_log" value = $user_log>
								<input type = "submit" name = "username" value = "Γεωγραφία">
					      </form>
					   </td>
				
					   <td align=middle>
					      <form action="questions.php" method="POST">
								<input type = "hidden" name = "category" value = 2>
								<input type = "hidden" name = "user_log" value = $user_log>
								<input type = "submit" name = "username" value = "Διασκέδαση / Ψυχαγωγία">
					      </form>
					   </td>

					   <td align=middle>
					      <form action="questions.php" method="POST">
								<input type = "hidden" name = "category" value = 3>
								<input type = "hidden" name = "user_log" value = $user_log>
								<input type = "submit" name = "username" value = "Ιστορία">
					      </form>
					   </td>
					</tr>

					<tr>
					   <td align=middle>
					      <form action="questions.php" method="POST">
								<input type = "hidden" name = "category" value = 4>
								<input type = "hidden" name = "user_log" value = $user_log>
								<input type = "submit" name = "username" value = "Τέχνη & Λογοτεχνία">
					      </form>
					   </td>

					   <td align=middle>
					      <form action="questions.php" method="POST">
								<input type = "hidden" name = "category" value = 5>
								<input type = "hidden" name = "user_log" value = $user_log>
								<input type = "submit" name = "username" value = "Επιστήμη & Φύση">
					      </form>
					   </td>
					
					   <td align=middle>
					      <form action="questions.php" method="POST">
								<input type = "hidden" name = "category" value = 6>
								<input type = "hidden" name = "user_log" value = $user_log>
								<input type = "submit" name = "username" value = "Σπορ & Χόμπι">
					      </form>
					   </td>
					</tr>
			
			<br><br>
			</table>
			</blockquote>

			<br><br>
			      <a href="logout.php">
						<H3><font color=LightBlue>Αποσύνδεση</font><H3>
			      </a>
			</center>

HERE;
	
}

?>

</body>										
</html>