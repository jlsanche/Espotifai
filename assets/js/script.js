let currentPlayList = [];
let audioElement ='';

function Audio() {

    this.currentlyPlaying;
    this.audio = document.createElement('audio');  // built-in html5 audio element 

    this.setTrack = function(src) {
        this.audio.src = src;
    }

    this.play = function() {

        this.audio.play();
    }

    this.pause = function () {
            this.audio.pause();
    }

}