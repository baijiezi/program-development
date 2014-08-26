<?php
namespace Model;

class Jobs extends \ActiveRecord\Model {
	static $table_name = 'jobs';
	static $primary_key = 'job_id';
	// static $connection = 'production';
	static $db = 'juguang';

	static $before_create = array (
			'apply_created'
	);

	public function apply_created() {
		$this->created = date ( "Y-m-d H:i:s" );
	}

	public function find_jobs( $page = 1, $num_of_a_page = 10) {
		$start_at = ($page - 1) * $num_of_a_page;
		return $this->find ( 'all', array (
				'offset' => $start_at,
				'limit' => $num_of_a_page
		) );
	}

	public function all_jobs( $select = '*' ) {
		return $this->find ( 'all', array (
				'order' => 'created desc',
				'select' => $select
		) );
	}
}
