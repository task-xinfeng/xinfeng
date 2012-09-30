<?php
App::uses('AppController', 'Controller');

class DashboardController extends AppController {

	public $name = 'Dashboard';
	public $layout = 'dashboard';
	public $uses = array('Brand', 'Article', 'Dealer', 'Product', 'BrandDealerMap');
	public $components = array('Session', 'Cookie', 'Upload');
	public $helpers = array('Form', 'Html', 'Js', 'Time', 'Phpthumb', 'StringUtil');
	
	var $avatarTempExt = 'jpg';
	var $avatarSize = '409200000';
	var $avatarMaxWidth = 2000;
	var $avatarMaxHeight = 2000;
	
	public function index(){
		$this->redirect(array('controller' => 'dashboard', 'action' => 'brands'));die();
	}
	
	public function brands(){
		$option = array('recursive'=>2, 'order' => 'Brand.weight desc');
		$brands = $this->Brand->find('all', $option);
		//debug($brands);die();
		$this->set('brands', $brands);
		
		$this->set('title_for_layout','新风网 —— Admin Dashboard');//标题
	}
	
	public function brandInfo(){
		$bid = $this->request->query['brand_id'];
		$brand = $this->Brand->findById($bid);
		$this->set('brand', $brand);
		//debug($brand);die();
		$this->set('title_for_layout','新风社 —— 新风系统供应商 - ' .  $brand['Brand']['name']);//标题
	}
	
	public function addBrand(){
		
	}
	
	public function saveBrand(){
		$this->layout = null;
		$handle = $this->Upload;
		$handle->upload($_FILES['logo']);
		$logoPath = '';
		if($handle->uploaded) {
			$handle->image_resize = true;
			$handle->image_ratio_no_zoom_in = true;
			$handle->image_x = $this->avatarMaxWidth;
			$handle->image_y = $this->avatarMaxHeight;
			$handle->file_max_size = $this->avatarSize;
			$handle->file_new_name_body = time();
			//$handle->file_overwrite	= true;	// file overwrite. forbidden, because of the explorer's cache
			$handle->mime_check	= true;	// MIME-Type check
			$handle->allowed = array('image/*'); // Only image
			/*$handle->image_convert = $this->avatarTempExt;*/
			$destination = WWW_ROOT . IMAGE_ROOT . BRAND;
			$handle->Process($destination); // Copy the file from temp to disk on server
			if ($handle->processed) { // Check wether the copying success
				$logoPath = $handle->file_dst_name;
			} else {
				
			}
		} else {
			
		}
		$handle2 = $this->Upload;
		$handle2->upload($_FILES['avatar']);
		$avatarPath = '';
		if($handle2->uploaded) {
			$handle2->image_resize = true;
			$handle2->image_ratio_no_zoom_in = true;
			$handle2->image_x = $this->avatarMaxWidth;
			$handle2->image_y = $this->avatarMaxHeight;
			$handle2->file_max_size = $this->avatarSize;
			$handle2->file_new_name_body = time();
			//$handle2->file_overwrite	= true;	// file overwrite. forbidden, because of the explorer's cache
			$handle2->mime_check	= true;	// MIME-Type check
			$handle2->allowed = array('image/*'); // Only image
			/*$handle2->image_convert = $this->avatarTempExt;*/
			$destination = WWW_ROOT . IMAGE_ROOT . BRAND;
			$handle2->Process($destination); // Copy the file from temp to disk on server
			if ($handle2->processed) { // Check wether the copying success
				$avatarPath = $handle2->file_dst_name;
			} else {
				
			}
		} else {
			
		}
		
		//TODO这里应该是在图片上传无误的情况下才写数据库，但是非高压力情况下也无所谓了
		$this->Brand->Create();
		$brandData = array();
		$brandData['Brand']['name'] = $this->request->data['name'];
		$brandData['Brand']['logo'] = $logoPath;
		$brandData['Brand']['avatar'] = $avatarPath;
		$brandData['Brand']['intro'] = $this->request->data['intro'];
		$brandData['Brand']['url'] = $this->request->data['url'];
		$brandData['Brand']['weight'] = 0;
		$this->Brand->save($brandData);
		$this->redirect(array('controller' => 'dashboard', 'action' => 'brands'));die();
	}
	
