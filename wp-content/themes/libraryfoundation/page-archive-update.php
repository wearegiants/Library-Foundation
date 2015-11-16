<?php Themewrangler::setup_page();get_header(/***Template Name: Archive update */); ?>

<?php get_template_part('templates/page', 'header-simple'); ?>

<div id="archive--wrapper">
  <div id="archive--newest">
    <a class="carouselBtn prevBtn"><i class="ss-icon ss-gizmo">navigateleft</i></a>
    <a class="carouselBtn nextBtn"><i class="ss-icon ss-gizmo">navigateright</i></a>
    <div class="row">
      <header class="desktop-12 tablet-6 mobile-3">
        <div class="row">
          <div class="desktop-6 tablet-3 mobile-half">
            <h2 class="title">Featured</h2>
          </div>
          <div class="desktop-6 tablet-3 mobile-half text-right">
            <div class="row">
              <div class="desktop-8 mobile-1">
                <a href="#" class="search-btn ss-gizmo ss-icon ss-search"></a>
              </div>
              <div class="desktop-4 mobile-2">
                <select name="selecter_basic" id="selecter_basic" class="selected" data-selecter-options='{"external":"true", "customClass":"archive-select","label":"Jump to Section"}'>
                  <option value="#archive--videos">Videos</option>
                  <option value="#archive--podcasts">Podcasts</option>
                  <option value="#archive--photos">Photo Galleries</option>
                  <option value="#archive--featured">Featured</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </header>

      <?php
        $starting_year  = 2005;
        $ending_year    = date("Y");

        for($starting_year; $starting_year <= $ending_year; $starting_year++) {
          $years[] = '<option value="'.$starting_year.'">'.$starting_year.'</option>';
        }
      ?>

      <div id="search-box" class="desktop-8 tablet-6 mobile-3 right">
        <form id="search-archive" method="get" action="/media-archive/category">
          <div class="row">
            <div class="desktop-8 tablet-4 mobile-2"><input type="text" placeholder="Jeff Koons, Un-Private Collection, etc" class="search-input" name="search" size="21" maxlength="120"></div>
            <div class="desktop-2 tablet-1 mobile-1"><select name="date" data-selecter-options='{"label":"Date"}' class="selected"><?php echo implode("\n\r", array_reverse($years));  ?></select></div>
            <div class="desktop-2 tablet-1 mobile-1"><input type="submit" value="search" class="btn"></div>
          </div>
        </form>
      </div>

      <div class="desktop-12 tablet-6 mobile-3">
        <div id="upcoming-events-carousel" class="newest row">
          <?php include locate_template('/templates/media/sticky.php' ); ?>
          <?php include locate_template('/templates/media/newest.php' ); ?>
        </div>
      </div>
    </div>
  </div>
  <div id="archive--videos">
    <div class="row">
      <header class="desktop-12 tablet-6 mobile-3">
        <div class="row">
          <div class="desktop-6 tablet-3 mobile-half">
            <h2 class="title">Videos</h2>
          </div>
          <div class="desktop-6 tablet-3 mobile-half text-right">
            <a href="/media/videos" class="view-all">View All</a>
          </div>
        </div>
      </header>
      <div class="desktop-12 tablet-6 mobile-3">
        <?php include locate_template('/templates/media/videos.php' ); ?>
      </div>
    </div>
  </div>
  <div id="archive--podcasts">
    <div class="row">
      <header class="desktop-12 tablet-6 mobile-3">
        <div class="row">
          <div class="desktop-6 tablet-3 mobile-half">
            <h2 class="title">Podcasts</h2>
          </div>
          <div class="desktop-6 tablet-3 mobile-half text-right">
            <a href="/media/podcasts" class="view-all">View All</a>
          </div>
        </div>
      </header>
      <div class="desktop-12 tablet-6 mobile-3">
        <?php include locate_template('/templates/media/podcasts.php' ); ?>
      </div>
    </div>
  </div>
  <div id="archive--photos">
    <div class="row">
      <header class="desktop-12 tablet-6 mobile-3">
        <div class="row">
          <div class="desktop-6 tablet-3 mobile-half">
            <h2 class="title">Photo Galleries</h2>
          </div>
          <div class="desktop-6 tablet-3 mobile-half text-right">
            <a href="/media/photos" class="view-all">View All</a>
          </div>
        </div>
      </header>
      <div class="desktop-12 tablet-6 mobile-3">
        <?php include locate_template('/templates/media/galleries.php' ); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>