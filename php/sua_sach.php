<script type="text/javascript"> 
  function KiemTraSuaSach()
  {
    if(document.form_suasach.tuade.value=="")
    {
      alert("Bạn chưa nhập tựa đề. Vui lòng nhập vào !");
      document.form_suasach.tuade.focus();
      return false; 
    }

    if(document.form_suasach.tacgia.value=="")
    {
      alert("Bạn chưa nhập tên tác giả. Vui lòng nhập vào !");
      document.form_suasach.tacgia.focus();
      return false;
    }
  
    if(document.form_suasach.nhaxuatban.value=="")
    {
      alert("Bạn chưa nhập nhà xuất bản. Vui lòng nhập vào");
      document.form_suasach.nhaxuatban.focus();
      return false;   
    }
   
    if(document.form_suasach.tomtat.value=="")
    {
      alert("Bạn chưa nhập tóm tắt sách. Vui lòng nhập vào !");
      document.form_suasach.tomtat.focus();
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
	error_reporting(E_ALL^E_NOTICE); 
	session_start();

	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'");

 	if ($_GET['do']!="sua")
 	{
 		$_SESSION['sach_id'] = $_GET['act_sua'];
 	}
	$sql_query = mysqli_query($mysqli,"SELECT * FROM sach WHERE id='$_SESSION[sach_id]' ");
	$book = mysqli_fetch_array( $sql_query ); 
	//----Noi dung thong bao sau khi sua
	if ($_GET['do']=="sua") 
	{
		$id = addslashes( $_POST['id'] );
		$tuade = addslashes( $_POST['tuade'] );
		$tacgia = addslashes( $_POST['tacgia'] );
		$nhaxuatban = addslashes( $_POST['nhaxuatban'] );
		$namxuatban = addslashes( $_POST['namxuatban'] );
		$tomtat = addslashes( $_POST['tomtat'] );
		$gia = addslashes( $_POST['gia'] );
		$sql="
		update `sach` set
		`id`='$id',
		`TuaDe`= '$tuade',
		`TacGia` = '$tacgia',
		`NhaXuatBan` = '$nhaxuatban',
		`NamXuatBan` = '$namxuatban',
		`TomTat` = '$tomtat',
		`Gia` ='$gia' where `id`='$_SESSION[sach_id]'";
		if (mysqli_query($mysqli, $sql))
		{
			$temp="Bạn đã sửa thành công!";
			echo '<script type="text/javascript">
        	function hello(temp)
        	{
             	alert(temp);
			 	window.location="../php/quanlysach.php";		 
        	}
          	hello("'.$temp.'");
        	</script>';
		}
		else
			echo "<p align=center><font color=red size=5px>Sửa không thành công</font></p>";
		
	}
	else
    {
	    echo "<div align=center><b><font size=4>Đang sửa sách <font color=red></font></b></div></font></br>";
		echo"
		<form name='form_suasach' method='POST' action='?do=sua' onsubmit='return KiemTraSuaSach()' >
			<table border='0' width='30%' id='table1' cellspacing='3' cellpadding='0' align='center'>
				<tr>
					<td>Mã sách:</td>
					<td><input type='text' value='{$book['id']}' disabled name='id' size='30'></td>
				</tr>
				<tr>
					<td>Tựa đề:</td>
					<td><input type='text' value='{$book['TuaDe']}' name='tuade' size='30'></td>
				</tr>
				<tr>
					<td>Tác giả:</td>
					<td><input type='text' value='{$book['TacGia']}' name='tacgia' size='30'></td>
				</tr>
				<tr>
					<td>Nhà xuất bản:</td>
					<td><input type='text' value='{$book['NhaXuatBan']}' name='nhaxuatban' size='30'></td>
				</tr>
				<tr>
					<td>Năm xuất bản:</td>
					<td><input type='text' value='{$book['NamXuatBan']}' name='namxuatban' required='true' onkeypress='return checkNumber(event, this)' size='30'></td>
				</tr>
				<tr>
					<td>Tóm tắt:</td>
					<td><input rows='4' id='tomtat' type='text'  value='{$book['TomTat']}' name='tomtat' size='30' height='50'></td>
				</tr>
				<tr>
					<td>Giá:</td>
					<td><input type='text' value='{$book['Gia']}' name='gia' required='true' onkeypress='return checkNumber(event, this)' size='30'></td>
				</tr>
				
			</table>
			<p align='center'><input type='submit' value='Sửa'></p>
		</form>
		";
	} 
?>
