<?php
namespace Controller;

class AdminNews extends \PestMVC\Controller {

	function index() {
		\Utils\Auth::check('SYSTEM');
		
		$args = func_get_args ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );

		$model = new \Model\News ();
		$news_number = $model->count ();
		$num_per_page = 10;

		$pager = new \PestMVC\Pager ( 'admin/news', $current_page, $news_number, $num_per_page );
		$pager = $pager->get_pagination_html ();

		$all_news = $model->find_news ( $current_page, $num_per_page );

		$param ['news'] = $all_news;
		$param ['pager'] = $pager;
		$this->render ( 'news_list', $param );
	}

	function add() {
		\Utils\Auth::check('SYSTEM');
		$news = new \Model\News ();

		$param ['news'] = $news;
		$param ['form_action'] = '/admin/news/create';
		$this->render ( 'news_add', $param );
	}

	function create() {
		\Utils\Auth::check('SYSTEM');
		
		$news = new \Model\News ();

		$news->title = $_POST ['title'];
		$news->content = stripcslashes($_POST ['news_content']);
		$news->save ();
		$this->redirect ( '/admin/news' );
	}

	function edit() {
		\Utils\Auth::check('SYSTEM');
		
		$news = new \Model\News ();

		$args = func_get_args ();
		$news_id = array_shift ( $args );

		$news = $news->find ( $news_id );
		$news->content = stripcslashes($news->content);

		$param ['news'] = $news;

		$param ['form_action'] = "/admin/news/update";
		$param ['_method'] = 'PUT';

		$this->render ( 'news_add', $param );
	}

	function update() {
		\Utils\Auth::check('SYSTEM');
		
		$news = new \Model\News ();

		$news = $news->find ( $_POST ['news_id'] );
		$news->title = $_POST ['title'];
		$news->content = stripcslashes($_POST ['news_content']);
		$news->save ();

		$this->redirect ( '/admin/news' );
	}

	function delete() {
		\Utils\Auth::check('SYSTEM');
		
		$news = new \Model\News ();

		// remove from user table.
		$args = func_get_args ();
		$news_id = array_shift ( $args );
		$news = $news->find ( $news_id );

		$news->delete ();
		$this->redirect ( '/admin/news' );
	}

	function get() {
	}

}
