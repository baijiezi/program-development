<?php
namespace Controller;

class AdminJobs extends \PestMVC\Controller {

	function index() {
		\Utils\Auth::check('SYSTEM');
		
		$args = func_get_args ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );

		$model = new \Model\Jobs ();
		$products_number = $model->count ();
		$num_per_page = 10;

		$pager = new \PestMVC\Pager ( 'jobs', $current_page, $products_number, $num_per_page );
		$pager = $pager->get_pagination_html ();

		$all_jobs = $model->find_jobs ( $current_page, $num_per_page );

		$param ['jobs'] = $all_jobs;
		$param ['pager'] = $pager;
		$this->render ( 'jobs_list', $param );
	}

	function add() {
		\Utils\Auth::check('SYSTEM');
		
		$jobs = new \Model\Jobs ();

		$param ['_method'] = 'POST';
		
		$param ['job'] = $jobs;
		$param ['form_action'] = '/admin/jobs/create';
		$this->render ( 'jobs_add', $param );
	}

	function create() {
		\Utils\Auth::check('SYSTEM');
		
		$jobs = new \Model\Jobs ();

		$jobs->name = $_POST ['name'];
		$jobs->description = stripcslashes($_POST ['description']);
		$jobs->save ();
		$this->redirect ( '/admin/jobs' );
	}

	function edit() {
		\Utils\Auth::check('SYSTEM');
		
		$job = new \Model\Jobs ();

		$args = func_get_args ();
		$job_id = array_shift ( $args );

		$job = $job->find ( $job_id );

		$job->description = stripcslashes($job->description);
		$param ['job'] = $job;

		$param ['form_action'] = "/admin/jobs/update";
		$param ['_method'] = 'PUT';

		$this->render ( 'jobs_add', $param );
	}

	function update() {
		\Utils\Auth::check('SYSTEM');
		
		$jobs = new \Model\Jobs ();

		$jobs = $jobs->find ( $_POST ['job_id'] );
		$jobs->name = $_POST ['name'];
		$jobs->description = stripcslashes($_POST ['description']);
		$jobs->save ();

		$this->redirect ( '/admin/jobs' );
	}

	function delete() {
		\Utils\Auth::check('SYSTEM');
		
		$jobs = new \Model\Jobs ();

		// remove from user table.
		$args = func_get_args ();
		$job_id = array_shift ( $args );
		$jobs = $jobs->find ( $job_id );

		$jobs->delete ();
		$this->redirect ( '/admin/jobs' );
	}

	function get() {
	}

}
