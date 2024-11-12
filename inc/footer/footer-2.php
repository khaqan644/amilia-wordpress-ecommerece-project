<?php
	global $smof_data, $amilia_meta;
	$footer_animate = (isset($amilia_meta->_cms_footer_animate) && $amilia_meta->_cms_footer_animate != '') ? $amilia_meta->_cms_footer_animate : '';
?>
<footer id="main-footer" class="cms-footer-layout2-wrap cms-footer-wrapper">
	<div class="footer-white-bg title-lines-container">
		<div class="container">
			<div class="row">
				<div class="col-md-4 <?php echo esc_attr(($footer_animate) ? 'fadeInLeft wow' : ''); ?>" <?php echo esc_attr(($footer_animate) ? 'data-wow-duration="1s"' : ''); ?>>
					<?php dynamic_sidebar('footer-21'); ?>
				</div>
				<div class="col-md-4 <?php echo esc_attr(($footer_animate) ? 'fadeIn wow' : ''); ?>" <?php echo esc_attr(($footer_animate) ? 'data-wow-duration="1s"' : ''); ?>>
					<?php dynamic_sidebar('footer-22'); ?>
				</div>
				<div class="col-md-4 <?php echo esc_attr(($footer_animate) ? 'fadeInRight wow' : ''); ?>" <?php echo esc_attr(($footer_animate) ? 'data-wow-duration="1s"' : ''); ?>>
					<?php dynamic_sidebar('footer-23'); ?>
				</div>
			</div>
		</div>
	</div>
	<?php
		$attr = array(
            'menu' => '',
            'menu_class' => 'footer-menu-wrap',
            'container' => 'nav',
            'container_class' => 'clearfix',
            'container_id' => 'footer-menu',
        );
        $menu_locations = get_nav_menu_locations();
        if(!empty($menu_locations['footer-menu'])){
            $attr['theme_location'] = 'footer-menu';
        }
	?>
	<div class="copyright-container title-lines-container">
		<div class="container">
			<div class="row">
				<div class="col-md-8 <?php echo esc_attr(($footer_animate) ? 'fadeInUp wow' : ''); ?>">
					<div class="footer-menu-container">
						<?php wp_nav_menu( $attr ); ?>
					</div>
				</div>
				<div class="col-md-4 <?php echo esc_attr(($footer_animate) ? 'fadeInUp wow' : ''); ?>">
					<div class="footer-copyright-container">
						<div class="mask-footer-copyright-container"></div>
						<div class="footer-copyright-text">
							<?php echo esc_html(''.$smof_data['copyright']); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>