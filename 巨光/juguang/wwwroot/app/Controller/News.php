<?php
namespace Controller;

class News extends \PestMVC\Controller {

	function index() {
		$args = func_get_args ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );

		$model = new \Model\News ();
		$news_number = $model->count ();
		$num_per_page = 7;

		$pager = new \PestMVC\Pager ( 'news', $current_page, $news_number, $num_per_page );
		$pager = $pager->get_pagination_html ();

		$all_news = $model->find_news ( $current_page, $num_per_page, 'news_id, title, created' );

		$param ['news'] = $all_news;
		$param ['pager'] = $pager;
		
		$model = new \Model\CaseCat ();
		$case_list = $model->top_cases_list();
		$param ['list'] = $case_list;
		
		$this->render_front( 'news', $param );
	}
	
	function display() {
		$args = func_get_args ();
		$news_id = empty ( $args ) ? 1 : array_shift ( $args );
		$news = \Model\News::find_by_news_id($news_id);
		
		$news->content = stripcslashes($news->content);
		$param ['news'] = $news;
		
		$model = new \Model\CaseCat ();
		$case_list = $model->top_cases_list();
		$param ['list'] = $case_list;
		
		$this->render_front( 'news_display', $param );
	}

}
