<?php get_header(); ?>
<?php $artwork = get_field('album_artwork'); ?>

<div class="container">
    
    <?php $artist = get_field('artist'); ?>
    <?php $artistWiki = str_replace(' ','_', $artist); ?>
            <div class="single-artist">
                <h1 class="single-album-title"><?php echo the_title(); ?></h1>
                <h2><a href="https://en.wikipedia.org/wiki/<?php echo $artistWiki; ?>" target="_blank"><?php echo $artist ?></a></h2>
            </div>
            <p class="title">Click album art for larger view.  Click tracks to hear/see youtube video of clicked song. Click artist title to go to their Wiki Page.</p>
    <div class="wrapper">
        <div class="single-left">
            
            <div class="album-art">
                <div class=art-frame>
                    <?php $q=0; ?>
                    <?php foreach ($artwork as $art): ?>
                        <a href="<?php echo $art['sizes']['large'] ?> " data-lightbox="album"> 
                            <div class="album-pic <?php echo ($q > 0)  ?  'no-show' : ' '; ?> " style="background-image:url('<?php echo $art['sizes']['medium'] ?>');"></div>
                        </a>
                        <?php $q++; ?>
                    <?php endforeach; ?>
                </div>
            </div>  
            <?php get_template_part('blocks/tracks'); ?>
        </div>

        <div class="single-right">
            <?php 
            $artistURLd = str_replace(' ', '%20', $artist);
            $bioSearch = file_get_contents('http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=' . $artistURLd . '&api_key=c3b254cd58b275bf0538636f72970a49&format=json');
            $bioDecode = json_decode($bioSearch, true);
            $pic = $bioDecode['artist']['image'][3]['#text'];
            $bio = $bioDecode['artist']['bio']['summary'];
            ?>
            
            <p> <?php echo $bio ?></p>
            <div class="bioPic" style="background-image: url('<?php echo $pic ?>')"></div>
        </div>
    </div>
</div>

<?php get_footer(); ?>