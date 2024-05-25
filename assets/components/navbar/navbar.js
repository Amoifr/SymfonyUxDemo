import './navbar.css';


export default class {
  constructor(name) {
    this.name = name;
  }

  navLinkListener() {
    document.querySelector('.sticky-header').addEventListener('click', function (event) {
      if (event.target.classList.contains('navBarLink')) {
        const input = document.getElementById('categoryPlaylistInput');
        input.value = event.target.getAttribute('data-category');
        input.dispatchEvent(new Event('change', {bubbles: true}));
      }
    });
  }
}