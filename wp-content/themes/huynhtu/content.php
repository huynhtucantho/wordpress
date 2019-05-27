<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="entry-thumbnail">
 			<?php huynhtu_thumbnail('thumbnail'); ?>
        </div>
        <header class="entry-header">
 			<?php huynhtu_entry_header(); ?>
 			<?php huynhtu_entry_meta() ?>
        </header>
		<div class="entry-content">
		        <?php huynhtu_entry_content(); ?>
		        <?php ( is_single() ? huynhtu_entry_tag() : '' ); ?>
		</div>

<h1>Hello</h1>
<?php
var_dump(get_query_var('khoa'));
var_dump(get_query_var('phong'));

?>
</article>

