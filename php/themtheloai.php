<script type="text/javascript"> 
	function KiemTra()
	{
  		if(document.form_themtheloai.tentheloai.value=="")
  		{
    		alert("Bạn chưa nhập tên thể loại. Vui lòng nhập vào !");
    		document.form_themtheloai.tentheloai.focus();
    		return false; 
  		}
  		return true;
	}

	function KiemTraCapNhat()
	{
  		if(document.form_capnhattheloai.theloai.value=="")
  		{
    		alert("Bạn chưa chọn tên thể loại cũ. Vui lòng chọn!");
    		document.form_capnhattheloai.theloai.focus();
    		return false; 
  		}

  		if(document.form_capnhattheloai.tentheloaimoi.value=="")
  		{
    		alert("Bạn chưa nhập tên thể loại mới. Vui lòng nhập vào!");
    		document.form_capnhattheloai.tentheloaimoi.focus();
    		return false; 
  		}
  
  		return true;
	}

	function KiemTraXoa()
	{
  		if(document.form_xoatheloai.theloai.value=="")
  		{
    		alert("Bạn chưa chọn tên thể loại. Vui lòng chọn !");
    		document.form_xoatheloai.theloai.focus();
    		return false; 
  		}
  		return true;
	}

	function confirmActionCapNhat() 
    {
     	return confirm("Bạn có chắc chắc muốn thêm tên thể loại này không?")
    }
 

    function confirmActionCapNhatSach() 
    {
      	return confirm("Bạn có chắc chắc muốn cập nhật tên thể loại không?")
    }
</script> 

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
	error_reporting(E_ALL^E_NOTICE);
	session_start();
	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'");

	if ($_GET['do'] == "themtheloai") 
	{   
		$tenTheLoai = addslashes( $_POST['tentheloai'] );
		$sql = "INSERT INTO `theloai` (`TenTheLoai`) VALUES ('$tenTheLoai')";
		if (mysqli_query($mysqli, $sql))
		{			
			echo '<script type="text/javascript">
        			window.location="../php/quanlysach.php";	
        		</script>';
		}		
		else
			echo "<p align=center><font color=red size=5px>Không thành công</font></p>";		
	}
	else
    {
	    echo "</br>";
		echo"
		<form name='form_themtheloai' method='POST' action='?do=themtheloai' onsubmit='return confirmActionCapNhat()'>
			<table border='0' width='20%' id='table1' cellspacing='3' cellpadding='0'>	
			<tr >
				<td style='background-image:url(../images/danhmuc.png)'  height='28'>
					<p style='color:#FFF; font-weight:bold; text-align:center'>Thêm thể loại</p>
				</td>
			</tr>

			<tr>
				<td align=center>Tên Thể Loại</td>
			</tr>

			<tr>
				<td><input type='text' value='' name='tentheloai' size='22'></td>
			</tr>		
			</table>
			<div align=center><br><input type='submit' onclick='return KiemTra()' value='Thêm thể loại'></div>
		</form> ";
		echo "</br>";	
	} 
?>

<form name='form_capnhattheloai' method='POST' action='?do=capnhattheloai' onsubmit='return confirmActionCapNhatSach()'>
	<table border='0' width='20%' id='table1' cellspacing='3' cellpadding='0'>	
		<td style="background-image:url(../images/danhmuc.png)"  height="28">
			<p style="color:#FFF; font-weight:bold; text-align:center">Cập nhật tên thể loại </p>
		</td>

		<tr>
			<td align=center>Tên Thể Loại Cũ</td>
		</tr>

		<tr>
			<td align=center >
				<select id="theloai" name="theloai"  >
					<option value="" >Thể loại</option>
						<?php
							$conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
							mysqli_query($conn, "SET NAMES utf8");
							$sql = "SELECT * FROM theloai";
							$query = mysqli_query($conn, $sql);

							while($row = mysqli_fetch_assoc($query))
							{
								echo "<option value = ".$row['MaTheLoai'].">".$row['TenTheLoai']."</option>";
							}
						?>
				</select>
			</td>
		</tr>
	
		<tr>
			<td align=center><br>Tên Thể Loại Mới</td>
		</tr>

		<tr>
			<td><input type='text' value='' name='tentheloaimoi' size='22'></td>
		</tr>
	</table>
	<div align=center><br><input type='submit' onclick='return KiemTraCapNhat()' value='Cập nhật tên thể loại' ></div>
</form>

<?php 
	error_reporting(E_ALL^E_NOTICE);
	session_start();
	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'");

	if ($_GET['do']=="capnhattheloai") 
	{   
		$tenTheLoai = addslashes( $_POST['tentheloaimoi'] );
		$tenTheLoaiCu = addslashes( $_POST['theloai'] );
		$sql=" UPDATE theloai SET TenTheLoai = '$tenTheLoai' where MaTheLoai = '$tenTheLoaiCu'";
				
		if (mysqli_query($mysqli, $sql))
		{
			echo "<font color=red size=5px>Cập nhật thành công</font>";	
			echo '<script type="text/javascript">
					window.location="../php/quanlysach.php";
        		</script>'; 
		}		
		else
			echo "<p align=center><font color=red size=5px>Không thành công</font></p>";
		
	}
?>


