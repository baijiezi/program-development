<?php 
namespace Utils;

class Auth {
	public $user_id;
	public $username;
	public $role;

	public static function check($role) {
		if (!isset($_SESSION['_auth'])) {
			throw new \PestMVC\AuthException('认证失败。');
		}else{
			$auth = $_SESSION['_auth'];
			if($auth->role !== $role){
				throw new \PestMVC\AuthException('认证失败。');
			}
		}
	}

	public static function setAuth($auth) {
		$_SESSION['_auth'] = $auth;
	}

	public static function unAuth(){
		unset($_SESSION['_auth']);
	}
}
