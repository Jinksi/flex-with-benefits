<?php
class InstagramFeed {
  static $defaultProps = array(
    'url' => 'https://instagram.com/instagram',
    'username' => '',
    'postCount' => 10,
    'renderTitle' => true,
    'lazy' => false,
    'legacy' => false
  );

  static function parseInstagramUrl($url) {
    return preg_replace( "/(?:https?:\/\/)(?:www.)?instagram.com\/([\w\d_-]+)\/?/i", '$1', $url );
  }

  static function instagramSourceUrl($username) {
    return 'http://instagram.thrivex.io/' . $username;
  }

	static function scrapeInstagram($username) {
		$cache = new InstagramCache(WP_CONTENT_DIR . '/instagram-cache');
		if (!($insta_source = $cache->get('insta_source'))) {
			$insta_source = file_get_contents(self::instagramSourceUrl($username));
			$cache->set('insta_source', $insta_source);
		}
		$insta_array = json_decode($insta_source, TRUE);
		return $insta_array;
	}

  public static function render(array $args = []) {
    $props = array_merge(self::$defaultProps, $args);
    if (!$props['username']) $props['username'] = self::parseInstagramUrl($props['url']);
    $posts = self::scrapeInstagram($props['username']);
    $classNamePrefix = $props['legacy'] ? 'instagram-banner' : 'InstagramFeed';
    $i = 0;
    ob_start(); ?>
    <div class="<?= $classNamePrefix; ?>">
      <?php if($props['renderTitle']): ?>
    		<a class="<?= $classNamePrefix; ?>--link" href="https://instagram.com/<?= $props['username']; ?>">
          <h4 class="<?= $classNamePrefix; ?>--title">
            <i class="fa fa-instagram"></i> <?= $props['username']; ?>
          </h4>
        </a>
      <?php endif; ?>
  		<div class="<?= $classNamePrefix; ?>--row">
  			<?php foreach ($posts as $post) : $i++; ?>
  				<a
            target="_blank"
            class="<?= $classNamePrefix; ?>--item lazy-parent"
            href="https://instagram.com/p/<?= $post['code'] ?>"
          >
            <?php if ($props['lazy']) { ?>
              <img
                class="lazy-child"
                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                data-src="<?= $post['display_src']; ?>"
                alt="<?= $post['caption']; ?>"
              />
            <?php } else { ?>
              <img src="<?= $post['display_src']; ?>" alt="<?= $post['caption']; ?>" />
            <?php } ?>
          </a>
  				<?php if($i === $props['postCount']) break; ?>
  			<?php endforeach; ?>
  		</div>
  	</div>
    <?php echo ob_get_clean();
  }
}

class InstagramCache {
  function __construct($dir) {
    $this->dir = $dir;
    if (!file_exists($this->dir)) {
      if (!mkdir($this->dir, 0777, true)) {
        trigger_error('Failed to create cache directory');
      }
    }
  }

  private function _name($key) {
    return sprintf("%s/%s", $this->dir, sha1($key));
  }

  public function get($key, $expiration = 3600) {
    if (!is_dir($this->dir) OR !is_writable($this->dir)) {
      return FALSE;
    }
    $cache_path = $this->_name($key);
    if (!@file_exists($cache_path)) {
      return FALSE;
    }
    if (filemtime($cache_path) < (time() - $expiration)) {
      $this->clear($key);
      return FALSE;
    }
    if (!$fp = @fopen($cache_path, 'rb')) {
      return FALSE;
    }
    flock($fp, LOCK_SH);
    $cache = '';
    if (filesize($cache_path) > 0) {
      $cache = unserialize(fread($fp, filesize($cache_path)));
    } else {
      $cache = NULL;
    }
    flock($fp, LOCK_UN);
    fclose($fp);
    return $cache;
  }

  public function set($key, $data) {
    if (!is_dir($this->dir) OR !is_writable($this->dir)) {
      return FALSE;
    }
    $cache_path = $this->_name($key);
    if (!$fp = fopen($cache_path, 'wb')) {
      return FALSE;
    }
    if (flock($fp, LOCK_EX)) {
      fwrite($fp, serialize($data));
      flock($fp, LOCK_UN);
    } else {
      return FALSE;
    }
    fclose($fp);
    @chmod($cache_path, 0777);
    return TRUE;
  }

  public function clear($key) {
    $cache_path = $this->_name($key);
    if (file_exists($cache_path)) {
      unlink($cache_path);
      return TRUE;
    }
    return FALSE;
  }
}
