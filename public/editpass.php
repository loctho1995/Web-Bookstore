<link href="dndk.css" rel="stylesheet" type="text/css" />

<?php 
	error_reporting(E_ALL^E_NOTICE);
	session_start();

	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'"); 
	if (isset($_POST['ChangePass']))
	{
		$user_id = intval($_SESSION['user_id']);
		$sql_query = mysqli_query($mysqli, "SELECT * FROM thanhvien WHERE id='{$user_id}'");
		$member = mysqli_fetch_array( $sql_query ); 
		//----Noi dung thong bao sau khi sua	
		$password = md5( addslashes( $_POST['password'] ) );
		$newpassword = md5( addslashes( $_POST['pass'] ) );
		$newpassword2 = md5( addslashes( $_POST['pass2'] ) );
			
		if($member['PassWord'] != $password)
		{
			print "<font size=5px color=red>Mật khẩu không chính xác ! Xin vui lòng nhập lại .</br> </font>";
			return 0;  
		}
		else
		{
			if($newpassword != $newpassword2)
			{
				print "<font size=5px color=red>Mật khẩu mới không giống nhau! Xin vui lòng nhập lại .</br> </font>";
				return 0;  
			}
			else
			{
				$sql="UPDATE thanhvien SET PassWord='$newpassword' WHERE id = $user_id LIMIT 1 ";		
			}
		}					
		
		if (mysqli_query($mysqli, $sql))
			echo "<font color=red size=5px>Thay đổi PassWord thành công !</font>";
		else
			echo "<font color=red size=5px>Thay đổi PassWord không thành công !</font>";	
	} 
?>

