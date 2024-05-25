import './serp.css';
import Playlist from "../playlist/playlist.js";

export default class {
  constructor(name) {
    this.name = name;
  }

  /************************************************************************
   ADD TO PLAYLIST
   ************************************************************************/
  /** To be able to catch click on items added dynamically we wired the click on a parent element */
  addToPlaylist() {
    document.querySelector('.card-list').addEventListener('click', function(event) {
      if (event.target.classList.contains('card-meta--add')) {
        const videoId = event.target.id.split('add-to-playlist_')[1];
        const data = {
          'videoId': videoId,
          'name': event.target.dataset.name,
          'description': event.target.dataset.description,
          'picture': event.target.dataset.picture,
          'video': event.target.dataset.video,
          'channel': event.target.dataset.channel,
        };
        const jsonData = JSON.stringify(data);
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/api/add-to-playlist', true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log('added-to-playlist_' + videoId)
            /** switch the link to a red heart and specific message */
            document.getElementById('added-to-playlist_' + videoId).style.display = 'block';
            document.getElementById('add-to-playlist_' + videoId).style.display = 'none';
            console.log('Playlist updated successfully');
            const playlist = new Playlist();
            playlist.refresh();
          }
        };
        xhr.send(jsonData);
      }
    });
  }
}