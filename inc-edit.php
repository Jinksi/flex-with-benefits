<?php
if ( is_user_logged_in() ) :
    global $current_user;
    wp_get_current_user();
    edit_post_link( '<i class="fa fa-pencil" aria-hidden="true"></i> <span>Edit Page</span>', '<p class="edit_link">', '</p>' );
endif;
?>
