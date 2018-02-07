<?php get_header(); ?>
  <?php $artist = get_field('artist'); ?>
<?php $artwork = get_field('album_artwork'); ?>
      <!-- calling out to Last.FM for information on selected artist -->
      <?php 
      $albumTitle = get_the_title();
      //echo $albumTitle;
      $titleURLd = str_replace(' ', '%20', $albumTitle);
      //echo $titleURLd;
      $artistURLd = str_replace(' ', '%20', $artist);
      //echo $artistURLd;
      $bioSearch = file_get_contents('http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=' . $artistURLd . '&api_key=c3b254cd58b275bf0538636f72970a49&format=json');
      $albumSearch = file_get_contents('http://ws.audioscrobbler.com/2.0/?method=album.getinfo&api_key=c3b254cd58b275bf0538636f72970a49&artist=' . $artistURLd . '&album=' . $titleURLd . '&format=json');
      $tracksAndSuch = json_decode($albumSearch, true);
      print_r($tracksAndSuch);

      //print_r($bioSearch);
      $summary = array_key_exists('wiki', $tracksAndSuch['album']) ? $tracksAndSuch['album']['wiki']['summary'] : '';
      $tracksFM = $tracksAndSuch['album']['tracks']['track'];
      $bioDecode = json_decode($bioSearch, true);
      $pic = $bioDecode['artist']['image'][3]['#text'];
      $bio = $bioDecode['artist']['bio']['summary'];
      ?>

<div class="container">
  


  <!-- setting up variable for use with wikipedia -->
  <?php $artistWiki = str_replace(' ','_', $artist); ?>
    <!-- single artist page title and artist info -->
    <div class="single-artist">
    <h1 class="single-album-title"><?php echo the_title(); ?></h1>
    <h2><a class="artist-link" href="https://en.wikipedia.org/wiki/<?php echo $artistWiki; ?>" target="_blank"><?php echo $artist ?></a></h2>
    </div>

    <!-- page guide -->
    <p class="title ">Click album art for larger view.  Click tracks to hear/see youtube video of clicked song. Click artist title to go to their Wiki Page.</p>

  <!-- content wrapper -->
  <div class="wrapper">

    <!-- left portion of content -->
    <div class="single-left">

      <!-- getting album artwork -->
        <?php $q=0; ?>
        <?php foreach ($artwork as $art): ?>
        <a href="<?php echo $art['sizes']['large'] ?> " data-lightbox="album"> 
          <div class="album-pic <?php echo ($q > 0)  ?  'no-show' : ' '; ?> " style="background-image:url('<?php echo $art['sizes']['medium'] ?>');"></div>
        </a>
        <?php $q++; ?>
        <?php endforeach; ?>

      <!-- getting tracks -->
       <?php //foreach ($tracksFM as $track): ?>
      <!-- <h3><?php //echo $track['name'] ?></h3> -->
      <?php //endforeach; ?>
      <?php get_template_part('blocks/tracks'); ?>
    </div>

    <!-- right portion of content -->
    <div class="single-right">


      <p> <?php echo $bio ?></p>
      <?php if($summary) : ?>
      <p> <?php echo $summary ?></p>
      <?php endif; ?>
      <div class="bioPic" style="background-image: url('<?php echo $pic ?>')"></div>
    </div>

  </div>

</div>

<?php get_footer(); ?>