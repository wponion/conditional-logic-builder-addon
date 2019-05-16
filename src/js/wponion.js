jQuery.fn.queryBuilder.define( 'wponion', function() {
	var Selectors = jQuery.fn.queryBuilder.selectors;
	this.on( 'afterCreateRuleFilters', function( e, rule ) {
		window.wponion_field( rule.$el.find( Selectors.rule_filter ) ).reload();
		//rule.$el.find( Selectors.rule_filter ).removeClass( 'form-control' ).select2( options );
	} );

	this.on( 'afterCreateRuleOperators', function( e, rule ) {
		if( e.builder.getOperators( rule.filter ).length > 1 ) {
			window.wponion_field( rule.$el.find( Selectors.rule_operator ) ).reload();
			//rule.$el.find( Selectors.rule_operator ).removeClass( 'form-control' ).select2( options );
		}
	} );
} );
