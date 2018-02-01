<?php /* Template Name: Home Page */ ?>

<?php get_header(); ?>
<div class="container">
    <div class="center"><h1 class="home-title">Music and Such</h1></div>

    <h2 class="center">Current Featured Albums</h2>
    <?php 
    wp_reset_postdata();
    $posts = get_field('featured_albums');
    // print_r($posts);
    if( $posts ): ?>
        <div class="featured-albums">
        <?php foreach( $posts as $post): // variable must be called $post (IMPORTANT) ?>
            <div class="featured-album">
                <?php setup_postdata($post); ?>
                <?php get_template_part('blocks/albumArtAlbumPage'); ?>
                
                    <!-- <a href="<?php the_permalink(); ?>">Go To Album</a> -->
            
            </div>
        <?php endforeach; ?>
        
        <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
    <?php endif; ?>

    </div>

    <div class="description">
        <h2>A basic site to showcase albums I've appreciated over the years.</h2>
    </div>

</div>


<?php get_footer(); ?>