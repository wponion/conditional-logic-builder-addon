<?php

namespace WPOnion\Field;

use WPOnion\Addon\Conditional_Logic_Helper;
use WPOnion\Field;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

if ( ! class_exists( '\WPOnion\Field\Conditional_Logic_Builder' ) ) {
	/**
	 * Class Conditional_Logic_Builder
	 *
	 * @package WPOnion\Field
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Conditional_Logic_Builder extends Field {
		/**
		 * Fields Assets.
		 *
		 * @return mixed|void
		 */
		public function field_assets() {
			wp_enqueue_script( 'wponion-query-builder' );
			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'wponion-query-builder' );
			wp_enqueue_style( 'select2' );
		}

		protected function output() {
			//var_dump( $this->value );
			var_dump( $this->value );

			echo '<div class="query-builder wponion-query-builder"></div>';
			echo '<div class="query-builder-value"></div>';
			echo '<button class="btn btn-primary parse-json" data-target="basic" type="button">Get rules</button>';
		}


		/**
		 * System Args.
		 *
		 * @return array
		 */
		protected function js_field_args() {
			return array(
				'saved_rules'  => ( ! is_array( $this->value ) ) ? false : $this->value,
				'fieldid'      => $this->name(),
				'querybuilder' => array(
					'icons'     => Conditional_Logic_Helper::icons(),
					'optgroups' => Conditional_Logic_Helper::logic_groups(),
					'filters'   => Conditional_Logic_Helper::filters( Conditional_Logic_Helper::group_values( $this->value ) ),
					/*'filters'   => [
						array(
							'id'    => 'name',
							'label' => 'Name',
							'type'  => 'string',
						),
						array(
							'id'        => 'category',
							'label'     => 'Category',
							'type'      => 'integer',
							'input'     => 'select',
							'values'    => array(
								'1' => 'Books',
								'2' => 'Movies',
								'3' => 'Music',
								'4' => 'Tools',
								'5' => 'Goodies',
								'6' => 'Clothes',
							),
							'operators' => array( 'equal', 'not_equal', 'in', 'not_in', 'is_null', 'is_not_null' ),
						),
						array(
							'id'        => 'in_stock',
							'label'     => 'In stock',
							'type'      => 'integer',
							'input'     => 'radio',
							'values'    => [ 'Yes', 'No' ],
							'operators' => [ 'equal' ],
						),
						array(
							'id'         => 'price',
							'label'      => 'Price',
							'type'       => 'double',
							'validation' => [
								'min'  => 0,
								'step' => 0.01,
							],
						),
						array(
							'id'          => 'id',
							'label'       => 'Identifier',
							'type'        => 'string',
							'placeholder' => '____-____-____',
							'operators'   => [ 'equal', 'not_equal' ],
							'validation'  => array( 'format' => '/^.{4}-.{4}-.{4}$/' ),
						),
					],*/
				),
			);
		}

		protected function field_default() {
			return array();
		}
	}
}
