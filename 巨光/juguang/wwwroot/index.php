<?php
require "vendor/autoload.php";

error_reporting(E_ALL);

define ( 'VIEW_BASE_PATH', __DIR__ . '/app/View/' );
define ( 'VIEW_PATH_FRONT', __DIR__ . '/app/View/front/' );
define ( 'CSS_BASE_PATH_ADMIN', '/app/View/admin/css' );
define ( 'JS_BASE_PATH_ADMIN', '/app/View/admin/js' );
define ( 'CSS_BASE_PATH', '/app/View/front/style' );
define ( 'JS_BASE_PATH', '/app/View/front/scripts' );
define ( 'IMG_BASE_PATH', '/app/View/front/images' );
define ( 'CKEDITOR_PATH', '/vendor/ckeditor' );
define ( 'CKFINDER_PATH', '/vendor/ckfinder' );
define ( 'UPLOAD_BASE_PATH', __DIR__ . '/upload/' );
define ( 'PRODUCT_PIC_BASE_PATH', '/upload/products/' );
define ( 'CASES_PIC_BASE_PATH', '/upload/cases/' );
define ( 'UPLOAD_IMG_BASE_PATH', '/upload/images/' );

define ( 'MODEL_BASE_PATH', __DIR__ . '/app/Model' );

$connections = array (
		'development' => 'mysql://juguang:jgled88@localhost/juguang'
	// 'development' => 'mysql://root:root@localhost/juguang'
);

// initialize ActiveRecord
\ActiveRecord\Config::initialize ( function ($cfg) use($connections) {
	$cfg->set_model_directory ( MODEL_BASE_PATH );
	$cfg->set_connections ( $connections );
} ); 

// 	echo "<pre>";

	// error handling
	function pest_error_handle($exception) {
		if($exception instanceof \PestMVC\AuthException) {
			\PestMVC\Controller::redirect('/noAuth');
		}else {
			\PestMVC\Controller::redirect('/404');
			// var_dump($exception);
		}
	}
	set_exception_handler('pest_error_handle');
	// error handling end

	$mvc = new \PestMVC\App ();

	// TODO route sequence.
	
	$mvc->get ( '/404', \PestMVC\Helper::route_param ( 'main', 'notFound' ) );
	$mvc->get ( '/noAuth', \PestMVC\Helper::route_param ( 'main', 'noAuth' ) );

	// admin
	$mvc->get ( '/index', \PestMVC\Helper::route_param ( 'news', 'index', 'admin' ) );
	$mvc->get ( '/users', \PestMVC\Helper::route_param ( 'user', 'index', 'admin' ) );
	$mvc->get ( '/users/pg/:pg_id', \PestMVC\Helper::route_param ( 'user', 'index', 'admin' ) );
	$mvc->get ( '/users/add', \PestMVC\Helper::route_param ( 'user', 'add', 'admin' ) );
	$mvc->post ( '/users/create', \PestMVC\Helper::route_param ( 'user', 'create', 'admin' ) );
	$mvc->get ( '/users/:id/edit', \PestMVC\Helper::route_param ( 'user', 'edit', 'admin' ) );
	$mvc->put ( '/users/:id', \PestMVC\Helper::route_param ( 'user', 'update', 'admin' ) );
	$mvc->delete ( '/users/:id', \PestMVC\Helper::route_param ( 'user', 'delete', 'admin' ) );
	$mvc->get ( '/users/:id/delete', \PestMVC\Helper::route_param ( 'user', 'delete', 'admin' ) );

	$mvc->rest ( 'news', 'admin' );	//prefix
	$mvc->get ( '/news/pg/:pg_id', \PestMVC\Helper::route_param ( 'news', 'index', 'admin' ));

	$mvc->rest ( 'jobs', 'admin' );	//prefix
	// $mvc->get ( '/news/pg/:pg_id', \PestMVC\Helper::route_param ( 'news', 'index', 'admin' ));

	$mvc->post ( '/products/img/upload', \PestMVC\Helper::route_param ( 'products', 'img_upload', 'admin' ) );
	$mvc->rest ( 'products', 'admin' );
	$mvc->get ( '/products/pg/:pg_id', \PestMVC\Helper::route_param ( 'products', 'index', 'admin' ) );
	
	$mvc->rest ( 'cases', 'admin' );
	$mvc->get ( '/cases/pg/:pg_id', \PestMVC\Helper::route_param ( 'cases', 'index', 'admin' ) );
	$mvc->rest ( 'casecat', 'admin' );
	$mvc->get ( '/casecat/pg/:pg_id', \PestMVC\Helper::route_param ( 'casecat', 'index', 'admin' ) );
	$mvc->post ( '/casecat/img/upload', \PestMVC\Helper::route_param ( 'casecat', 'img_upload', 'admin' ) );

	$mvc->get ( '/login', \PestMVC\Helper::route_param ( 'user', 'login', 'admin' ) );
	$mvc->post ( '/login/post', \PestMVC\Helper::route_param ( 'user', 'doLogin', 'admin' ) );
	$mvc->get ( '/logout', \PestMVC\Helper::route_param ( 'user', 'logout', 'admin' ) );

	// front-end
	$mvc->get('/index.php', \PestMVC\Helper::route_param ( 'Index', 'index' ));
	$mvc->get('/index');
	$mvc->get('/about');
	$mvc->get('/news');
	$mvc->get('/news/:id', \PestMVC\Helper::route_param ( 'news', 'display' ));
	$mvc->get('/news/pg/:pg_id', \PestMVC\Helper::route_param ( 'news', 'index' ));
	$mvc->get('/cases');
	$mvc->get('/cases/:id', \PestMVC\Helper::route_param ( 'cases', 'display' ));
	$mvc->get('/cases/pg/:pg_id', \PestMVC\Helper::route_param ( 'cases', 'index' ));
	$mvc->get('/products');
	$mvc->get('/products/:id', \PestMVC\Helper::route_param ( 'products', 'display' ));
	$mvc->get('/jobs');
	$mvc->get('/jobs/:id', \PestMVC\Helper::route_param ( 'jobs', 'display' ));
	// $mvc->get('/jobs/customer', \PestMVC\Helper::route_param ( 'jobs', 'customer' ));
	// $mvc->get('/jobs/ledengineer', \PestMVC\Helper::route_param ( 'jobs', 'ledengineer' ));
	
	$mvc->get('/contactUs');
	$mvc->get('/contactUs/foshan', \PestMVC\Helper::route_param ( 'contactus', 'foshan' ));
	$mvc->get('/contactUs/maoming', \PestMVC\Helper::route_param ( 'contactus', 'maoming' ));

	$mvc->run ();
	
	

