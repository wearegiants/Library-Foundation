<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<p>This plugin will remove unused images from your disk. Images are checked from: <strong>Featured Images</strong>,
	<strong>Post content</strong> and <strong>Image Galleries</strong></p>
	<br>
	<p>BE PATIENT. THIS CAN TAKE A LOOOONG TIME TO FINISH!</p>
	<p>
		<button id="cii_start" class="button-primary">GO!</button>
		<span id="loading" style="display: none"></span>
	</p>
	<div id="results"></div>
</div>
