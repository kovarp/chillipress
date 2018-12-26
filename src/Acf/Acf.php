<?php declare(strict_types=1);

namespace kovarp\ChilliPress\Acf;

use Nette\Utils\Arrays;

class Acf {
	public static function addGroup(array $args): void {
		$defaultArgs = array(
			'title'           => $args['key'],
			'fields'          => array(),
			'label_placement' => 'left'
		);

		$args = Arrays::mergeTree($args, $defaultArgs);

		acf_add_local_field_group($args);
	}

	public static function addField(array $args): void {
		$defaultArgs = array(
			'key'   => 'field_' . $args['name'],
			'label' => $args['name'],
			'type'  => 'text'
		);

		$args = Arrays::mergeTree($args, $defaultArgs);

		acf_add_local_field($args);
	}

	public static function getField(string $selector, $post_id) {
		return get_field($selector, $post_id);
	}

	public static function addOptionPage(array $args): void {
		$defaultArgs = array(
			'icon_url' => 'dashicons-info'
		);

		$args = Arrays::mergeTree($args, $defaultArgs);

		acf_add_options_page($args);
	}
}