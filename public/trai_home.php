<table align="center" width="170" cellpadding="0" cellspacing="0"  border="0" style="padding:0px;">
	<tr >
		<td style="background-image:url(../images/danhmuc.png)"  height="28">
			<p style="color:#FFF; font-weight:bold; text-align:center">  Danh mục sách </p>
		</td>
	</tr>
    <tr><td><br /></td></tr>
	<tr>
		<td >
			<?php
				$mysqli = mysqli_connect('localhost','root','','bookstore'); 
				mysqli_query($mysqli, "SET NAMES 'utf8'");		
			?>		
			<?php include'ham_lay_danh_muc_home.php';?>
		</td>
	</tr>
	
    <tr><td><br /></td></tr>
    <tr>
    	<td style="background-image:url(../images/danhmuc.png)"  height="28">
        	<p style="color:#FFF; font-weight:bold; text-align:center">Đối tác</p>
        </td>
    </tr>
    <tr>
    	<td>        
			<marquee onmouseover="this.stop();" onmouseout="this.start();"  Behaviour = "scroll" direction="up" scrollamount="3" style = "text-align:center;height:300px;">
				 <a href="http://www.amazon.com/books-used-books-textbooks/b?node=283155" target = "blank" ><img src="../images/Doi_Tac/amazon.jpg"/></a>  
				 <a href="http://alphabooks.vn/" target = "blank" title="Arti"><img src="../images/Doi_Tac/alpha.jpg" /></a>  
				 <a href="http://ebooks.cambridge.org/" target = "blank"><img src="../images/Doi_Tac/cambridge.jpg"/></a>  
				 <a href="http://www.fahasa.com/" target = "blank"><img src="../images/Doi_Tac/fahasa.jpg" /></a>  
				 <a href="http://www.minhkhai.com.vn/" target = "blank"><img src="../images/Doi_Tac/minhkhai.png" /></a>   
				 <a href="http://tiki.vn/" target = "blank"><img src="../images/Doi_Tac/tiki.jpg" /></a> 				
			</marquee>
			</div>
        </td>
    </tr>
    <tr><td><br /></td></tr>
    <tr>
    	<td style="background-image:url(../images/danhmuc.png)"  height="28">
        	<p style="color:#FFF; font-weight:bold; text-align:center">Thống Kê</p>
        </td>
    </tr>
    <tr><td><br /></td></tr>
    <tr>
    	<td>
        	<?php
				@session_start();
				function online()
				{	
					$rip = $_SERVER['REMOTE_ADDR'];
					$sd = time();
					$count = 1;
					$maxu = 1;
					$file1 = "online.log";
					$lines = file($file1);
					$line2 = "";
						foreach ($lines as $line_num => $line)
						{
							if($line_num == 0)
							{
								 $maxu = $line;
							}
							else
							{
								$fp = strpos($line,'****');
								$nam = substr($line,0,$fp);
								$sp = strpos($line,'++++');
								$val = substr($line,$fp+4,$sp-($fp+4));
								$diff = $sd-$val;
								if($diff < 300 && $nam != $rip)
								{
									$count = $count+1;
									$line2 = $line2.$line;
								}
							}
						}
					$my = $rip."****".$sd."++++\n";
					if($count > $maxu)
					$maxu = $count;
					$open1 = fopen($file1, "w");
					fwrite($open1,"$maxu\n");
					fwrite($open1,"$line2");
					fwrite($open1,"$my");
					fclose($open1);
					$count=$count;
					$maxu=$maxu+200;
					return $count;	
				}
				///////////////////////
				$ip = $_SERVER['REMOTE_ADDR'];
				$file_ip = fopen('ip.txt', 'rb');
				while (!feof($file_ip))
				{
				 $line[]=fgets($file_ip);
				}
				for ($i=0; $i<(count($line)); $i++) {
					@list($ip_x) = split(";",$line[$i]);
					if ($ip == $ip_x) {$found = 1;}
				}
				fclose($file_ip);
				if (@!($found==1)) {
					$file_ip2 = fopen('ip.txt', 'ab');
					$line = "$ip\n";
					fwrite($file_ip2, $line, strlen($line));
					$file_count = fopen('count.txt', 'rb');
					$data = '';
					while (!feof($file_count)) $data .= fread($file_count, 4096);
					fclose($file_count);
					@list($today, $yesterday, $total, $date, $days) = split("%", $data);
					if ($date == date("Y m d")) $today++;
						else {
							$yesterday = $today;
							$today = 1;
							$days++;
							$date = date("Y m d");
						 }
					$total++;
					$line = "$today%$yesterday%$total%$date%$days";
					$file_count2 = fopen('count.txt', 'wb');
					fwrite($file_count2, $line, strlen($line));
					fclose($file_count2);
					fclose($file_ip2);
				 }	
				function today()
				{
					$file_count = fopen('count.txt', 'rb');
					$data = '';
					while (!feof($file_count)) $data .= fread($file_count, 4096);
					fclose($file_count);
					@list($today, $yesterday, $total, $date, $days) = split("%", $data);
					return $today;
				}
				function yesterday()
				{
					$file_count = fopen('count.txt', 'rb');
					$data = '';
					while (!feof($file_count)) $data .= fread($file_count, 4096);
					fclose($file_count);
					@list($today, $yesterday, $total, $date, $days) = split("%", $data);
					return $yesterday;
				}
				function total()
				{
					$file_count = fopen('count.txt', 'rb');
					$data = '';
					while (!feof($file_count)) $data .= fread($file_count, 4096);
					fclose($file_count);
					@list($today, $yesterday, $total, $date, $days) = split("%", $data);
					echo $total;
				}
				function avg()
				{
					$file_count = fopen('count.txt', 'rb');
					$data = '';
					while (!feof($file_count)) $data .= fread($file_count, 4096);
					fclose($file_count);
					@list($today, $yesterday, $total, $date, $days) = split("%", $data);
					echo ceil($total/$days);
				}	
			?>
			
						Đang online: <?php echo online(); ?> <br>
						Truy cập hôm nay: <?php echo today(); ?> <br>
						Truy cập hôm qua: <?php echo yesterday(); ?> <br>
						Tổng số truy cập: <?php total(); ?> <br>
						Truy cập trung bình: <?php avg(); ?> <br>
				   
    	</td>
    </tr> 
</table>