import './playlist.css';
import Player from '../player/player.js';
import Form from "../form/form.js";

export default class {
  constructor(name) {
    this.name = name;
    this.refresh = this.refresh.bind(this);
  }

  /************************************************************************
   REFRESH PLAYLIST
   ************************************************************************/
  refresh() {
    const input = document.getElementById('updatePlaylistBtn');

    input.dispatchEvent(new Event('click', { bubbles: true }));
    this.playlistItemInteractionListener();
  }

  /************************************************************************
   PLAY ITEM FROM PLAYLIST OR OPEN MODAL
   ************************************************************************/
  playlistItemInteractionListener() {
    document.querySelector('.playlist-container').addEventListener('click', function(event) {
      if (event.target.classList.contains('play-button')) {
        let parentArticle = event.target.closest('.playlist-container-profile');
        if (parentArticle && parentArticle.dataset.videoid) {
          let videoId = parentArticle.dataset.videoid;
          let start = parentArticle.dataset.start;
          let stop = parentArticle.dataset.stop;
          const player = new Player();
          player.playVideo(videoId, start, stop);
        }
      }
      if (event.target.id.includes('openModalBtn_')) {
        const modalSelector = document.getElementById("editContentModal");

        let targetId = event.target.id.split("openModalBtn_")[1];
        modalSelector.style.display = "block";
        this.fetchContent(targetId);
      }
    }.bind(this));
  }

  /************************************************************************
   EDIT MODAL
   ************************************************************************/
  edit(modalSelector, targetId) {
    const closeButton = document.getElementsByClassName("close")[0];

    closeButton.onclick = function() {
      modalSelector.style.display = "none";
      const form = new Form();
      form.refreshPlaylist();
    }
    window.onclick = function(event) {
      if (event.target === modalSelector) {
        modalSelector.style.display = "none";
      }
    }

    if(targetId) {
      this.fetchContent(targetId);
    }
  }

  fetchContent(targetId) {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (this.readyState === 4 && this.status === 200) {
        document.getElementById("modalContent").innerHTML = this.responseText;
      }
    };
    xhr.open("GET", "/api/edit-playlist-item/" + targetId + "", true);
    xhr.send();
  }
}