<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<section class="torso has-global-padding is-layout-constrained">
					<?php the_content(); ?>
				</section>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php _e( 'This page contains no content.', 'gute') ?></p>
		<?php endif; ?>
	</main>
</div>

<?php get_footer(); ?>