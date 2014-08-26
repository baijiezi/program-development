<?php
namespace Controller;

class AdminCases extends \PestMVC\Controller {

	function index() {
		\Utils\Auth::check('SYSTEM');
		
		$args = func_get_args ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );

		$model = new \Model\Products ();
		$products_number = $model->count ();
		$num_per_page = 10;

		$pager = new \PestMVC\Pager ( 'products', $current_page, $products_number, $num_per_page );
		$pager = $pager->get_pagination_html ();

		$all_products = $model->find_products ( $current_page, $num_per_page );

		$param ['products'] = $all_products;
		$param ['pager'] = $pager;
		$this->render ( 'products_list', $param );
	}

	function add() {
		\Utils\Auth::check('SYSTEM');
		
		$products = new \Model\Products ();

		$param ['_method'] = 'POST';
		
		$param ['product'] = $products;
		$param ['form_action'] = '/admin/products/create';
		$this->render ( 'products_add', $param );
	}

	function create() {
		\Utils\Auth::check('SYSTEM');
		
		$products = new \Model\Products ();

		$products->name = $_POST ['name'];
		$products->pic = $_POST ['pic'];
		$products->description = $_POST ['description'];
		$products->save ();
		$this->redirect ( '/admin/products' );
	}

	function edit() {
		\Utils\Auth::check('SYSTEM');
		
		$product = new \Model\Products ();

		$args = func_get_args ();
		$product_id = array_shift ( $args );

		$product = $product->find ( $product_id );

		$param ['product'] = $product;

		$param ['form_action'] = "/admin/products/update";
		$param ['_method'] = 'PUT';

		$this->render ( 'products_add', $param );
	}

	function update() {
		\Utils\Auth::check('SYSTEM');
		
		$products = new \Model\Products ();

		$products = $products->find ( $_POST ['product_id'] );
		$products->name = $_POST ['name'];
		$products->description = $_POST ['description'];
		$products->save ();

		$this->redirect ( '/admin/products' );
	}

	function delete() {
		\Utils\Auth::check('SYSTEM');
		
		$products = new \Model\Products ();

		// remove from user table.
		$args = func_get_args ();
		$product_id = array_shift ( $args );
		$products = $products->find ( $product_id );

		$products->delete ();
		$this->redirect ( '/admin/products' );
	}

	function img_upload(){
		\Utils\Auth::check('SYSTEM');
		
		$picname = $_FILES['mypic']['name'];
		$picsize = $_FILES['mypic']['size'];
		if ($picname != "") {
			if ($picsize > 512000) { //限制上传大小
				echo '图片大小不能超过500k';
				exit;
			}
			$type = strstr($picname, '.'); //限制上传格式
// 			if ($type != ".gif" && $type != ".jpg") {
			if (!($type == ".gif" || $type == ".jpg" || $type == '.png')) {
				echo '图片格式不对！';
				exit;
			}
			$rand = rand(100, 999);
			$pics = date("YmdHis") . $rand . $type; //命名图片名称
			//上传路径
			$pic_path = UPLOAD_BASE_PATH . 'products/' . $pics;
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
