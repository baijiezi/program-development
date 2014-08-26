<?php
namespace Model;

class Cases extends \ActiveRecord\Model {
	static $table_name = 'cases';
	static $primary_key = 'case_id';

	static $before_create = array (
			'apply_created'
	);

	public function apply_created() {
		$this->created = date ( "Y-m-d H:i:s" );
	}

	public function find_cases( $page = 1, $num_of_a_page = 10, $select = '*') {
		$start_at = ($page - 1) * $num_of_a_page;
		return $this->find ( 'all', array (
				'select' => $select,
				'limit' => $num_of_a_page,
				'offset' => $start_at
		) );
	}
	
	public function get_cases($number) {
		return $this->find ( 'all', array (
				'limit' => $number,
				'order' => 'created desc'
		) );
	}
}
