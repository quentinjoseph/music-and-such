<?php 
/* Template Name: Search Page */
get_header();

?>
search albums
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div><label class="screen-reader-text" for="search">Search for:</label>
        <input type="text" value="" name="search" id="search" placeholder="you did this" />
        <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form>
<?php get_footer();