	public function editBrand(){
		$brand_id = $this->request->query['brand_id'];
		$conditions = array('Brand.id' => $brand_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions,);
		$brand = $this->Brand->find('first', $option);
		//debug($brand);die();
		$this->set('brand', $brand);
	}
	
	public function updateBrand(){
		$this->layout = null;
		$logoPath = '';
		if(!empty($_FILES['avatar'])){
			$handle = $this->Upload;
			$handle->upload($_FILES['avatar']);
			if($handle->uploaded) {
				$handle->image_resize = true;
				$handle->image_ratio_no_zoom_in = true;
				$handle->image_x = $this->avatarMaxWidth;
				$handle->image_y = $this->avatarMaxHeight;
				$handle->file_max_size = $this->avatarSize;
				$handle->file_new_name_body = time();
				//$handle->file_overwrite	= true;	// file overwrite. forbidden, because of the explorer's cache
				$handle->mime_check	= true;	// MIME-Type check
				$handle->allowed = array('image/*'); // Only image
				/*$handle->image_convert = $this->avatarTempExt;*/
				$destination = WWW_ROOT . IMAGE_ROOT . BRAND;
				$handle->Process($destination); // Copy the file from temp to disk on server
				if ($handle->processed) { // Check wether the copying success
					$logoPath = $handle->file_dst_name;
				} else {
					
				}
			} else {
				
			}
		}
		
		//TODO这里应该是在图片上传无误的情况下才写数据库，但是非高压力情况下也无所谓了
		$brand_id = $this->request->data['brand_id'];
		$this->Brand->read(null, $brand_id);
		if($logoPath==''){
			$updateArray = array(
							'name' => $this->request->data['name'],
							'intro' => $this->request->data['intro'],
							'url' => $this->request->data['url'],
							'weight' => $this->request->data['weight']
							);
		}else{
			$updateArray = array(
							'name' => $this->request->data['name'],
							'intro' => $this->request->data['intro'],
							'url' => $this->request->data['url'],
							'weight' => $this->request->data['weight'],
							'logo' => $logoPath
							);
		}
		$this->Brand->set($updateArray);
		$this->Brand->save();
		
		$this->redirect(array('controller' => 'dashboard', 'action' => 'brandInfo', '?'=>array('brand_id' => $brand_id)));die();
	}
	
	public function delBrand(){
		$this->layout = null;
		if(!empty($this->request->data['brand_id'])){
			$brand_id= $this->request->data['brand_id'];
		}else{
			$brand_id= $this->request->query['brand_id'];
		}
		$this->Brand->delete($brand_id);
		
		$sql = "delete from brand_dealer_maps where brand_id=".$brand_id.";";
		$this->Brand->query($sql);
		
		$sql2 = "delete from articles where brand_id=".$brand_id.";";
		$this->Article->query($sql2);
		
		$sql3 = "delete from products where brand_id=".$brand_id.";";
		$this->Product->query($sql3);
		
		if(empty($this->request->data['no_redirect'])){
			$this->redirect(array('controller' => 'dashboard', 'action' => 'brands'));die();
		}
	}
	
	public function getProductsByBrand(){
		$this->layout = null;
		$brand_id = $this->request->data['brand_id'];
		$this->set('brand_id', $brand_id);
		$conditions = array('Product.brand_id' => $brand_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions, 'order' => 'Product.id desc');
		$products = $this->Product->find('all', $option);
		$this->set('products', $products);
		//debug($products);die();
	}
	
	public function productInfo(){
		$product_id = $this->request->query['product_id'];
		$conditions = array('Product.id' => $product_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions,);
		$product = $this->Product->find('first', $option);
		//debug($product);die();
		$this->set('product', $product);
	}
	
	public function addProduct(){
		$brand_id = $this->request->query['brand_id'];
		$conditions = array('Brand.id' => $brand_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions);
		$brand = $this->Brand->find('first', $option);
		$this->set('brand', $brand);
	}
	
