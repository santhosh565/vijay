<?php get_header(); ?>

<?php
$args = array(
	'post_type'			=> 'post',
	'posts_per_page'    => 20,
	'orderby' 			=> 'ID',
	'order'     		=> 'DESC',
	 's' 				=> get_search_query()
);
$post_query = new WP_Query( $args );
$count = $post_query->found_posts;
?>
<div class="main-content">
	<div class="category-title search-title">
		<?php echo 'Search for - <div class="search-for">'.get_search_query().'</div>'; ?>
	</div>
  	<?php 
	if ( $post_query->have_posts() ) {
		while( $post_query->have_posts() ) : $post_query->the_post(); 
	?>	  
			<?php 
			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$image_size ); 
			$category = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'all' ) );
			?>
			<a href="<?php echo get_permalink(); ?>"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>"/></a>
			<div class="category-item-desc">
				<div class="category-item-title">
					<a href="<?php echo get_permalink(); ?>">
					<?php the_title(); ?>
					</a>
			  	</div>
			</div>
	  <?php 
		endwhile; 
		wp_reset_postdata();
	} else {
		echo '<div class="search-for" style="padding: 12px;">No Result Found</div>';
	}
  ?>
</div>
</div>
</div>
<?php get_footer(); ?>
