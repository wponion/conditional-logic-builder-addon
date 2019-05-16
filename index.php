<?php
/**
 * Plugin Name: WPOnion Conditional Logic Builder
 * Plugin URI: https://github.com/wponion/conditional-logic-builder-addon
 * Description: Simple Addon Which Providers An Interface for End Users To Build Custom Logis Based On Their Needs.
 * Version: 0.1
 * Author: varunsridharan
 * Author URI: https://varunsridharan.in
 * Text Domain: wponion-conditional-logic-builder-addon
 * Domain Path: /i18n/
 */


if ( ! function_exists( 'wponion_conditional_logic_addon_register_v01' ) ) {
	add_action( 'wponion_before_addons_load', 'wponion_conditional_logic_builder_addon_register_v01' );

	/**
	 * Registers This Addon With WPOnion.
	 * Since Its Version Based Its Required To Change Adodn Name For Every release.
	 */
	function wponion_conditional_logic_builder_addon_register_v01() {
		wponion_register_addon( __( 'Conditional Logic Builder' ), '0.1', __DIR__ . '/class-addon.php' );
	}
}
