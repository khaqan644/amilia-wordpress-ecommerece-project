<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$category_link = $first_text = $last_text = $el_class = '';
$post_in_page = (!empty($atts['post_in_page'])) ? $atts['post_in_page'] : 3;
$latest_title = (!empty($atts['latest_title'])) ? $atts['latest_title'] : '';
$cms_viewall_text = (!empty($atts['cms_viewall_text'])) ? $atts['cms_viewall_text'] : esc_html__('OUR BLOG', 'wp-amilia');
$categories_name = (!empty($atts['categories_name'])) ? $atts['categories_name'] : '';

if (!empty($categories_name)) {
	$category_id = get_cat_ID( $categories_name );
	$category_link = get_category_link( $category_id );
} else {
	$category_link = '#';
}

$args_query = array(
    'posts_per_page'   => $post_in_page,
    'category__in' => $category_id,
    'orderby'       => 'post_date',
    'order'         => 'DESC'
);

switch ($post_in_page) {
	case 4:
		$el_class = 'col-sm-6 col-md-3 col-lg-3';
		break;
	case 6:
		$el_class = 'col-sm-6 col-md-2 col-lg-2';
		break;
	
	default:
		$el_class = 'col-sm-6 col-md-4 col-lg-4';
		break;
}

$recent_posts = new WP_Query($args_query);

$text_array = explode('|', $latest_title);
for ($i=0; $i < count($text_array); $i++) { 
	if (($i + 1) == count($text_array)) {
		$last_text = '<span class="bold">'.$text_array[$i].'</span>';
	}
	else {
		$first_text = $text_array[$i].' ';
	}
}
?>

<div class="row cms-latest-news-wrapper cms-latest-layout-columns">
	<?php if (!empty($latest_title) || ((isset($atts['cms_viewall']) && $atts['cms_viewall'] == true)) ) : ?>
	    <div class="latest-title col-xs-12">
	    	<h2 class="section-title">
	    		<?php echo esc_html($first_text.$last_text); ?>
	    		<?php if(isset($atts['cms_viewall']) && $atts['cms_viewall'] == true): ?>
	    			<a class="section-more" href="<?php echo esc_url($category_link);?>"><?php echo esc_attr($cms_viewall_text); ?></a>
	    		<?php endif;?>
	    	</h2>
	    </div>
	<?php endif; ?>

	<?php if ($recent_posts->have_posts()) : ?>
		<?php $i = 0; while($recent_posts->have_posts()) : $recent_posts->the_post(); global $post; ?>
			<div class="cms-blog-item wow fadeIn pb-70 <?php echo esc_attr($el_class); ?>" data-wow-delay="<?php echo esc_attr(($i*200)); ?>ms">
    			<div class="entry-feature entry-feature-image mb-25">
    				<a href="<?php the_permalink(); ?>">
    					<?php the_post_thumbnail('portfolio-wide'); ?>
    				</a>
    			</div>
    			<header class="entry-header">
					<h3 class="entry-title">
				    	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				    </h3>
				</header>
				<div class="post-info">
			        <ul>
			            <li class="entry-date">
			                <span><?php echo get_the_date('F d') ?></span>
			            </li>
			            <li class="entry-author">
			                <?php the_author_posts_link(); ?>
			            </li>         
			        </ul>
			    </div>
				<div class="entry-content">
					<?php echo wp_trim_words(get_the_excerpt(),20,'') ?>
				</div>
				<footer class="entry-footer">
				    <?php amilia_archive_readmore(); ?>
				    <!-- .readmore link -->
				</footer>
    		</div>
		<?php $i++; endwhile; ?>
	<?php endif; ?>
</div>