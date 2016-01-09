<?php 
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
 	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
 	mysqli_query($mysqli, "SET NAMES 'utf8'");

	if(isset($_POST['submit']))
	{
		foreach($_POST['qty'] as $key=>$value)
		{
			if( ($value == 0) and (is_numeric($value)))
			{
				unset ($_SESSION['cart'][$key]);
			}
			else if(($value > 0) and (is_numeric($value)))
			{
				$_SESSION['cart'][$key]=$value;
		}
	}
}
?>

<html>
	<h1 align="center">GIỎ HÀNG</h1>
<?php
	$ok = 1;
	$s = 0;
	if(isset($_SESSION['cart']))
	{
		foreach($_SESSION['cart'] as $k => $v)
		{
			if(isset($k))
			{
				$ok = 2;
				$s++;
			}
		}
	}

	if($ok == 2)
	{
		echo "<form action=cart.php method=post>";
		foreach($_SESSION['cart'] as $key=>$value)
		{
			$item[] = $key;
		}
		$str = implode(",",$item);
		$total = 0;
		$numberRecordPerPage = 3;
		$numberPage	= ceil($s / $numberRecordPerPage);
	
	    $curPage				= isset($_GET["page"])?$_GET["page"]:1;
	    $startRecord			= ($curPage - 1)*$numberRecordPerPage;
		
        $mysql = mysqli_query( $mysqli, "SELECT * FROM sach");
		while($row=mysqli_fetch_array($mysql))
		{
            $total+=$_SESSION['cart'][$row['id']]*$row['Gia'];
		}
        $mysql =mysqli_query(  $mysqli,"select * from sach where id in ($str) LIMIT $startRecord,$numberRecordPerPage") or die("Query to get blah failed with error: ".mysql_error());
        
        while($row=mysqli_fetch_array($mysql))
		{
			echo"<table border='1' align='center' width='450' height='200'>";
			echo"<td><img width='160' height='180' src='../data/".$row['ImgSrc']."'></td>";
			echo"<td><h3>$row[TuaDe]</h3> <br> Tác Giả: $row[TacGia]<br> Giá bán: <font color=red>".number_format($row['Gia'],3)." VNĐ</font> <br> Số lượng: <input type=text name=qty[$row[id]] size=10 value={$_SESSION['cart'][$row[id]]}>  <br> Giá tiền cho món hàng: <font color=red> ". number_format($_SESSION['cart'][$row['id']]*$row['Gia'],3) ." VND</font> <br> <br> <a href=deletecart.php?productid=$row[id]>Xóa sách này</a></td></tr>";   	
		}
			echo"</table>" ;
			
      		echo "<br>";
			echo "<b>Tổng tiến tất cả hàng: <font color=red>". number_format($total,3)." VND</font></b>";
 			echo "<br>";
  			echo "<br>";
			echo "<input type='submit' name=submit value='Cập nhật giỏ hàng'>";
		 	echo "<br>";
		 	echo "<br>";
			echo "<b><a href=?act=thanhtoan&ok=1>Thanh toán</a> - <a href=deletecart.php?productid=0>Xóa bỏ giỏ hàng</a></b>";

		if(!isset($_GET['ok']))
		{
			$_GET['ok']='undefine';
		}
		if ($_GET['ok']=="1")
		{
			$sql="INSERT INTO `hoadon` (`id_KhachHang`,`id_Sach`,`TongTien`) VALUES ('$_SESSION[user_id]','$str','$total')";
			$result = mysqli_query($mysqli,$sql) or die("Query to get blah failed with error: ".mysql_error());
			if ($result)
			{
				$temp="Hóa đơn của bạn đã được lưu! Hàng sẽ được chuyển đến địa chỉ bạn đã đăng ký";
				echo '
        			<script type="text/javascript">
        				function hello(temp)
        				{
             				alert(temp);
			 				window.location="trangchu.php";
        				}
        				hello("'.$temp.'");
        			</script>';
			}
		}
		echo "<br>";
		echo "<br>";
		echo "<b>Trang: </b>";
	    for ($k=1; $k<=$numberPage; $k++):
		print '<a href="cart.php?page='.$k.'">'.$k.'</a>&nbsp;&nbsp;';
	    endfor;
	}
	else
	{
		echo '<b>Bạn không có món hàng nào trong giỏ hàng</b><br /></p>';
	}	
?>
</body>
</html>