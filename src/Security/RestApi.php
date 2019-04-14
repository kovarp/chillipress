<?php

namespace kovarp\ChilliPress\Security;

class RestApi {

	public function __construct() {
		global $configurator;

		$config = $configurator->getConfig();

		if (!isset($config['restApi']['enabled']) || $config['restApi']['enabled'] === false) {
			$this->disableRestApi();
		}
	}

	public function disableRestApi() {
		add_action(
			'rest_api_init',
			array(
				$this,
				'disabledRestApiCallback'
			),
			1
		);
	}

	public function disabledRestApiCallback() {
		header('Content-type: application/json');

		$data = array(
			'code'    => 'rest_api_disabled',
			'message' => 'The JSON API is disabled.'
		);

		echo json_encode( $data );
		die();
	}
}