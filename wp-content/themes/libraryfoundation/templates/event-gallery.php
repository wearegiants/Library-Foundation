<?php $images = get_field('archive_gallery'); ?>
<?php if( $images ): ?>
<div class="event-gallery" itemscope itemtype="http://schema.org/ImageGallery">

<?php $image  = $images[0]; ?>

<?php if( $image ) : ?>
<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="show item_<?php echo $counter; ?>">
<a href="<?php echo $image['url']; ?>" itemprop="contentUrl" data-size="<?php echo $image['width']; ?>x<?php echo $image['height']; ?>">
<img class="img-responsive" src="<?php echo $image['sizes']['footer-module-image']; ?>" alt="<?php echo $image['alt']; ?>" />
</a>
</figure>
<?php endif; ?>

<?php $counter = 1; $i = 0; foreach( $images as $image ): $i++; if ($i != 1): ?>
<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" class="hidden item_<?php echo $counter; ?>">
<a href="<?php echo $image['url']; ?>" itemprop="contentUrl" data-size="<?php echo $image['width']; ?>x<?php echo $image['height']; ?>">
<img class="img-responsive" src="" alt="<?php echo $image['alt']; ?>" />
</a>
</figure>

<?php  $counter++; endif; endforeach; ?>
</div>
<?php endif; ?>