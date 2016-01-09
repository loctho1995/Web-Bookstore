<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css.css" />
<title>Edit book</title>
</head>

<body>

<script type="text/javascript">

function onSubmitted(element)
{
	var image = document.getElementById("inputupload").value;
	var theloai = document.getElementById("theloai").value;

	element.setAttribute("value", "uploaded");			
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

function updateElement($data)
{
	var element = document.getElementById("tuade");
	element.setAttribute("value", $data['TuaDe']);

	element = document.getElementById("bookid");
	element.setAttribute("value", $data['id']);

	element = document.getElementById("tacgia");
	element.setAttribute("value", $data['TacGia']);

	element = document.getElementById("tomtat");
	element.innerHTML = $data['TomTat'];

	element = document.getElementById("theloai");
	element.value = $data['MaTheLoai'];

	element = document.getElementById("nhaxuatban");
	element.setAttribute("value", $data['NhaXuatBan']);

	element = document.getElementById("namxuatban");
	element.setAttribute("value", $data['NamXuatBan']);

	element = document.getElementById("giaban");
	element.setAttribute("value", $data['Gia']);
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


<form action="index.php" method="post" enctype="multipart/form-data" id="formmain" onload="resetValue()">
<table width="500" id="maintable">
<tr>
<th> Chọn hình </th>
<td> <input type="file" name="file" id="inputupload" onchange="checkImage(this)" ></td>
</tr>

<tr>
<th>Book ID</th>
<td>
<input type="text" name="bookid" required="true" id="bookid" readonly/>
</td>
</tr>

<tr>
<th>Tựa Đề</th>
<td>
<input type="text" name="tuade" required="true" id="tuade" />
</td>
</tr>

<tr>
<th>Tác giả</th>
<td>
<input type="text" name="tacgia" required="true" id="tacgia" />
</td>
</tr>

<tr>
<th>Tóm tắt</th>
<td>
<!--<input id="tomtat" type="text" name="tomtat" required="true"/>-->
<textarea rows="4" id="tomtat" type="text" name="tomtat" required="true" id ="tomtat"> </textarea>
</td>
</tr>

<tr>
<th>Thể loại</th>
<td>
<select id="theloai" name="theloai" required>
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
<th>Nhà xuất bản</th>
<td>	
<input type="text" id="nhaxuatban" name="nhaxuatban" required="true" />
</td>
</tr>

<tr>
<th>Năm xuất bản</th>
<td>	
<input type="text" name="namxuatban" id="namxuatban" required="true" onkeypress="return checkNumber(event, this)"/>
</td>
</tr>

<tr>
<th>Giá bán</th>
<td>	
<input type="text" name="giaban" id="giaban" onkeypress="return checkNumber(event, this)" required="true" /> VNĐ
</td>
</tr>

<tr>
<td>
<th>
<input id = "submit" type="submit" value="Cập Nhật" name="ok" onclick="onSubmitted(this)"/>
</td>
</th>
</tr>

</table>
</form>

<?php 
//get method
 $id = $_GET['book-id'];
	
 $conn = mysqli_connect('localhost','root','','bookstore') or die ('can not connect to database');
 mysqli_query($conn, "SET NAMES utf8");
 $sql = "SELECT * from sach where id = {$id}";
 $rs = mysqli_query($conn, $sql);
 $val = '';

 while($val = mysqli_fetch_assoc($rs))
 {
 	$str = json_encode($val);

 	echo "
 	<script>
 		updateElement($str);
 	</script>
 	";
 }
?>


</body>
</html>