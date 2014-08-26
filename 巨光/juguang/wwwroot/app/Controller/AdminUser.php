<?php

namespace Controller;

class AdminUser extends \PestMVC\Controller {

	public function index() {
		\Utils\Auth::check('SYSTEM');
		
		$args = func_get_args ();
		$model = new \Model\Users ();
		$user_number = $model->count ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );

		$num_per_page = 10;

		$pager = new \PestMVC\Pager ( 'users', $current_page, $user_number, $num_per_page );
		$pager = $pager->get_pagination_html ();

		$users = $model->find_by_page ( $current_page, $num_per_page );
		// $users = $model->all();

		$param ['users'] = $users;
		$param ['pager'] = $pager;
		// var_dump($users);
		// \_MVC::v ( 'users_list', $param );
		$this->render ( 'users_list', $param );
	}

	function add() {
		\Utils\Auth::check('SYSTEM');

		$user = new \Model\Users ();
		$param ['user'] = $user;
		$param ['roles'] = \Model\Roles::all ();

		$param ['form_action'] = '/users/create';

		$param ['text_title'] = '添加用户';
		$param ['text_button'] = '确认添加';
		
		$this->render ( 'users_edit', $param );
	}

	function create() {
		\Utils\Auth::check('SYSTEM');
		
		$user = new \Model\Users ();

		// if (isset ( $_POST ['_post'] )) {
		$user->username = $_POST ['username'];
		$user->password = $_POST ['password'];
		$user->company = $_POST ['company'];
		$user->tel = $_POST ['tel'];
		$user->save ();

		$user_role = new \Model\UsersRoles ();
		$user_role->users_id = $user->id;
		$user_role->roles_id = $_POST ['role'];
		$user_role->save ();

		print_r ( $user );

		$this->redirect ( '/users' );
		// }
	}

	function edit() {
		\Utils\Auth::check('SYSTEM');
		
		$args = func_get_args ();

		$model = new \Model\Users ();
		$user_id = array_shift ( $args );
		$user = $model->get_user_by_id ( $user_id );

		$param ['user'] = $user;
		$param ['roles'] = \Model\Roles::all ();
		$param ['form_action'] = '/users/update';
		$param ['_method'] = 'PUT';

		$param ['text_title'] = '修改用户信息';
		$param ['text_button'] = '确认修改';

		$this->render ( 'users_edit', $param );

	}

	function update() {
		\Utils\Auth::check('SYSTEM');
		
		$model = new \Model\Users ();

		// if (isset ( $_POST ['_post'] )) {
		$user_id = $_POST ['id'];
		$user = $model->find ( $user_id );
		$user->username = $_POST ['username'];
		$user->password = $_POST ['password'];
		$user->company = $_POST ['company'];
		$user->tel = $_POST ['tel'];
		$user->save ();

		$user_role = new \Model\UsersRoles ();
		$role = $user_role->find ( 'first', array (
				'conditions' => array (
						'users_id = ?',
						intval ( $user_id )
				)
		) );
		$role->roles_id = $_POST ['role'];
		$role->save ();

		// echo '<pre>';
		// print_r ( $role );

		// \_MVC::redirect ( 'users.php?a=edit&user_id=' . $user_id );

		$this->redirect ( '/users/' . $user_id . '/edit' );
		// }
	}

	function delete() {
		\Utils\Auth::check('SYSTEM');
		
		$args = func_get_args ();
		$model = new \Model\Users ();

		// remove from user table.
		$user_id = array_shift ( $args );
		$user = $model->find ( $user_id );

		$user->delete ();

		// remove from users_roles table.
		$user_role = new \Model\UsersRoles ();
		$role = $user_role->find ( 'first', array (
				'conditions' => array (
						'users_id = ?',
						intval ( $user_id )
				)
		) );
		$role->delete ();

		$this->redirect ( '/users' );
	}

	public function notFound() {
		// $this->render ( "error", array (), 404 );
	}

	function get() {
	}

	function login() {
		$param = array();
		$this->render ( 'login', $param, 'login' );
	}

	function doLogin() {
		$username= $_POST['username'];
		$password= $_POST['password'];

		$model = new \Model\Users ();
		$user = $model->check_user($username, $password);
		if(is_null($user)) {
			$this->redirect('/404');
		}

		$auth = new \Utils\Auth();
		$auth->user_id = $user->id;
		$auth->username = $user->username;
		$auth->role = $user->roles[0]->role_name;
		\Utils\Auth::setAuth($auth);

		$this->redirect('/admin/index');
		print_r($_SESSION['_auth']);
	}

	function logout() {
		\Utils\Auth::check('SYSTEM');
		
		\Utils\Auth::unAuth();
		$this->redirect('/admin/login');
	}
}
