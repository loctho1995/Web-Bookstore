<script type="text/javascript"> 
	function confirmAction() 
 	{
      	return confirm("Bạn có chắc chắc muốn xóa hóa đơn này không?")
    }
</script> 
<table width="100%" border="1"   cellspacing="0" style="border-style:dotted" bordercolor="#3333CC">
	<td colspan='7' style='background-image:url(../images/danhmuc.png)' height='15'>
		<p style="color:#FFF; font-weight:bold; text-align:center">Trang hóa đơn </p>
	</td>

	<tr colspan='4' style='background-image:url(../images/danhmuc.png)' height='15'>
	<br>
	<td> <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>ID</td>
	<td> <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>UserName</td>
	<td> <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Tên khách hàng</td>
	<td> <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Mã sách</td>
	<td> <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Tổng tiền</td>
	<td> <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Ngày mua</td>
	<td> <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Xóa</td>
	</tr>
<?php 
	error_reporting(E_ALL^E_NOTICE);
	session_start();
 	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
 	mysqli_query($mysqli, "SET NAMES 'utf8'");

	if($_GET['act'])
	{
		$sql1="delete from hoadon where id_HoaDon='$_GET[act]'";
		mysqli_query($mysqli ,$sql1) or die(mysqli_error());
	}

	$sql = "select * from hoadon";
	$query = mysqli_query($mysqli ,$sql) or die (mysqli_error());
	$s = mysqli_num_rows($query);
	$numberRecordPerPage = 5;
	$numberPage	= ceil($s / $numberRecordPerPage);
	$curPage				= isset($_GET["page"])?$_GET["page"]:1;
	$startRecord			= ($curPage-1)*$numberRecordPerPage;
	$query = mysqli_query($mysqli , "select id_HoaDon, id_KhachHang, id_Sach, TongTien, NgayMua, SoDT, DiaChi, UserName, Name from hoadon hd, thanhvien tv Where hd.id_KhachHang = tv.id LIMIT $startRecord,$numberRecordPerPage") or die("Query to get blah failed with error: ".mysql_error());
	while($row = mysqli_fetch_array($query))
	{
	?>
		<tr>
		<td><?php echo $row['id_HoaDon']?></td>
		<td><?php echo $row['UserName']?></td>
		<td><?php echo $row['Name']?></td>
		<td><?php echo $row['id_Sach']?></td>
		<td><?php echo number_format($row['TongTien'],3)."VNĐ"?></td>
		<td><?php echo $row['NgayMua']?></td>
		<td><?php echo "<a onclick='return confirmAction()' href=hoadon.php?act=$row[id_HoaDon]><b>Xóa</b></a>"?></td>
		</tr>
	<?php
	}
	echo "<b>Trang: </b>";
		     for ($k=1; $k<=$numberPage; $k++):
			 print '<a href="hoadon.php?page='.$k.'">'.$k.'</a>&nbsp;&nbsp;';
		     endfor;
?>
</table>
