<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css.css" />
<title>Edit book</title>
</head>

<body>

<?php 
  if(sizeof($_GET) == 0)
  {
    echo "
    <script>
      window.location = '?trang=1';
    </script>";
  }
?>

<script type="text/javascript">

function onImageClicked(element)
{

}

function addNewElement($data)
{
	var lielement = document.createElement("li");
	var img = document.createElement("img");
	var label = document.createElement("label");
	var link = document.createElement("a");
	var divcontainer = document.createElement("div");

	divcontainer.title = $data['id'];
	divcontainer.setAttribute("class", "div-container");
	divcontainer.setAttribute("onclick", "onImageClicked(this)");

	link.href = "\editbook.php?book-id=" + $data['id'];

	img.src = $data['ImgSrc'];
	img.width = "250";
	img.height = "350";

	label.innerText = $data['TuaDe'];

	divcontainer.appendChild(label);
	divcontainer.appendChild(img);
	link.appendChild(divcontainer);
	lielement.appendChild(link);

	document.getElementById("main-div-main-ul").appendChild(lielement);
}

</script>

<!-- HTML -->
<form action="index.php" method="get" enctype="multipart/form-data" id="formmain" onload="setHrefLocation()">
	<div id ="main-div">
		<ul id ="main-div-main-ul">
		</ul>
	</div>

	<div id="main-footer">
	</div>
</form>

<?php
//cap nhat lai sau khi chinh sua book, data duoc dua tu editbook form
  if(isset($_POST['ok']) && $_POST['ok'] == "uploaded"){ 

      $conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
      mysqli_query($conn, "SET NAMES utf8");
    //$result = mysqli_query($conn, $sql);
    //chu y phan id
      $sql = "UPDATE sach SET ";
      $imgsrc= '';

      if($_FILES['file']['name'] != NULL){ 
       if($_FILES['file']['type'] == "image/jpeg"
      || $_FILES['file']['type'] == "image/png"
      || $_FILES['file']['type'] == "image/gif"){

          $path = "../data/";
          $tmp_name = $_FILES['file']['tmp_name'];
          $name = $_FILES['file']['name'];
          $type = $_FILES['file']['type']; 
          $imgsrc = $path.$name;
          //$size = $_FILES['file']['size']; 
          move_uploaded_file($tmp_name,$imgsrc);

      }else{
        //echo "Kiểu file không hợp lệ";
      }
    }else{
           //echo "Vui lòng chọn file";
      }

  if(true)
  {
      if(isset($_POST['tuade']))
      {
        $sql = $sql."TuaDe = '".$_POST['tuade']."',";
      }

      if(isset($_POST['tacgia']))
      {
        $sql = $sql."TacGia = '".$_POST['tacgia']."',";
      }

      if(isset($_POST['giaban']))
      {
        $sql = $sql."Gia = '".$_POST['giaban']."',";
      }

      if(isset($_POST['tomtat']))
      {
        $sql = $sql."TomTat = '".$_POST['tomtat']."',";
      }

      if(isset($_POST['nhaxuatban']))
      {
        $sql = $sql."NhaXuatBan = '".$_POST['nhaxuatban']."',";
      }

      if(isset($_POST['namxuatban']))
      {
        $sql = $sql."NamXuatBan ='".$_POST['namxuatban']."',";
      }

      if(isset($_POST['theloai']))
      {
        $sql = $sql."MaTheLoai = '".$_POST['theloai']."'";
      }

      if($imgsrc != '')
      {
        $sql = $sql.", ImgSrc = '".$imgsrc."'";
      }

      $sql = $sql." where id = {$_POST['bookid']}";

    $result = mysqli_query($conn, $sql);

    if($result)
    {
        echo "
        <script>
        alert('Cập nhật Thành công!');
        window.location = '?trang=1';
        </script>";
    }       
    else
    {
      echo "
        <script>
        alert('Cập nhật Thất bại!');
        window.location = '?trang=1';
        </script>";
    }   
  }
  }
?>

<?php
	$pageSize = 8; //8 elements / page
	$pageCount = 0; //tong so trang	

	$conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
  	mysqli_query($conn, "SET NAMES utf8");

  	$sql = "select count(*) from sach";
  	$result = mysqli_query($conn, $sql);
  	$row = mysqli_fetch_array($result);
  	$pageCount = ceil($row[0] / $pageSize);

	for($i = 1;	 $i <= $pageCount; $i++)
	{
	  	echo "
      <script>
        var str = '<a href=\"?trang={$i}\">$i</a>';
        
        //add khoang trong vao cac link page
      	if($i <= $pageCount - 1)
      	{
      		str += ' -- ';
      	}

		document.getElementById('main-footer').innerHTML += str;
      </script>
	  	";
	}  		
?>

<?php
  if(isset($_GET["trang"]))
  {
  	$trang = $_GET["trang"];
    $index = ($trang - 1) * $pageSize;

    $conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
      mysqli_query($conn, "SET NAMES utf8");

    $sql = "select * from sach limit {$index}, {$pageSize}";  
    $rs = mysqli_query($conn, $sql);

    while($r = mysqli_fetch_assoc($rs))
      {
        $str = json_encode($r);

        echo "
            <script>
              addNewElement($str);
            </script>
        ";
      }  
  }

  if(isset($_GET["book-id"]))
  {
    $bookid = $_GET["book-id"];
    $sql = "select * from sach where id = {$bookid}";

    $conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
      mysqli_query($conn, "SET NAMES utf8");

    $rs = mysqli_query($conn, $sql);

    while($r = mysqli_fetch_assoc($rs))
      {
        include("editbook.php");
      }
  }
?>

</body>
</html>

