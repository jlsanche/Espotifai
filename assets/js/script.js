let currentPlaylist = [];
let shufflePlaylist = [];
let tempPlaylist = [];
let audioElement = '';
let mouseDown = false;
let currentIndex = 0;
let repeat = false;
let shuffle = false;
let userLoggedIn;

function openPage(url) {

    if (url.indexOf("?") == -1) {
        url = url + "?";
    }
    let encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
    console.log(encodedUrl);
    $("#mainContent").load(encodedUrl);
    $("body").scrollTop(0);
    history.pushState(null, null, url);
   

}

function formatTime(seconds) {
    let time = Math.round(seconds);
    let minutes = Math.floor(time / 60);
    var seconds = time - (minutes * 60);

    var extraZero = (seconds < 10) ? '0' : '';

    return minutes + ":" + extraZero + seconds;
}


function updateTimeProgressBar(audio) {
    $(".progressTime.current").text(formatTime(audio.currentTime));
    $(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

    let progress = audio.currentTime / audio.duration * 100;
    $(".playbackBar .progress").css("width", progress + "%");
}


function updateVolumeProgressBar(audio) {

    let volume = audio.volume * 100;
    $(".volumeBar .progress").css("width", volume + "%");

}

function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');  // built-in html5 audio element 

    this.audio.addEventListener('ended', function () {
        nextSong();
    });
    this.audio.addEventListener('canplay', function () {
        let duration = formatTime(this.duration)
        $(".progressTime.remaining").text(duration);

    });

    this.audio.addEventListener('timeupdate', function () {
        if (this.duration) {
            updateTimeProgressBar(this);
        }
    })

    this.setTrack = function (track) {
        this.currentlyPlaying = track;
        this.audio.src = track.path;
    }

    this.play = function () {

        this.audio.play();
    }

    this.pause = function () {
        this.audio.pause();
    }

    this.setTime = function (seconds) {
        this.audio.currentTime = seconds;
    }

    this.audio.addEventListener('volumechange', function () {
        updateVolumeProgressBar(this);
    })

}