	public function saveProduct(){
		$this->layout = null;
		$handle = $this->Upload;
		$handle->upload($_FILES['avatar']);
		$avatarPath = '';
		if($handle->uploaded) {
			$handle->image_resize = true;
			$handle->image_ratio_no_zoom_in = true;
			$handle->image_x = $this->avatarMaxWidth;
			$handle->image_y = $this->avatarMaxHeight;
			$handle->file_max_size = $this->avatarSize;
			$handle->file_new_name_body = time();
			//$handle->file_overwrite	= true;	// file overwrite. forbidden, because of the explorer's cache
			$handle->mime_check	= true;	// MIME-Type check
			$handle->allowed = array('image/*'); // Only image
			/*$handle->image_convert = $this->avatarTempExt;*/
			$destination = WWW_ROOT . IMAGE_ROOT . PRODUCT;
			$handle->Process($destination); // Copy the file from temp to disk on server
			if ($handle->processed) { // Check wether the copying success
				$avatarPath = $handle->file_dst_name;
			} else {
				
			}
		} else {
			
		}
		
		//TODO这里应该是在图片上传无误的情况下才写数据库，但是非高压力情况下也无所谓了
		$this->Product->Create();
		$productData = array();
		$productData['Product']['brand_id'] = $this->request->data['brand_id'];
		$productData['Product']['name'] = $this->request->data['name'];
		$productData['Product']['avatar'] = $avatarPath;
		$productData['Product']['intro'] = $this->request->data['intro'];
		$this->Product->save($productData);
		$this->redirect(array('controller' => 'dashboard', 'action' => 'brandInfo', '?'=>array('brand_id' => $this->request->data['brand_id'])));die();
	}
	
	public function editProduct(){
		$product_id = $this->request->query['product_id'];
		$conditions = array('Product.id' => $product_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions,);
		$product = $this->Product->find('first', $option);
		//debug($product);die();
		$this->set('product', $product);
	}
	
	public function updateProduct(){
		$this->layout = null;
		$avatarPath = '';
		if(!empty($_FILES['avatar'])){
			$handle = $this->Upload;
			$handle->upload($_FILES['avatar']);
			if($handle->uploaded) {
				$handle->image_resize = true;
				$handle->image_ratio_no_zoom_in = true;
				$handle->image_x = $this->avatarMaxWidth;
				$handle->image_y = $this->avatarMaxHeight;
				$handle->file_max_size = $this->avatarSize;
				$handle->file_new_name_body = time();
				//$handle->file_overwrite	= true;	// file overwrite. forbidden, because of the explorer's cache
				$handle->mime_check	= true;	// MIME-Type check
				$handle->allowed = array('image/*'); // Only image
				/*$handle->image_convert = $this->avatarTempExt;*/
				$destination = WWW_ROOT . IMAGE_ROOT . PRODUCT;
				$handle->Process($destination); // Copy the file from temp to disk on server
				if ($handle->processed) { // Check wether the copying success
					$avatarPath = $handle->file_dst_name;
				} else {
					
				}
			} else {
				
			}
		}
		
		$product_id = $this->request->data['product_id'];
		$this->Product->read(null, $product_id);
		if($avatarPath==''){
			$updateArray = array(
							'name' => $this->request->data['name'],
							'intro' => $this->request->data['intro']
							);
		}else{
			$updateArray = array(
							'name' => $this->request->data['name'],
							'intro' => $this->request->data['intro'],
							'avatar' => $avatarPath
							);
		}
		$this->Product->set($updateArray);
		$this->Product->save();
		
		$this->redirect(array('controller' => 'dashboard', 'action' => 'ProductInfo', '?'=>array('product_id' => $product_id)));die();
	}
	
	public function delProduct(){
		$this->layout = null;
		if(!empty($this->request->data['product_id'])){
			$product_id= $this->request->data['product_id'];
		}else{
			$product_id= $this->request->query['product_id'];
		}
		$this->Product->delete($product_id);
		
		if(empty($this->request->data['no_redirect'])){
			$this->redirect(array('controller' => 'dashboard', 'action' => 'products'));die();
		}
	}
	
	public function article(){
		$article_id = $this->request->query['article_id'];
		$conditions = array('Article.id' => $article_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions);
		$article = $this->Article->find('first', $option);
		$this->set('article', $article);
	}
	
	public function addArticle(){
		$brand_id = $this->request->query['brand_id'];
		$conditions = array('Brand.id' => $brand_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions);
		$brand = $this->Brand->find('first', $option);
		$this->set('brand', $brand);
		
		$type = $this->request->query['type'];
		$this->set('type', $type);
	}
	
