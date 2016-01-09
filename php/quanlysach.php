<?php
    error_reporting (E_ALL ^ E_NOTICE);
    session_start();

    include "../includes/pager.php";   
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
		body{ font-family:Tahoma, Geneva, sans-serif;}
		table
		{
			padding:0px;
		}
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
                            <td width="1044" valign="top" >
                                <?php include("../public/quanly_sach.php") ?>
                            </td>                   
                        </tr>
                    </table>
                </td>
            </tr>
        </table>		
	</body>
</html>