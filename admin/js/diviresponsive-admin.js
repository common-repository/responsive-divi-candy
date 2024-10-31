jQuery(window).on('load', function () {
	addObserver();     
});


/**
 * Add the Observer to check changes in the Divi Builder
 * 
 *
 * @since    1.0.0
 * 
 */
function addObserver(){

	var elem = document.querySelector('#et-fb-app');
			
	// Options for the observer (which mutations to observe)
	const config = { attributes: true, childList: true, subtree: true };

	// Callback function to execute when mutations are observed
	const callback = function(mutationsList, observer) {
		
		// Use traditional 'for loops' for IE 11
		for(const mutation of mutationsList) {
			if (mutation.type === 'childList') {
				if(mutation.addedNodes){
					for(const addedNode of mutation.addedNodes){
						checkChildNodes(addedNode, 'et-fb-dr_row_stacking_order_tablet', 'et_pb_row', 'switch');
						checkChildNodes(addedNode, 'et-fb-dr_row_stacking_order_mobile', 'et_pb_row', 'switch');

						checkChildNodes(addedNode, 'et-fb-dr_column_stacking_order_tablet', 'et_pb_column', 'list');
						checkChildNodes(addedNode, 'et-fb-dr_column_stacking_order_mobile', 'et_pb_column', 'list');

						checkChildNodes(addedNode, 'et-fb-dr_row_number_column_tablet', 'et_pb_column', 'list');
						checkChildNodes(addedNode, 'et-fb-dr_row_number_column_mobile', 'et_pb_column', 'list');
					}
				}
			}
			if (mutation.type === 'attributes'){
				checkFieldValue(mutation, 'et-fb-dr_row_stacking_order_tablet', 'et_pb_row', 'switch');
				checkFieldValue(mutation, 'et-fb-dr_row_stacking_order_mobile', 'et_pb_row', 'switch');

				checkFieldValue(mutation, 'et-fb-dr_column_stacking_order_tablet', 'et_pb_column', 'list');
				checkFieldValue(mutation, 'et-fb-dr_column_stacking_order_mobile', 'et_pb_column', 'list');

				checkFieldValue(mutation, 'et-fb-dr_row_number_column_tablet', 'et_pb_row', 'list');
				checkFieldValue(mutation, 'et-fb-dr_row_number_column_mobile', 'et_pb_row', 'list');
			}

		}
	};

	// Create an observer instance linked to the callback function
	const observer = new MutationObserver(callback);

	if(elem){
		// Start observing the target node for configured mutations
		observer.observe(elem, config);
	}
}




/**
 * Check if the id is found in the mutation Node
 * 
 * @since    1.0.0
 * 
 * @param Node	Mutation Node
 * @param string	Id to check
 * @param string	type to check
 * @param string	selector to check
 */
function getFieldValue( id, type, selector ){
	if(type == 'et_pb_row'){
		if(selector == 'switch'){
			return jQuery("#".concat(id)).val();
		}
		if(selector == 'list'){
			return jQuery("#".concat(id).concat(" li")).attr('data-value');
		}
	}

	if(type == 'et_pb_column'){	
		return jQuery("#".concat(id).concat(" li")).attr('data-value');
	}
}

/**
 * Check if the id is found in the mutation Node
 * 
 * @since    1.0.0
 * 
 * @param Node	Mutation Node
 * @param string	Id to check
 */
function checkChildNodes( node, id, type, selector ){
	if(node.id && node.id.includes(id)){
		addClassesToField( id, type, selector );
	}
	if( !node.childNodes )
		return false;

	for(const childNode of node.childNodes){
		checkChildNodes(childNode, id, type, selector);
	}
}


/**
 * Check if the id is present in the DOM
 * 
 * @since    1.0.0
 * 
 * @param string	Id to check
 */
function checkFieldValue( mutation, id, type, selector ){
	var fieldValue = document.getElementById(id);
	
	if(fieldValue){
		if(mutation.target.id == id){
			addClassesToField(id, type, selector);
		}
	}
}


/**
 * Add or Remove the custom classes 
 * 
 * @since    1.0.0
 * 
 * @param string	Id to check
 */
