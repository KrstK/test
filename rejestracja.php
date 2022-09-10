<?php
session_start();
//if (@$_SESSION['haslo_ok']==true&&@$_SESSION['email_ok']=true&&@$_SESSION['login_ok']=true&&@$_SESSION['regulamin_ok']=true)
//		{
//			unset($_SESSION['loginMsg']);unset($_SESSION['emailMsg']);unset($_SESSION['hasloMsg']);
//			unset($_SESSION['haslo_ok']);unset($_SESSION['email_ok']);unset($_SESSION['login_ok']);
//			unset($_SESSION['regulamin_ok']);
//			echo"już się zarejestrowałeś";
//			session_abort();session_unset();session_destroy();
//			exit();
//		}

if (isset($_POST['login'])) {
	$_SESSION['login_ok'] = true;
	$login = $_POST['login'];
	if ((strlen($login) < 3) || strlen($login) > 20) {
		$_SESSION['login_ok'] = false;
		$_SESSION['loginMsg'] = "LOGIN MUSI MIEĆ OD 3 DO 20 ZNAKÓW! ! !";
	}
	if ((ctype_alnum($login) == false)) {
		$_SESSION['login_ok'] = false;
		$_SESSION['loginMsg'] = "LOGIN MUSI SIĘ SKŁADAĆ TYLKO Z LITER I CYFR(BEZ POLSKICH ZNAKÓW)! ! !";
	}
	if ($login == '') {
		$_SESSION['login_ok'] = false;
		$_SESSION['loginMsg'] = "WPROWADŹ LOGIN! ! !";
	}

	if ($_SESSION['login_ok'] == true) {
		require_once "DB_auth.php";
		$polaczenie_DB = @new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie_DB->connect_errno != 0) {
			echo "Error: " . $polaczenie_DB->connect_errno . "</br>Opis: " . $polaczenie_DB->connect_error;
		} else {
			$login = htmlentities($login, ENT_QUOTES, "UTF-8");
			if ($query_to_DB = @$polaczenie_DB->query(
				sprintf(
					"SELECT ID FROM users where username='%s'",
					mysqli_real_escape_string($polaczenie_DB, $login)
				)
			)) {
				$ilu_userów = $query_to_DB->num_rows;
				if ($ilu_userów > 0) {
					$_SESSION['login_ok'] = false;
					$_SESSION['loginMsg'] = "LOGIN JEST ZAJĘTY! ! !";
				}
				$query_to_DB->free_result();
				$polaczenie_DB->close();
			}
		}
	}


	$_SESSION['email_ok'] = true;
	$email = $_POST['email'];
	$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
	if (filter_var($email, FILTER_SANITIZE_EMAIL) == false || ($emailB != $email)) {
		$_SESSION['email_ok'] = false;
		$_SESSION['emailMsg'] = "EMAIL JEST NIEPRAWIDŁOWY! ! !";
	}
	if ($_SESSION['email_ok'] == true) {
		require_once "DB_auth.php";
		$polaczenie_DB = @new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie_DB->connect_errno != 0) {
			echo "Error: " . $polaczenie_DB->connect_errno . "</br>Opis: " . $polaczenie_DB->connect_error;
		} else {
			$login = htmlentities($email, ENT_QUOTES, "UTF-8");
			if ($query_to_DB = @$polaczenie_DB->query(
				sprintf(
					"SELECT ID FROM users where email='%s'",
					mysqli_real_escape_string($polaczenie_DB, $email)
				)
			)) {
				$ilu_userów = $query_to_DB->num_rows;
				if ($ilu_userów > 0) {
					$_SESSION['email_ok'] = false;
					$_SESSION['emailMsg'] = "EMAIL JEST ZAJĘTY! ! !";
				}
				$query_to_DB->free_result();
				$polaczenie_DB->close();
			}
		}
	}

	$_SESSION['haslo_ok'] = true;
	$haslo1 = $_POST['haslo1'];
	$haslo2 = $_POST['haslo2'];
	if ($haslo1 !== $haslo2) {
		$_SESSION['haslo_ok'] = false;
		$_SESSION['hasloMsg'] = "HASŁA NIE SĄ IDENTYCZNE! ! !";
	}
	if ((strlen($haslo1) < 4)) {
		$_SESSION['haslo_ok'] = false;
		$_SESSION['hasloMsg'] = "HASŁO MUSI MIEĆ CO NAJMNIEJ 4 ZNAKi! ! !";
	}


	$_SESSION['regulamin_ok'] = true;
	if (!isset($_POST['regulamin'])) {
		$_SESSION['regulamin_ok'] = false;
		$_SESSION['regulaminMsg'] = "MUSISZ ZAAKCEPTOWAĆ REGULAMIN! ! !";
	}

	if (($_SESSION['haslo_ok']) == true && ($_SESSION['email_ok']) == true && ($_SESSION['login_ok']) == true && ($_SESSION['regulamin_ok']) == true) {
		require_once "DB_auth.php";
		$polaczenie_DB = @new mysqli($host, $db_user, $db_password, $db_name);
		if ($polaczenie_DB->connect_errno != 0) {
			echo "Error: " . $polaczenie_DB->connect_errno . "</br>Opis: " . $polaczenie_DB->connect_error;
		} else {
			if ($query_to_DB = @$polaczenie_DB->query("INSERT INTO users VALUES (null,'$login','$email','1','$haslo1','')")) 
			{
				$_SESSION['udanarejestracja'] = true;
				header('Location: index.php');
			} 
			//else {
			//	echo "Error: ".$query_to_DB->connect_errno."</br>Opis: ".$query_to_DB->connect_error;
			//}
		}
		unset($_SESSION['loginMsg']);
		unset($_SESSION['emailMsg']);
		unset($_SESSION['hasloMsg']);
		unset($_SESSION['regulaminMsg']);

		//exit();
	}
}


?>

<DOCTYPE HTML>
	<HTML lang="pl">

	<head>
		<meta charset="utf-8" />
		<title>Rejestracja</title>
		<script src="https://www.google.com/recaptcha/api.js"></script>

	</head>

	<body>
		<h1>Nowe konto</h1>
		<form action="rejestracja.php" method="post">
			Login:<br /><input type="text" name="login" /><br />
			<?PHP
			if (isset($_SESSION['loginMsg'])) {
				echo ($_SESSION['loginMsg']);
				unset($_SESSION['loginMsg']);
			}
			?>
			</br></br>E-mail:<br /><input type="text" name="email" /><br />
			<?PHP
			if (isset($_SESSION['emailMsg'])) {
				echo ($_SESSION['emailMsg']);
				unset($_SESSION['emailMsg']);
			}
			?>
			<br /></br>Haslo:<br /><input type="password" name="haslo1" /><br />
			Powtórz hasło: <br /><input type="password" name="haslo2" /><br />
			<?PHP
			if (isset($_SESSION['hasloMsg'])) {
				echo ($_SESSION['hasloMsg']);
				unset($_SESSION['hasloMsg']);
			}
			?>
			<br /></br><input type="checkbox" name="regulamin" /> Akceptuję regulamin<br />
			<?PHP
			if (isset($_SESSION['regulaminMsg'])) {
				echo ($_SESSION['regulaminMsg']);
				unset($_SESSION['regulaminMsg']);
			}
			?>

			<br /></br><input type="submit" value="Rejestruj" />
		</form>

	</body>

	</html>