<?php

namespace Controller;

class Index extends \PestMVC\Controller {

	public function index() {
		$model = new \Model\News ();
		$news = $model->get_news(3);

		$first_news = array_shift($news);
		$first_news = \Model\News::find_by_news_id($first_news->news_id);
		preg_match("/\/upload\/images\/.*\.\w{3}/", $first_news->content, $first_img);

		$first_news->content = mb_substr(strip_tags($first_news->content, '<div>'), 0 ,50, 'utf-8');
		$param ['news'] = $news;
		$param['first_news'] = $first_news;
		$param['first_img'] = $first_img[0];
		
		// 		$param ['pager'] = $pager;
		// 		// var_dump($users);
		// 		// \_MVC::v ( 'users_list', $param );
		$this->render_front ( 'index', $param );
	}
}
