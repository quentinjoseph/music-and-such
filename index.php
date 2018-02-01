<?php get_header(); ?>

<div class="blog-title"><h1>Music and Such</h1></div>

<?php if(have_posts()):
  while( have_posts()) : the_post(); ?>
	
	<?php get_template_part('content', get_post_format());  ?>
	
  
  <?php endwhile; endif; ?>


<?php get_footer(); ?>