<?php
namespace Model;

class Products extends \ActiveRecord\Model {
	static $table_name = 'products';
	static $primary_key = 'product_id';
	// static $connection = 'production';
	static $db = 'juguang';

	static $before_create = array (
			'apply_created'
	);

	public function apply_created() {
		$this->created = date ( "Y-m-d H:i:s" );
	}

	public function find_products( $page = 1, $num_of_a_page = 10) {
		$start_at = ($page - 1) * $num_of_a_page;
		return $this->find ( 'all', array (
				'limit' => $num_of_a_page,
				'offset' => $start_at
		) );
	}

	public function all_products( $select = '*' ) {
		return $this->find ( 'all', array (
				'select' => $select
		) );
	}
}
