<?php
define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . '/core');

require_once (CORE . '/init.php');

if (! isset($content_width)) {
    $content_width = 620;
}

if (! function_exists('huynhtu_theme_setup')) {

    function huynhtu_theme_setup($param)
    {
        $language_folder = THEME_URL . '/languges';
        load_theme_textdomain('huynhtu', $language_folder);

        add_theme_support('post-thumbnails');

        add_theme_support('post-formats', [
            'image',
            'video',
            'gallery',
            'quote',
            'link'
        ]);

        /* Tạo menu cho theme */
        register_nav_menu('primary-menu', __('Primary Menu', 'huynhtu'));

        /* Tạo sidebar cho theme */
        $sidebar = array(
            'name' => __('Main Sidebar', 'huynhtu'),
            'id' => 'main-sidebar',
            'description' => 'Main sidebar for huynhtu theme',
            'class' => 'main-sidebar',
            'before_title' => '<h3 class="widgettitle">',
            'after_sidebar' => '</h3>'
        );
        register_sidebar($sidebar);
    }
    add_action('init', 'huynhtu_theme_setup');
}

/**
 * @ Thiết lập hàm hiển thị logo
 * @ huynhtu_logo()
 */
if (! function_exists('huynhtu_logo')) {

    function huynhtu_logo()
    {
        ?>
<div class="logo">
	<div class="site-name">
         <?php

        if (is_home()) {
            printf('<h1><a href="%1$s" title="%2$s">%3$s</a></h1>', get_bloginfo('url'), get_bloginfo('description'), get_bloginfo('sitename'));
        } else {
            printf('<a href="%1$s" title="%2$s">%3$s</a>', get_bloginfo('url'), get_bloginfo('description'), get_bloginfo('sitename'));
        } // endif ?>
             </div>
	<div class="site-description"><?php bloginfo( 'description' ); ?></div>
</div>
<?php
    }
}

/**
 * @ Thiết lập hàm hiển thị menu
 * @ huynhtu_menu( $slug )
 * *
 */
if (! function_exists('huynhtu_menu')) {

    function huynhtu_menu($slug)
    {
        $menu = array(
            'theme_location' => $slug,
            'container' => 'nav',
            'container_class' => $slug
        );
        wp_nav_menu($menu);
    }
}

/**
 * @ Tạo hàm phân trang cho index, archive.
 * @ Hàm này sẽ hiển thị liên kết phân trang theo dạng chữ: Newer Posts & Older Posts
 * @ huynhtu_pagination()
 */
if (! function_exists('huynhtu_pagination')) {

    function huynhtu_pagination()
    {
        /*
         * Không hiển thị phân trang nếu trang đó có ít hơn 2 trang
         */
        if ($GLOBALS['wp_query']->max_num_pages < 2) {
            return '';
        }
        ?>
<nav class="pagination" role="navigation">
     		<?php if ( get_next_post_link() ) : ?>
     		<div class="prev"><?php next_posts_link( __('Older Posts', 'huynhtu') ); ?></div>
     			<?php endif; ?>
           		<?php if ( get_previous_post_link() ) : ?>
     		<div class="next"><?php previous_posts_link( __('Newer Posts', 'huynhtu') ); ?></div>
 			<?php endif; ?>
      	</nav><?php
    }
}

/**
 * @ Hàm hiển thị ảnh thumbnail của post.
 * @ Ảnh thumbnail sẽ không được hiển thị trong trang single
 * @ Nhưng sẽ hiển thị trong single nếu post đó có format là Image
 * @ huynhtu_thumbnail( $size )
 */
if (! function_exists('huynhtu_thumbnail')) {

    function huynhtu_thumbnail($size)
    {
        // Chỉ hiển thumbnail với post không có mật khẩu
        if (! is_single() && has_post_thumbnail() && ! post_password_required() || has_post_format('image')) {
             echo "<figure class='post-thumbnail'>";
             the_post_thumbnail( $size ); 
             echo "</figure>";
        }
    }
}
/**
 * @ Hàm hiển thị tiêu đề của post trong .entry-header
 * @ Tiêu đề của post sẽ là nằm trong thẻ <h1> ở trang single
 * @ Còn ở trang chủ và trang lưu trữ, nó sẽ là thẻ <h2>
 * @ huynhtu_entry_header()
 */
