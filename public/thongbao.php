<script type="text/javascript"> 
function confirmActionThoat() 
{
    return confirm("Bạn có chắc chắc muốn thoát không?")
}
</script>

<?php 
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();

	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'");

	if ($_SESSION['user_id'] )
	{
		$user_id = intval($_SESSION['user_id']);
		$sql_query = @mysqli_query($mysqli,"SELECT * FROM thanhvien WHERE id='{$user_id}'");
		$member = @mysqli_fetch_array($sql_query ); 

		if ($member['Admin'] == "1")  {
		echo "<font size=3px color=red text-align=right><a href='suathongtin.php'>Tài khoản: {$member['UserName']} </a></font>";
		
		echo "<a href='quanlythanhvien.php'>Quản lý tài khoản</a>";
		echo "<a href='quanlysach.php'>Quản lý sách</a>";
		echo "<a href='hoadon.php'>Hóa đơn</a>";
		echo "<a href='uploadsach.php'>Upload sách</a>";
		echo "<a href='timkiemadmin.php'>Tìm kiếm</a>";
		echo "<a onclick='return confirmActionThoat()' href='thoat.php'>Thoát</a>";
	}
	else
	{
		echo "<font size=3px color=red text-align=right><a href='suathongtin.php'>Tài khoản: {$member['UserName']} </a></font>";
		echo "<a href='suapassword.php'>Sửa password</a>"; 
		echo "<a href='timkiem.php'>Tìm kiếm</a>";
		echo "<a onclick='return confirmActionThoat()' href='thoat.php'>Thoát</a>";
	}	
} 
?>
