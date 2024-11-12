<?php
class Custom_WC_Widget_Recent_Reviews extends WC_Widget_Recent_Reviews {
	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	 public function widget( $args, $instance ) {
		global $comments, $comment;

		if ( $this->get_cached_widget( $args ) ) {
			return;
		}

		ob_start();

		global $product;

		$number   = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
		$comments = get_comments( array( 'number' => $number, 'status' => 'approve', 'post_status' => 'publish', 'post_type' => 'product' ) );

		if ( $comments ) {
			$this->widget_start( $args, $instance );

			echo '<ul class="product_list_widget">';

			foreach ( (array) $comments as $comment ) {
				$_product = wc_get_product( $comment->comment_post_ID );
				$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
				?>
				<li class="clearfix">
					<a class="cms-featured-wg" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<?php echo ''.$_product->get_image(); ?>
					</a>
					<div class="cms-widget-product-desc">
						<a class="product-title" href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
							<?php echo esc_attr($_product->get_title()); ?>
						</a>
						<?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
						<?php
							printf( '<span class="reviewer">' . _x( 'by %1$s', 'by comment author', 'wp-amilia' ) . '</span>', get_comment_author() );
						?>
					</div>
				</li>
				<?php
			}
			echo '</ul>';
			$this->widget_end( $args );
		}

		$content = ob_get_clean();
		echo wp_kses_post($content);
		$this->cache_widget( $args, $content );
	}
}