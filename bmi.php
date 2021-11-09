<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Twoje BMI</title>
		<link rel="stylesheet" href="styl3.css"/>
	</head>
	<div id="logo">
		<img src="wzor.png" alt="wzór BMI"/>
		</div>
	<header>
		<h1>Oblicz swoje BMI</h1>
	</header>
	<body>
	<?php   
		$db=mysqli_connect('localhost','root','','egzamin');
	?>
	
		<main>
			<table>
				<tr>
					<th>Interpretacja BMI</th>
					<th>Wartość minimalna</th>
					<th>Wartość maksymalna</th>
				</tr>
				
				<?php    
					$query="SELECT `informacja`, `wart_min`, `wart_max` FROM `bmi`;";
					$result=mysqli_query($db,$query);
					
					while ($row=mysqli_fetch_array($result)){
						echo "<tr>";
						echo "<td>".$row['informacja']."</td>";
						echo "<td>".$row['wart_min']."</td>";
						echo "<td>".$row['wart_max']."</td>";
						echo "</tr>";
					}
				?>
				
					
			</table>
		</main>
		<nav>
			<h2>Podaj wagę i wzrost</h2>
			<form action="bmi.php" method="POST">
				Waga:<input type="number" name="waga" min="1"/>
				Wzrost w cm:<input type="number" name="wzrost" min="1"/>
				<input type="submit" value="Oblicz i zapamiętaj wynik"/>
			</form>
			<?php  
				$Waga=$_POST['waga'];
				$Wzrost=$_POST['wzrost'];
				$wzor1=$Wzrost*$Wzrost;
				$bmiwzor=($Waga/$wzor1)*10000;
				$wynik=$bmiwzor;
				$data=date("Y-m-d");
				$wartosc=0;
				
				
				if (isset($_POST['waga'])&&isset($_POST['wzrost'])){
					echo "Twoja waga: ".$Waga.";"."Twój wzrost: ".$Wzrost."<br/>";
					echo "BMI wynosi: ".$bmiwzor;
				}
				
				if ($bmiwzor>=0&&$bmiwzor<=18){
						
					$wartosc=1;
				}
				else
				{
							if ($bmiwzor>=19&&$bmiwzor<=25){
								
								$wartosc=2;
							}
							
							else 
								
								{   if($bmiwzor>=26&&$bmiwzor<=30)
									
									{
										
										$wartosc=3;
										
									}
									
									else  {
										
										if ($bmiwzor>=31&&$bmiwzor<=100)
											
											{
												$wartosc=4;
												
												
											}
										
										
									}
								
								
								
								}
								
					

				}
				
				$query2="INSERT INTO `wynik`(`id`, `bmi_id`, `data_pomiaru`, `wynik`) VALUES ('NULL','$wartosc','$data','$wynik');";
				$result2=mysqli_query($db,$query2);
				
				
			?>
		</nav>
		<aside>
			<img src="rys1.png" alt="ćwiczenia"/>
		</aside>
		
		<?php   
		
		mysqli_close($db);
		?>
	</body>
	<footer>
		Autor: DF4K
		<a href="kwerendy.txt">Zobacz kwerendy</a>
	</footer>
</html>