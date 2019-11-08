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

	public static function addOptionPage(array $args): void {
		$defaultArgs = array(
			'icon_url' => 'dashicons-info'
		);

		$args = Arrays::mergeTree($args, $defaultArgs);

		acf_add_options_page($args);
	}

	public static function getField(string $selector, $post_id = FALSE) {
		return get_field($selector, $post_id);
	}

	public static function getText(string $selector, $post_id = FALSE) {
		return self::formatText(self::getField($selector, $post_id));
	}

	public static function formatText($text) {
		return (is_string($text)) ? nl2br($text) : '';
	}

	public static function getWysiwyg(string $selector, $post_id = FALSE) {
		return self::formatWysiwyg(self::getField($selector, $post_id));
	}

	public static function formatWysiwyg($text) {
		return (is_string($text)) ? $text : '';
	}

	public static function getImage(string $selector, $post_id = FALSE) {
		return self::formatImage(self::getField($selector, $post_id));
	}

	public static function formatImage($image) {
		return (is_array($image)) ? $image : array();
	}

	public static function getLink(string $selector, $post_id = FALSE) {
		return self::formatLink(self::getField($selector, $post_id));
	}

	public static function formatLink($link) {
		if (!is_array($link)) {
			return [];
		}

		return array(
			'url'    => $link['url'],
			'target' => (empty($link['target'])) ? '_self' : $link['target'],
			'title'  => $link['title']
		);
	}

	public static function getRepeater(string $selector, $post_id = FALSE) {
		return self::formatRepeater(self::getField($selector, $post_id));
	}

	public static function formatRepeater($repeater) {
		if (!is_array($repeater)) {
			return [];
		}

		return $repeater;
	}

	public static function getSwitch(string $selector, $post_id = FALSE) {
		return self::formatSwith(self::getField($selector, $post_id));
	}

	public static function formatSwith($switch) {
		return ($switch === TRUE);
	}

	public static function getFlexibleContent(string $selector, $post_id = FALSE) {
		return self::formatFlexibleContent(self::getField($selector, $post_id));
	}

	public static function formatFlexibleContent($flexibleContent) {
		return (is_array($flexibleContent))? $flexibleContent : [];
	}
}