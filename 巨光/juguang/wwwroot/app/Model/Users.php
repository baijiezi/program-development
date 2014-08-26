<?php
namespace Model;

class Users extends \ActiveRecord\Model {
	static $table_name = 'users';
	static $primary_key = 'id';

	static $has_many = array(
			array('users_roles', 'class_name' => "UsersRoles", 'foreign_key' => "users_id"),
			array('roles', 'class_name' => "Roles", 'through' => 'users_roles', 'foreign_key' => "users_id"),
	);

	static $before_create = array('apply_created');

	public function apply_created() {
		$this->created = date("Y-m-d H:i:s");
	}

	public function find_by_page($page = 1, $num_of_a_page = 10) {
		$start_at = ($page - 1) * $num_of_a_page;
		return $this->find ( 'all', array (
				'limit' => $num_of_a_page,
				'offset' => $start_at
		) );
	}

	public function get_user_by_id($user_id) {
		return $this->find($user_id);
	}

	public function check_user($username, $password) {
		return $this->find('first', array('conditions'=>array('username = ? AND password = ?', $username, $password)));
	}
}

class Roles extends \ActiveRecord\Model {
	static $table_name = 'roles';
	static $primary_key = 'id';

	static $has_many = array(
			array('users_roles', 'class_name' => "UsersRoles", 'foreign_key' => "roles_id"),
			// 		array('users', 'class_name' => "Users", 'through' => 'users_roles', 'foreign_key' => "roles_id"),
	);
}

class UsersRoles extends \ActiveRecord\Model {
	static $table_name = 'users_roles';

	static $belongs_to = array(
			// 		array ('users', 'class_name' => 'Users', 'foreign_key' => "users_id"),
			// 		array ('roles', 'class_name' => 'Roles', 'foreign_key' => "roles_id")
	);
}