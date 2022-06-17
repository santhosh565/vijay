 <?php get_header(); ?>
	<?php	
		
	?>
	<div class="main-content">
		<?php if (have_posts()): while (have_posts()) : the_post();  $post_id = $post->ID?>
			<h1>
				<?php the_title(); ?>
			</h1>
			<div class="post-body">
				<?php $img_url = wp_get_attachment_url( get_post_thumbnail_id($post_id) );  $image_alt = get_post_meta( get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true); ?>
				<img src="<?php echo $img_url; ?>" alt="<?php echo $image_alt; ?>" style="width: 100%;">
				<?php the_content(); // Dynamic Content ?>
			</div>
		<?php endwhile; ?>
		<?php else: ?>
			<h1><?php _e( 'Sorry, nothing to display.', '' ); ?></h1>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>
