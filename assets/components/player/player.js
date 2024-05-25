import './player.css';

export default class {
  constructor(name) {
    this.name = name;
  }

  /************************************************************************
   CONSTRUCT VIDEO URL AND PUSH IT TO THE IFRAME
   ************************************************************************/
  playVideo(videoId, start, stop) {
    let target = document.getElementById('youtubePlayer');
    let source = 'https://www.youtube.com/embed/' + videoId;
    if(start && start !== 0) {
      source += '?start=' + start;
    }
    if(stop && stop !== 0) {
      if(start && start !== 0) {
        source += '&';
      } else {
        source += '?';
      }
      source += 'end=' + stop;
    }
    target.src = source;
  }
}