<?php
global $woocommerce;

$is_there_any_product         = false;
$is_there_any_product_to_sell = false;

ob_start();
?>
<form action="<?php echo esc_url( add_query_arg( 'wootickets_process', 1, $woocommerce->cart->get_cart_url() ) ); ?>" class="cart" method="post" enctype='multipart/form-data'>
	<h2 class="tribe-events-tickets-title"><?php _e( 'Tickets', 'tribe-wootickets' ) ?></h2>



	<?php if( have_rows('related_ticket_groups') ):?>
	<div id="things">
	<?php include locate_template('templates/event-tabs.php'); ?>
	<?php endif; ?>

	<div width="100%" class="tribe-events-tickets">
		<?php
		foreach ( $tickets as $ticket ) {

			global $product;

			if ( class_exists( 'WC_Product_Simple' ) ) {
				$product = new WC_Product_Simple( $ticket->ID );
			} else {
				$product = new WC_Product( $ticket->ID );
			}

			$gmt_offset = ( get_option( 'gmt_offset' ) >= '0' ) ? ' +' . get_option( 'gmt_offset' ) : " " . get_option( 'gmt_offset' );
			$gmt_offset = str_replace( array( '.25', '.5', '.75' ), array( ':15', ':30', ':45' ), $gmt_offset );

			$end_date = null;
			if ( ! empty( $ticket->end_date ) ){
				$end_date = strtotime( $ticket->end_date . $gmt_offset );
			} else {
				$end_date = strtotime( tribe_get_end_date( get_the_ID(), false, 'Y-m-d G:i' ) . $gmt_offset );
			}

			$start_date = null;
			if ( ! empty( $ticket->start_date ) ) {
				$start_date = strtotime( $ticket->start_date . $gmt_offset );
			}

			if ( ( empty( $start_date ) || time() > $start_date ) && ( empty( $end_date ) || time() < $end_date ) ) {

				$is_there_any_product = true;

				echo sprintf( "<input type='hidden' name='product_id[]' value='%d'>", $ticket->ID );

				$ticket_id = $ticket->ID;

				// strip out all whitespace
				$zname_clean = $ticket->name;
				$zname_clean = preg_replace('/[^A-Za-z0-9]/', '', $zname_clean);
				// convert the string to all lowercase
				$zname_clean = strtolower($zname_clean);

				$tickettime = $zname_clean;

				if( have_rows('related_ticket_groups') ) {
					echo "<div id='ticket_$tickettime' class='row boom ticket ticket_$zname_clean'>";

				} else {
					echo "<div id='ticket_$tickettime' class='row boom ticket ticket_$zname_clean'>";
				}

				echo "<div class='desktop-2 woocommerce padded'>";

				if ( $product->is_in_stock() ) {

					$productPrice = $product->get_price();

					if ( $productPrice <= 0 ) {
						$maxQuantity = 2;
					} else {
						$maxQuantity = $product->backorders_allowed() ? '' : $product->get_stock_quantity();
					}

					woocommerce_quantity_input( array( 'input_name'  => 'quantity_' . $ticket->ID,
					                                   'input_value' => 0,
					                                   'min_value'   => 0,
					                                   'max_value'   => $maxQuantity, ) );

					$is_there_any_product_to_sell = true;
				} else {
					echo "<span class='tickets_nostock'>" . esc_html__( 'Out of stock!', 'tribe-wootickets' ) . "</span>";
				}
				echo "</div>";

				echo "<div nowrap='nowrap' class='desktop-10 tickets_name padded'>";

				echo '<h3 class="title">';
				echo $this->get_price_html( $product );
				echo '—';
				echo $ticket->name;
				echo '</h3>';
				echo "</div>";

				echo "<div class='desktop-10 right tickets_description padded'>";
				echo $ticket->description;
				echo "</div>";
				echo "<hr>";

				echo "</div>";
			}

		}

		if ( $is_there_any_product_to_sell ) : ?>
			<div>
				<div colspan="4" class='woocommerce add-to-cart'>



					<button type="submit"
					        class="button alt"><?php esc_html_e( 'RSVP for this Event', 'tribe-wootickets' );?></button>

				</div>
			</div>
		<?php endif ?>
	</div>

<?php if( have_rows('related_ticket_groups') ):?>
	</div>
	<?php endif; ?>


</form>
<?php if( have_rows('related_ticket_groups') ):?>
<?php include locate_template('templates/event-tickets-alt.php'); ?>
<?php else: ?>
<?php include locate_template('templates/event-tickets.php'); ?>
<?php endif; ?>
<?php
$content = ob_get_clean();
if ( $is_there_any_product ) {
	echo $content;
}