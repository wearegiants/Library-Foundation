
<?php
  $temp = $wp_query;
  $wp_query = null;
  $wp_query = new WP_Query();
  $wp_query->query('p=4457&post_type=page');
  while ($wp_query->have_posts()) : $wp_query->the_post();
?>

<div <?php post_class(); ?>>
<h3 class="title">Important Event Information</h3>
<?php the_content(); ?>
</div>

<?php endwhile; ?>

<?php
  $wp_query = null;
  $wp_query = $temp;  // Reset
?>

<?php if ($membership === false) { ?>
<script>
  // Paid Event

  var memberstatus = $('td[data-title="Are you currently an LFLA member?" ]').text();

  if( memberstatus == 'Yes' ){

  } else {

  $(window).load(function(){
    setTimeout(function(){
      $.magnificPopup.open({
        items: {
          src: '<a class="membership-cta" href="/membership"><img src="/assets/img/membership-cta.png" /></a>',
          type: 'inline'
        },
        mainClass: 'mfp-fade',
        type: 'image'
      }, 0);
    }, 4000);
  });

  }
</script>
<?php } ?>