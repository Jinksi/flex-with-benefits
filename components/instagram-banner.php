<section class="section instagram-banner">
  <?php
  $instagram = explode('/', get_field( "instagram", 'options' ));
  $account = $instagram[count($instagram) - 1];
  $number = 10;
  ?>
  <h4 class="uppercase title sans-serif"><i class="fa fa-instagram"></i>
    <a target="_blank"
    href="http://instagram.com/<?php echo $account; ?>">
    @<?php echo $account; ?></a>
  </h4>
  <div class="row">
    <?php
    $results = scrape_insta($account);
    //An example of where to go from there
    $count = 0;
    foreach ($results as $item) {
      $count++;
      if($count >= $number){ continue; }
      echo '<a target="_blank" class="item" href="http://instagram.com/p/'.$item['code'].'"><img src="'.$item['display_src'].'"></a>';
    }
    ?>
  </div>
</section>
