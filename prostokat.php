<DOCTYPE HTML>
	<HTML lang="PL">

	<head>
		<meta charset="utf-8" />
		<title>Podsumowanie zamówienia</title>
		<link rel="stylesheet" href="styles.css"></link>
	</head>

	<body>
		<h1>Rysuj prostokąt</h1>
		<form action="prostokat.php" method="post">
			Wysokość
			<input type="int" name="wys" />
			<br /><br />
			Szerokość
			<input type="int" name="szer" />
			<br /><br />
			Grybość przekątnej
			<input type="float" name="gr" />
			<br /><br />
			<input type="submit" value="narysuj" />

		</form>

		<?php
	$wys=$_POST['wys'];
	$szer=$_POST['szer'];
	$gr=$_POST['gr'];
	$gr=$gr/1.50;
	$l=$wys*$szer;
	
	echo'pole= '."$l"."</br>";
	
		$Ax=0;
		$Ay=$wys;


		$abs=(abs($wys*$Ax)+($szer*$Ay)-($wys*$szer));
		$sqrt=(sqrt(($wys*$wys)+($szer*$szer)));
		$d=$abs/$sqrt;

		echo'wys'.$wys.'</br>';//prawidłowa wartosc
		echo'szer'.$szer.'</br>';//prawidłowa wartosc
		echo'd '.$d.'</br>';
		echo'abs '.$abs.'</br>';
		echo'sqrt '.$sqrt.'</br>';

		$i='0';
		$i2='0';
	
	do	
	{
		if (isset($_SESSION['kolejna_linijka'])) 
		{$i=$i-1;
		unset($_SESSION['kolejna_linijka']);
			}

		if ($i>=$szer&&$i%$szer==0)
				{
					echo'</br>';
					//echo'X';
					$Ay=$Ay-1;
					$Ax=0;
					$i2++;
					$i++;
					$_SESSION['kolejna_linijka'] = true;
				}
		
		$abs=(abs($wys*$Ax)+($szer*$Ay)-($wys*$szer));
		$sqrt=(sqrt(($wys*$wys)+($szer*$szer)));
		$d=$abs/$sqrt;
		if($d<0)
		{$d=$d*-1;}
		if($d<$gr)
			{echo'<span class="red">O</span>';
				$Ax++;
				$i++;}
				else  if($i>=$szer&&$i%$szer==0)
				{
					echo'</br>';
					//echo'X';
					$Ay=$Ay-1;
					$Ax=0;
					$i2++;
					$i++;
					$_SESSION['kolejna_linijka'] = true;
				}
				else {
						echo'<span class="black"</span>O</span>';
						$Ax++;
						$i++;
						}
				
				
				
	

//
// if ($i>=$szer&&$i%$szer==0)
//	{
//		echo'</br>';
//		//echo'X';
//		$Ay=$Ay-1;
//		$Ax=0;
//		$i2++;
//		$i++;
//		$_SESSION['kolejna_linijka'] = true;
//		}
//	
//	$abs=(abs($wys*$Ax)+($szer*$Ay)-($wys*$szer));
//	$sqrt=(sqrt(($wys*$wys)+($szer*$szer)));
//	$d=$abs/$sqrt;
//	if($d<0)
//	{$d=$d*-1;}
//	if($d<$gr)
//		{echo'<b>O</b>';
//		$Ax++;
//		$i++;}
//		
//	else if($i>=$szer&&$i%$szer==0)
//	{
//		echo'</br>';
//		//echo'X';
//		$Ay=$Ay-1;
//		$Ax=0;
//		$i2++;
//		$i++;
//		$_SESSION['kolejna_linijka'] = true;
//	}
//	
//	if(!($d<0)&&!($i>=$szer&&$i%$szer==0))
//	{
//		echo'X';
//		$Ax++;
//		$i++;
//		}
		
	}	
	
	 while ($i2<$wys&&$i<$l);


	
?>
	</body>

	</html>