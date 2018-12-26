<?php declare(strict_types=1);

namespace ChilliPress\Security;

class HideBackend {

	public function __construct() {
		update_option('whl_page', 'administrace');
	}

	public function initBackendSlug(): void {
		if (!get_option('whl_page')) {
			update_option('whl_page', 'administrace');
		}
	}
}
