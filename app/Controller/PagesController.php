<?php
App::uses('AppController', 'Controller');
class PagesController extends AppController {

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Pages';
	public $layout = 'classic';

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();


	public function index() {
		
	}
	
	public function about(){
	}
	
	public function error400(){
	}
}
