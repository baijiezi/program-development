<?php
namespace Controller;

class AdminCasecat extends \PestMVC\Controller {

	function index() {
		\Utils\Auth::check('SYSTEM');
		
		$args = func_get_args ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );

		$model = new \Model\CaseCat ();
		$casecat_number = $model->count ();
		$num_per_page = 10;

		$pager = new \PestMVC\Pager ( 'admin/casecat', $current_page, $casecat_number, $num_per_page );
		$pager = $pager->get_pagination_html ();

		$all_casecat = $model->find_cats ( $current_page, $num_per_page );

		$param ['casecats'] = $all_casecat;
		$param ['pager'] = $pager;
		$this->render ( 'casecat_list', $param );
	}

	function add() {
		\Utils\Auth::check('SYSTEM');
		
		$casecat = new \Model\CaseCat ();
		$casecat->case_cat_order = $casecat::count() + 1;

		$param ['_method'] = 'POST';
		
		$param ['cat'] = $casecat;
// 		$param ['pics'] = null;
		
		$param ['form_action'] = '/admin/casecat/create';
		$this->render ( 'casecat_add', $param );
	}

	function create() {
		\Utils\Auth::check('SYSTEM');
		
		$casecat = new \Model\CaseCat ();

		$casecat->case_cat_name = $_POST ['case_cat_name'];
		$casecat->case_cat_order = $_POST ['case_cat_order'];
		$casecat->case_cat_pics = $_POST ['case_cat_pics'];
		$casecat->save ();
		$this->redirect ( '/admin/casecat' );
	}

	function edit() {
		\Utils\Auth::check('SYSTEM');
		
		$cat = new \Model\CaseCat ();

		$args = func_get_args ();
		$cat_id = array_shift ( $args );

		$cat = $cat->find ( $cat_id );

		$param ['cat'] = $cat;
// 		$param ['pics'] = explode(';', $cat->case_cat_pics);

		$param ['form_action'] = "/admin/casecat/update";
		$param ['_method'] = 'PUT';

		$this->render ( 'casecat_add', $param );
	}

	function update() {
		\Utils\Auth::check('SYSTEM');
		
		$casecat = new \Model\CaseCat ();

		$casecat = $casecat->find ( $_POST ['case_cat_id'] );
		$casecat->case_cat_name = $_POST ['case_cat_name'];
		$casecat->case_cat_order = $_POST ['case_cat_order'];
		$casecat->case_cat_pics = $_POST ['case_cat_pics'];
		$casecat->save ();

		$this->redirect ( '/admin/casecat' );
	}

	function delete() {
		\Utils\Auth::check('SYSTEM');
		
		$casecat = new \Model\CaseCat ();

		// remove from user table.
		$args = func_get_args ();
		$product_id = array_shift ( $args );
		$casecat = $casecat->find ( $product_id );

		$casecat->delete ();
		$this->redirect ( '/admin/casecat' );
	}

	function img_upload(){
		$picname = $_FILES['mypic']['name'];
		$picsize = $_FILES['mypic']['size'];
		if ($picname != "") {
			if ($picsize > 512000) { //限制上传大小
				echo '图片大小不能超过500k';
				exit;
			}
			$type = strstr($picname, '.'); //限制上传格式
			// 	if ($type != ".gif" && $type != ".jpg") {
			if (!($type == ".gif" || $type == ".jpg" || $type == '.png')) {
				echo '图片格式不对！';
				exit;
			}
			$rand = rand(100, 999);
			$pics = date("YmdHis") . $rand . $type; //命名图片名称
			//上传路径
			$pic_path = UPLOAD_BASE_PATH . 'cases/' . $pics;
			move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
		}
		$size = round($picsize/1024,2); //转换成kb
		$arr = array(
				'name'=>$picname,
				'pic'=>$pics,
				'size'=>$size
		);
		echo json_encode($arr); //输出json数据
}


function get() {
}

}
