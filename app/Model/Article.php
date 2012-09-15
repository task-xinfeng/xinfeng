<?php
App::uses('AppModel', 'Model');
/**
 * Article Model
 *
 * @property Brand $Brand
 */
class Article extends AppModel {

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
