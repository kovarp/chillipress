<?php declare(strict_types=1);

namespace kovarp\ChilliPress\Theme;

class Setup {
	public function __construct() {
		$this->disableEmoji();
	}

	public function disableEmoji(): void {
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');

		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
	}
}