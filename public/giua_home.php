<?php
 	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
 	mysqli_query($mysqli, "SET NAMES 'utf8'");

	$sql = "SELECT * FROM sach ORDER BY id DESC LIMIT 28 ";
	$result = mysqli_query($mysqli, $sql);
	if(mysqli_num_rows($result)<>0) // co du lieu
	{
		echo"<table align='center'>";
			echo"<tr >";
				echo"<td colspan='4' style='background-image:url(../images/danhmuc.png)' height='28'><p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Sách Mới Nhất</p></td>";
			echo"</tr>";
			$stt=0;
			while($row = mysqli_fetch_row($result))
			{
				if($stt%4==0)
				{
					echo "<tr>";
				}
					echo"<td valign='top'>";
					echo"<table align='center'>";
					echo"<tr><td align='center'><p style='font-weight:bold '><a href='list_sach_home.php?mas=$row[0]'><b>$row[1]</b></a></td></tr>";
					echo"<tr><td align='center'><img width='140' height='140' src='../data/".$row[8]." ' ></td></tr>";
					echo"<tr><td align='center'>$row[3].000 VND</td></tr>";
					echo "</br>";
					echo"</table>";
					echo"</td>";
				$stt++;
				if($stt%4==0)
				{
					echo "</tr>";
				}
			}
		echo"</table>"	;
	}
?> 
    	

