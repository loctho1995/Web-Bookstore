<script LANGUAGE="JavaScript">
   	function confirmAction() 
   	{
   		return confirm("Bạn có chắc chắc muốn xóa thành viên này không ? Nếu bạn xóa, bạn sẽ xóa đi tất cả hóa đơn mà khách hàng này đã đặt!")
   	}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<table width="100%" border="1"   cellspacing="0" style="border-style:dotted" bordercolor="#3333CC">
	<tr><td colspan='8' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Trang quản lý tài khoản</p></td></tr>
	<tr colspan='4' style='background-image:url(../images/danhmuc.png)' height='15'>

	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>ID</td>
	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>Username</td>
	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>Tên thật</td>
	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>Email</td>
	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>Địa chỉ</td>
	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>Số ĐT</td>
	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>Ngày Sinh</td>
	<td <p style='color:#FFF; font-weight:bold ;text-align:center' align='center'></p>Xóa</td>
</tr>
<?php 
	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'");
 
	if($_GET['act'])
	{
		$sql = "delete from thanhvien where id='$_GET[act]'";
		$sql1 = "delete from hoadon where id_KhachHang = '$_GET[act]'";
		mysqli_query($mysqli, $sql1) or die(mysql_error());
		mysqli_query($mysqli, $sql) or die(mysql_error());
	}
	$sql="select * from thanhvien";
	$query = mysqli_query($mysqli, $sql) or die (mysql_error());
	$s = mysqli_num_rows($query);
	$numberRecordPerPage = 5;
	$numberPage	= ceil($s / $numberRecordPerPage);
	$curPage				= isset($_GET["page"])?$_GET["page"]:1;
	$startRecord			= ($curPage-1)*$numberRecordPerPage;
	$query = mysqli_query($mysqli, "select * from thanhvien LIMIT $startRecord,$numberRecordPerPage") or die("Query to get blah failed with error: ".mysql_error());

	while($row = mysqli_fetch_array($query))
	{ 
		?>
		<tr>
		<td><?php echo $row['id']?></td>
		<td><?php echo $row['UserName']?></td>
		<td><?php echo $row['Name']?></td>
		<td><?php echo $row['Email']?></td>
		<td><?php echo $row['DiaChi']?></td>
		<td><?php echo $row['SoDT']?></td>
		<td><?php echo $row['NgaySinh']?></td>
		<td><?php echo "<a onclick='return confirmAction()' href=quanlythanhvien.php?act=$row[id]><b>Xóa</b></a>"?></td>
		<tr>	
		</tr>

		<?php
	}
 	echo"<table align:'center' width='100%'>";
    echo "<p align:'center'>";
    echo"<td colspan='4' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold;  text-align:center' >";
    echo  "Trang: ";
    for ($k=1; $k<=$numberPage; $k++):
    	echo '<a href="quanlythanhvien.php?page='.$k.'">'.$k.'</a>';
    endfor;
    echo "</p>";
    echo"</table>";
?>
</table>