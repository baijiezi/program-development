<?php
namespace PestMVC;
use \PestMVC\Route;

// TODO move to common
define ( 'CONTROLLER_NAMESPACE', '\Controller\\' );

/**
 * Processe url mapping and dispatch the request
 * to certain controller.
 *
 * @author andy
 *
*/
class Router {

	/**
	 * Contains the Route list.
	 *
	 * @var array
	 */
	private $routes;
// 	private static $routes;

	public function addRoute($route) {
		$this->validate ( $route );

		// for example GET@/users/:id/edit
		$route_key = $route->http_method . '@' . Helper::get_route_key($route);
// 		var_dump($route_key);
		// $route_key =  Helper::get_route_key($route);

		if (! isset ( $this->routes [$route_key] )) {
			$this->routes [$route_key] = $route;
		}
	}

	private function validate($route) {
		if (! $route instanceof Route) {
			throw new \InvalidArgumentException ( 'route is not leagal.' );
		}

		$class = CONTROLLER_NAMESPACE . $route->controller;
		if (! class_exists ( $class )) {
			throw new \PestMVC\CannotFoundException ( 'Can not find Controller class "' . $class . '".' );
		} else {
			if (! method_exists ( new $class (), $route->action )) {
				throw new \PestMVC\CannotFoundException ( 'Can not find action "' . $route->action . '" in class ' . $class );
			}
		}
	}

	/**
	 * Do the dispatch job here!
	 *
	 * @param string $uri
	 * @param string $http_method
	 * @throws \PestMVC\CannotFoundException
	 */
	public function dispatch($uri, $http_method) {
		// case ignore for uri.
		$uri = strtolower($uri);
// 		var_dump($uri);
// 		var_dump($http_method);

		foreach ( $this->routes as $route ) {
			// update $rule from /xxx/:xx to /xxx/([a-zA-Z0-9_\+\-%]+)/?
			$url_regex = preg_replace_callback ( '@:[\w]+@', array (
					$this,
					'regex_url'
			), Helper::get_route_key($route) );	//$route->rule
			$url_regex .= '/?';
				
			$p_values = array ();
			if ($route->http_method === $http_method) {
				if (preg_match ( '@^' . $url_regex . '$@', $uri, $p_values )) {
					$class = CONTROLLER_NAMESPACE . $route->controller;
					$controller = new $class ();
						
					// trim the first item, 'cause it equals to $uri
					array_shift ( $p_values );
						
					return call_user_func_array ( array (
							$controller,
							$route->action
					), $p_values );
				}
			}
		}
		throw new \PestMVC\CannotFoundException ( 'Your request "' . $http_method . '@' . $uri . '" is invalid.' );
	}

	private function regex_url($matches) {
		return '([a-zA-Z0-9_\+\-%]+)';
	}

	/**
	 * Get defaut controller and action by rule.
	 *
	 * // GET@/users
	 * // GET@/users/:id
	 *
	 * // GET@/users/add
	 * // POST@/users/create
	 *
	 * // GET@/users/:id/edit
	 * // PUT@/users/:id
	 *
	 * // DELETE/users/:id
	 * // GET/users/:id/delete
	 *
	 * @param string $rule
	 * @throws \PestMVC\CannotFoundException
	 */
	public function get_default_param($rule) {
		$param = array ();
		$default_actions = array (
				'GET\@/([a-zA-Z0-9_\+\-%]+)/?' => 'index',
				'GET\@/([a-zA-Z0-9_\+\-%]+)/(:[\w]+)/?' => 'get',
				'GET\@/([a-zA-Z0-9_\+\-%]+)/add/?' => 'add',
				'POST\@/([a-zA-Z0-9_\+\-%]+)/create/?' => 'create',
				'GET\@/([a-zA-Z0-9_\+\-%]+)/(:[\w]+)/edit/?' => 'edit',
				'PUT\@/([a-zA-Z0-9_\+\-%]+)/(:[\w]+)/?' => 'update',
				'DELETE\@/([a-zA-Z0-9_\+\-%]+)/(:[\w]+)/?' => 'delete',
				'GET\@/([a-zA-Z0-9_\+\-%]+)/(:[\w]+)/delete?' => 'delete'
		);

		foreach ( $default_actions as $pattern => $action ) {
			// echo $rule . ' ## ' . $pattern . ' ## ' . $action . '<br>';
			$p_var = array ();
			if (preg_match ( '@^' . $pattern . '$@', $rule, $p_var )) {
				$param = array (
						'controller' => $p_var [1],
						'action' => $action
				);
				unset ( $p_var );
				return $param;
				break;
			}
		}

		// TODO
		throw new \PestMVC\CannotFoundException ( 'Pattern can not found. ' . $rule );
	}

}
