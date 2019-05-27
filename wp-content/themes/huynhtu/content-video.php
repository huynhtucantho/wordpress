<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php huynhtu_entry_header(); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			if ( is_single() ) :
				huynhtu_entry_tag();
			endif;
		?>
	</div>
</article>