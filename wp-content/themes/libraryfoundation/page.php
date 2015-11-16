<?php

  if ( is_page( 'cart' ) || is_page( 'checkout' ) ) {

    include locate_template('page-cart.php' );

  } elseif ( is_page( 'aloud' ) ) {

    include locate_template('page-aloud.php' );

  } elseif ( is_page( 'blog' ) ) {

    //include locate_template('page-blog-temp.php' );

  } elseif ( is_page( 'archive' ) ) {

    include locate_template('page-archive.php' );

  } elseif ( is_page( 'board' ) ) {

    include locate_template('page-board.php' );

  } elseif ( is_page( 'council-board' ) ) {

    include locate_template('page-board.php' );

  } elseif ( is_page( 'about' ) ) {

    include locate_template('page-about.php' );

  } elseif ( is_page( 'membership' ) ) {

    include locate_template('page-membership.php' );

  } elseif ( is_page( 'bibliophiles' ) ) {

    include locate_template('page-bibliophiles.php' );

  } elseif ( is_page( 'young-literati' ) ) {

    include locate_template('page-membership.php' );

  } elseif ( is_page( 'thanks' ) ) {

    include locate_template('page-confirmation.php' );

  } elseif ( is_page( 'protected' ) ) {

    include locate_template('page-protected.php' );

  } else {

    include locate_template('page-default.php' );

  }

?>