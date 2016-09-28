<?php
	//functions.php
	
	//alusan sessiooni, et saaks kasutada
	//$_SESSION muutujaid
	
	session_start();
	
	//*******************************
	//**********SIGNUP***************
	//*******************************
	//var_dump($GLOBALS[]);
	
	
	$database = "if16_siim_1";
	
	function signup ($email, $password) {
		
		$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email,password) VALUES (?, ?)");
		echo $mysqli->error;
		
		$stmt->bind_param("ss", $email, $password); 
		
		if ($stmt->execute()) {
			
			echo "salvestamine 6nnestus";
		} else {
			echo "ERROR" .$stmt->error;
			
		}
	}
		
function login($email, $password){
		
	$error = "";	
		
	$mysqli = new mysqli($GLOBALS["serverHost"],$GLOBALS["serverUsername"],$GLOBALS["serverPassword"],$GLOBALS["database"]);
		
	$stmt = $mysqli->prepare("
		
		SELECT id, email, password, created FROM user_sample WHERE email = ?
		
	");
	echo $mysqli->error;
	
	//asendan kysim2rgi
	$stmt->bind_param("s", $email);
	
	//m22ran tulpadele mutujad
	$stmt->bind_result($id, $emailFromDb, $passwordFromDb, $created);
	$stmt->execute();
	
	if($stmt->fetch()){
		
		$hash = hash("sha512", $password);
		if($hash == $passwordFromDb){
			
			echo "kasuaja ".$id." logis sisse";
			
			$_SESSION["userID"] = $id;
			$_SESSION["email"] = $emailFromDb;
			
			//suunaks uuele lehele	
			header("Location: data.php");
			
			
		} else {
			$error = "parool vale";
			
		}
		
	} else {	
		
		$error = "sellise emailiga " .$email. " kasutajat ei olnud";
		
	}
	
	
	return $error;
	
}
	
	
	
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 /*
	function sum ($x, $y) {
	
		return $x + $y;
	
	}

	echo sum(427643634265,7473264);
	echo "<br>";
	$answer = sum (10,15);
	echo $answer;
	echo "<br>";

	
	function hello ($first_name, $last_name) {
		
		return "Tere tulemast ".$first_name." ".$last_name."!";
		
	}
	
	echo hello ("Siim", "Hytsi");
		

*/
?>