<?php
  error_reporting (E_ALL ^ E_NOTICE);
  session_start();
?>
<script type="text/javascript"> 
function KiemTraThongTin()
{
  if(document.form_dangnhap.username.value=="")
  {
    alert("Bạn chưa nhập tên tài khoản . Vui lòng nhập vào !");
    document.form_dangnhap.username.focus();
    return false;
  }

  if(document.form_dangnhap.password.value=="")
  {
    alert("Bạn chưa nhập mật khẩu . Vui lòng nhập vào !");
    document.form_dangnhap.password.focus();
    return false;
  }   
  return true;
}
</script> 

<?php
$mysqli = mysqli_connect('localhost','root','','bookstore'); 
mysqli_query($mysqli, "SET NAMES 'utf8'");

if (isset($_POST['dangnhap']))
{
  // Dùng hàm addslashes() để tránh SQL injection, dùng hàm md5() để mã hóa password
  $username = addslashes( $_POST['username'] );
  $password = md5( addslashes( $_POST['password'] ) );
  $password1 = addslashes( $_POST['password']  );
  // Lấy thông tin của username đã nhập trong table members
  $query = mysqli_query($mysqli,  "SELECT id, UserName, PassWord,Name,DiaChi FROM thanhvien WHERE UserName='{$username}'");
  $member = mysqli_fetch_array( $query );
  // Nếu username này không tồn tại thì....
  if (mysqli_num_rows( $query ) <= 0 )
  {
    echo "
      <form name='form_dangnhap' action='dangnhap.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTraThongTin()'>
        <table width='350' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
        <tr><td colspan='2' align='center'><h1 align='center' style='color:#336999' margin-top ='20px'>Đăng Nhập Tài Khoản </h1></td></tr>
        <tr><td width='100px'>Tài Khoản : </td><td> <input type='text' value='$username' name='username' size='30'> </td></tr>
        <tr><td width='100px'>Mật Khẩu : </td><td> <input type='password'  value='$password1' name='password' size='30'> </td></tr>
        <tr><td colspan='2' align='center'><input type='submit' value='Đăng Nhập'  name ='dangnhap' ></p></td></tr>
        </table>
      </form>";
    print "<font size=5px color=red text-align=center>Tên tài khoản $username không tồn tại.</br></font></p>";
    return 0; 
  }
  // Nếu username này tồn tại thì tiếp tục kiểm tra mật khẩu
    if ( $password != $member['PassWord'] )
    {
      echo "
        <form name='form_dangnhap' action='dangnhap.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTraThongTin()'>
        <table width='350' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
        <tr><td colspan='2' align='center'><h1 align='center' style='color:#336999' margin-top ='20px'>Đăng Nhập Tài Khoản </h1></td></tr>
        <tr><td width='100px'>Tài Khoản : </td><td> <input type='text' value='$username' name='username' size='30'> </td></tr>
        <tr><td width='100px'>Mật Khẩu : </td><td> <input type='password'  value='$password1' name='password' size='30'> </td></tr>
        <tr><td colspan='2' align='center'><input type='submit' value='Đăng Nhập'  name ='dangnhap' ></p></td></tr>
        </table>
        </form>";
      print "<font size=5px color=red>Nhập sai mật khẩu.</font>";
      return 0;
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
          function hello(temp)
          {
            window.location="trangchu.php";       
          }
          hello("'.$temp.'");
          </script>';
    }   
  }
  else
  {
    echo "
      <form name='form_dangnhap' action='dangnhap.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTraThongTin()'>
      <table width='350' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
      <tr><td colspan='2' align='center'><h1 align='center' style='color:#336999' margin-top ='20px'>Đăng Nhập Tài Khoản </h1></td></tr>
      <tr><td width='100px'>Tài Khoản : </td><td> <input type='text' value='' name='username' size='30'> </td></tr>
      <tr><td width='100px'>Mật Khẩu : </td><td> <input type='password'  value='' name='password' size='30'> </td></tr>
      <tr><td colspan='2' align='center'><input type='submit' value='Đăng Nhập'  name ='dangnhap' ></p></td></tr>
      </table>
      </form>";
  }
?>