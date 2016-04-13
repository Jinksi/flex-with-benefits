<?php

if ( is_user_logged_in() ) :

	global $current_user;

	if (is_category()){
			edit_term_link( 'Edit Page', '<p class="edit_link"> Logged in as '. $current_user->user_login . '<span></span>','</p>', null, true );
	} elseif (is_tax()){
			edit_term_link( 'Edit Page', '<p class="edit_link"> Logged in as '. $current_user->user_login . '<span></span>','</p>', null, true );
	} elseif (is_tag()){
		edit_tag_link( 'Edit Page', '<p class="edit_link"> Logged in as '. $current_user->user_login . '<span></span>','</p>', null, true  );
	} else {
		edit_post_link( 'Edit Page', '<p class="edit_link"> Logged in as '. $current_user->user_login . '<span></span>', '</p>' );
	}

endif;

?>
