<script type="text/javascript"> 
function KiemTra()
{    
  if(document.form_edit.name2.value=="")
  {
    alert("Bạn chưa nhập họ tên . Vui lòng nhập vào !");
    document.form_edit.name2.focus();
    return false;
  }

  if(document.form_edit.email.value=="")
  {
    alert("Bạn chưa nhập email. Vui lòng nhập vào !");
    document.form_edit.email.focus();
    return false;
  }

  if(document.form_edit.ngaysinh.value=="")
  {
    alert("Ngày sinh chưa được chọn. Vui lòng chọn !");
    document.form_edit.ngaysinh.focus();
    return false;
  }
  if(document.form_edit.diachi.value=="")
  {
    alert("Bạn chưa nhập địa chỉ. Vui lòng nhập vào !");
    document.form_edit.diachi.focus();
    return false;

  }

  if(document.form_edit.sodienthoai.value=="")
  {
    alert("Bạn chưa nhập số điện thoại. Vui lòng nhập vào !");
    document.form_edit.sodienthoai.focus();
    return false;

  }
  return true;
}
function confirmAction() 
{
  	return confirm("Bạn có chắc chắc muốn cập nhật thông tin không?")
}

function checkNumber(e, element)
{
	var charcode = (e.which) ? e.which : e.keyCode;

	//kiem tra xem co phai number khong
	if(charcode > 31 && (charcode < 48 || charcode > 57))
	{
		return false;
	}

	return true;
}

</script>
<?php 
	error_reporting(E_ALL^E_NOTICE);
	session_start();

	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'"); 
	if ($_SESSION['user_id'] )
	{ 
		$user_id = intval($_SESSION['user_id']);
		$sql_query = mysqli_query($mysqli, "SELECT * FROM thanhvien WHERE id='{$user_id}'");
		$member = mysqli_fetch_array( $sql_query ); 
	//----Noi dung thong bao sau khi sua
	
	if ($_GET['do']=="sua")
	{		
		$name = addslashes( $_POST['name2'] );
		$ngaysinh = addslashes( $_POST['ngaysinh'] );
		$diachi = addslashes( $_POST['diachi'] );
		$email = addslashes( $_POST['email'] );
		$sodt = addslashes( $_POST['sodienthoai'] );
		$sql="UPDATE thanhvien SET Name ='$name' ,NgaySinh='$ngaysinh',Email='$email',DiaChi='$diachi', SoDT ='$sodt' WHERE id = $user_id LIMIT 1 ";
	
		if (mysqli_query($mysqli, $sql))
		{
			echo "
			<form name='form_edit' action='suathongtin.php?do=sua' method='post'  onsubmit='return confirmAction()'>
			    <table width='450' padding-top='50' border='1' bordercolor='#336999' cellspacing='0' cellpadding='3' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse'>
			     <tr><td colspan=2 align=center><h1 align='center' style='color:#336999'> Đang sửa tài khoản <font color=red>{$member['UserName']}</h1></td></tr>
			     <tr><td width='200px'>Họ Tên  </td><td> <input type='text' value='{$name}' name='name2' size='40'> </td></tr>
			     <tr><td width='200px'>Email </td><td> <input type='text'  value='{$email}' name='email' size='40'> </td></tr>
			     <tr><td width='200px'>Ngày Sinh </td><td> <input type='date' value='{$ngaysinh}' name ='ngaysinh' size='40'> </td></tr>
			     <tr><td width='200px'>Địa Chỉ </td><td> <input type='text' value='{$diachi}' name='diachi' size='40'> </td></tr> 
			     <tr><td width='200px'>Số Điện Thoại </td><td> <input type='text' value='{$sodt}' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>         
				 <tr><td colspan=2 align=center><input type='submit'  onclick='return KiemTra()' value='Update'></td></tr>
			</table>	
			</form> ";
			echo "<font color=red size=5px>Update thành công !</font></p>";	
		}
		else
		{
			echo "
			<form name='form_edit' action='suathongtin.php?do=sua' method='post'  onsubmit='return confirmAction()'>
			    <table width='450' padding-top='50' border='1' bordercolor='#336999' cellspacing='0' cellpadding='3' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse'>
			     <tr><td colspan=2 align=center><h1 align='center' style='color:#336999'> Đang sửa tài khoản <font color=red>{$member['UserName']}</h1></td></tr>
			     <tr><td width='200px'>Họ Tên  </td><td> <input type='text' value='{$name}' name='name2' size='40'> </td></tr>
			     <tr><td width='200px'>Email </td><td> <input type='text'  value='{$email}' name='email' size='40'> </td></tr>
			     <tr><td width='200px'>Ngày Sinh </td><td> <input type='date' value='{$ngaysinh}' name ='ngaysinh' size='40'> </td></tr>
			     <tr><td width='200px'>Địa Chỉ </td><td> <input type='text' value='{$diachi}' name='diachi' size='40'> </td></tr> 
			     <tr><td width='200px'>Số Điện Thoại </td><td> <input type='text' value='{$sodt}' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>         
				 <tr><td colspan=2 align=center><input type='submit'  onclick='return KiemTra()' value='Update'></td></tr>
			</table>	
			</form> ";
			echo "<font color=red size=5px>Update không thành công !</font></p>";
		}		
		
	}	
	else
		echo "
			<form name='form_edit' action='suathongtin.php?do=sua' method='post' onsubmit='return confirmAction()' >
			    <table width='450' padding-top='50' border='1' bordercolor='#336999' cellspacing='0' cellpadding='3' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse'>
			     <tr><td colspan=2 align=center><h1 align='center' style='color:#336999'> Đang sửa tài khoản <font color=red>{$member['UserName']}</h1></td></tr>
			     <tr><td width='200px'>Họ Tên  </td><td> <input type='text' value='{$member['Name']}' name='name2' size='40'> </td></tr>
			     <tr><td width='200px'>Email </td><td> <input type='text'  value='{$member['Email']}' name='email' size='40'> </td></tr>
			     <tr><td width='200px'>Ngày Sinh </td><td> <input type='date' value='{$member['NgaySinh']}' name ='ngaysinh' size='40'> </td></tr>
			     <tr><td width='200px'>Địa Chỉ </td><td> <input type='text' value='{$member['DiaChi']}' name='diachi' size='40'> </td></tr> 
			     <tr><td width='200px'>Số Điện Thoại </td><td> <input type='text' value='{$member['SoDT']}' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>         
				 <tr><td colspan=2 align=center><input type='submit'  onclick='return KiemTra()'  value='Update'></td></tr>
			</table>	
			</form> ";
	} 
?>




