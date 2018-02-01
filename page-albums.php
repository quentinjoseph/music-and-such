
<?php 
/* Template Name: Album List */
get_header();

?>




<div class="container">
    <?php $trackSearch = 0; ?>
    <form id="search-form" action="" method="GET">
        <input type="" name="search" id="search" placeholder="search">
        <button class='q-btn btn secondary' type="submit">Search</button>
        <select name="trackSearch" id="trackSearch">
            <option value="0">Album</option>
            <option value="1">Track</option>
        </select>
    </form>
    






    <?php
// filter
    function chickenfoot( $where ) {
    global $wpdb;
    $where = str_replace("meta_key = 'tracks_%", "meta_key LIKE 'tracks_%", $wpdb->remove_placeholder_escape( $where));

    return $where;
}
    add_filter('posts_where', 'chickenfoot', 99);



    $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        // The Query
        $args = array(
            'post_type' => 'full_albums',
            'paged' => $paged,
            'orderby' => 'post_title',
            'order' => ( isset($ASC) && isset($DESC)) ? ($ASC && $DESC) : 'ASC', (($ASC=true) && ($DESC=false)),
            'posts_per_page' => isset($number) ? $number : 10,
            'meta_query'    => array(
                'relation'      => 'OR', 
            )
        );
        
    //FORM DATA
        $number= isset($number) ? $number : 10;
        if(isset($_GET['ascDesc'])){
        $upDown = $_GET['ascDesc'];
        $number = isset($number) ? $_GET['numPerPage'] :  10;
        $args['posts_per_page']=$number;
        $args['order']=$upDown;
        
            if($upDown == 'ASC'){
                $ASC=True;
                $DESC=False;
            }else{
                $ASC=False;
                $DESC=True;
            }      
        }
        
        if(isset($_GET['numPerPage'])){
        $number = $_GET['numPerPage'];
        $args['posts_per_page']=$number;
        //echo $number;
        //print_r($args);
        }

        
        if(isset($_GET['trackSearch'])){
        $trackSearch = $_GET['trackSearch'];
        //echo $trackSearch;
        //print_r($args);
        }
        if (array_key_exists('search',$_REQUEST)): 
            $search = $_REQUEST['search'];
            if ($trackSearch == 0){
                $args['s'] = $search;
                //print_r($args);
            }else{
            $args['meta_query'][]=array(
                'key'       => 'tracks_%_track_name',
                'value'     => $search,
                'compare'   => 'LIKE'
            );
            }
           //print_r($args) ;
        endif;
    

        $wp_query = new WP_Query( $args ); 
        //print_r($wp_query);
    ?>
    <!-- forms -->
        <form id="ascDescForm" action="" method="GET">
        <label for="asc">Ascending List</label>
        <input type="radio" name="ascDesc" id="ascDesc" value="ASC" <?php echo $ASC ? 'checked' : ' ' ?> >
        <label for="desc">Descending List</label>
        <input type="radio" name="ascDesc" id="ascDesc" value="DESC" <?php echo $DESC ? 'checked' : ' ' ?>>
        
        <label for="numberOfPostOnPage">Posts Per Page</label>
            <select onchange="form.submit()" name="numPerPage" id="numPerPage">
                <option value=""></option>
                <option value="2" <?php echo $number != 2 ? '' : 'selected' ?>>2</option>
                <option value="5" <?php echo $number != 5 ? '' : 'selected' ?> >5</option>
                <option value="10" <?php echo $number != 10 ? '' : 'selected' ?> >10</option>
            </select>
        </form>

<h2 class="title">All Albums</h2>
<p class="title">Click album art or album name for for info on the album and to listen to tracks</p>

<?php if ( $wp_query->have_posts() ) : ?>
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
        <?php $artist = get_field('artist'); ?>
        <?php $title = get_the_title(); ?>

<!-- Get Youtube Video ID -->
            <!-- //youtube code that grabs video id of first video of specified search -->
         <?php
            $yt_search = "$artist $title full album" ;
            //echo $yt_search;
            $yt_source = file_get_contents('https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&order=relevance&q='.urlencode($yt_search).'&key=AIzaSyCfR2wGmzhCbGyzWcAK1iGMb3DTVqHeBe0');
            $yt_decode = json_decode($yt_source, true);
            //print_r($yt_decode);
            if ($yt_decode['pageInfo']['totalResults']>0) {
                if (array_key_exists('videoId', $yt_decode['items'][0]['id'])){
                    if (strlen($yt_decode['items'][0]['id']['videoId'])>5) {
                    $yt_videoid = trim($yt_decode['items'][0]['id']['videoId']);
                    $videoId = $yt_videoid;
                    $isVid = true;
                    //echo $yt_videoid;
                    }
                }else if (strlen($yt_decode['items'][0]['id']['playlistId'])>5){
                    $yt_videoid = trim($yt_decode['items'][0]['id']['playlistId']);
                    //echo $yt_videoid;
                    $videoId = $yt_videoid;
                    $isVid = false;
                    //echo $videoId;
                }
            }
            ?>
            <?php $videoURL = $isVid ? "https://www.youtube.com/watch?v=" . $videoId : "https://www.youtube.com/playlist?list=" . $videoId; ?>
            <?php //echo $videoURL; ?>
   
    <!-- Album Block  -->
    <div class="album">

        <div class="top">
        <!-- Artist -->
        <div class="artist ">
            <a class="artist-link" href="<?php the_permalink(); ?>"><h1> <?php echo $title; ?></a>
                <a <?php echo $isVid ? 'data-lity' : '' ?> href="<?php echo $videoURL; ?>" target="<?php echo $isVid ? '' : '_blank'  ?>" >
                    <i class="fa fa-youtube-play" aria-hidden="true"></i> 
                </a>
            </h1>
            <h3> <?php echo $artist ?> </h3>
        </div>

        </div>

        <div class="bottom">
            <!-- Album Art -->
            <div class="album-art">
                <div class=art-frame>
                    <?php get_template_part('blocks/albumArtAlbumPage'); ?>
                </div>
            </div>  

            <!-- Album Tracks -->
            <!-- <div class="tracks">
               
                <?php // $tracks = get_field('tracks'); ?>
                    <?php //$i=1; ?>
                    <?php //foreach ($tracks as $track): ?>
                        <div class="track">
                           <h3> <?php // echo $i; ?> - <?php echo $track['track_name']; ?> </h3>
                        </div>
                        <?php // $i++; ?>
                    <?php // endforeach; ?>
                
            </div>  -->
        </div>

    </div>
    <?php endwhile; ?>
    <div class="pagination"><?php previous_posts_link(); ?>
        <?php next_posts_link(); ?>
          
    </div>
   <?php 
        
	/* Restore original Post Data */
	wp_reset_postdata();
?>
</div>



<?php else:  ?>
<?php endif; ?>
<?php get_footer(); ?>