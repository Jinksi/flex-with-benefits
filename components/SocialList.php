  <?php
  class SocialList {
    static $defaultProps = [
      'socials' => [
        'facebook',
        'instagram',
        'twitter',
        'pinterest',
        'youtube',
        'vimeo',
        'linkedin',
        'email'
      ]
    ];

    public static function render (array ...$args) {
      $props = array_merge(self::$defaultProps, $args);
      ob_start(); ?>
        <ul class="SocialList">
          <?php for ($i = 0; $i < count($props['socials']); $i++) {
          	$href = get_field($props['socials'][$i], 'option');
          	if (!$href) { continue; }
          	switch ($props['socials'][$i]) {
          		case 'pinterest':
          			$fa = 'pinterest-p';
          			break;
          		case 'email':
          			$fa = 'envelope-o';
          			$href = 'mailto:' . $href;
          			break;
          		default:
          			$fa = $props['socials'][$i];
          	}
          	?>
         	<li class="SocialList--item">
            <a target="_blank" href="<?= $href; ?>"><i class="fa fa-fw fa-<?= $fa; ?>"></i></a>
          </li>
        <?php } ?>
      </ul>
      <?php echo ob_get_clean();
    }

    public static function acf () {
      add_action( 'init', 'socialOptions' );
      function socialOptions(){
        if( function_exists('acf_add_options_page') ) {
          acf_add_options_page(array(
            'page_title' => 'Social Media',
            'icon_url' => 'dashicons-thumbs-up',
            'position' => 56
          ));
        }

        if( function_exists('acf_add_local_field_group') ):
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
    }
  }
