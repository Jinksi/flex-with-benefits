<?php
///////////////////////////////////////////////////////
// add_image_size( '100x100', 100, 100, true );
// add_image_size( '100x100', 100, 100, true );
add_image_size( '100w', 100, 0, false );
// add_image_size( '200x200', 200, 200, true );
add_image_size( '200w', 200, 0, false );
// add_image_size( '400x400', 400, 400, true );
add_image_size( '400w', 400, 0, false );
// add_image_size( '600x600', 600, 600, true );
add_image_size( '600w', 600, 0, false );
// add_image_size( '800x800', 800, 800, true );
add_image_size( '800w', 800, 0, false );
// add_image_size( '1000x1000', 1000, 1000, true );
// add_image_size( '1000w', 1000, 0, false );
// add_image_size( '1200x1200', 1200, 1200, true );
add_image_size( '1200w', 1200, 0, false );
// add_image_size( '1500x1500', 1500, 1500, true );
// add_image_size( '1500w', 1500, 0, false );
// add_image_size( '1800x1800', 1800, 1800, true );
add_image_size( '1800w', 1800, 0, false );

//////////////////////////////////////////////////////
// IMAGE QUALITY
function gpp_jpeg_quality_callback($arg) {

    return (int)75; // change 100 to whatever you prefer, but don't go below 60

}
add_filter('jpeg_quality', 'gpp_jpeg_quality_callback');

?>
