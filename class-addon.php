<?php

namespace WPOnion\Addon;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

use WPOnion\Addon_Field;

if ( ! class_exists( '\WPOnion\Addon\Conditional_Logic' ) ) {
	/**
	 * Class Conditional_Logic
	 *
	 * @package WPOnion\Addon\Conditional_Logic
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Conditional_Logic extends Addon_Field {
		/**
		 * Conditional_Logic constructor.
		 */
		public function __construct() {
			$this->field_type       = 'conditional_logic_builder';
			$this->field_args       = array();
			$this->field_supports   = 'all';
			$this->field_class_file = 'includes/class-conditional-logic-builder.php';
			parent::__construct( __( 'Conditional Logic Builder' ), __FILE__, '0.1' );
			require_once $this->dir( 'includes/class-helper.php' );
		}

		/**
		 * Registers Assets.
		 */
		public function register_assets() {
			wp_register_script( 'wponion-query-builder-core', $this->url( 'assets/js/query-builder.js' ), array(
				'jquery',
				'wponion-core',
			), $this->version );
			wp_register_script( 'wponion-query-builder', $this->url( 'assets/js/addon.js' ), array( 'wponion-query-builder-core' ), $this->version );

			wp_register_style( 'wponion-query-builder-core', $this->url( 'assets/css/query-builder.min.css' ), array( 'wponion-core' ), $this->version );
			wp_register_style( 'wponion-query-builder', $this->url( 'assets/css/addon.css' ), array( 'wponion-query-builder-core' ), $this->version );
		}
	}
}

return Conditional_Logic::instance();
