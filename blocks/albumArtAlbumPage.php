 <!-- Album Art Album Page-->
            
        <?php $artwork = get_field('album_artwork'); ?>
        <?php $q=0; ?>
        <?php foreach ($artwork as $art): ?>
            <a href="<?php the_permalink(); ?>"> 
                <div class="album-pic <?php echo ($q > 0)  ?  'no-show' : ' '; ?> " style="background-image:url('<?php echo $art['sizes']['medium'] ?>');"></div>
            </a>
            <?php $q++; ?>
        <?php endforeach; ?>