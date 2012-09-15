<?php
App::uses('AppModel', 'Model');
/**
 * Product Model
 *
 * @property Brand $Brand
 */
class Product extends AppModel {

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Brand' => array(
			'className' => 'Brand',
			'foreignKey' => 'brand_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
