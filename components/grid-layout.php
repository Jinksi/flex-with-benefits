<?php $grid_items = get_field('grid-layout'); ?>
<?php if (!$grid_items) {
  $grid_items = array(
    array('title' => 'Lorem'),
    array('title' => 'Ipsum'),
    array('title' => 'Vez'),
    array('title' => 'Umaci'),
    array('title' => 'Dub'),
    array('title' => 'Ivauho')
  );
} ?>

<?php if ($grid_items): ?>
  <?php $grid_rows = array_chunk($grid_items, 3); // split array into rows of 3 ?>
  <section class="grid-layout--section section light">
    <?php foreach ($grid_rows as $grid_row) : ?>
      <div class="grid-layout--row container">
        <?php foreach ($grid_row as $grid_item) : ?>
          <div class="grid-layout--item">
            <div class="background-image" style="background-image: url(https://source.unsplash.com/600x600);"></div>
            <h6 class="grid-layout--item--title relative"><?= $grid_item['title']; ?></h6>
          </div>
        <?php endforeach; //endforeach grid_row ?>
      </div>
    <?php endforeach; // end foreach grid_rows ?>
  </section>
<?php endif; // endif grid_items ?>
