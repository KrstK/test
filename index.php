<?php
	session_start();
	if (@$_SESSION['zalogowany']==true)
	{
		header('Location: gra.php');
		exit();
	}
	
	if (@$_SESSION['udanarejestracja']==true)
	{
		echo"Dziękujemy za rejestrację, możesz się zalogować";
	}
?>

<DOCTYPE HTML>
<HTML lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Tytuł strony</title>
</head>

<body>
	<h1>Loguj</h1>
	<form action="zaloguj.php" method="post">
	Login: 
	<input type="text" name="login"/>
		<br/><br/>
	Hasło: 
	<input type="password" name="haslo"/>
		<br/><br/>
	<input type="submit" value="Zaloguj" />
	</form>

</br></br><br/></br>

	<form action="rejestracja.php" method="post">
	<input type="submit" value="Zarejestruj" />
	</form>


</body>
</html>