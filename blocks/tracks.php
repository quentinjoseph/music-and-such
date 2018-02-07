<!-- Album Tracks -->
<?php $artist = get_field('artist'); ?>

<div class="tracks single-page-track">

  <?php $butts = get_the_title(); ?>
  <!-- <ul class="track-table"> -->
  <?php $tracks = get_field('tracks'); ?>
  <?php $i=1; ?>
  <?php foreach ($tracks as $track): ?>
  <?php
  $trackname = $track['track_name'];
  $yt_search = "$butts $artist $trackname video";
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
    }
  };
  ?>

  <?php $singleVideoURL = $isVid ? "https://www.youtube.com/watch?v=" . $videoId : "https://www.youtube.com/playlist?list=" . $videoId; ?>

  <div class="track single-page-track">
  <a <?php echo $isVid ? 'data-lity' : '' ?> href="<?php echo $singleVideoURL; ?>" target="<?php echo $isVid ? '' : '_blank' ?>" ><h3> <?php echo $i; ?> - <?php echo $track['track_name']; ?> </a> 
  <!-- <i class="fa fa-play-circle-o" aria-hidden="true"></i> -->
  </h3>
  </div>
  <?php $i++; ?>
  <?php endforeach; ?>
  <!-- </ul> -->
</div> 