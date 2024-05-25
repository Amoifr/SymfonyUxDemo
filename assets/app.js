// Import Stimulus and related controllers
import './bootstrap.js';

// Import layout
import './layout/layout.css';

// Import components

import './components/modal/modal.css';
import './components/searchEngine/searchEngine.css';
import Playlist from "./components/playlist/playlist.js";
import Serp from "./components/serp/serp.js";
import Form from "./components/form/form.js";
import Navbar from "./components/navbar/navbar.js";

// Wait for the DOM to be fully loaded
document.addEventListener("DOMContentLoaded", function() {
    const modalSelector = document.getElementById("editContentModal");
    const navbar = new Navbar();
    navbar.navLinkListener();
    const serp = new Serp();
    serp.addToPlaylist();
    const playlist = new Playlist();
    playlist.edit(modalSelector);
    playlist.playlistItemInteractionListener();
    const form = new Form();
    form.addListenerOnRemoveButton(modalSelector);
});

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
