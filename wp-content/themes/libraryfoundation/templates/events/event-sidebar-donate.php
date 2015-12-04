<?php
$post_object = get_field('donation_product');
if( $post_object ):

// override $post
$post = $post_object;
setup_postdata( $post );

?>

<div id="donation-module" class="widget">
<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>
<?php if(get_field('min_donation')): ?>
<small>We ask that you make donation of $<?php the_field('min_donation'); ?> or more. You may also make a contribution over the phone by calling 213.228.7500.</small>
<?php else: ?>
<small>We ask that you make donation of $25 or more. You may also make a contribution over the phone by calling 213.228.7500.</small>
<?php endif; ?>
</div>

<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
<?php endif; ?>