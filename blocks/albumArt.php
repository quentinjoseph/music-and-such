 <!-- Album Art -->
            
        <?php $artwork = get_field('album_artwork'); ?>
        <?php $q=0; ?>
        <?php foreach ($artwork as $art): ?>
            <a href="<?php echo $art['sizes']['large'] ?> " data-lightbox="album-<?php echo get_the_ID(); ?>"> 
                <div class="album-pic <?php echo ($q > 0)  ?  'no-show' : ' '; ?> " style="background-image:url('<?php echo $art['sizes']['medium'] ?>');"></div>
            </a>
            <?php $q++; ?>
        <?php endforeach; ?>
