const audioPlaylist = document.querySelector(".wp-radio-player-himu-playlist-wrapper");
const showPlaylistBtn = document.querySelector(".wp-radio-player-himu-audio-box-play-list");
const hidePlaylistBtn = document.querySelector("#close-playlist");

showPlaylistBtn.addEventListener("click", () => {
  audioPlaylist.classList.toggle("show");
});

hidePlaylistBtn.addEventListener("click", () => {
  showPlaylistBtn.click();
});


const audio = document.querySelector('audio');
const playPauseBtn = document.querySelector('.wp-radio-player-himu-audio-box-play-btn');
const songList = document.querySelector('.wp-radio-player-himu-playlist-items');
const title = document.querySelector('.wp-radio-player-himu-audio-box-play-name-item');
const host = document.querySelector('.wp-radio-player-himu-audio-box-play-name-host');

const playing = document.querySelector('.playing');

let songArray = [];
let songHeading = '';
let songIndex = 0;
let isPlaying = false;

function loadAudio() {
  audio.src = songArray[songIndex];

  let songListItems = songList.getElementsByTagName('li');
  songHeading = songListItems[songIndex].getAttribute('data-name');
  songHost = songListItems[songIndex].getAttribute('data-host');
  title.innerText = songHeading;
  host.innerText = songHost;

  // highlight
  for (i = 0; i < songListItems.length; i++) {
    songListItems[i].classList.remove('active');
  }

  songList.getElementsByTagName('li')[songIndex].classList.add('active');
}

function loadSongs() {
  let songs = songList.getElementsByTagName('li');
  for (i = 0; i < songs.length; i++) {
    songArray.push(songs[i].getAttribute('data-src'));
  }

  loadAudio();
}

loadSongs();

function playAudio() {
  audio.play();
  playPauseBtn.querySelector("i").innerText = "pause";
  isPlaying = true;
}

function pauseAudio() {
  audio.pause();
  playPauseBtn.querySelector("i").innerText = "play_arrow";
  isPlaying = false;
}

playPauseBtn.addEventListener('click', function () {
  if (isPlaying) {
    pauseAudio();
  } else {
    playAudio();
  }
}, false);

songList.addEventListener('click', function (e) {
  songIndex = e.target.closest('li').getAttribute('data-index');
  loadAudio();
  playAudio();
}, false);

audio.addEventListener('ended', function () {
  pauseAudio();
});



const progressArea = document.querySelector(".wp-radio-player-himu-audio-box-play-bar-area");
const progressBar = document.querySelector(".wp-radio-player-himu-audio-box-play-bar-length");


// update progress bar
audio.addEventListener("timeupdate", (e) => {
  const currentTime = e.target.currentTime;
  const duration = e.target.duration;
  let progressWidth = (currentTime / duration) * 100;
  progressBar.style.width = `${progressWidth}%`;

  let musicCurrentTime = document.querySelector(".current");
  let musicDuration = document.querySelector(".duration");

  audio.addEventListener("loadeddata", () => {

    // update some duration
    let audioDuration = audio.duration;
    let totalMin = Math.floor(audioDuration / 60);
    let totalSec = Math.floor(audioDuration % 60);
    if (totalSec < 10) {
      totalSec = `0${totalSec}`;
    }
    musicDuration.innerText = `${totalMin}:${totalSec}`;
  });

  // update playing song current time
  let currentMin = Math.floor(currentTime / 60);
  let currentSec = Math.floor(currentTime % 60);
  if (currentSec < 10) {
    currentSec = `0${currentSec}`;
  }
  musicCurrentTime.innerText = `${currentMin}:${currentSec}`;
});

progressArea.addEventListener("click", (e) => {
  let progressWidthVal = progressArea.clientWidth;
  let clickedOffSetX = e.offsetX;
  let songDuration = audio.duration;

  audio.currentTime = (clickedOffSetX / progressWidthVal) * songDuration;
  playAudio();
});