import './form.css';
import Playlist from "../playlist/playlist.js";

export default class {
  constructor(name) {
    this.name = name;
  }

  /************************************************************************
   ADD TO PLAYLIST
   ************************************************************************/
  /** To be able to catch click on items added dynamically we wired the click on a parent element */
  refreshPlaylist() {
    const removePlaylistItemBtn = document.getElementById('removePlayListItemBtn');
    if (removePlaylistItemBtn) {
      removePlaylistItemBtn.addEventListener('click', function (event) {
        const playlist = new Playlist();
        playlist.refresh();
      });
    }
  }

  addListenerOnRemoveButton(modalSelector) {
    modalSelector.addEventListener('click', function (event) {
      if (event.target.id === 'removePlayListItemBtn') {
        const playlist = new Playlist();
        playlist.refresh();
      }
      if (event.target.id === 'editPlayListItemBtn') {
        const playlist = new Playlist();
        playlist.refresh();
      }
    });
  }
}