	public function saveArticle(){
		$this->Article->Create();
		$articleData = array();
		$articleData['Article']['brand_id'] = $this->request->data['brand_id'];
		$articleData['Article']['type'] = $this->request->data['type'];
		$articleData['Article']['title'] = $this->request->data['title'];
		$articleData['Article']['content'] = $this->request->data['content'];
		$this->Article->save($articleData);
		$this->redirect(array('controller' => 'dashboard', 'action' => 'brandInfo', '?'=>array('brand_id' => $this->request->data['brand_id'])));die();
	}
	
	public function editArticle(){
		$article_id = $this->request->query['article_id'];
		$conditions = array('Article.id' => $article_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions);
		$article = $this->Article->find('first', $option);
		$this->set('article', $article);
	}
	
	public function updateArticle(){
		$article_id = $this->request->data['article_id'];
		$this->Article->read(null, $article_id);
		$updateArray = array(
						'title' => $this->request->data['name'],
						'content' => $this->request->data['intro']
						);
		$this->Article->set($updateArray);
		$this->Article->save();
		
		$this->redirect(array('controller' => 'dashboard', 'action' => ''));die();
	}
	
	public function delArticle(){
		$this->layout = null;
		if(!empty($this->request->data['article_id'])){
			$article_id= $this->request->data['article_id'];
		}else{
			$article_id= $this->request->query['article_id'];
		}
		$this->Article->delete($article_id);
	}
	
	public function addDealer(){
		
	}
	
	public function saveDealer(){
		$this->Dealer->Create();
		$dealerData = array();
		$dealerData['Dealer']['name'] = $this->request->data['name'];
		$dealerData['Dealer']['prov'] = $this->request->data['prov'];
		$dealerData['Dealer']['city'] = $this->request->data['city'];
		$dealerData['Dealer']['address'] = $this->request->data['address'];
		$dealerData['Dealer']['tel'] = $this->request->data['tel'];
		$dealerData['Dealer']['intro'] = $this->request->data['intro'];
		$this->Dealer->save($dealerData);
		$this->redirect(array('controller' => 'dashboard', 'action' => 'dealers'));die();
	}
	
	public function editDealer(){
		$dealer_id = $this->request->query['dealer_id'];
		$conditions = array('Dealer.id' => $dealer_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions);
		$dealer = $this->Dealer->find('first', $option);
		$this->set('dealer', $dealer);
	}
	
	public function updateDealer(){
		$dealer_id = $this->request->data['dealer_id'];
		$this->Dealer->read(null, $dealer_id);
		$updateArray = array(
						'name' => $this->request->data['name'],
						'intro' => $this->request->data['intro'],
						'prov' => $this->request->data['prov'],
						'city' => $this->request->data['city'],
						'address' => $this->request->data['address'],
						'tel' => $this->request->data['tel'],
						);
		$this->Dealer->set($updateArray);
		$this->Dealer->save();
		
		$this->redirect(array('controller' => 'dashboard', 'action' => 'dealers'));die();
	}
	
	public function delDealer(){
		$this->layout = null;
		if(!empty($this->request->data['dealer_id'])){
			$dealer_id= $this->request->data['dealer_id'];
		}else{
			$dealer_id= $this->request->query['dealer_id'];
		}
		$this->Dealer->delete($dealer_id);
		
		$sql = "delete from brand_dealer_maps where dealer_id=".$dealer_id.";";
		$this->Dealer->query($sql);
		
		if(empty($this->request->data['no_redirect'])){
			$this->redirect(array('controller' => 'dashboard', 'action' => 'dealers'));die();
		}
	}
	
	public function getNewsByBrand(){
		$this->layout = null;
		$brand_id = $this->request->data['brand_id'];
		$this->set('brand_id', $brand_id);
		$conditions = array('Article.brand_id' => $brand_id, 'Article.type' => 'news');
		$option = array('recursive'=>-1, 'conditions' => $conditions, 'order' => 'Article.id desc');
		$news = $this->Article->find('all', $option);
		$this->set('news', $news);
		//debug($news);die();
	}
	
