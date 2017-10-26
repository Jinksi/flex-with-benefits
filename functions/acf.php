<?php
import('/components/SocialList.php');
SocialList::acf();

// ACF Google Maps
function my_acf_init() {
	$mapsKey = 'YOUR_KEY';
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
