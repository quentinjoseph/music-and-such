// lightbox settings
console.log('hooray for javascript🎉');
lightbox.option({
    'resizeDuration': 200,
    'wrapAround': true
  })

  //AIzaSyCfR2wGmzhCbGyzWcAK1iGMb3DTVqHeBe0 youtube api key

// making radio buttons do stuff
var radioForm = document.getElementById("ascDescForm");
var selectForm = document.getElementById("selectNumber");
var radioButtons = $('input:radio');
var selectOptions = $("#numPerPage option:selected");
radioButtons.on("click", function () {
  radioForm.submit();
});


// WP API STUFF

// variables
var pushButton = document.getElementById('wp-api-btn');
var yerp = document.getElementById('yerp');

//making button clickable so a thing happens...
$('#wp-api-btn').on("click", function(){

// call to wp api
  $.get("http://music-and-such:8888/wp-json/wp/v2/full_albums", function(data){
  console.log(data);
    // getting ACF data (must use plugin for this)
      // for loop for WP content
      for (i = 0; i < data.length; i++) {
        var albums = data[i].title.rendered;
        var links = data[i].link;
        var tracks = data[i].acf.tracks;
        var icon = data[i].acf.album_artwork[0].sizes.thumbnail;
        $('#yerp').append('<a href="' + links +'"><h2 class="album-title-test">' + albums + '</h2><img src="'+ icon + '"></a>');

          // nested for loop for ACF data 
          for (q = 0; q < tracks.length; q++) {
            var albumTracks = tracks[q].track_name;
            $('#yerp').append('<h4>' + albumTracks + '</h4>');
          }
        }
    })
  .done(function(){
    console.log('wp api done');
    pushButton.remove();
  })
  .fail(function(){
    console.log('failure');
  })
});

