<?php

namespace Controller;

class Jobs extends \PestMVC\Controller {

	function index() {
		// $args = func_get_args ();
		// $current_page = empty ( $args ) ? 1 : array_shift ( $args );

		// $model = new \Model\Jobs ();
		// $news_number = $model->count ();
		// $num_per_page = 7;

		// $pager = new \PestMVC\Pager ( 'jobs', $current_page, $news_number, $num_per_page );
		// $pager = $pager->get_pagination_html ();

		// $all_news = $model->find_news ( $current_page, $num_per_page, 'job_id, title, created' );

		// $param ['news'] = $all_news;
		// $param ['pager'] = $pager;
		
		// $model = new \Model\CaseCat ();
		// $case_list = $model->top_cases_list();
		// $param ['list'] = $case_list;
		
		// $this->render_front( 'jobs_display', $param );
		$this->display(1);
	}
	
	function display() {
		$args = func_get_args ();
		$job_id = empty ( $args ) ? 1 : array_shift ( $args );
		$jobs = \Model\Jobs::find_by_job_id($job_id);
		
		$jobs->description = stripcslashes($jobs->description);
		$param ['jobs'] = $jobs;
		
		$model = new \Model\Jobs();
		$jobs_list = $model->all_jobs();
		$param ['list'] = $jobs_list;
		
		$this->render_front( 'jobs_display', $param );
	}

	// public function index() {
	// 	$this->render_front ( 'jobs' );
	// }
	
	public function customer() {
		$this->render_front ( 'jobs_1' );
	}
	
	public function ledengineer() {
		$this->render_front ( 'jobs_2' );
	}
}
