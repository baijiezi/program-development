<?php
namespace PestMVC;

class Pager {
	/**
	 * page name.
	 *
	 * @var unknown_type
	 */
	private $page_name = 'index.php';
	
	/**
	 * current page.
	 *
	 * @var int
	 */
	private $current = 1;
	
	/**
	 * previous page.
	 *
	 * @var unknown_type
	 */
	private $pre;
	
	/**
	 * nex page.
	 *
	 * @var unknown_type
	 */
	private $next;
	
	/**
	 * total item number.
	 *
	 * @var unknown_type
	 */
	private $item_count;
	
	/**
	 * total page count.
	 *
	 * @var unknown_type
	 */
	private $page_count;
	
	/**
	 * number of item per page.
	 *
	 * @var unknown_type
	 */
	private $num_per_page = 10;
	
	/**
	 * constructor.
	 *
	 * @param unknown_type $current        	
	 * @param unknown_type $item_count        	
	 * @param unknown_type $num_per_page        	
	 */
	public function __construct($page_name, $current = 1, $item_count, $num_per_page = 10) {
		if ($current < 1) {
			$current = 1;
		}
		
		if ($num_per_page < 1) {
			$num_per_page = 10;
		}
		
		$this->page_name = $page_name;
		$this->item_count = $item_count;
		$this->num_per_page = $num_per_page;
		
		$this->page_count = intval ( $item_count / $num_per_page );
		if ($item_count % $num_per_page > 0) {
			$this->page_count ++;
		}
		// echo '$this->page_count = ' . $this->page_count;
		
		$this->current = ($current <= $this->page_count) ? $current : $this->page_count;
		$this->pre = ($current - 1 > 0) ? $current - 1 : null;
		$this->next = ($current + 1 > $this->page_count) ? null : $current + 1;
	}
	
	/**
	 * <ul>
	 * <li class="disabled"><a href="#">«</a></li>
	 * <li class="active"><a href="users.php?p=1">1</a></li>
	 * <li><a href="users.php?p=3">2</a></li>
	 * <li><a href="#">3</a></li>
	 * <li><a href="#">4</a></li>
	 * <li><a href="#">5</a></li>
	 * <li><a href="#">»</a></li>
	 * </ul>
	 */
	public function get_pagination_html() {
		$pg_start = $this->current - intval ( $this->num_per_page / 2 ) + 1;
		if ($pg_start < 1) {
			$pg_start = 1;
		}
		$pg_end = intval ( $this->num_per_page / 2 ) + $this->current;
		if ($pg_end > $this->page_count) {
			$pg_end = $this->page_count;
		}
		
		// echo '$pg_start = ' . $pg_start . ' ## $pg_end = ' . $pg_end .
		// '<br>';
		if (($pg_end - $pg_start + 1) < $this->num_per_page) {
			if (abs ( $this->current - $pg_start ) < abs ( $this->current - $pg_end )) {
				// adjust $pg_end
				// echo 'ADJUST PG_END ';
				$pg_end = $pg_start + $this->num_per_page - 1;
				$pg_end = ($pg_end > $this->page_count) ? $this->page_count : $pg_end;
			} else {
				// adjust $pg_star
				// echo 'ADJUST PG_START ';
				$pg_start -= (intval ( $this->num_per_page / 2 ) - abs ( $this->current - $pg_end ));
				// $pg_start = $pg_end - $this->num_per_page - 1;
				$pg_start = $pg_start < 1 ? 1 : $pg_start;
			}
		}
		// echo '$pg_start = ' . $pg_start . ' ## $pg_end = ' . $pg_end;
		
		$ret = '<ul>';
		// previous page
		if ($this->pre == null) {
			$ret .= '<li class="disabled"><a href="#">«</a></li>';
		} else {
			$ret .= '<li><a href="/' . $this->page_name . '/pg/' . $this->pre . '">«</a></li>';
		}
		
		// pages
		for($i = $pg_start; $i <= $pg_end; $i ++) {
			if ($i == $this->current) {
				$ret .= '<li class="disabled"><a href="/' . $this->page_name . '/pg/' . $i . '">' . $i . '</a></li>';
			} else {
				$ret .= '<li><a href="/' . $this->page_name . '/pg/' . $i . '">' . $i . '</a></li>';
			}
		}
		
		// next page
		if ($this->next == null) {
			$ret .= '<li class="disabled"><a href="#">»</a></li>';
		} else {
			$ret .= '<li><a href="/' . $this->page_name . '/pg/' . $this->next . '">»</a></li>';
		}
		return $ret . '</ul>';
	}
	/**
	 *
	 * @return the $current
	 */
	public function getCurrent() {
		return $this->current;
	}
	
	/**
	 *
	 * @return the $pre
	 */
	public function getPre() {
		return $this->pre;
	}
	
	/**
	 *
	 * @return the $next
	 */
	public function getNext() {
		return $this->next;
	}
	
	/**
	 *
	 * @return the $item_count
	 */
	public function getItem_count() {
		return $this->item_count;
	}
	
	/**
	 *
	 * @return the $page_count
	 */
	public function getPage_count() {
		return $this->page_count;
	}
	
	/**
	 *
	 * @return the $num_per_page
	 */
	public function getNum_per_page() {
		return $this->num_per_page;
	}
	
	/**
	 *
	 * @param number $current        	
	 */
	public function setCurrent($current) {
		$this->current = $current;
	}
	
	/**
	 *
	 * @param \utils\unknown_type $pre        	
	 */
	public function setPre($pre) {
		$this->pre = $pre;
	}
	
	/**
	 *
	 * @param \utils\unknown_type $next        	
	 */
	public function setNext($next) {
		$this->next = $next;
	}
	
	/**
	 *
	 * @param \utils\unknown_type $item_count        	
	 */
	public function setItem_count($item_count) {
		$this->item_count = $item_count;
	}
	
	/**
	 *
	 * @param \utils\unknown_type $page_count        	
	 */
	public function setPage_count($page_count) {
		$this->page_count = $page_count;
	}
	
	/**
	 *
	 * @param \utils\unknown_type $num_per_page        	
	 */
	public function setNum_per_page($num_per_page) {
		$this->num_per_page = $num_per_page;
	}

}
