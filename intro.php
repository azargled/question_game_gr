<?php
session_start();
session_destroy();

define('SPACE1', 6);
define('SPACE2', 4);
define('SPACE3', 3);
define('CATEG', 6);
?>

<html>
     <head>
          <meta http-equiv="content-type" content="text-html; charset=iso-8859-7">
	      <title>Παιχνίδι Γνώσεων</title>		<!-- Εμφάνιση Επικεφαλίδας -->
          <link rel="stylesheet" type="text/css" href="style.css" media="screen" />
		  
     </head>
	 
     <body>
    
     <div id="help">
	    <a href="help.php">Περί του παιχνιδιού</a>
	 </div>
	 
	 <div id="contact">
	    <a href="contact.php">Επικοινωνία</a>
	 </div>
	 

          <br><br>
          <br><br>			
			     <!-- Κυλιόμενο μήνυμα εμφάνισης -->
              <marquee border=0  Align="Middle"  Width=1350 Height=50>
	              <H1><font color=lightblue> Καλωσήρθατε στο Παιχνίδι Γνώσεων</font></H1>
			  </marquee>                 
	    
        <form action="quiz.php" name="form1" method="POST">
	  	<br><br>

	  	<div id="login" class="right">
			<h2><p>
				Είσοδος χρήστη
			</p></h2>
			
			<br>

		  	  <p>
			     Όνομα χρήστη &nbsp; &nbsp;
		      	  <input type="text" name="username" size=20>
		    	<br> <br>
			     Συνθηματικό &nbsp; &nbsp; &nbsp;
		      	  <input type="password" name="pass" size=20>
		    	<br> <br> <br>
		          <input type="submit" name="button1" value="Είσοδος">
		        </p>

          </form>
		  
	  <H3>			<!-- Στήχιση στη μέση -->
	      <a href="register.html">		<!-- Κάλεσμα της φόρμας register.html -->
		  <font color=lightblue>	<!-- Χρωμάτισε με ελαφρό μπλέ το παρακάτω μήνυμα -->
		    	Εγγραφή Χρήστη</a>	<!-- Εμφάνιση μηνύματος -->
		  </font>			<!-- Τέλος της ιδιότητας χρώματος -->
	  </H3>					<!-- Τέλος στήχισης -->     
	 
	 </div>
	
	
	
     </body>

	 
	 </html>