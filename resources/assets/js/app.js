// First we will load all of this project's JavaScript dependencies which
// includes Vue and other libraries. It is a great starting point when
// building robust, powerful web applications using Vue and Laravel.
import './bootstrap';

// Initialise Foundation.
$(document).foundation();

// Scroll Reveal.
ScrollReveal().reveal('[data-scrollreveal]');

// Toggle the header search bar.
$(document).on('click', '[data-toggle-search-trigger]', (e) => {
  e.preventDefault();
  $('[data-toggle-search]').slideToggle();
});

// Prefetch and transition to the next page.
(() => {
  'use strict';

  // Prefetch a url on hover.
  $(document).on('mouseover', 'a', (e) => {
    // New prerender url.
    const url = $(e.currentTarget).attr('href');

    if (url && url.length > 1) {
      // Prerender <Link> element.
      const prerender = $('#prerender');

      // Create a new <link> element and apply the prerender url.
      if (prerender.length === 0) {
        $('<link id="prerender" rel="prefetch prerender" href="' + url + '">').appendTo('body');

        return;
      }

      // Prerender already contains the hovered link url.
      if (prerender.attr('href') === url) {
        return;
      }

      prerender.attr('href', url);
    }
  });

  // Transition out the current page.
  $(document).on('click', 'a', (e) => {
    // Redirect url.
    const url = $(e.currentTarget).attr('href');

    if (url && url.length > 1) {
      e.preventDefault();

      $('body').addClass('fadeOut');

      setTimeout(() => {
        window.location.href = url;
      }, 150);
    }
  });
})();
