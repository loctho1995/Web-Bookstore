<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body >
<?php 
	if (isset($_POST['DangKy'])) 
    {
		$mysqli = mysqli_connect('localhost','root','','bookstore'); 
		mysqli_query($mysqli, "SET NAMES 'utf8'");

		$username = addslashes( $_POST['username'] );
		$pass = $_POST['pass'];
		$pass2 = $_POST['pass2'];
		$password = md5( addslashes( $_POST['pass'] ) );
		$verify_password = md5( addslashes( $_POST['pass2'] ) );
		$email = addslashes( $_POST['email'] );
		$name = addslashes( $_POST['name2'] );
		$ngaysinh = addslashes( $_POST['ngaysinh'] );
		$diachi = addslashes( $_POST['diachi'] );
		$sodt = addslashes( $_POST['sodienthoai'] );
		// Ki?m tra 7 thông tin, n?u có b?t k? thông tin chua di?n thì s? báo l?i
		if($username==""||$pass==""||$pass2==""||$name==""||$email==""||$diachi==""||$ngaysinh ==""||$sodt=="")
		{
			exit;
		}
		else		
		// Ki?m tra username nay co nguoi dung chua
			if ( mysqli_num_rows(mysqli_query($mysqli, "SELECT UserName FROM thanhvien WHERE UserName='$username'"))>0)
			{
				print "<p align=center><font size=5px color=red>Username này đã có người dùng, Bạn vui lòng chọn username khác!</br></font>/p>";
				exit;
			}
			else
			// Ki?m tra email nay co nguoi dung chua
				if ( mysqli_num_rows(mysqli_query($mysqli, "SELECT Email FROM thanhvien WHERE Email='$email'"))>0)
				{
					print "<p align=center><font size=5px color=red>Email này dã có người dùng, Bạn vui lòng chọn Email khác! </br></font></p>";
					exit;
				}
				else
				// Ki?m tra m?t kh?u, b?t bu?c m?t kh?u nh?p lúc d?u và m?t kh?u lúc sau ph?i trùng nhau
					if ( $password != $verify_password )
					{
						print "<p align=center><font size=5px color=red>Mật khẩu không giống nhau, bạn hãy nhập lại mật khẩu!</br></font></p>";
						exit;
					}
					else
						if(filter_var($email,FILTER_VALIDATE_EMAIL))
						{
						// Tiến hành tạo tài khoản
							$a=mysqli_query($mysqli, "INSERT INTO thanhvien (UserName, PassWord, Email,DiaChi,SoDT,Name,NgaySinh) VALUES
						 	('{$username}', '{$password}', '{$email}', '{$diachi}','{$sodt}', '{$name}', '{$ngaysinh}')");
						}
						else
						{
							print "<p align=center><font size=5px color = red> Địa Chỉ email không hợp lệ !</br></font></p>";
							exit;
						}
						// Thông báo hoàn t?t vi?c t?o tài kho?n
		if ($a)
			print "<p text-align=center><font size=5px>Tài khoản <font color=blue><b>{$username}</b></font> đã được tạo.</br></p>";
		}
		
?>
</body>