<?php
	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'");

	$result = mysqli_query($mysqli, "SELECT * from sach where Gia <= 50");
  
    if(mysqli_num_rows($result) <> 0)
    {
        print '<table Border="0" Cellspacing="0" Cellpadding="5" width="100%">';
        while($row = mysqli_fetch_assoc( $result))
        {   
            echo "<tr>";
            echo "<td>";             
            echo '<img src ="../images/arrow.png" >  <a href="gia_home.php?matheloai='.$row['MaTheLoai'].'"> '.$row['TenTheLoai'].'</a></font>';
            echo "</br>";
            echo "</td>"; 
            echo "</tr>";      
        }  
        print '</table>';    
    }
    else
    {
        echo "Chưa có dữ liệu!";
    } 
?>
