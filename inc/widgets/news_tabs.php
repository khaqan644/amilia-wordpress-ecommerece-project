<?php

add_action('widgets_init', function(){
 global $wp_widget_factory;
 $wp_widget_factory->register('WW_News_Tabs_Widget');
});
class WW_News_Tabs_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'ww_news_tabs', esc_html__('CMS News Tab Widget', 'wp-amilia'), array('description' => esc_html__('Popular post, recent post and comments.', 'wp-amilia'),)
        );
    }

    function widget($args, $instance) {

        extract($args);

        $posts = $instance['posts'];
        $comments = $instance['comments'];
        $tags_count = $instance['tags'];
        $show_popular_posts = isset($instance['show_popular_posts']) ? 'true' : 'false';
        $show_recent_posts = isset($instance['show_recent_posts']) ? 'true' : 'false';
        $show_comments = isset($instance['show_comments']) ? 'true' : 'false';
        $show_tags = isset($instance['show_tags']) ? 'true' : 'false';

        $extra_class = !empty($instance['extra_class']) ? $instance['extra_class'] : "";

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', 'class="'. $extra_class . '"', $before_widget);
        }
        // there is 'class' attribute - append width value to it
        else {
            $before_widget = str_replace('class="', 'class="'. $extra_class . ' ', $before_widget);
        }

        echo ''.$before_widget;
        ?>
        <div class="news-tab">
            <div class="tabs-3">
                <ul id="tabs" class="nav nav-tabs bootstrap-tabs mb-30 clearfix">
                    <?php if ($show_popular_posts == 'true'): ?>
                        <li class="active"><a href="#tab1" data-toggle="tab"><?php echo esc_html__('Popular', 'wp-amilia'); ?></a></li>
                    <?php endif; ?>
                    <?php if ($show_recent_posts == 'true'): ?>
                        <li><a href="#tab2" data-toggle="tab"><?php echo esc_html__('Recent', 'wp-amilia'); ?></a></li>
                    <?php endif; ?>
                    <?php if ($show_comments == 'true'): ?>
                        <li><a href="#tab3" data-toggle="tab"><?php echo esc_html__('Comments', 'wp-amilia'); ?></a></li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content cms-latest-news-wrapper">
                    <?php if ($show_popular_posts == 'true'): ?>
                        <div id="tab1" class="tab-pane active">
                            <?php
                            $popular_posts = new WP_Query('showposts=' . $posts . '&orderby=comment_count&order=DESC');
                            if ($popular_posts->have_posts()):
                                ?>
                                <ul class="news-list cs-popular special-row">
                                    <?php while ($popular_posts->have_posts()): $popular_posts->the_post(); ?>
                                        <li class="cms-blog-item">
                                            <div class="entry-feature entry-feature-image pull-left">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                            <div class="magazine-listing-wrap">
                                                <header class="entry-header">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </header>
                                                <div class="entry-post-info">
                                                    <ul>
                                                        <li class="entry-date">
                                                            <span><?php echo get_the_date('F d') ?></span>
                                                        </li>
                                                        <li class="entry-author">
                                                            <?php the_author_posts_link(); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($show_recent_posts == 'true'): ?>
                        <div id="tab2" class="tab-pane">
                            <?php
                            $recent_posts = new WP_Query('showposts=' . $posts);
                            if ($recent_posts->have_posts()):
                                ?>
                                <ul class="news-list cs-popular special-row">
                                    <?php while ($recent_posts->have_posts()): $recent_posts->the_post(); ?>
                                        <li class="cms-blog-item">
                                            <div class="entry-feature entry-feature-image pull-left">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('thumbnail'); ?>
                                                </a>
                                            </div>
                                            <div class="magazine-listing-wrap">
                                                <header class="entry-header">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </header>
                                                <div class="entry-post-info">
                                                    <ul>
                                                        <li class="entry-date">
                                                            <span><?php echo get_the_date('F d') ?></span>
                                                        </li>
                                                        <li class="entry-author">
                                                            <?php the_author_posts_link(); ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($show_comments == 'true'): ?>
                        <div id="tab3" class="tab-pane">
                            <ul class="news-list sh-list-comment">
                                <?php
                                global $wpdb;
                                $number = $instance['comments'];
                                $recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
                                $the_comments = $wpdb->get_results($recent_comments);
                                foreach ($the_comments as $comment) {
                                    ?>
                                    <li>
                                        <div class="image table-cell">
                                            <a>
                                                <?php echo get_avatar($comment->comment_author_email, '32'); ?>
                                            </a>
                                        </div>
                                        <div class="post-holder table-cell">
                                            <p><?php echo strip_tags($comment->comment_author); ?> says:</p>
                                            <div class="meta">
                                                <a class="comment-text-side" href="<?php echo get_permalink($comment->ID); ?>#comment-<?php echo ''.$comment->comment_ID; ?>" title="<?php echo strip_tags($comment->comment_author); ?> on <?php echo ''.$comment->post_title; ?>"><?php echo wp_trim_words(strip_tags($comment->com_excerpt),12,'') ?>...</a>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
        echo ''.$after_widget;
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['posts'] = $new_instance['posts'];
        $instance['comments'] = $new_instance['comments'];
        $instance['tags'] = $new_instance['tags'];
        $instance['show_popular_posts'] = $new_instance['show_popular_posts'];
        $instance['show_recent_posts'] = $new_instance['show_recent_posts'];
        $instance['show_comments'] = $new_instance['show_comments'];
        $instance['show_tags'] = $new_instance['show_tags'];
        $instance['extra_class'] = $new_instance['extra_class'];

        return $instance;
    }

    function form($instance) {
        $defaults = array('posts' => 3, 'comments' => '3', 'tags' => 20, 'show_popular_posts' => 'on', 'show_recent_posts' => 'on', 'show_comments' => 'on', 'show_tags' => 'on');
        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <p>
            <label for="<?php echo ''.$this->get_field_id('posts'); ?>">Number of popular posts:</label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('posts')); ?>" name="<?php echo esc_attr($this->get_field_name('posts')); ?>" value="<?php echo esc_attr($instance['posts']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('tags')); ?>">Number of recent posts:</label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('tags')); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" value="<?php echo esc_attr($instance['tags']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('comments')); ?>">Number of comments:</label>
            <input class="widefat" style="width: 30px;" id="<?php echo esc_attr($this->get_field_id('comments')); ?>" name="<?php echo esc_attr($this->get_field_name('comments')); ?>" value="<?php echo esc_attr($instance['comments']); ?>" />
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_popular_posts'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_popular_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_popular_posts')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_popular_posts')); ?>">Show popular posts</label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_recent_posts'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_recent_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('show_recent_posts')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_recent_posts')); ?>">Show recent posts</label>
        </p>
        <p>
            <input class="checkbox" type="checkbox" <?php checked($instance['show_comments'], 'on'); ?> id="<?php echo esc_attr($this->get_field_id('show_comments')); ?>" name="<?php echo esc_attr($this->get_field_name('show_comments')); ?>" />
            <label for="<?php echo esc_attr($this->get_field_id('show_comments')); ?>">Show comments</label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('extra_class')); ?>">Extra Class:</label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('extra_class')); ?>" name="<?php echo esc_attr($this->get_field_name('extra_class')); ?>" value="<?php if(isset($instance['extra_class'])){echo esc_attr($instance['extra_class']);} ?>" />
        </p>
        <?php
    }

}
?>