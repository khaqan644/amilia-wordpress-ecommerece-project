<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() ) {
	return;
}

?>

<form class="woocommerce-shipping-calculator form" action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">
	<section class="shipping-calculator-form">

		<div class="mb-20" id="calc_shipping_country_field">
			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state form-control" rel="calc_shipping_state">
				<option value=""><?php esc_html_e( 'SELECT A COUNTRY', 'wp-amilia' ); ?></option>
				<?php
					foreach( WC()->countries->get_shipping_countries() as $key => $value )
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				?>
			</select>
		</div>
		<div class="row">
			<?php
				$current_cc = WC()->customer->get_shipping_country();
				$current_r  = WC()->customer->get_shipping_state();
				$states     = WC()->countries->get_states( $current_cc );
			?>
			<div class="col-md-6 mb-20 <?php echo (empty($states)) ? 'hidden' : ''; ?>">
				<div class="form-row form-row-wide" id="calc_shipping_state_field">
					<?php
						// Hidden Input
						if ( is_array( $states ) && empty( $states ) ) {

							?><input type="hidden" class="form-control" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_html_e( 'STATE / COUNTY', 'wp-amilia' ); ?>" /><?php

						// Dropdown Input
						} elseif ( is_array( $states ) ) {

							?><span>
								<select name="calc_shipping_state" id="calc_shipping_state" class="form-control" placeholder="<?php esc_html_e( 'STATE / COUNTY', 'wp-amilia' ); ?>">
									<option value=""><?php esc_html_e( 'Select a state&hellip;', 'wp-amilia' ); ?></option>
									<?php
										foreach ( $states as $ckey => $cvalue )
											echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) .'</option>';
									?>
								</select>
							</span><?php

						// Standard Input
						} else {

							?><input type="text" class="input-text form-control" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_html_e( 'STATE / COUNTY', 'wp-amilia' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php

						}
					?>
				</div>
			</div>
			<div class="col-md-6 mb-20">
				<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>
					<div class="form-row form-row-wide" id="calc_shipping_postcode_field">
						<input type="text" class="input-text form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_html_e( 'POSTCODE / ZIP', 'wp-amilia' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
					</div>
				<?php endif; ?>
			</div>
		</div>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>
			<div class="row">
				<div class="col-md-12 mb-20">
					<div class="form-row form-row-wide" id="calc_shipping_city_field">
						<input type="text" class="input-text form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_html_e( 'CITY', 'wp-amilia' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="mb-0"><button type="submit" name="calc_shipping" value="1" class="cms-button medium gray"><?php esc_html_e( 'UPDATE TOTALS', 'wp-amilia' ); ?></button></div>

		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