if (! function_exists('huynhtu_entry_header')) {

    function huynhtu_entry_header()
    {
        if (is_single()) :
            ?>
<h1 class="entry-title">
	<a href=" <?php the_permalink(); ?>" rel="bookmark"
		title="<?php the_title_attribute(); ?>">
<?php the_title(); ?>
</a>
</h1>
<?php else : ?>
<h2 class="entry-title">
	<a href=" <?php the_permalink(); ?>" rel="bookmark"
		title="<?php the_title_attribute(); ?>">
<?php the_title(); ?>
</a>
</h2><?php
        endif;
    }
}
/**
 * @ Hàm hiển thị thông tin của post (Post Meta)
 * @ huynhtu_entry_meta()
 * *
 */
if (! function_exists('huynhtu_entry_meta')) {

    function huynhtu_entry_meta()
    {
        if (! is_page()) :
            echo '<div class="entry-meta">';
            // Hiển thị tên tác giả, tên category và ngày tháng đăng bài
            printf(__('<span class="author">Posted by %1$s</span>', 'huynhtu'), get_the_author());
            printf(__('<span class="date-published"> at %1$s</span>', 'huynhtu'), get_the_date());
            printf(__('<span class="category"> in %1$s</span>', 'huynhtu'), get_the_category_list(', '));
            // Hiển thị số đếm lượt bình luận
            if (comments_open()) :
                echo ' <span class="meta-reply">';
                comments_popup_link(__('Leave a comment', 'huynhtu'), __('One comment', 'huynhtu'), __('% comments', 'huynhtu'), __('Read all comments', 'huynhtu'));
                echo '</span>';
                endif;

            echo '</div>';
                endif;

    }
}

/*
 * Thêm chữ Read More vào excerpt
 */
function huynhtu_readmore()
{
    return '...<a class="read-more" href="' . get_permalink(get_the_ID()) . '">' . __('Read More', 'huynhtu') . '</a>';
}
add_filter('excerpt_more', 'huynhtu_readmore');
/**
 * @ Hàm hiển thị nội dung của post type
 * @ Hàm này sẽ hiển thị đoạn rút gọn của post ngoài trang chủ (the_excerpt)
 * @ Nhưng nó sẽ hiển thị toàn bộ nội dung của post ở trang single (the_content)
 * @ huynhtu_entry_content()
 */
if (! function_exists('huynhtu_entry_content')) {

    function huynhtu_entry_content()
    {
        if (! is_single() && !is_page()) :
            the_excerpt();
        else :
            the_content();
            /*
             * Code hiển thị phân trang trong post type
             */
            $link_pages = array(
                'before' => __('Page:', 'huynhtu'),
                'after' => '',
                'nextpagelink' => __('Next page', 'huynhtu'),
                'previouspagelink' => __('Previous page', 'huynhtu')
            );
            wp_link_pages($link_pages);
        endif;
    }
}
/**
 * @ Hàm hiển thị tag của post
 * @ huynhtu_entry_tag()
 * *
 */
if (! function_exists('huynhtu_entry_tag')) {

    function huynhtu_entry_tag()
    {
        if (has_tag()) {
            echo '<div class="entry-tag">';
            printf(__('Tagged in %1$s', 'huynhtu'), get_the_tag_list('', ', '));
            echo '</div>';
        }

    }
}

function custom_rewrite_tag() {
    add_rewrite_tag('%khoa%', '([^&]+)');
    add_rewrite_tag('%phong%', '([^&]+)');
    
}
add_action('init', 'custom_rewrite_tag', 10, 0);

flush_rewrite_rules();
function custom_rewrite_rule() {
    add_rewrite_rule('^booking/([^/]*)/([^/]*)/?','index.php?page_id=38&khoa=$matches[1]&phong=$matches[2]','top');
    add_rewrite_rule('^booking/([^/]*)','index.php?page_id=32&khoa=$matches[1]','top');
    add_rewrite_rule('^booking','index.php?page_id=30','top');
    
}
add_action('init', 'custom_rewrite_rule', 10, 0);
