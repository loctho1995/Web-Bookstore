 <?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
    $mysqli = mysqli_connect('localhost','root','','bookstore'); 
    mysqli_query($mysqli, "SET NAMES 'utf8'"); 

    $p = new Pager;
    // yêu cầu giới hạn bao nhiêu dòng
    $limit = 8 ;
    // Tìm dòng bắt đầu đưa vào trang lấy được (khai báo nếu nó chưa có giá trị)
    $start = $p -> findStart($limit);
    // Tìm tổng số dOng với câu lệnh truy vấn
    if(isset($_GET["matheloai"]))
    {
        $query = mysqli_query( $mysqli , "SELECT * FROM sach WHERE MaTheLoai = '".$_GET["matheloai"]."'");
        $count = mysqli_num_rows($query);
        // Tìm số trang dựa vào số dọng và số giới hạn
        $pages = $p -> findPages($count,$limit);
   
        $sql = "SELECT s.id, s.TuaDe, s.TacGia, s.Gia, s.NhaXuatBan, s.NamXuatBan, s.MaTheLoai,s.ImgSrc, tl.TenTheLoai FROM sach s, theloai tl WHERE s.MaTheLoai = tl.MaTheLoai AND s.MaTheLoai = '".$_GET["matheloai"]."' limit ".$start.",".$limit ;
        $sach = "SELECT tl.TenTheLoai, count(s.MaTheLoai) from sach s, theloai tl where s.MaTheLoai = tl.MaTheLoai AND s.MaTheLoai = '".$_GET["matheloai"]."' group by tl.TenTheLoai";
        $kq = mysqli_query( $mysqli , $sach);
        $so = mysqli_fetch_row($kq);
        $result = mysqli_query( $mysqli , $sql);
       
        if(mysqli_num_rows($result)<>0) // co du lieu
        {       
            echo"<table align='center' width='100%'>";
            echo"<tr style='color:red; font-weight:bold'; align='center' >";
            echo"<td colspan='4' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold;  text-align:center' >Sách $so[0] ($so[1] sách)  </p></td>";
            echo"</tr>";
            $stt=0;
            while($row = mysqli_fetch_row($result))
            {
            if($stt%4==0)
            {
                echo "<tr>";
            }
                echo"<td valign='top'>";
                echo"<table align='center'>";
                echo"<tr><td align='center'><p style='font-weight:bold '><a href='list_sach_home.php?mas=$row[0]'><b>$row[1]</b></a></td></tr>";
                echo"<tr><td align='center'><img width='140' height='140' src='../data/".$row[7]."'></td></tr>";
                echo"<tr><td align='center'>$row[3].000 VND</td></tr>";
                echo"</table>";
                echo"</td>";
            $stt++;
            if($stt%4==0)
            {
                echo "</tr>";
            }
            }
        echo"</table>"  ;
         //xuat danh sach phan trang
        $pagelist = $p -> pageList($_GET['page'],$pages);
        echo"<table align:'center' width='100%'>";
        echo "<p align:'center'>";
        echo"<td colspan='4' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold;  text-align:center' >";
        echo  "Trang: $pagelist ";
        echo "</p>";
        echo"</table>";
    }
    else
    {
        echo "Không có sách";
    }
}   
?>
