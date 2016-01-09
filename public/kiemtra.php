<?php
error_reporting (E_ALL ^ E_NOTICE);
session_start();

echo '<title>Đăng nhập</title>';
$mysqli = mysqli_connect('localhost','root','','bookstore'); 
mysqli_query($mysqli, "SET NAMES 'utf8'");

if (isset($_POST['dangnhap']))
{
	// Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
	$username = addslashes( $_POST['username'] );
	$password = md5( addslashes( $_POST['password'] ) );
	// Lấy thông tin của username đã nhập trong table members
	$query = mysqli_query($mysqli,  "SELECT id, UserName, PassWord,Name,DiaChi FROM thanhvien WHERE UserName='{$username}'");
	$member = mysqli_fetch_array( $query );
	// Nếu username này không tồn tại thì....
	if (mysqli_num_rows( $query ) <= 0 )
	{
		print "<font size=5px color=red text-align=center>Tên tài khoản không tồn tại.</br></font></p>";
		
	}
	// Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
	
		if ( $password != $member['PassWord'] )
		{
			print "<font size=5px color=red>Nhập sai mật khẩu.</font>";
		}
	
	else
	{
		if(!isset($_SESSION['user_id']))
		 {$_SESSION['user_id']="doit";}
				// Khởi động phiên làm việc (session)

	    $_SESSION['user_id'] = $member['id'];
		$_SESSION['tenkh']=$member['Name'];
		$_SESSION['dc']=$member['DiaChi'];

				$temp="Bạn đăng nhập với tài khoản: '{$member['UserName']}' thành công!";
			echo '<script type="text/javascript">
	        function hello(temp){
				 window.location="trangchu.php";			 
	        }
	          hello("'.$temp.'");
	        </script>
	        ';
	    }		
	}
?>