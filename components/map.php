<?php
const $mapsKey = 'YOUR_KEY';
wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key='. $mapsKey .'&callback=initMap' );
function my_acf_init() {
	acf_update_setting('google_api_key', $mapsKey);
}
add_action('acf/init', 'my_acf_init');

$location = get_field('location');

if ($location): ?>
  <section class="map--section light">
    <div class="acf-map">
      <div class="marker"
        data-lat="<?= $location['lat']; ?>"
        data-lng="<?= $location['lng']; ?>"
      ></div>
    </div>
  </section>
<?php endif; ?>
