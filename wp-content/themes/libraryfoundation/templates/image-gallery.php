<?php 
  if ( is_tax() ) {
    $images = get_sub_field('gallery', $taxTerm );
  } else {
    $images = get_sub_field('gallery' ); 
  }
  if( $images ):
?>

<div id="image-gallery">
  <div class="row">
    <div class="desktop-12">
      <div class="royalslider rsMinW">
        <?php foreach( $images as $image ): ?>
        <div class="rsContent">
          <img class="rsImg" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
          <div class="rsABlock meta" data-move-effect="bottom"><p><?php echo $image['caption']; ?></p></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<?php endif; ?>
