<?php
App::uses('AppModel', 'Model');
/**
 * BrandDealerMap Model
 *
 * @property Brand $Brand
 * @property Dealer $Dealer
 */
class BrandDealerMap extends AppModel {

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
		),
		'Dealer' => array(
			'className' => 'Dealer',
			'foreignKey' => 'dealer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
