<?php
App::uses('AppModel', 'Model');
/**
 * Dealer Model
 *
 * @property BrandDealerMap $BrandDealerMap
 */
class Dealer extends AppModel {

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'BrandDealerMap' => array(
			'className' => 'BrandDealerMap',
			'foreignKey' => 'dealer_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
