<?php declare(strict_types = 1);

namespace ChilliPress\Admin;

class Dashboard {
	public function __construct() {
		add_action('wp_dashboard_setup', array($this, 'removeDashboardWidgets') );
	}

	public function removeDashboardWidgets() {
		global $wp_meta_boxes;

		unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	}
}