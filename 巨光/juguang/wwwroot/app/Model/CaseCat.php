<?php
namespace Model;

class CaseCat extends \ActiveRecord\Model {
	static $table_name = 'case_cat';
	static $primary_key = 'case_cat_id';
	
	static $before_create = array (
			'apply_created' 
	);
	
	public function apply_created() {
		$this->created = date ( "Y-m-d H:i:s" );
	}
	
	/**
	 * validate if $cat_id exists.
	 * 
	 * @param unknown_type $cat_id        	
	 */
	public function validate_category($cat_id) {
		$cats = $this->all ();
		foreach ( $cats as $c ) {
			if ($cat_id == $c->id) {
				return true;
			}
		}
		return false;
	}
	
	public function find_cats( $page = 1, $num_of_a_page = 10) {
		$start_at = ($page - 1) * $num_of_a_page;
		return $this->find ( 'all', array (
				'limit' => $num_of_a_page,
				'offset' => $start_at,
				'order' => 'created desc'
		) );
	}
	
	public function top_cases_list () {
		return $this->find ( 'all', array (
				'limit' => 10,
				// 'order' => 'case_cat_order asc'
				'order' => 'created desc'
		) );
	}
}
