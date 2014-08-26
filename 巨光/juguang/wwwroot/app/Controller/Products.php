<?php
namespace Controller;

class Products extends \PestMVC\Controller {

	function index() {
		$args = func_get_args ();
		$current_page = empty ( $args ) ? 1 : array_shift ( $args );
		
		$model = new \Model\Products ();
		$products_number = $model->count ();
		$num_per_page = 9;
		
		$pager = new \PestMVC\Pager ( 'products', $current_page, $products_number, $num_per_page );
		$pager = $pager->get_pagination_html ();
		
		$all_products = $model->find_products ( $current_page, $num_per_page, 'product_id, name, pic, created' );
		
		$product_list = $model->all_products('product_id, name');
		
		$param ['product_list'] = $product_list;
		$param ['products'] = $all_products;
		$param ['pager'] = $pager;
		
		$this->render_front( 'products', $param );
	}
	
	function display() {
		$args = func_get_args ();
		$product_id = empty ( $args ) ? 1 : array_shift ( $args );
		$product = \Model\Products::find_by_product_id($product_id);
		
		$model = new \Model\Products();
		$product_list = $model->all_products('product_id, name');

		$product->description = stripcslashes($product->description);
		$param ['product'] = $product;
		$param ['product_list'] = $product_list;
		$this->render_front( 'productDetail', $param );
	}

}