	public function getGuidesByBrand(){
		$this->layout = null;
		$brand_id = $this->request->data['brand_id'];
		$this->set('brand_id', $brand_id);
		$conditions = array('Article.brand_id' => $brand_id, 'Article.type' => 'guide');
		$option = array('recursive'=>-1, 'conditions' => $conditions, 'order' => 'Article.id desc');
		$guides = $this->Article->find('all', $option);
		$this->set('guides', $guides);
	}
	
	public function getDealersByBrand(){
		$this->layout = null;
		$bid = $this->request->data['brand_id'];
		$conditions = array('BrandDealerMap.brand_id' => $bid);
		$option = array('recursive'=>1, 'conditions' => $conditions, 'order' => 'BrandDealerMap.id desc');
		$dealers = $this->BrandDealerMap->find('all', $option);
		$this->set('dealers', $dealers);
		//debug($dealers);die();
	}
	
	public function dealers() {
		$this->paginate = array(
				'Dealer' => array (
				'recursive' => 2,
				'order' => 'Dealer.id desc',
				'limit' => 30,
				'page'=>1)
		);
		$dealers = $this->paginate('Dealer');
		$this->set('dealers', $dealers);
		//debug($dealers);die();
	}
	
	public function products() {
		$this->paginate = array(
				'Product' => array (
				'recursive' => 2,
				'order' => 'Product.id desc',
				'limit' => 30,
				'page'=>1)
		);
		$products = $this->paginate('Product');
		$this->set('products', $products);
	}
	
	public function news() {
		$this->paginate = array(
				'Article' => array (
				'recursive' => 2,
				'conditions' => array('Article.type' => 'news'),
				'order' => 'Article.id desc',
				'limit' => 30,
				'page'=>1)
		);
		$news = $this->paginate('Article');
		$this->set('news', $news);
	}
	
	public function guides() {
		$this->paginate = array(
				'Article' => array (
				'recursive' => 2,
				'conditions' => array('Article.type' => 'guide'),
				'order' => 'Article.id desc',
				'limit' => 30,
				'page'=>1)
		);
		$guides = $this->paginate('Article');
		$this->set('guides', $guides);
	}
	
	public function brandDealers(){
		$brand_id= $this->request->query['brand_id'];
		
		$conditions = array('Brand.id' => $brand_id);
		$option = array('recursive'=>-1, 'conditions' => $conditions,);
		$brand = $this->Brand->find('first', $option);
		$this->set('brand', $brand);
		
		/*$conditions = array('BrandDealerMap.brand_id' => $brand_id);
		$option = array('recursive'=>1, 'conditions' => $conditions);
		$maps = $this->BrandDealerMap->find('all', $option);
		$this->set('maps', $maps);*/
		
		$sql = "select dealer_id from brand_dealer_maps where brand_id=".$brand_id.";";
		$dealerIds = $this->BrandDealerMap->query($sql);
		$dealerIdArray = array();
		foreach($dealerIds as $dealerId){
			$dealerIdArray[] = $dealerId['brand_dealer_maps']['dealer_id'];
		}
		$this->set('dealerIdArray', $dealerIdArray);
		
		//TODO：这个将来经销商多了的话需要改成tab的分省份查询
		$option = array('recursive'=>1, 'order' => 'Dealer.id desc',);
		$dealers = $this->Dealer->find('all', $option);
		$this->set('dealers', $dealers);
	}
	
	public function bindDealer(){
		$brand_id= $this->request->data['brand_id'];
		$dealer_id= $this->request->data['dealer_id'];
		$sql = "delete from brand_dealer_maps where brand_id=".$brand_id." AND dealer_id=".$dealer_id.";";
		$this->BrandDealerMap->query($sql);
		
		$this->BrandDealerMap->Create();
		$mapData = array();
		$mapData['BrandDealerMap']['brand_id'] = $brand_id;
		$mapData['BrandDealerMap']['dealer_id'] = $dealer_id;
		$this->BrandDealerMap->save($mapData);
	}
	
	public function unbindDealer(){
		$brand_id= $this->request->data['brand_id'];
		$dealer_id= $this->request->data['dealer_id'];
		$sql = "delete from brand_dealer_maps where brand_id=".$brand_id." AND dealer_id=".$dealer_id.";";
		$this->BrandDealerMap->query($sql);
	}
}
