<?php declare(strict_types = 1);

namespace ChilliPress\Admin;

class Topbar {
	public function __construct() {
		add_action('admin_bar_menu', array($this, 'removeToolbarNode'), 999);
	}

	public function removeToolbarNode($wp_admin_bar) {
		$wp_admin_bar->remove_node('wp-logo');
		$wp_admin_bar->remove_node('new-content');
		$wp_admin_bar->remove_node('updates');
	}
}