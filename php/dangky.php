<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();
?>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  </head>
    <style>
    body{ font-family:Tahoma, Geneva, sans-serif;}
        </style>
        <table summary="" width="100%" align="center" cellpadding="0" cellspacing="0"  border="0">
            <tr>
                <td>
                    <table summary="" width="1000" align="center" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="3">
                                <?php include("../public/top_home.php") ?>
                            </td>
                        </tr>
                        <tr><td colspan="3" bgcolor="white" height="4"></td></tr>
                        <tr>
                            <td width="170" valign="top">
                                   <?php include("../public/trai_home.php") ?>
                            </td>
                            <td width="660" align="center" valign="top">
                                <?php include("../public/dang_ky.php") ?>
                            </td>
                            <td width="170" valign="top">
                                    <?php include("../public/phai_home.php") ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <?php include("../public/cuoi_home.php") ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>    
  </body>
</html>