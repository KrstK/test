<DOCTYPE HTML>
<HTML lang="PL">
<head>
	<meta charset="utf-8" />
	<title>Podsumowanie zamówienia</title>
</head>
<body>
<?php
	$paczki=$_POST['paczki'];
	$grzebienie=$_POST['grzebienie'];
	$cenaPaczki=$paczki*0.99;
	$cenaGrzebieni=$grzebienie*1.29;
	$suma=$cenaGrzebieni+$cenaPaczki;
echo<<<END
<h2>Podsumowanie zamówienia</h2>

Pączki: $paczki*0.99zł = $cenaPaczki </br>
Grzebienie: $grzebienie*1.29zł = $cenaGrzebieni </br>
SUMA: $suma

END;
	
?>
</body>
</html>