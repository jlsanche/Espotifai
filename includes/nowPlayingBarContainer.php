<?php


$songQuery = mysqli_query($con, "SELECT id FROM Songs ORDER BY RAND() LIMIT 10");

$resultArray = array();

while ($row = mysqli_fetch_array($songQuery)) {

    array_push($resultArray, $row['id']);
}

$jsonArray = json_encode($resultArray);

?>
<script>
    $(document).ready(function() {

        currentPlaylist = <?php echo $jsonArray; ?>;
        audioElement = new Audio();
        setTrack(currentPlaylist[0], currentPlaylist, false);


    });

    function setTrack(trackId, newPlaylist, play) {


        $.post("includes/handlers/ajax/getSongJson.php", {
            songId: trackId
        }, function(data) {

            let track = JSON.parse(data);
            console.log(track);
            audioElement.setTrack(track.path);

        });

        if (play) {
            audioElement.play();

        }

    }

    function playSong() {
        $(".controlButton.play").hide();
        $(".controlButton.pause").show();
        audioElement.play();
    }

    function pauseSong() {
        $(".controlButton.play").show();
        $(".controlButton.pause").hide();
        audioElement.pause();
    }
</script>

<div id="nowPlayingBarContainer">

    <div id="nowPlayingBar">

        <div id="nowPlayingLeft">

            <div class="content">

                <span class="albumLink">
                    <img class="albumArtwork" src="https://cdn2.bigcommerce.com/server4600/tol1d8sk/products/86870/images/213650/f2a63963-a4ed-47a7-b60d-7c25b77da11a__66970.1527922695.1280.1280.JPG?c=2" alt="">
                </span>

                <div class="trackInfo">

                    <span class="trackName">
                        <span>One Crunchy Tune </span>
                    </span>

                    <span class="artistName">
                        <span>EL YUNI</span>
                    </span>

                </div>

            </div>


        </div>

        <div id="nowPlayingCenter">

            <div class="content playerControls">

                <div class="buttons">

                    <button class="controlButton shuffle" title="Shuffle button">
                        <img src="assets/images/icons/shuffle.png" alt="Shuffle">
                    </button>

                    <button class="controlButton previous" title="Previous button">
                        <img src="assets/images/icons/previous.png" alt="Previous">
                    </button>
                    <button class="controlButton play" title="Play button" onclick="playSong()">
                        <img src="assets/images/icons/play.png" alt="Play">
                    </button>

                    <button class="controlButton pause" title="Pause button" onclick="pauseSong()" style="display: none">
                        <img src="assets/images/icons/pause.png" alt="Pause">
                    </button>
                    <button class="controlButton next" title="Next button">
                        <img src="assets/images/icons/next.png" alt="Next">
                    </button>
                    <button class="controlButton repeat" title="Repeat button">
                        <img src="assets/images/icons/repeat.png" alt="Repeat">
                    </button>


                </div>

                <div class="playbackBar">

                    <span class="progressTime current">0.00</span>

                    <div class="progressBar">

                        <div class="progressBarBg">

                            <div class="progress"></div>

                        </div>

                    </div>

                    <span class="progressTime remaining">0.00</span>

                </div>


            </div>

        </div>

        <div id="nowPlayingRight">

            <div class="volumeBar">

                <button class="controlButton volume" title="Volume button">
                    <img src="assets/images/icons/volume.png" alt="Volume">
                </button>

                <div class="progressBar">

                    <div class="progressBarBg">

                        <div class="progress"></div>

                    </div>

                </div>

            </div>


        </div>


    </div>

</div>