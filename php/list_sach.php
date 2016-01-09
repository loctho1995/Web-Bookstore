<?php 
	error_reporting (E_ALL ^ E_NOTICE);
  session_start();
  $mysqli = mysqli_connect('localhost','root','','bookstore'); 
  mysqli_query($mysqli, "SET NAMES 'utf8'");
   
	include "../includes/pager.php";
?>
      <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
        body{ font-family:Tahoma, Geneva, sans-serif;}
        </style>
    </head>
    <body>
        <table summary="" width="100%" align="center" cellpadding="0" cellspacing="0">
            <tr>
                <td>
                    <table summary="" width="1000" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3">
                                <?php include("../public/top.php") ?>
                            </td>
                        </tr>
                        <tr><td colspan="3" bgcolor="white" height="4"></td></tr>
                        <tr>
                            <td width="170" valign="top">
                               <?php include("../public/trai.php") ?>
                            </td>
                            <td width="660" valign="top">
                               <?php
                                  if(isset($_GET["mas"]))
                                  {
                                      echo"<table border='1' align='center'>";
                                        $mysqli = mysqli_connect('localhost','root','','bookstore'); 
                                        mysqli_query($mysqli, "SET NAMES 'utf8'");
                                                                        
                                        $sql = "SELECT * FROM sach WHERE id = '".$_GET["mas"]."'";
                                        $result = mysqli_query($mysqli,$sql);
                                        $row = mysqli_fetch_row($result);
                                        echo"<tr style='color:red; font-weight:bold'><td align='center' colspan='2'>$row[0] - $row[1]</td></tr>";

                                        echo"<tr><td align='center'><img  width='190' height='200' src='../data/".$row[8]."'><a href=addcart.php?item=$row[0]><img src='../images/dathang.gif' alt='đặt hàng' width='20' height='16' align='center' ></a></td>";

                                        echo"<td>Tác Giả: $row[2]<br> Nhà Xuất Bản: $row[5] <br> Năm Xuất Bản: $row[6]<p>Tóm Tắt: $row[4] </p><br> Giá: $row[3].000 VND</td></tr>";   

                                      echo"</table>"    ;
                                  }                           
                                ?>
                            </td>
                            <td width="170" valign="top">
                                 <?php include("../public/phai.php") ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <?php include("../public/cuoi.php") ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>        
    </body>
</html>
