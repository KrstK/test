<?php
	session_start();
	if (@$_SESSION['zalogowany']!==true)
	{
		header('Location: index.php');
		exit();
	}
	
?>

<DOCTYPE HTML>
<HTML lang="PL">
<head>
	<meta charset="utf-8" />
	<title>gra</title>
</head>
<body>

<?php

echo"<H1>Witaj ".$_SESSION['username']."!";	
?>

<h1>Zamówienie online</h1>
<form action="order.php" method="post">
ile pączków (0.99 zł/szt)
<input type="text" name="paczki"/>
	<br/><br/>
ile grzebieni (1.29 zł/szt)
<input type="text" name="grzebienie"/>
	<br/><br/>
<input type="submit" value="wyślij zamówienie" />
</form>

<h1>Rysuj prostokąt</h1>
<form action="prostokat.php" method="post">
Wysokość
<input type="int" name="wys"/>
	<br/><br/>
Szerokość
<input type="int" name="szer"/>
	<br/><br/>
<input type="submit" value="narysuj" />
</form>

<h2>Wyloguj</h2>
<form action="wyloguj.php" method="post">
<input type="submit" value="Wyloguj" />
</form>

</body>
</html>