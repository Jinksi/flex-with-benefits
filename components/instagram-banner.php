<?php
function scrape_insta($username) {
	$insta_source = file_get_contents('http://instagram.com/'.$username.'/media');
	$insta_array = json_decode($insta_source, TRUE);
	$latest_array = $insta_array['items'];
	return $latest_array;
}
?>

<section class="instagram-banner--section section">
  <?php
  $instagram = explode('/', get_field( "instagram", 'options' ));
  $account = $instagram[count($instagram) - 1];
  $account = $account ? $account : 'instagram';
  $number = 10;
  ?>
  <h4 class="instagram-banner--title sans-serif"><i class="fa fa-instagram"></i>
    <a target="_blank"
    href="http://instagram.com/<?php echo $account; ?>">
    @<?php echo $account; ?></a>
  </h4>
  <div class="instagram-banner--row">
    <?php
    $results = scrape_insta($account);
    $count = 0;
    foreach ($results as $item) {
      $count++;
      if($count >= $number){ continue; }
      echo '<a target="_blank" class="instagram-banner--item" href="'.$item['link'].'"><img src="'.$item['images']['standard_resolution']['url'].'"></a>';
    }
    ?>
  </div>
</section>
