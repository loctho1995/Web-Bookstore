<script type="text/javascript"> 

function KiemTraPass()
{
  if(document.form_changepass.password.value=="")
  {
    alert("Bạn chưa nhập mật khẩu . Vui lòng nhập vào !");
    document.form_changepass.password.focus();
    return false;
  }

  if(document.form_changepass.pass.value=="")
  {
    alert("Bạn chưa nhập mật khẩu mới . Vui lòng nhập vào !");
    document.form_changepass.pass.focus();
    return false;
  }
  
  if(document.form_changepass.pass2.value=="")
  {
    alert("Bạn chưa nhập lại xác nhận mật khẩu . Vui lòng nhập vào");
    document.form_changepass.pass2.focus();
    return false;
  }   
 
  return true;
}
</script> 

<meta charset="utf-8"/>

<?php 
  session_start();
  error_reporting(E_ALL^E_NOTICE);

  $mysqli = mysqli_connect('localhost','root','','bookstore'); 
  mysqli_query($mysqli, "SET NAMES 'utf8'"); 
  if ( !$_SESSION['user_id'] )
  { 
    echo "Bạn chưa đăng nhập! <a href='dangnhap.php'>Nhấp vào đây để đăng nhập</a> hoặc <a href='dangky.php'>Nhấp vào đây để đăng ký</a>"; 
    return 0;
  }
  else
  { 
    
  }
  ?>

<form name="form_changepass" action="suapassword.php" method="post" enctype="multipart/form-data" onsubmit="return KiemTraPass()">
    <table width="315" border="1" bordercolor="#336999" cellspacing="0" cellpadding="2" align="center" bgcolor="#FEFBC5" style="color:#336999; border-collapse:collapse">
    	<tr><td colspan=2 align=center><h1 align='center' style='color:#336999'>Sửa Password</h1></td></tr>
      <tr><td width="100px">Mật khẩu cũ </td><td> <input type="password"  value="" name="password" size="20"/>  </td></tr>
      <tr><td width="100px">Mật khẩu Mới </td><td> <input type="password"  value="" name="pass" size="20"/>  </td></tr>
      <tr><td width="130px">Nhập lại mật khẩu </td><td> <input type="password"  value="" name="pass2" size="20"/>  </td></tr> 
      <tr><td colspan=2 align=center><input type="submit" value=" Change PassWord "  name ="ChangePass" ></td></tr>     
    
</table>
</form>

<?php
  require("editpass.php");
?>

