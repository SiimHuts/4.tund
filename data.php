﻿<?php
	require("functions.php");
	
	//kas on sisseloginud, kui eiole siis suunata login lehele
	
	if (!isset($_SESSION[userID])){
		
		header ("Location: login.php")
		
	}
	
	
	if (isset($_GET["logout"])){
		
		session_destroy();
		
		header("Location: login.php");
		
	}
?>
<h1>Data</h1>
<p>
	Tere tulemast! <?=$_SESSION["email"];?>!
	<a href="?logout=1">Log out</a>
</p>