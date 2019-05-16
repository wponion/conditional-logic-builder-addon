<?php

namespace WPOnion\Addon;

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

use WPOnion\Addon_Field;

if ( ! class_exists( '\WPOnion\Addon\Conditional_Logic_Helper' ) ) {
	/**
	 * Class Conditional_Logic_Helper
	 *
	 * @package WPOnion\Addon
	 * @author Varun Sridharan <varunsridharan23@gmail.com>
	 * @since 1.0
	 */
	class Conditional_Logic_Helper extends Addon_Field {

		/**
		 * Groups Selected Values.
		 *
		 * @param       $values
		 * @param array $return
		 *
		 * @static
		 * @return array
		 */
		public static function group_values( $values, $return = array() ) {
			if ( is_array( $values ) ) {
				if ( isset( $values['rules'] ) ) {
					foreach ( $values['rules'] as $value ) {
						$return = self::group_values( $value, $return );
					}
				} elseif ( isset( $values['field'] ) && isset( $values['value'] ) ) {
					if ( ! isset( $return[ $values['field'] ] ) ) {
						$return[ $values['field'] ] = array();
					}
					$return[ $values['field'] ][] = $values['value'];
				}
			}

			return $return;
		}

		/**
		 * Returns QueryBuilders Icons.
		 *
		 * @hook wpo_conditional_logic_builder_icons
		 * @static
		 * @return array
		 */
		public static function icons() {
			return apply_filters( 'wpo_conditional_logic_builder_icons', array(
				'add_group'    => 'dashicons dashicons-plus-alt',
				'add_rule'     => 'dashicons dashicons-plus',
				'remove_group' => 'dashicons dashicons-trash',
				'remove_rule'  => 'dashicons dashicons-no-alt',
				'error'        => 'dashicons dashicons-warning',
			) );
		}

		/**
		 * Returns Logic Groups.
		 *
		 * @hook wpo_conditional_logic_builder_groups
		 * @static
		 * @return array
		 */
		public static function logic_groups() {
			return apply_filters( 'wpo_conditional_logic_builder_groups', array(
				'post'    => __( 'Post' ),
				'archive' => __( 'Archive' ),
				'author'  => __( 'Author' ),
				'user'    => __( 'User' ),
				'browser' => __( 'Browser' ),
			) );
		}

		/**
		 * Returns Filters Data.
		 *
		 * @static
		 * @return array
		 */
		public static function filters( $values ) {
			$post = ( isset( $values['post'] ) ) ? $values['post'] : array();

			$element = wponion_field_builder( 'select', '{wpoid}' )
				->ajax( true )
				->select_framework( 'select2' )
				->options( 'posts' )
				->only_field( true )
				->style( 'min-width:250px;' )
				->desc_field( __( 'Simple Description' ) )
				->query_args( array(
					'post_type' => 'any',
				) )
				->name( '{wpoid}' );

			return array(
				array(
					'id'       => 'post',
					'label'    => __( 'Post' ),
					'type'     => 'string',
					'input'    => 'function(rule,input_name) { 
					var $string = \'' . $element->render( $post ) . '\' 
						return $string.replace(/{wpoid}/g,input_name); 
					}',
					'optgroup' => 'post',
					'values'   => array( 'ABC', 'EFG', 'HIJ' ),
				),
				array(
					'id'         => 'price',
					'label'      => 'price',
					'type'       => 'double',
					'validation' => array( 'min' => '0', 'step' => '0.01' ),
				),
			);
		}
	}
}

return Conditional_Logic::instance();
