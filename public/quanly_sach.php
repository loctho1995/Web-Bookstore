<script type="text/javascript">
function confirmActionXoaSach() 
{
  	return confirm("Bạn có chắc chắc muốn xóa sách này không?")
}
</script>

<table align="left" width="200" cellpadding="0" cellspacing="0"  border="0">
	<tr >
		<td style="background-image:url(../images/danhmuc.png)"  height="28">
			<p style="color:#FFF; font-weight:bold; text-align:center">  Danh mục thể loại </p>
		</td>
	</tr>
    <tr><td><br /></td></tr>
	<tr>
		<td >
	<?php
		session_start();
	       $mysqli = mysqli_connect('localhost','root','','bookstore'); 
	       mysqli_query($mysqli, "SET NAMES 'utf8'");

	       $result = mysqli_query($mysqli, "SELECT * FROM theloai");
  
            if(mysqli_num_rows($result) <> 0)
            {
                print '<table Border="0" Cellspacing="0" Cellpadding="5" width="100%">';
                while($row = mysqli_fetch_assoc( $result))
                {   
                    echo "<tr>";
                    echo "<td>";             
                    echo '<img src ="../images/arrow.png" >  <a href="quanlysach.php?matheloai='.$row['MaTheLoai'].'"> '.$row['TenTheLoai'].'</a></font>';
                    echo "</br>";
                    echo "</td>"; 
                    echo "</tr>";      
                }  
                print '</table>';    
            }
            else
            {
                echo "Chưa có dữ liệu!";
            } 
            require('themtheloai.php'); 
    ?>
		</td>
	</tr>
    <tr><td><br /></td></tr>
<table>
	<tr>
    	<td>
<table align="center" bgcolor="#CCCCCC" width="830">

<?php
    session_start();

    if($_GET['act']  )
    {
    	$mysqli = mysqli_connect('localhost','root','','bookstore'); 
        mysqli_query($mysqli, "SET NAMES 'utf8'");
    	$layhinh = "SELECT * FROM sach WHERE id='".$_GET['act']."'";
    	$query_layhinh = mysqli_query($mysqli, $layhinh);
    	$filename = mysqli_fetch_assoc($query_layhinh);

    	$sql="delete from sach where id = '$_GET[act]' ";
    	mysqli_query($mysqli, $sql) or die(mysqli_error());

    	unlink('../data/'.$filename['ImgSrc']);  
    }     

    $p = new Pager;
    // yêu cầu giới hạn bao nhiêu dòng
    $limit = 8 ;
    // Tìm dòng bắt đầu đưa vào trang lấy được (khai báo nếu nó chưa có giá trị)
    $start = $p -> findStart($limit);
    // Tìm tổng số dOng với câu lệnh truy vấn
    if(!isset($_GET["matheloai"]))  $_GET["matheloai"] = 1;

    if(isset($_GET["matheloai"]))
    {
    	
        $query = mysqli_query($mysqli,"SELECT * FROM sach WHERE MaTheLoai = '".$_GET["matheloai"]."'");
        $count = mysqli_num_rows($query);
        // Tìm số trang dựa vào số dọng và số giới hạn
        $pages = $p -> findPages($count,$limit);
   
        $sql = "SELECT s.id, s.TuaDe, s.TacGia, s.Gia, s.NhaXuatBan, s.NamXuatBan,s.TomTat, s.MaTheLoai,s.ImgSrc, tl.TenTheLoai FROM sach s, theloai tl WHERE s.MaTheLoai = tl.MaTheLoai AND s.MaTheLoai = '".$_GET["matheloai"]."' limit ".$start.",".$limit ;
        $sach = "SELECT tl.TenTheLoai, count(s.MaTheLoai) from sach s, theloai tl where s.MaTheLoai = tl.MaTheLoai AND s.MaTheLoai = '".$_GET["matheloai"]."' group by tl.TenTheLoai";
        $kq = mysqli_query($mysqli,$sach);
        $so = mysqli_fetch_row($kq);
        $result = mysqli_query($mysqli,$sql);

        echo "
          </td>
          <td valign='top'>
        <table width='100%'  border='1'  cellspacing='0' style='border-style:dotted' bordercolor='#3333CC'>
        <td colspan='9' style='background-image:url(../images/danhmuc.png)' height='20'><p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Sách $so[0] ($so[1] sách) </p>
        <tr bgcolor='#FF99FF' >
        <td>ID</td>
        <td>Tên sách</td>
        <td>Tác giả</td>
        <td>Nhà Xuất Bản</td>
        <td>Năm Xuất Bản</td>
        <td>Tóm Tắt</td>
        <td>Giá sách</td>
        <td>Sửa</td>
        <td>Xóa</td>
        </tr>";
       
        if(mysqli_num_rows($result)<>0) // co du lieu
        {               
            while($row=mysqli_fetch_array($result))
        {
?>

    <tr>
    <td><?php echo $row['id']?></td>
    <td><?php echo $row['TuaDe']?></td>
    <td><?php echo $row['TacGia']?></td>
    <td><?php echo $row['NhaXuatBan']?></td>
    <td><?php echo $row['NamXuatBan']?></td>
    <td><?php echo $row['TomTat']?></td>
    <td><?php echo number_format($row['Gia'],3)."VNĐ"?></td>
    <td><?php echo "<a href=sua_sach.php?act_sua=$row[id]><img src=../images/edit.png width=40px height=40 border=0 align=center/> </a>"?></td>
    <td><?php echo "<a onclick='return confirmActionXoaSach()' href=quanlysach.php?act=$row[id]><img src=../images/x.png width=40px height=40 border=0 align=center/></a>"?></td>
    <tr>	
    </tr>

    <?php
}
 //xuat danh sach phan trang
    $pagelist = $p -> pageList($_GET['page'],$pages);
    echo"<table align:'center' width='100%'>";
    echo "<p align:'center'>";
    echo"<td colspan='4' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold;  text-align:center' >";
    echo  "Trang: $pagelist ";
    echo "</p>";
    echo"</table>"; 
    }  
}
    ?>
</td>
    </tr>
</table>  

