<?php

namespace Controller;

class Cases extends \PestMVC\Controller {

	public function index() {
		$args = func_get_args ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );
		
		$cases_number = \Model\CaseCat::count ();
		$num_per_page = 9;

		$model = new \Model\CaseCat ();
		
		$pager = new \PestMVC\Pager ( 'cases', $current_page, $cases_number, $num_per_page );
		$pager = $pager->get_pagination_html ();
		
		$all_cases = $model->find_cats ( $current_page, $num_per_page, 'case_cat_id, case_cat_name, created' );
		$case_list = $model->top_cases_list();
		
		$param ['list'] = $case_list;
		$param ['cases'] = $all_cases;
		$param ['pager'] = $pager;
		
		$this->render_front( 'cases', $param );
	}
	
	function display() {
		$args = func_get_args ();
		$case_id = empty ( $args ) ? 1 : array_shift ( $args );
		$cases = \Model\CaseCat::find_by_case_cat_id($case_id);
		
		$model = new \Model\CaseCat ();
		$case_list = $model->top_cases_list();
		
		$param ['list'] = $case_list;
		$param ['cases'] = $cases;
		$this->render_front( 'caseDetail', $param );
	}
}
