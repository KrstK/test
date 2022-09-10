<DOCTYPE HTML>
<HTML lang="PL">
<head>
	<meta charset="utf-8" />
	<title>Podsumowanie zamówienia</title>
</head>
<body>

<?php
	session_start();
	if (@$_SESSION['zalogowany']==true)
	{
		header('Location: gra.php');
		exit();
	}
	
	else
{
	require_once "DB_auth.php";
	$polaczenie_DB = @new mysqli($host,$db_user,$db_password,$db_name);
	if ($polaczenie_DB->connect_errno!=0)
	{
		echo "Error: ".$polaczenie_DB->connect_errno . "</br>Opis: ". $polaczenie_DB->connect_error;
	}
	else
	{
		@$login=$_POST['login'];
		@$haslo=$_POST['haslo'];
		
		@$login = htmlentities($login, ENT_QUOTES, "UTF-8");
		@$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
				
		if	($query_to_DB = @$polaczenie_DB->query(
		sprintf("SELECT * FROM users where username='%s' AND pass='%s'",
		mysqli_real_escape_string($polaczenie_DB,$login),
		mysqli_real_escape_string($polaczenie_DB,$haslo))))
		{
			$ilu_userów =$query_to_DB->num_rows;
			if ($ilu_userów>0)
			{
				$_SESSION['zalogowany']=true;

				$wiersz=$query_to_DB->fetch_assoc();

				$_SESSION['userID']=$wiersz['ID'];
				$_SESSION['username']=$wiersz['username'];
				echo"Zalogowano ". $_SESSION['username'];
				$query_to_DB->free_result();
				$polaczenie_DB->close();
				header('Location: gra.php');
			}
			else 
			{
			echo"błędny login lub hasło";
			$polaczenie_DB->close();
			}

			
		}

	}

}	
?>

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

	
</body>
</html>