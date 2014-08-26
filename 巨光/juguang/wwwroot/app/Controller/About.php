<?php

namespace Controller;

class About extends \PestMVC\Controller {

	public function index() {
		$model = new \Model\CaseCat ();
		$case_list = $model->top_cases_list();
		
		$param ['list'] = $case_list;
		$this->render_front ( 'about', $param );
	}
}
