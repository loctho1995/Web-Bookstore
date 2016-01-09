<script type="text/javascript"> 
  function KiemTra()
  {
    if(document.form_dangky.username.value=="")
    {
      alert("Bạn chưa nhập tên tài khoản . Vui lòng nhập vào !");
      document.form_dangky.username.focus();
      return false; 
    }

    if(document.form_dangky.pass.value=="")
    {
      alert("Bạn chưa nhập mật khẩu . Vui lòng nhập vào !");
      document.form_dangky.pass.focus();
      return false;
    }
  
    if(document.form_dangky.pass2.value=="")
    {
      alert("Bạn chưa nhập lại mật khẩu . Vui lòng nhập vào");
      document.form_dangky.pass2.focus();
      return false;   
    }
   
    if(document.form_dangky.name2.value=="")
    {
      alert("Bạn chưa nhập họ tên . Vui lòng nhập vào !");
      document.form_dangky.name2.focus();
      return false;
    }

    if(document.form_dangky.email.value=="")
    {
      alert("Bạn chưa nhập email . Vui lòng nhập vào !");
      document.form_dangky.email.focus();
      return false;
    }

    if(document.form_dangky.ngaysinh.value=="")
    {
      alert("Ngày sinh chưa được chọn . Vui lòng chọn vào !");
      document.form_dangky.ngaysinh.focus();
      return false;
    }
    if(document.form_dangky.diachi.value=="")
    {
      alert("Bạn chưa nhập địa chỉ . Vui lòng nhập vào !");
      document.form_dangky.diachi.focus();
      return false;
    }

    if(document.form_dangky.sodienthoai.value=="")
    {
      alert("Bạn chưa nhập số điện thoại . Vui lòng nhập vào !");
      document.form_dangky.sodienthoai.focus();
      return false;
    }
    return true;
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
    
    if($username==""||$pass==""||$pass2==""||$name==""||$email==""||$diachi==""||$ngaysinh ==""||$sodt=="")
    {
      return 0;
    }
    else    
      if (mysqli_num_rows(mysqli_query($mysqli, "SELECT UserName FROM thanhvien WHERE UserName='$username'")) > 0)
      {
        echo "
      <form   name='form_dangky' action='dangky.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTra()'>
        <table width='455' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
        <tr><td colspan='2' align='center'> <h1  align='center' style='color:red'> Đăng Ký Tài Khoản</h1></td></tr>
        <tr><td width='130px'>Tài Khoản </td><td> <input type='text' value='$username' name='username' size='40'/>  </td></tr>
        <tr><td width='100px'>Mật Khẩu </td><td> <input type='password'  value='$pass' name='pass' size='40'> </td></tr>
        <tr><td width='100px'>Nhập lại mật khẩu </td><td> <input type='password'  value='$pass2' name='pass2' size='40'> </td></tr>
        <tr><td width='100px'>Họ Tên  </td><td> <input type='text'  value='$name' name='name2' size='40'> </td></tr>
        <tr><td width='100px'>Email </td><td> <input type='text'  value='$email' name='email' size='40'> </td></tr>
        <tr><td width='100px'>Ngày Sinh </td><td> <input type='date' value='$ngaysinh' name ='ngaysinh' size='40'> </td></tr>
        <tr><td width='100px'>Địa Chỉ </td><td> <input type='text'  value='$diachi' name='diachi' size='40'> </td></tr>   
        <tr><td width='100px'>Sô Điện Thoại </td><td> <input type='text'  value='$sodt' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>   
        <tr><td colspan='2' align='center'><input type='submit' value='Đăng Ký'  name ='DangKy' ></td></tr>
        </table>
      </form>";
        print "<font size=5px color=red>Tài khoản $username đã có người dùng</br> Bạn vui lòng chọn tài khoản khác!</br></font>";
        return 0;
      }
      else
        if ( mysqli_num_rows(mysqli_query($mysqli, "SELECT Email FROM thanhvien WHERE Email='$email'"))>0)
        {
          echo "
          <form   name='form_dangky' action='dangky.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTra()'>
            <table width='455' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
            <tr><td colspan='2' align='center'> <h1  align='center' style='color:red'> Đăng Ký Tài Khoản</h1></td></tr>
            <tr><td width='130px'>Tài Khoản </td><td> <input type='text' value='$username' name='username' size='40'/>  </td></tr>
            <tr><td width='100px'>Mật Khẩu </td><td> <input type='password'  value='$pass' name='pass' size='40'> </td></tr>
            <tr><td width='100px'>Nhập lại mật khẩu </td><td> <input type='password'  value='$pass2' name='pass2' size='40'> </td></tr>
            <tr><td width='100px'>Họ Tên  </td><td> <input type='text'  value='$name' name='name2' size='40'> </td></tr>
            <tr><td width='100px'>Email </td><td> <input type='text'  value='$email' name='email' size='40'> </td></tr>
            <tr><td width='100px'>Ngày Sinh </td><td> <input type='date' value='$ngaysinh' name ='ngaysinh' size='40'> </td></tr>
            <tr><td width='100px'>Địa Chỉ </td><td> <input type='text'  value='$diachi' name='diachi' size='40'> </td></tr>   
            <tr><td width='100px'>Sô Điện Thoại </td><td> <input type='text'  value='$sodt' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>   
            <tr><td colspan='2' align='center'><input type='submit' value='Đăng Ký'  name ='DangKy' ></td></tr>
            </table>
          </form>";
          print "<font size=5px color=red>Email này dã có người dùng, Bạn vui lòng chọn Email khác! </br></font>";
          return 0;
        }
        else
          if ( $password != $verify_password )
          {
            echo "
            <form   name='form_dangky' action='dangky.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTra()'>
                <table width='455' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
               <tr><td colspan='2' align='center'> <h1  align='center' style='color:red'> Đăng Ký Tài Khoản</h1></td></tr>
               <tr><td width='130px'>Tài Khoản </td><td> <input type='text' value='$username' name='username' size='40'/>  </td></tr>
               <tr><td width='100px'>Mật Khẩu </td><td> <input type='password'  value='$pass' name='pass' size='40'> </td></tr>
               <tr><td width='100px'>Nhập lại mật khẩu </td><td> <input type='password'  value='$pass2' name='pass2' size='40'> </td></tr>
               <tr><td width='100px'>Họ Tên  </td><td> <input type='text'  value='$name' name='name2' size='40'> </td></tr>
               <tr><td width='100px'>Email </td><td> <input type='text'  value='$email' name='email' size='40'> </td></tr>
               <tr><td width='100px'>Ngày Sinh </td><td> <input type='date' value='$ngaysinh' name ='ngaysinh' size='40'> </td></tr>
               <tr><td width='100px'>Địa Chỉ </td><td> <input type='text'  value='$diachi' name='diachi' size='40'> </td></tr>   
               <tr><td width='100px'>Sô Điện Thoại </td><td> <input type='text'  value='$sodt' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>   
                <tr><td colspan='2' align='center'><input type='submit' value='Đăng Ký'  name ='DangKy' ></td></tr>
              </table>
          </form>";
            print "<font size=5px color=red>Mật khẩu không giống nhau, bạn hãy nhập lại mật khẩu!</br></font>";
            return 0;
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
              echo "
              <form   name='form_dangky' action='dangky.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTra()'>

              <table width='455' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
             <tr><td colspan='2' align='center'> <h1  align='center' style='color:red'> Đăng Ký Tài Khoản</h1></td></tr>
             <tr><td width='130px'>Tài Khoản </td><td> <input type='text' value='$username' name='username' size='40'/>  </td></tr>
             <tr><td width='100px'>Mật Khẩu </td><td> <input type='password'  value='$pass' name='pass' size='40'> </td></tr>
             <tr><td width='100px'>Nhập lại mật khẩu </td><td> <input type='password'  value='$pass2' name='pass2' size='40'> </td></tr>
             <tr><td width='100px'>Họ Tên  </td><td> <input type='text'  value='$name' name='name2' size='40'> </td></tr>
             <tr><td width='100px'>Email </td><td> <input type='text'  value='$email' name='email' size='40'> </td></tr>
             <tr><td width='100px'>Ngày Sinh </td><td> <input type='date' value='$ngaysinh' name ='ngaysinh' size='40'> </td></tr>
             <tr><td width='100px'>Địa Chỉ </td><td> <input type='text'  value='$diachi' name='diachi' size='40'> </td></tr>   
             <tr><td width='100px'>Sô Điện Thoại </td><td> <input type='text'  value='$sodt' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>   
              <tr><td colspan='2' align='center'><input type='submit' value='Đăng Ký'  name ='DangKy' ></td></tr>
            </table>
        </form>
              ";
                      print "<font size=5px color = red> Địa Chỉ email không hợp lệ !</br></font>";
                      return 0;
                    }
                    // Thông báo hoàn t?t vi?c t?o tài kho?n
            if ($a)
             echo "
              <form   name='form_dangky' action='dangky.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTra()'>
              <table width='455' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
             <tr><td colspan='2' align='center'> <h1  align='center' style='color:red'> Đăng Ký Tài Khoản</h1></td></tr>
             <tr><td width='130px'>Tài Khoản </td><td> <input type='text' value='$username' name='username' size='40'/>  </td></tr>
             <tr><td width='100px'>Mật Khẩu </td><td> <input type='password'  value='$pass' name='pass' size='40'> </td></tr>
             <tr><td width='100px'>Nhập lại mật khẩu </td><td> <input type='password'  value='$pass2' name='pass2' size='40'> </td></tr>
             <tr><td width='100px'>Họ Tên  </td><td> <input type='text'  value='$name' name='name2' size='40'> </td></tr>
             <tr><td width='100px'>Email </td><td> <input type='text'  value='$email' name='email' size='40'> </td></tr>
             <tr><td width='100px'>Ngày Sinh </td><td> <input type='date' value='$ngaysinh' name ='ngaysinh' size='40'> </td></tr>
             <tr><td width='100px'>Địa Chỉ </td><td> <input type='text'  value='$diachi' name='diachi' size='40'> </td></tr>   
             <tr><td width='100px'>Sô Điện Thoại </td><td> <input type='text'  value='$sodt' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>   
              <tr><td colspan='2' align='center'><input type='submit' value='Đăng Ký'  name ='DangKy' ></td></tr>
            </table>
            </form>";
      print "<font size=5px>Tài khoản <font color=blue><b>{$username}</b></font> đã được tạo.</br>";
    }
    else
    {
        echo "
            <form   name='form_dangky' action='dangky.php' method='post' enctype='multipart/form-data' onsubmit='return KiemTra()'>
            <table width='455' border='1' bordercolor='#336999' cellspacing='0' cellpadding='2' align='center' bgcolor='#FEFBC5' style='color:#336999; border-collapse:collapse' >
           <tr><td colspan='2' align='center'> <h1  align='center' style='color:red'> Đăng Ký Tài Khoản</h1></td></tr>
           <tr><td width='130px'>Tài Khoản </td><td> <input type='text' value='' name='username' size='40'/>  </td></tr>
           <tr><td width='100px'>Mật Khẩu </td><td> <input type='password'  value='' name='pass' size='40'> </td></tr>
           <tr><td width='100px'>Nhập lại mật khẩu </td><td> <input type='password'  value='' name='pass2' size='40'> </td></tr>
           <tr><td width='100px'>Họ Tên  </td><td> <input type='text'  value='' name='name2' size='40'> </td></tr>
           <tr><td width='100px'>Email </td><td> <input type='text'  value='' name='email' size='40'> </td></tr>
           <tr><td width='100px'>Ngày Sinh </td><td> <input type='date' name ='ngaysinh' size='40'> </td></tr>
           <tr><td width='100px'>Địa Chỉ </td><td> <input type='text'  value='' name='diachi' size='40'> </td></tr>   
           <tr><td width='100px'>Sô Điện Thoại </td><td> <input type='text  value='' name='sodienthoai' required='true' onkeypress='return checkNumber(event, this)' size='40'> </td></tr>   
            <tr><td colspan='2' align='center'><input type='submit' value='Đăng Ký'  name ='DangKy' ></td></tr>
          </table>
          </form>";
    } 
?>


