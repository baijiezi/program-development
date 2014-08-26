<?php
namespace Model;

class News extends \ActiveRecord\Model {
	static $table_name = 'news';
	static $primary_key = 'news_id';
	// static $connection = 'production';
	static $db = 'juguang';

	static $before_create = array (
			'apply_created'
	);

	public function apply_created() {
		$this->created = date ( "Y-m-d H:i:s" );
	}

	public function find_news( $page = 1, $num_of_a_page = 10, $select = '*') {
		$start_at = ($page - 1) * $num_of_a_page;
		return $this->find ( 'all', array (
				'select' => $select,
				'order' => 'created desc',
				'limit' => $num_of_a_page,
				'offset' => $start_at
		) );
	}
	
	public function get_news($number) {
		return $this->find ( 'all', array (
				'limit' => $number,
				'order' => 'created desc'
		) );
	}
}
