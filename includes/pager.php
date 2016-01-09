  <?php
/**************************************************************************************
* Class: Pager
* Methods:
* findStart
* findPages
* pageList
* nextPrev
* Redistribute as you see fit.
**************************************************************************************/
class pager
{
/***********************************************************************************
* Ham int findStart (int limit)
* Tra ve dong bat dau cua trang duoc chon dua tren trang lay duoc va bien limit
***********************************************************************************/
	function findStart($limit)
	{
		if ((!isset($_GET['page'])) || ($_GET['page'] == "1"))
		{
			$start = 0;
			$_GET['page'] = 1;
		}
		else
		{
			$start = ($_GET['page']-1) * $limit;
		}
		
		return $start;
	}
/***********************************************************************************
* Ham int findPages (int count, int limit)
* Tra ve so luong trang can thiet dua tren tong so dong co trong table va limit
***********************************************************************************/
	function findPages($count, $limit)
	{
		$pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1;
		return $pages;
	}
/***********************************************************************************
* Ham: string pageList (int curpage, int pages)
* Tra ve danh sach trang theo dinh dang "Trang dau tien  < [cac trang] > Trang cuoi cung"
***********************************************************************************/
	function deleteParam($query_string, $param)
	{
		//////xử lý giữ tham số trên url
		
		if($query_string!='')
		{
			$query_string = preg_replace('/(^'.$param.'=[\da-zA-Z]*&)|(&?'.$param.'=[\da-zA-Z]*)|/', '', $query_string);

			if($query_string)
				$query_string = "$query_string&";

		}
		//////xử lý giữ tham số trên url
		return $query_string;
	}

	function pageList($curpage, $pages)
	{
		$page_list = "";
		
		$query_string = $this->deleteParam($_SERVER['QUERY_STRING'], 'page');
				
		/* In trang dau tien va nhung link toi trang truoc neu can */
		if (($curpage != 1) && ($curpage))
		{
			$page_list .= " <a href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=1\" title=\"Trang đầu\"><<</a> ";
		}
	
		if (($curpage-1) > 0)
		{
			$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".($curpage-1)."\" title=\"Về trang trước\"><</a> ";
		}
	
		/* In ra danh sach cac trang va lam cho trang hien tai dam hon va mat link o chan*/
		for ($i=1; $i<=$pages; $i++)
		{
			if ($i == $curpage)
			{
				$page_list .= "<b>".$i."</b>";
			}
			else
			{
				$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".$i."\" title=\"Trang ".$i."\">".$i."</a>";
			}
			$page_list .= " ";
		}

		/* In linh cua trang tiep theo va trang cuoi cung neu can*/
		if (($curpage+1) <= $pages)
		{
			$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".($curpage+1)."\" title=\"Dến trang sau\">></a> ";
		}
		
		if (($curpage != $pages) && ($pages != 0))
		{
			$page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".$pages."\" title=\"Trang cuối\">>></a> ";
		}
		$page_list .= "</td>\n";

	return $page_list;
	}
/***********************************************************************************
* Ham string nextPrev (int curpage, int pages)
* Returns "Previous | Next" string for individual pagination (it's a word!)
***********************************************************************************/
	function nextPrev($curpage, $pages)
	{
		$next_prev = "";
		
		$query_string = $this->deleteParam($_SERVER['QUERY_STRING'], 'page');
		
		if (($curpage-1) <= 0)
		{
			$next_prev .= "Về trang trước";
		}
		else
		{
			$next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".($curpage-1)."\">Về trang trước</a>";
		}
		$next_prev .= " | ";
		
		if (($curpage+1) > $pages)
		{
			$next_prev .= "Đến trang sau";
		}
		else
		{
			$next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?".$query_string."page=".($curpage+1)."\">Đến trang sau</a>";
		}
		return $next_prev;
	}
}
?>