<?php
// ACF Google Maps
$mapsKey = 'YOUR_KEY';
function my_acf_init() {
	acf_update_setting('google_api_key', $mapsKey);
}
add_action('acf/init', 'my_acf_init');

// ACF Keyboard Shortcuts
function acf_keyboardshortcuts() { ?>
	<script type="text/javascript">
		console.log(`
			---

			ACF keyboard shortcuts:
			A   – new field
			ESC – close field

			---
		`)
		document.addEventListener('keydown', (e) => {
			if (e.key === 'Escape') {
				document.querySelectorAll('.acf-field-object.open a[title="Close Field"]').forEach(btn => btn.click())
			}
			if ((e.target.nodeName === 'BODY' || e.target.nodeName === 'DIV') && e.key === 'a') {
				const addButton = Array.from(document.querySelectorAll('.acf-hl.acf-tfoot a.add-field')).pop()
				if (addButton) addButton.click()
			}
			if (e.key === 's' && e.metaKey === true) {
				e.preventDefault()
				document.querySelector('#publishing-action input[name="save"]').click()
			}
		})
	</script>
<?php }
add_action('acf/input/admin_footer', 'acf_keyboardshortcuts');

// ACF custom field validation
add_filter('acf/validate_value/name=text', 'my_acf_validate_value', 10, 4);
function my_acf_validate_value($valid, $value, $field, $input) {
	if ($valid && strlen(strip_tags($value)) > 250) {
		$valid = 'You can\'t enter more that 250 chars';
	}
	return $valid;
}

// ACF Social Options
add_action( 'init', 'socialOptions' );
function socialOptions(){
  //// ACF Options Page
  if( function_exists('acf_add_options_page') ) {
  	acf_add_options_page(array(
  		'page_title' => 'Social Media',
  		'icon_url' => 'dashicons-thumbs-up',
  		'position' => 56
  	));
  }
  if( function_exists('acf_add_local_field_group') ):


  // ACF Options Fields
  acf_add_local_field_group(array (
  	'key' => 'group_56206f7d247be',
  	'title' => 'Social Media',
  	'fields' => array (
  		array (
  			'key' => 'field_56206fbc26b24',
  			'label' => 'Facebook',
  			'name' => 'facebook',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array (
  			'key' => 'field_56206fcf26b25',
  			'label' => 'Instagram',
  			'name' => 'instagram',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array (
  			'key' => 'field_56206fe026b27',
  			'label' => 'Twitter',
  			'name' => 'twitter',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array (
  			'key' => 'field_56206fde26b26',
  			'label' => 'Pinterest',
  			'name' => 'pinterest',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array (
  			'key' => 'field_56206fe326b28',
  			'label' => 'Youtube',
  			'name' => 'youtube',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array (
  			'key' => 'field_56206fed26b29',
  			'label' => 'Vimeo',
  			'name' => 'vimeo',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array (
  			'key' => 'field_5620702126b2a',
  			'label' => 'LinkedIn',
  			'name' => 'linkedin',
  			'type' => 'url',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  		),
  		array (
  			'key' => 'field_5620702b26b2b',
  			'label' => 'Email',
  			'name' => 'email',
  			'type' => 'text',
  			'instructions' => '',
  			'required' => 0,
  			'conditional_logic' => 0,
  			'wrapper' => array (
  				'width' => '',
  				'class' => '',
  				'id' => '',
  			),
  			'default_value' => '',
  			'placeholder' => '',
  			'prepend' => '',
  			'append' => '',
  			'maxlength' => '',
  			'readonly' => 0,
  			'disabled' => 0,
  		),
  	),
  	'location' => array (
  		array (
  			array (
  				'param' => 'options_page',
  				'operator' => '==',
  				'value' => 'acf-options-social-media',
  			),
  		),
  	),
  	'menu_order' => 0,
  	'position' => 'normal',
  	'style' => 'seamless',
  	'label_placement' => 'top',
  	'instruction_placement' => 'label',
  	'hide_on_screen' => '',
  	'active' => 1,
  	'description' => '',
  ));

  endif;
}
?>
