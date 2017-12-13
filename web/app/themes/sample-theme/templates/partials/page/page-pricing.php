<?php the_title(); ?>
<?php the_content(); ?>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sample-theme'), 'after' => '</p></nav>']); ?>
