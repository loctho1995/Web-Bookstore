<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css.css" />
<title>Upload book</title>
</head>

<body>

<script type="text/javascript">
/*
function onInputFileChanged(str)
{
	var x = document.getElementById('btfile');
	//x.style.backgroundImage = "url(" + str +  ")";
}
*/

function resetValue()
{
	//var subm = document.getElementById("submit");
	//subm.setAttribute("value", "upload");
}

function onSubmitted(element)
{
	var image = document.getElementById("inputupload").value;
	var theloai = document.getElementById("theloai").value;

	if(image.length == 0)
	{
		alert("Chưa chọn file ảnh, Upload thất bại");
		return false;
	}
	else
	{
		element.setAttribute("value", "uploaded");	
	}		
}


function checkImage(element)
{
	var length = element.value.length;
	var data = element.value;
	var pos = data.lastIndexOf('.');
	var slice = data.slice(pos + 1, length);
	slice = slice.toLowerCase();

	if(!(slice == 'png' || slice == 'jpg' || slice == 'jpeg'))
	{
		alert('Không đúng định dạng ảnh: png, jpg, jpeg');
		element.value = '';
	}
}

function checkNumber(e, element)
{
	var charcode = (e.which) ? e.which : e.keyCode;

	//khong cho nhap 0 dau tien
	if(element.value.length == 0)
	{
		if(charcode == 48)
			return false;
	}

	//kiem tra xem co phai number khong
	if(charcode > 31 && (charcode < 48 || charcode > 57))
	{
		return false;
	}

	return true;
}

</script>

<?php
//var_dump($_POST);
		 
  if(isset($_POST['ok']) && isset($_FILES['file']['name']) && $_POST['ok'] == "uploaded"){ 
  		$conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
  		mysqli_query($conn, "SET NAMES utf8");
		//$result = mysqli_query($conn, $sql);
		//chu y phan id
  		$sql = "INSERT INTO sach VALUES('',";
  		$imgsrc= '';

      if($_FILES['file']['name'] != NULL){ 
		   if($_FILES['file']['type'] == "image/jpeg"
			|| $_FILES['file']['type'] == "image/png"
			|| $_FILES['file']['type'] == "image/gif"){

		   		//while($row = mysqli_fetch_assoc($result))
		   		//{
		   			//var_dump($row);
		   		//}

			  	$path = "data/";
			    $tmp_name = $_FILES['file']['tmp_name'];
			    $name = $_FILES['file']['name'];
			    $type = $_FILES['file']['type']; 
			    $imgsrc = $name;
			    //$size = $_FILES['file']['size']; 
			    move_uploaded_file($tmp_name,"../data/".$_FILES['file']['name']);

			}else{
			  //echo "Kiểu file không hợp lệ";
			}
	  }else{
           //echo "Vui lòng chọn file";
      }

      $imageLink = "SELECT * FROM sach";
      $rs = mysqli_query($conn, $imageLink);
      $flag = false; //kiem tra xem co trung anh khong

      while($r = mysqli_fetch_assoc($rs))
      {
      		if($imgsrc == $r['ImgSrc'])
      		{
      			echo "
      			<script>
      			alert('hình ảnh đã tồn tại');
      			</script>";

      			$flag = true;
      		}
      }

	if($flag == false)
	{
      if(isset($_POST['tuade']))
      {
		$sql = $sql."'".$_POST['tuade']."',";
      }

      if(isset($_POST['tacgia']))
      {
		$sql = $sql."'".$_POST['tacgia']."',";
      }

      if(isset($_POST['giaban']))
      {
		$sql = $sql."'".$_POST['giaban']."',";
      }

      if(isset($_POST['tomtat']))
      {
		$sql = $sql."'".$_POST['tomtat']."',";
      }

      if(isset($_POST['nhaxuatban']))
      {
		$sql = $sql."'".$_POST['nhaxuatban']."',";
      }

      if(isset($_POST['namxuatban']))
      {
		$sql = $sql."'".$_POST['namxuatban']."',";
      }

      if(isset($_POST['theloai']))
      {
		$sql = $sql."'".$_POST['theloai']."',";
      }

      $sql = $sql."'".$imgsrc."');";
		
	  $result = mysqli_query($conn, $sql);
	  if($result)
	  {
	  		echo "
	  		<script>
	  		alert('Upload Thành công!');
	  		</script>";
	  }
	  else
	  {
	  	echo "
	  		<script>
	  		alert('Upload Thất bại!');
	  		</script>";
	  }
	}
  }
?>

<form action="uploadsach.php" method="post" enctype="multipart/form-data" id="formmain" onload="resetValue()">
<table width="400" id="maintable">
<tr><td colspan='4' style='background-image:url(../images/danhmuc.png)' height='30'><p style='color:#FFF; font-weight:bold ;text-align:center' align='center'>Upload Sách</p></td></tr>
<tr>
<th> Chọn hình </th>
<td> <input type="file" name="file" id="inputupload" onchange="checkImage(this)"></td>
</tr>

<tr>
<th>Tên sách</th>
<td>
<input type="text" name="tensach" required="true"/>
</td>
</tr>

<tr>
<th>Tác giả</th>
<td>
<input type="text" name="tacgia" required="true"/>
</td>
</tr>

<tr>
<th>Tựa Đề</th>
<td>
<input type="text" name="tuade" required="true"/>
</td>
</tr>

<tr>
<th>Tóm tắt</th>
<td>
<!--<input id="tomtat" type="text" name="tomtat" required="true"/>-->
<textarea rows="4" id="tomtat" type="text" name="tomtat" required="true" ></textarea>
</td>
</tr>

<tr>
<th>Thể loại</th>
<td>
<select id="theloai" name="theloai" required>
<option value="">Thể loại</option>
<?php
	$conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
	mysqli_query($conn, "SET NAMES utf8");
	$sql = "SELECT * FROM theloai";
	$query = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($query))
	{
		echo "<option value = ".$row['MaTheLoai'].">".$row['TenTheLoai']."</option>";
		;
	}
?>
</select>
</td>
</tr>

<tr>
<th>Nhà xuất bản</th>
<td>	
<input type="text" id="nhaxuatban" name="nhaxuatban" required="true"/>
</td>
</tr>

<tr>
<th>Năm xuất bản</th>
<td>	
<input type="text" name="namxuatban" id="namxuatban" required="true" onkeypress="return checkNumber(event, this)" />
</td>
</tr>

<tr>
<th>Giá bán</th>
<td>	
<input type="text" name="giaban" id="giaban" onkeypress="return checkNumber(event, this)" required="true"/> VNĐ
</td>
</tr>

<tr>
<td>
<th>
<input id = "submit" type="submit" value="Upload" name="ok" onclick="onSubmitted(this)" />
</td>
</th>
</tr>
</table>
</form>
</body>
</html>