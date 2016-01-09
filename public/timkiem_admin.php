<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php 
	error_reporting (E_ALL ^ E_NOTICE);
	session_start();
?>
<form  method="post" action="timkiemadmin.php?search=sach">
  <table width="403" border="0" align="center" cellspacing="4" cellpadding="0">
    <tr>
      <td width="150">Tên sách </td>
     <?php echo "<td width=386><input name=tensach type=text size=35 value= '$_POST[tensach]'></td>";?> 
    </tr>
    <tr>
      <td>Tác giả</td>
     <?php echo "<td><input name=tacgia type=text size=35 value='$_POST[tacgia]'></td>";  ?>
    </tr>
     <tr>
      <td>Mã sách</td>
     <?php echo "<td><input name=masach type=text size=35 value='$_POST[masach]'></td>";  ?>
    </tr>
    <tr>
      <td height="52" colspan="2">     
        <div align="center">
          <input type="submit" name="Submit" value="Tìm kiếm">
        </div></td></tr>
  </table>
</form>

<?php
$mysqli = mysqli_connect('localhost','root','','bookstore'); 
	mysqli_query($mysqli, "SET NAMES 'utf8'"); 

	 $p = new Pager;
    // yêu cầu giới hạn bao nhiêu dòng
    $limit = 8 ;
    // Tìm dòng bắt đầu đưa vào trang lấy được (khai báo nếu nó chưa có giá trị)
    $start = $p -> findStart($limit);

		if ( $_GET['search'] == "sach" ) 
		{
			$_SESSION["tensach"] =( $_POST['tensach'] );
			$_SESSION["tacgia"] = ( $_POST['tacgia'] );
			$_SESSION["masach"] = ( $_POST['masach'] );
		}
		else
		{
			return 0;
		}

	 $count = 0;
	
		$query = mysqli_query($mysqli, "SELECT * from sach where TuaDe like '%$_SESSION[tensach]%' and TacGia like '%$_SESSION[tacgia]%' and id = '$_SESSION[masach]' ") or die("Co loi:".mysql_error());
		while($row = mysqli_fetch_array($query))
		{
			 $count++;
		}
	 echo"<table align:'center' width='100%'>";
	 echo "<p align:'center'>";
	 echo"<td colspan='4' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold;  text-align:center' >";
   echo "<b>Số kết quả tìm được: <font color=blue> $count  </font> </b>";
   echo "</p>";
   echo"</table>";
   echo "<br>";

     $count = mysqli_num_rows($query);
    // Tìm số trang dựa vào số dọng và số giới hạn
    $pages = $p -> findPages($count,$limit);
	
    if($count != 0) 
    {
    	echo"<table border='1' align='center'>";
		  $query = mysqli_query($mysqli, "SELECT * from sach where TuaDe like '%$_SESSION[tensach]%' and TacGia like '%$_SESSION[tacgia]%' and id = '$_SESSION[masach]' limit ".$start.",".$limit)  or die("Co loi:".mysql_error());
		 while($row1 = mysqli_fetch_array($query))
		 {
			 echo"<tr style='color:red; font-weight:bold'><td align='center' colspan='2'>$row1[id] - $row1[TuaDe]</td></tr>";

			 echo"<tr><td align='center'><img width='190' height='200' src='../data/".$row1['ImgSrc']."'><br></td>";

			 echo"<td>Tác Giả: $row1[TacGia]<br> Nhà Xuất Bản: $row1[NhaXuatBan] <br> Năm Xuất Bản: $row1[NamXuatBan]<p>Tóm Tắt: $row1[TomTat] </p><br> Giá bán: <font color=red>$row1[Gia].000 VND</td></tr>";		
		 }
		  echo"</table>";
		
		  $pagelist = $p -> pageList($_GET['page'],$pages);
     	echo"<table align:'center' width='100%'>";
    	echo "<p align:'center'>";
    	echo"<td colspan='4' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold;  text-align:center' >";
    	echo  "Trang: $pagelist ";
    	echo "</p>";
    	echo"</table>";
	 }
?>
