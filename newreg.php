<html>
<head>

	<meta http-equiv="content-type" content="text-html; charset=utf-8">
	<title>Επιβεβαίωση εγγραφής</title>			<!-- Εμφάνιση Επικεφαλίδας -->
	<style type="text/css">

	     p.center {
	     text-align: center; }

	blockquote {
 	     border-top: 1pt solid black;
  	     border-right: 1pt solid black;
  	     border-left: 1pt solid black;
	     border-bottom: 1pt solid black;
	}
	
	 </style>
     </head>

     <body>	            		<!-- Ορισμός της φόντου σελίδας --> 
     <center>					<!-- Στοίχιση στη μέση -->

     <?php

	$new_username = $_POST["user"];
	$new_pass1 = $_POST["pass1"];
	$new_pass2 = $_POST["pass2"];
	$new_email = $_POST["email"];
	$new_surname = $_POST["surname"];
	$new_firstname = $_POST["firstname"];
	
	$myconn = mysql_connect("localhost", "root", "");
	mysql_select_db("db1", $myconn);
	
	mysql_query("SET NAMES 'utf8'");
	//utf-8

	$checkuser = mysql_query("SELECT username FROM users WHERE username = '" . $new_username . "'");

	if (mysql_num_rows($checkuser))		// (1)_Έλεγχος αν υπάρχει δεύτερος χρήστης με το ίδιο username
	{

		for ($i = 0; $i < 6; $i++) {		// Επαναληπτική διαδικασία
		print "<br>";				// εμφάνιση κενών γραμμών
		} 					// Τέλος επαναληπτικής διαδικασίας

?> 

	<h1>Υπάρχει ήδη αυτό το όνομα χρήστη.</h1>
	<h1>Παρακαλώ διαλέξτε διαφορετικό.</h1><br>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>

<?php
		for ($i = 0; $i < 3; $i++){	// Επαναληπτική διαδικασία
  		print "<br>";			// εμφάνιση κενών γραμμών
		} 				// Τέλος επαναληπτικής διαδικασίας


		}
		else // (1ος Έλεγχος)
		{

		if (($new_username == '') || ($new_pass1 == '') || ($new_pass2 == '') || ($new_surname == '') || ($new_firstname == ''))		// (2)_Έλεχγος αν τα υποχρεωτικά πεδία είναι κενά
		{

			for ($i = 0; $i < 6; $i++) {		// Επαναληπτική διαδικασία
			print "<br>";				// εμφάνιση κενών γραμμών
			} 					// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<h1>Έχετε αφήσει κενά υποχρεωτικά πεδία.</h1>
	<h1>Παρακαλώ συμπληρώστε τα πεδία.</h1>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>
HERE;

			for ($i = 0; $i < 3; $i++){	// Επαναληπτική διαδικασία
  			print "<br>";			// εμφάνιση κενών γραμμών
			} 				// Τέλος επαναληπτικής διαδικασίας
			
		}
		
		// elegxos KAI gia to mikos pedion
		elseif (((strlen($new_username) < 4) || (strlen($new_username) > 10)) || 
				((strlen($new_pass1) < 4) || (strlen($new_pass1) > 10)) || 
				((strlen($new_pass2) < 4) || (strlen($new_pass2) > 10)))
		{
		
					for ($i = 0; $i < 6; $i++) {		// Επαναληπτική διαδικασία
			print "<br>";				// εμφάνιση κενών γραμμών
			} 					// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<h1>Έχετε όνομα χρήστη ή κωδικό με μήκος έξω από τα καθορισμένα όρια.</h1>
	<h1>Παρακαλώ συμπληρώστε τα πεδία με σωστό αριθμό χαρακτήρων.</h1>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>
HERE;
		
		for ($i = 0; $i < 3; $i++){	// Επαναληπτική διαδικασία
  		print "<br>";			// εμφάνιση κενών γραμμών
		} 						// Τέλος επαναληπτικής διαδικασίας
		
		}
		else // (2ος Έλεγχος)
		{

			if (!strcmp($new_pass1, $new_pass2))	// (3)_Έλεγχος αν τα passwords ταιριάζουν
			{			

				is_integer($teleia);
				is_integer($papaki);
				
				$length=strlen($new_email);

				$papaki=0;
				$teleia=0;         
			
				for ($i=0; $i<$length; $i++) {				// Επαναληπτική διαδικασία
	
				if ($length=strrchr($new_email,"."))                    //Αν βρεθεί τελεία
					$teleia=1; 
        			if ($length=strrchr($new_email,"@"))                    //Αν βρεθεί παπάκι
					$papaki=1;      
				} 							// (Τέλος for)

             			if (($papaki==1) && ($teleia==1))         		// (4)_Έλεγχος για το αν βρεθεί τελεία και παπάκι στο E-mail
				{
					
					$userid = 0;
					do
					{
						$userid += 1;
						$testid = mysql_query("SELECT user_id FROM users WHERE user_id = '" . $userid . "'");
					}
					while (mysql_num_rows($testid));	

					//$encrypted = md5($new_pass1);

					$sql = "INSERT INTO users VALUES ('" . $userid . "', '". $new_username . "', '" . $new_pass1 . "', '" . $new_email . "', '" . $new_surname . "', '" . $new_firstname . "')";
	
					if (mysql_query($sql, $myconn))				//(5)_Έλεγχος
					{
	
						for ($i = 0; $i < 6; $i++){			// Επαναληπτική διαδικασία
  						print "<br>";					// εμφάνιση κενών γραμμών
						} 						// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<h1>Εχετε προστεθεί στην λίστα.</h1><br>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>
HERE;
	
						for ($i = 0; $i < 3; $i++){			// Επαναληπτική διαδικασία
 						print "<br>";					// εμφάνιση κενών γραμμών
						} 						// Τέλος επαναληπτικής διαδικασίας

					}	
					else // (5ος Έλεγχος)
					{

						for ($i = 0; $i < 6; $i++){			// Επαναληπτική διαδικασία
  						print "<br>";					// εμφάνιση κενών γραμμών
						} 						// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<h1>Αγνωστο λάθος, παρακαλώ προσπαθήστε ξανά.</h1><br>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>
HERE;
	
						for ($i = 0; $i < 3; $i++){			// Επαναληπτική διαδικασία
	 					print "<br>";					// εμφάνιση κενών γραμμών
						} 						// Τέλος επαναληπτικής διαδικασίας		

					} // (5ος Τέλος)

             			
				}
				else // (4ος Έλεγχος)
				{

					for ($i = 0; $i < 6; $i++){			// Επαναληπτική διαδικασία
  					print "<br>";					// εμφάνιση κενών γραμμών
					} 						// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<h1>Εχετε λάθος E-mail.</h1><br>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>
HERE;
	
					for ($i = 0; $i < 3; $i++){			// Επαναληπτική διαδικασία
 					print "<br>";					// εμφάνιση κενών γραμμών
					} 						// Τέλος επαναληπτικής διαδικασίας

				} // (4ος Τέλος)
	
			}
			else //(3ος Έλεγχος)
			{

				for ($i = 0; $i < 6; $i++){	// Επαναληπτική διαδικασία
  				print "<br>";				// εμφάνιση κενών γραμμών
				} 							// Τέλος επαναληπτικής διαδικασίας

print <<<HERE
	<h1>Συγγνώμη, οι κωδικοί δεν ταιριάζουν.</h1><br>
	<br><b>Παρακαλώ πατήστε το παρακάτω κουμπί για:<b>
HERE;
	
				for ($i = 0; $i < 3; $i++){	// Επαναληπτική διαδικασία
  				print "<br>";				// εμφάνιση κενών γραμμών
				} // end for loop			// Τέλος επαναληπτικής διαδικασίας

			} // (3ος Τέλος)

		} // (2ος Τέλος)

	} // (2ος Τέλος)
     ?>

    <a href="intro.html">    				<!-- Υπερσύνδεση στη σελίδα intro.html -->
	<img src="home.gif" alt="Επιστροφή στην αρχική σελίδα">
	<br>									<!-- Άλλαξε μια γραμμή -->
	   <font color=LightBlue>				<!-- Χρωμάτισε με ελαφρό μπλέ το παρακάτω μήνυμα -->
        	Επιστροφή στην αρχική σελίδα	<!-- Εμφάνιση μηνύματος -->
	   </font>								<!-- Τέλος της ιδιότητας χρώματος -->
     </a>									<!-- Τέλος της ιδιότητας επικοινωνίας -->
     </center>								<!-- Τέλος στοίχισης -->

     </body>
</html>