function addClassesToField( id, type, selector ){

	// existing classes
	var existing_classes = jQuery('#et-fb-module_class').val();

	var new_classes = existing_classes;

	if(id == 'et-fb-dr_row_stacking_order_tablet' && getFieldValue(id, type, selector) == 'on' && !new_classes.includes('dr_row_tablet')){
		new_classes = new_classes.concat(' ', 'dr_row_tablet')
	} 
	if(id == 'et-fb-dr_row_stacking_order_tablet' && getFieldValue(id, type, selector) == 'off'){
		var new_classes = new_classes.split(" ").filter(function(custom_class) {
			return custom_class != 'dr_row_tablet';
		}).join(' ');
	}

	if(id == 'et-fb-dr_row_stacking_order_mobile' && getFieldValue(id, type, selector) == 'on' && !new_classes.includes('dr_row_mobile')){
		new_classes = new_classes.concat(' ', 'dr_row_mobile')
	} 
	if(id == 'et-fb-dr_row_stacking_order_mobile' && getFieldValue(id, type, selector) == 'off'){
		var new_classes = new_classes.split(" ").filter(function(custom_class) {
			return custom_class != 'dr_row_mobile';
		}).join(' ');
	}

	var row_special_tablet_col_classes = [
		'dr_row_two_col_tablet',
		'dr_row_three_col_tablet',
		'dr_row_four_col_tablet'
	];

	if(id == 'et-fb-dr_row_number_column_tablet'){
		var new_classes = new_classes.split(" ").filter(function(custom_class) {
			return !(row_special_tablet_col_classes.includes(custom_class));
		}).join(' ');

		if(getFieldValue(id, type, selector) == 'two' && !new_classes.includes('dr_row_two_col_tablet')){
			new_classes = new_classes.concat(' ', 'dr_row_two_col_tablet')
		}
		if(getFieldValue(id, type, selector) == 'three' && !new_classes.includes('dr_row_three_col_tablet')){
			new_classes = new_classes.concat(' ', 'dr_row_three_col_tablet')
		}
		if(getFieldValue(id, type, selector) == 'four' && !new_classes.includes('dr_row_four_col_tablet')){
			new_classes = new_classes.concat(' ', 'dr_row_four_col_tablet')
		}
	}

	var row_special_mobile_col_classes = [
		'dr_row_two_col_mobile',
		'dr_row_three_col_mobile',
		'dr_row_four_col_mobile'
	];

	if(id == 'et-fb-dr_row_number_column_mobile'){
		var new_classes = new_classes.split(" ").filter(function(custom_class) {
			return !(row_special_mobile_col_classes.includes(custom_class));
		}).join(' ');

		if(getFieldValue(id, type, selector) == 'two' && !new_classes.includes('dr_row_two_col_mobile')){
			new_classes = new_classes.concat(' ', 'dr_row_two_col_mobile')
		}
		if(getFieldValue(id, type, selector) == 'three' && !new_classes.includes('dr_row_three_col_mobile')){
			new_classes = new_classes.concat(' ', 'dr_row_three_col_mobile')
		}
		if(getFieldValue(id, type, selector) == 'four' && !new_classes.includes('dr_row_four_col_mobile')){
			new_classes = new_classes.concat(' ', 'dr_row_four_col_mobile')
		}
	}



	var column_special_tablet_classes = [
		'dr_column_tablet_one',
		'dr_column_tablet_two',
		'dr_column_tablet_three',
		'dr_column_tablet_four',
		'dr_column_tablet_five',
		'dr_column_tablet_six'
	];

	if(id == 'et-fb-dr_column_stacking_order_tablet'){
		var new_classes = new_classes.split(" ").filter(function(custom_class) {
			return !(column_special_tablet_classes.includes(custom_class));
		}).join(' ');

		if(getFieldValue(id, type, selector) == 'one' && !new_classes.includes('dr_column_tablet_one')){
			new_classes = new_classes.concat(' ', 'dr_column_tablet_one')
		}
		if(getFieldValue(id, type, selector) == 'two' && !new_classes.includes('dr_column_tablet_two')){
			new_classes = new_classes.concat(' ', 'dr_column_tablet_two')
		}
		if(getFieldValue(id, type, selector) == 'three' && !new_classes.includes('dr_column_tablet_three')){
			new_classes = new_classes.concat(' ', 'dr_column_tablet_three')
		}
		if(getFieldValue(id, type, selector) == 'four' && !new_classes.includes('dr_column_tablet_four')){
			new_classes = new_classes.concat(' ', 'dr_column_tablet_four')
		}
		if(getFieldValue(id, type, selector) == 'five' && !new_classes.includes('dr_column_tablet_five')){
			new_classes = new_classes.concat(' ', 'dr_column_tablet_five')
		}
		if(getFieldValue(id, type, selector) == 'six' && !new_classes.includes('dr_column_tablet_six')){
			new_classes = new_classes.concat(' ', 'dr_column_tablet_six')
		}
	}

	var column_special_mobile_classes = [
		'dr_column_mobile_one',
		'dr_column_mobile_two',
		'dr_column_mobile_three',
		'dr_column_mobile_four',
		'dr_column_mobile_five',
		'dr_column_mobile_six'
	];

	if(id == 'et-fb-dr_column_stacking_order_mobile'){
		var new_classes = existing_classes.split(" ").filter(function(custom_class) {
			return !(column_special_mobile_classes.includes(custom_class));
		}).join(' ');

		if(getFieldValue(id, type, selector) == 'one' && !new_classes.includes('dr_column_mobile_one')){
			new_classes = new_classes.concat(' ', 'dr_column_mobile_one')
		}
		if(getFieldValue(id, type, selector) == 'two' && !new_classes.includes('dr_column_mobile_two')){
			new_classes = new_classes.concat(' ', 'dr_column_mobile_two')
		}
		if(getFieldValue(id, type, selector) == 'three' && !new_classes.includes('dr_column_mobile_three')){
			new_classes = new_classes.concat(' ', 'dr_column_mobile_three')
		}
		if(getFieldValue(id, type, selector) == 'four' && !new_classes.includes('dr_column_mobile_four')){
			new_classes = new_classes.concat(' ', 'dr_column_mobile_four')
		}
		if(getFieldValue(id, type, selector) == 'five' && !new_classes.includes('dr_column_mobile_five')){
			new_classes = new_classes.concat(' ', 'dr_column_mobile_five')
		}
		if(getFieldValue(id, type, selector) == 'six' && !new_classes.includes('dr_column_mobile_six')){
			new_classes = new_classes.concat(' ', 'dr_column_mobile_six')
		}
	} 

	// chnage value of class input filed if classes changed
	if (new_classes != existing_classes){
		jQuery("input[name='module_class']").attr('value', new_classes).val(new_classes);
		jQuery('input[name="module_class"]').focus();
		jQuery('input[name="module_class"]').blur();
	}
}


