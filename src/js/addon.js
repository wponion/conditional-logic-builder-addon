( function( window ) {
	window.wponion.hooks.addAction( 'wponion_after_fields_reload', 'wponion_conditional_logic_builder', function( $instance ) {
		$instance.init_field( '.wponion-element-conditional_logic_builder', 'conditional_logic_builder' );
	} );

	window.wponion.hooks.addAction( 'wponion_before_init', 'wponion_conditional_logic_builder', function() {
		/*let $group           = this.modify_qb_template( window.wponion._.clone( jQuery.fn.queryBuilder.constructor.templates.group ) );
						let $rule            = this.modify_qb_template( window.wponion._.clone( jQuery.fn.queryBuilder.constructor.templates.rule ) );
						let $filterSelect    = this.modify_qb_template( window.wponion._.clone( jQuery.fn.queryBuilder.constructor.templates.filterSelect ) );
						let $operatorSelect  = this.modify_qb_template( window.wponion._.clone( jQuery.fn.queryBuilder.constructor.templates.operatorSelect ) );
						let $ruleValueSelect = this.modify_qb_template( window.wponion._.clone( jQuery.fn.queryBuilder.constructor.templates.ruleValueSelect ) );*/
		/*$arg.templates = {
							group: $group,
							rule: $rule,
							filterSelect: $filterSelect,
							operatorSelect: $operatorSelect,
							ruleValueSelect: $ruleValueSelect,
						};*/
		var WPO_Conditional_Logic_Builder = window.wponion_create_field( function() {
			if( this.element.find( 'div.query-builder' ).length > 0 ) {
				let $arg      = this.handle_args( this.option( 'querybuilder' ), 'querybuilder' );
				$arg.filters  = this.handle_js_args( $arg.filters );
				let $instance = this.element.find( 'div.query-builder' );
				$instance     = $instance.queryBuilder( $arg );
				if( window.wponion._.isObject( this.option( 'saved_rules', {} ) ) ) {
					$instance.queryBuilder( 'setRules', this.option( 'saved_rules', {} ) );
				}

				window.wponion_field( jQuery( $instance ) ).reload();

				$instance.on( 'afterCreateRuleInput.queryBuilder', function( e, rule ) {
					window.wponion_field( jQuery( rule.$el ) ).reload();
				} );

				$instance.on( 'change', () => {
					this.save_inputs();
				} );

				this.save_inputs();
			}
		}, {
			save_inputs: function() {
				var result = this.element.find( 'div.query-builder' ).queryBuilder( 'getRules' );
				this.element.find( '.query-builder-value' )
					.html( this.object_to_html_input( result, this.option( 'fieldid' ) ) );
			},
			modify_qb_template: function( $data ) {
				$data = $data.replace( /btn/g, 'wpo-btn' );
				$data = $data.replace( /wpo-btn-xs/g, 'wpo-btn-sm' );
				return $data;
			},
			handle_js_args: function( $info ) {
				for( var $Id in $info ) {
					if( $info.hasOwnProperty( $Id ) ) {
						$info[ $Id ] = window.wponion.core.js_func( $info[ $Id ] );
					}
				}
				return $info;
			},
			object_to_html_input: function( $object, $id ) {
				let $return = '';
				if( window.wponion._.isObject( $object ) ) {
					for( var $i in $object ) {
						if( $object.hasOwnProperty( $i ) ) {
							$return += this.object_to_html_input( $object[ $i ], $id + '[' + $i + ']' );
						}
					}

				} else if( !window.wponion._.isObject( $object ) ) {
					$return += '<input type="hidden" name="' + $id + '" value="' + $object + '" />';
				}
				return $return;
			},
		} );

		window.wponion_register_field( 'conditional_logic_builder', function( $elem ) {
			return new WPO_Conditional_Logic_Builder( $elem );
		} );
	} );
} )( window );